<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php

	global $wpdb;
			
	$track_posts_perpage 		= get_option('atp_search_track_limits') ? get_option('atp_search_track_limits'):'10';
	$al_posts_perpage	 		=  get_option('atp_search_album_limits') ? get_option('atp_search_album_limits') :'-1';
	$ar_posts_perpage 	 		=  get_option('atp_search_artist_limits') ? get_option('atp_search_artist_limits') :'-1';
	$search_pagination_option 	= get_option('atp_search_pagination') ? get_option('atp_search_pagination') :''; 
	$iva_albunm_postids 		= $attachment_posts = $album_ids = array();
				
	$tracks_pagination 	 = '';
	$error = true; 
		
	$keyword = $_GET['iva_search_input'] ? $_GET['iva_search_input'] :'';
				
	if( $keyword ) {
		$results = '';
		
		// Pagination
		if ( get_query_var('paged') ) {
			$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
			$paged = get_query_var('page');
		} else {
			$paged = 1;  
		}
						
		// 
		$sql = "SELECT * FROM $wpdb->posts WHERE post_title LIKE '%$keyword%'
				AND ( post_type='attachement' OR post_mime_type='audio/mpeg') 
				AND ( post_status = 'inherit' OR post_status = 'publish')";
					
		$results = $wpdb->get_results( $sql );
					
		if( count( $results ) > 0  ) {
			$track_parent_id = ''; 
			$iva_track_ids 	 = $attachment_posts = array();
						
			foreach( $results as $result ) {
				$track_ids[] 		= $result->ID;
				$track_parent_id[]  = $result->post_parent;
			}
						
			// Track ids from media
			$track_ids = array_unique( $track_ids );
			
			// Fetching track ids from posttype 'albums'
			$track_args = array( 'post_type'=> 'albums');
	
			$iva_track_query = new WP_Query( $track_args );
			if ( $iva_track_query->have_posts() ) : 
				while ( $iva_track_query->have_posts() ) : $iva_track_query->the_post();

				$audio_posttype_option	= get_post_meta( $post->ID,'audio_posttype_option',true );

				if( $audio_posttype_option == 'player' ){
					$audiolist  = get_post_meta( $post->ID, 'audio_upload', true ) ? get_post_meta( $post->ID, 'audio_upload', true ) : '';
					$audio_list = explode( ', ', $audiolist );

					foreach( $track_ids as $trackid ){
						if( in_array( $trackid, $audio_list ) ) {
							$iva_track_ids[] = $trackid;
						}
					}
				}

				endwhile; 
	
				wp_reset_query();
				else :
			endif;
						
			// Track ids from posttype 'albums'
			$iva_track_ids = array_unique( $iva_track_ids );
						
			foreach( $iva_track_ids as $attachment_id ) {
				$attachment 			= get_post( $attachment_id );
				$attachment_title 		= $attachment->post_title;
				$attachment_posts[] 	= $attachment->post_parent;
			}
						
			// Fetching Post ids those having attachements
			$attachment_posts = array_unique( $attachment_posts );
					
		}
					

		// Album Meta Query
		$album_meta_args =  array(
			'post_type' => 'albums',
			'meta_query'=> array(
			'relation'  => 'OR',
				array(
					'key'     => 'audio_soundcloud_title',
					'value'   => $keyword,
					'compare' => 'LIKE'
				),
				array(
					'key'     => 'audio_mp3',
					'value'   => $keyword,
					'compare' => 'LIKE'
				)
			),
		);

		$tracks_output = '';
		$album_meta_query = new WP_Query( $album_meta_args );
						
		if ( $album_meta_query->have_posts() ) : 
		
			$soundcloudcount = $externalmp3count = 0; 
			
			while ( $album_meta_query->have_posts() ) : $album_meta_query->the_post();

			$audio_posttype_option			= get_post_meta( $post->ID,'audio_posttype_option',true );
			$audio_soundcloud_title 		= get_post_meta( $post->ID,'audio_soundcloud_title',true);
			$audio_soundcloud_title_label 	= $audio_soundcloud_title ? $audio_soundcloud_title :__('Title Label','musicplay');
			$audio_soundcloud_url 			= get_post_meta( $post->ID,'audio_soundcloud_url',true);
			$audio_mp3list					= get_post_meta( $post->ID,'audio_mp3',true ) ? get_post_meta( $post->ID,'audio_mp3',true ) :'';
			$audio_mp3list_count			= count( $audio_mp3list );
				
			// Fetching album posts having soundcloud urls and external mp3 urls
			$album_ids[] = $post->ID;
						
			if ( $audio_posttype_option  == 'soundcloud' ) {
				if( $audio_soundcloud_url != '' ){
					if ( preg_match("/$keyword/i", $audio_soundcloud_title )) {
						$soundcloudcount++;
					}
				}
			}
			if ( $audio_posttype_option  == 'externalmp3' ) {
				if( $audio_mp3list !='' && $audio_mp3list_count > 0) {
					foreach( $audio_mp3list as $mp3_list ) {
						if ( preg_match("/$keyword/i", $mp3_list['mp3title'])) {
							$externalmp3count++;
						}
					}
				}
			}

			endwhile; 

			wp_reset_query();
			else :
		endif;


		$iva_albunm_postids = array_merge( $attachment_posts,$album_ids );
		
		global $externalmp3count,$attachment_posts,$soundcloudcount;
		
		$total_postscount = $externalmp3count + $soundcloudcount + count( $attachment_posts );
						
		if( $iva_albunm_postids ) {
		
			// Query to fetch all posts that are having attachements
			$album_meta_args =  array(  
									'post_type' => 'albums',
									'post__in'  => $iva_albunm_postids,
								);
				 
			$album_meta_query = new WP_Query( $album_meta_args );
			
			if ( $album_meta_query->have_posts() ) : 
			
				$error = false;
			
				$pageCount = ceil( $total_postscount / $track_posts_perpage );
				$current_page 	= isset( $_GET['page'] ) ? intval( $_GET['page'] ) :'';
				
				if ( get_query_var('paged') ) {
					$current_page = get_query_var('paged');
				} elseif ( get_query_var('page') ) {
					$current_page = get_query_var('page');
				} else {
					$current_page = 1;  
				}
				
				if ( empty( $current_page ) || $current_page<=0 ) $current_page = 1;
					
					$max_pagenum = $current_page * $track_posts_perpage;
					$min_pagenum = ( $current_page-1 ) * $track_posts_perpage;
				
				if( $pageCount > 1 ){
					$pagenum_link 	= html_entity_decode( get_pagenum_link() );
					$page_link 		= $pagenum_link;
					
					$page_link_perma = true;
					
					if ( strpos( $page_link, '?' )!== false )
					
					$page_link_perma = false;
					
					$tracks_pagination = '<div class="clear"></div><div class="pagination">';
					for ( $j=1; $j<= $pageCount; $j++){
						if ( $j == $current_page )
							$tracks_pagination .= '<span class="current"> '.$j.' </span>';
						else
							$tracks_pagination .= '<a class="inactive" href="'.$page_link. ( ( $page_link_perma?'?':'&amp;') ). 'page='.$j.'">'.$j.'</a>';
					}
					$tracks_pagination .= '</div>';
				}// Tracks pagination 
					
				$i = $k = 0;
				
				$start = 1;
				
				while ( $album_meta_query->have_posts() ) : $album_meta_query->the_post();
											
					$album_post_title 				= get_the_title( $post->ID );
					$audio_soundcloud_title 		= get_post_meta( $post->ID,'audio_soundcloud_title',true);
					$audio_soundcloud_title_label 	= $audio_soundcloud_title ? $audio_soundcloud_title :__('Title Label','musicplay');
					$audio_soundcloud_url 			= get_post_meta( $post->ID,'audio_soundcloud_url',true);
					$audio_artist_name 				= get_post_meta( $post->ID,'audio_artist_name',true);
					$audio_mp3list					= get_post_meta( $post->ID,'audio_mp3',true ) ? get_post_meta( $post->ID,'audio_mp3',true ) :'';
					$audio_mp3list_count			= count( $audio_mp3list );
					$imagesrc 						= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false, '' );
					$music_image 					= aq_resize( $imagesrc[0], '80', '80', true );
					$audio_posttype_option			= get_post_meta( $post->ID,'audio_posttype_option',true );
							
					// Artist names
					if ( is_array( $audio_artist_name ) && count( $audio_artist_name ) > 0 ) {
						foreach( $audio_artist_name as $audio_artist_id){
							$permalink 		= get_permalink( $audio_artist_id );
							$playlisttitle 	= get_the_title( $audio_artist_id );
							$audio_artist[]	= '<a href="'.$permalink.'">'.$playlisttitle.'</a>';
						}
						$audio_artist_name = implode( ', ', $audio_artist );
					}
					
					// Player list
					if ( $audio_posttype_option  == 'player' && in_array( $post->ID,$attachment_posts) ) {
					
						$player_unique_id = $start.'player'.rand( 1,10 );
					
						if ( $k >= $min_pagenum && $k < $max_pagenum ) {
						
							$audio_uploadlist 	= get_post_meta( $post->ID,'audio_upload',true ) ? get_post_meta( $post->ID,'audio_upload',true ) :'';
							$album_audiolist	= explode( ',',$audio_uploadlist );
							
							$imagesrc 			= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false, '' );
							$music_image 		= aq_resize( $imagesrc[0], '80', '80', true );
							$post_date 			= get_post_meta($post->ID,'audio_release_date',true);
							
							if( $post_date !='') { 
								if(is_numeric($post_date)){
									 $post_date= date_i18n($default_date,$post_date);
								}	
							}
							
						
		
							global $track_ids;
							foreach( $track_ids as $trackid ){
								if( in_array( $trackid,$album_audiolist ) ){
									$iva_track_ids 		= $trackid;
									$attachment    		= get_post( $iva_track_ids );
									$attachment_title 	= $attachment->post_title;
									$attachment_url 	= $attachment->guid;
								}
							}
							$tracks_output.= '<div class="tracklist-Row">';
							$tracks_output.= '<div class="tracklist-details">';
							
							
							$tracks_output.= '<div class="tracklist-name tracklist-col"><a class="fap-single-track no-ajaxy" data-meta="#single-player-meta'.$player_unique_id.'" href="'.$attachment_url.'"  title="'.$attachment_title.'"  rel="'.$music_image.'"><i class="fa fa-play-circle fa-2x play_icon"></i> '.$attachment_title.'</a></div>';
							$tracks_output.= '<div class="tracklist-album tracklist-col">';
							$tracks_output.= '<div class="tracklist-thumb"><figure>'. atp_resize( $post->ID ,'',80, 80,'','').'</figure></div>';
							$tracks_output.= '<strong>'.$album_post_title.'</strong><p>'.$audio_artist_name.'</p></div>';
							$tracks_output.= '</div>';//.tracklist-details
							$tracks_output.= '</div>';//.tracklist-Row
							
							$tracks_output.= '<div style="display:none;" class="track-playlist" id="single-player-meta'.$player_unique_id.'">
												<a href="'.get_permalink( $post->ID ).'">'.get_the_title( $post->ID ).'</a>
											<div>'.get_the_term_list( $post->ID, 'label', '', ',', '' ).' | '.$post_date.'</div></div>'; 
						}
						$k++;
						$error = false;
					}
					// Soundcloud list
					if ( $audio_posttype_option  == 'soundcloud' ) {
						
						if( $audio_soundcloud_url !=''){
							
							$imagesrc 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false, '' );
							$music_image 	= aq_resize( $imagesrc[0], '80', '80', true );
							$post_date 		= get_post_meta($post->ID,'audio_release_date',true);
							
							if( $post_date !='') { 
								if(is_numeric($post_date)){
									 $post_date= date_i18n( $default_date,$post_date );
								}	
							}
						
							if ( preg_match("/$keyword/i", $audio_soundcloud_title )) {
								
								$soundcloud_unique_id = $start.'sc'.rand( 100,200 );
								
								if ( $k >= $min_pagenum && $k < $max_pagenum ) {
								
								
									$tracks_output.= '<div class="tracklist-Row">';
									$tracks_output.= '<div class="tracklist-details">';
									
									$tracks_output.= '<div class="tracklist-name tracklist-col"><a class="fap-single-track no-ajaxy" data-meta="#single-player-meta'.$soundcloud_unique_id.'"  href="'.$audio_soundcloud_url.'"  title="'.$audio_soundcloud_title.'"  rel="'.$music_image.'"><i class="fa fa-play-circle fa-2x play_icon"></i> '.$audio_soundcloud_title.'</a></div>';
									$tracks_output.= '<div class="tracklist-album tracklist-col">';
									$tracks_output.= '<div class="tracklist-thumb"><figure>'. atp_resize( $post->ID ,'',80, 80,'','').'</figure></div>';
									$tracks_output.= '<strong>'.$album_post_title.'</strong><p>'.$audio_artist_name.'</p></div>';											
									$tracks_output.= '</div>';//.tracklist-details
									$tracks_output.= '</div>';//.tracklist-Row
									
									$tracks_output.= '<div style="display:none;" class="track-playlist" id="single-player-meta'.$soundcloud_unique_id.'"><a href="'.get_permalink( $post->ID ).'">'.get_the_title( $post->ID ).'</a>
									<div>'.get_the_term_list( $post->ID, 'label', '', ',', '' ).' | '.$post_date.'</div></div>'; 
								 }
								$k++;
								$error = false;
							}
						}
					}
					// External mp3 list
					if ( $audio_posttype_option  == 'externalmp3' ) {
						
						if( $audio_mp3list !='' && $audio_mp3list_count > 0) {
						
							$imagesrc 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false, '' );
							$music_image 	= aq_resize( $imagesrc[0], '80', '80', true );
							$post_date 		= get_post_meta( $post->ID,'audio_release_date',true );
							
							if( $post_date !='') { 
								if(is_numeric($post_date)){
									 $post_date= date_i18n($default_date,$post_date);
								}	
							}
						
							foreach( $audio_mp3list as $mp3_list ) {
								if ( preg_match("/$keyword/i", $mp3_list['mp3title'])) {
									
									$mp3_unique_id = $start.'mp3'.rand( 200,300 );
								
									if ( $k >= $min_pagenum && $k < $max_pagenum ) {
									
																						
										$mp3_title	= $mp3_list['mp3title'];
										$mp3_url	= $mp3_list['mp3url'];
					
										$tracks_output.= '<div class="tracklist-Row">';
										$tracks_output.= '<div class="tracklist-details">';
										$tracks_output.= '<div class="tracklist-name tracklist-col"><a class="fap-single-track no-ajaxy"  data-meta="#single-player-meta'.$mp3_unique_id.'" href="'.esc_attr( $mp3_url ).'"  title="'.$mp3_title.'"  rel="'.$music_image.'"><i class="fa fa-play-circle fa-2x play_icon"></i> '.$mp3_title.'</a></div>';
										$tracks_output.= '<div class="tracklist-album tracklist-col">';
										$tracks_output.= '<div class="tracklist-thumb"><figure>'. atp_resize( $post->ID ,'',80, 80,'','').'</figure></div>';
										$tracks_output.= '<strong>'.$album_post_title.'</strong><p>'.$audio_artist_name.'</p></div>';
										$tracks_output.= '</div>';//.tracklist-details
										
										$tracks_output.= '</div>';//.tracklist-Row
										
										$tracks_output.= '<div style="display:none;" class="track-playlist" id="single-player-meta'.$mp3_unique_id.'"><a href="'.get_permalink( $post->ID ).'">'.get_the_title( $post->ID ).'</a>
										<div>'.get_the_term_list( $post->ID, 'label', '', ',', '' ).' | '.$post_date.'</div></div>'; 
						
									}
									$k++;
									$error = false;
								}
							}
							
						}
						
					}
					$start++;
				endwhile; 
		
				
				// Tracks Output
				if( $tracks_output ){
					echo '<div class="tracks-search">';
					echo '<h2>'.__('Tracks','musicplay').'</h2>';
					echo '<div class="tracklist-Table">';
					echo '<div class="tracklist-Header">';
					echo '<div class="tracklist-Row">';
					echo '<div class="tracklist-name tracklist-col">'.__('Tracks','musicplay').'</div>';
					echo '<div class="tracklist-album tracklist-col">'.__('Album','musicplay').'</div>';
					echo '</div>';// .tracklist-Row
					echo '</div>';//.tracklist-Header
					echo '<div class="tracklist-Body">';
					echo $tracks_output;
					
					// Tracks Pagination
					if( $search_pagination_option == 'on'){
						echo $tracks_pagination;
					}
					
					echo '</div>';//.tracklist-Body
					echo '</div>';//.tracklist-Table
					echo '</div>';//.tracklist-search
				}
				wp_reset_query();
			else :
			endif;
			echo '<div class="clear"></div>';
		}else{
			//$error = true;
		}
					
		// Album,Artist Search  Starts 
		$paged1 = isset( $_GET['paged1'] ) ? (int) $_GET['paged1'] : 1;
		$paged2 = isset( $_GET['paged2'] ) ? (int) $_GET['paged2'] : 1;
		$paged3 = isset( $_GET['paged3'] ) ? (int) $_GET['paged3'] : 1;
		$paged4 = isset( $_GET['paged4'] ) ? (int) $_GET['paged4'] : 1;

		
		// album title search query
		add_filter( 'posts_where', 'title_like_posts_where', 10, 2 );
		function title_like_posts_where( $where, &$wp_query ) {
			global $wpdb;
			if ( $post_title_like = $wp_query->get( 'post_title_like' ) ) {
				$search_orderby_s = esc_sql( $wpdb->esc_like( $post_title_like ) );
				$where .= "AND $wpdb->posts.post_title LIKE '%{$search_orderby_s}%'";
			}
			return $where;
		}
		
		$album_args = array(
			'post_type' 		=> 'albums',
			'post_title_like' 	=> $keyword,
			'posts_per_page'	=> $al_posts_perpage,
			'paged' 			=> $paged1,
			'orderby'		 	=>	'date',
			'order'			 	=>	'ASC'
		);
		$iva_album_query = new WP_Query( $album_args );
			
		$album_column_index = 0; $album_columns = 4;
		if( $album_columns == '4' ) { $album_class = 'col_fourth'; }
		if( $album_columns == '3' ) { $album_class = 'col_third'; }

		//Full Width Album Image Sizes
		if( $album_columns == '4' ) { $width='470'; $height = '470' ; }
		if( $album_columns == '3' ) { $width='470'; $height = '470' ; }
	
		if ( $iva_album_query->have_posts() ) : 
		
			$albums_title = get_option('atp_album_slug') ? get_option('atp_album_slug'):__('Albums','musicplay');
			
			echo '<div class="albums-search">';
			echo '<h2>'.$albums_title.'</h2>'; 
			
			while ( $iva_album_query->have_posts() ) : $iva_album_query->the_post();
			
				$audio_artist 		= array();
				$audio_artist_name  = get_post_meta( $post->ID,'audio_artist_name',true );
				
				if ( is_array( $audio_artist_name ) && count( $audio_artist_name ) > 0 ) {
					foreach( $audio_artist_name as $audio_artist_id){
						$permalink 		= get_permalink(  $audio_artist_id);
						$playlisttitle 	= get_the_title(  $audio_artist_id);
						$audio_artist[]	= '<a href="'.$permalink.'">'.$playlisttitle.'</a>';
					}
					$audio_artist_name = implode( ', ', $audio_artist );
				}
				
				$audio_catalog_id	= get_post_meta( $post->ID, 'audio_catalog_id', true );
				$img_alt_title 		= get_the_title();

				$album_column_index++;
				$album_last = ( $album_column_index == $album_columns && $album_columns != 1 ) ? 'end ' : '';
				echo '<div class="album-list   '.$album_class.'  '.$album_last.' ">';
				
				echo '<div class="custompost_entry">';
				if( has_post_thumbnail()){ 
					echo '<div class="custompost_thumb port_img">';
					echo '<figure>'.atp_resize( $post->ID, '', $width, $height, '', $img_alt_title ).'</figure>';
					echo '<div class="hover_type">';
					echo '<a class="hoveraudio" href="' .get_permalink(). '" title="' . get_the_title() . '"></a>';
					echo '</div>';
					echo'</div>';
				} 
				echo '<div class="album-desc">';
				echo '<h2 class="entry-title"><a href="'.get_the_permalink().'" rel="bookmark" title="'.esc_attr( get_the_title() ).'">'.get_the_title().'</a></h2>';
				echo '<span class="label-text">'.strip_tags( get_the_term_list( $post->ID, 'label', '', ', ', '' )).'</span>';
				echo '<span class="label-text">'.$audio_artist_name.'</span>';
				echo '</div>';//.album-desc
				echo '</div>';// .custompost_entry
				echo '</div>';// .album_list
				
				if( $album_column_index == $album_columns ){
					$album_column_index = 0;
					echo '<div class="clear"></div>';
				}
			$error = false;
		endwhile; 
			
		echo '<div class="clear"></div>';
		
		$al_pagenum_link = html_entity_decode( get_pagenum_link() );
		$al_format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $al_pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$al_format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'paged1/%#%', 'paged1' ) : '?paged1=%#%';

		$al_page_args = array(
			'base' 		=> add_query_arg( 'paged1', '%#%' ),
			'format' 	=> $al_format,	
			'current' 	=> $paged1,
			'prev_next' => false,
			'total'   	=> $iva_album_query->max_num_pages,
			'add_args' 	=> array( 'paged2' => $paged2 )
		);
		
		// Album pagination
		if( $search_pagination_option == 'on'){
			echo '<div class="pagination">'.paginate_links( $al_page_args ).'</div>';
		}	
		echo '</div>';//.albums-search
		wp_reset_query();
		
		else :
		endif;
		//Album Search Ends
		
		//
		$artist_args = array(
			'post_type' 		=> 'artists',
			'post_title_like' 	=> $keyword,
			'posts_per_page'	=> $ar_posts_perpage,
			'paged' 			=> $paged3,
			'orderby'		 	=>	'date',
			'order'			 	=>	'ASC'
		);
		$iva_artist_query = new WP_Query( $artist_args );
		
		$column_index = 0; $columns = 4;
		
		if( $columns == '4' ) { $class = 'col_fourth'; }
		if( $columns == '3' ) { $class = 'col_third'; }

		//Full Width Artist Image Sizes
		if( $columns == '4' ) { $width='470'; $height = '470' ; }
		if( $columns == '3' ) { $width='470'; $height = '470' ; }
		
		if ( $iva_artist_query->have_posts() ) : 
		
			$artists_title = get_option('atp_artist_slug') ? get_option('atp_artist_slug'):__('Artists','musicplay');

			echo '<div class="artists-search">';
			echo '<h2>'.$artists_title.'</h2>'; 
			
			while ( $iva_artist_query->have_posts() ) : $iva_artist_query->the_post();
			
				$artist_genres = get_post_meta( $post->ID, 'artist_genres', true );
				$img_alt_title = get_the_title();
				
				$column_index++;
				$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';
		
			echo '<div class="artist-list  '.$class. ' '.$last.'">';
			echo '<div class="custompost_entry">';
			
			if( has_post_thumbnail() ){
				echo '<div class="custompost_thumb port_img">';
				echo '<figure>'. atp_resize( $post->ID, '', $width, $height, '', $img_alt_title ) .'</figure>'; 
				echo '<div class="hover_type">';
				echo '<a class="hoverartist"  href="' .get_permalink(). '" title="' . get_the_title() . '"></a>';
				echo '</div>';
				echo '</div>';
			} 

			echo '<div class="artist-desc">';
			echo '<h2 class="entry-title"><a href="'.get_the_permalink().'" rel="bookmark" title="'.esc_attr( get_the_title() ).'">'.get_the_title().'</a></h2>';
			if( $artist_genres !='' ) { echo '<span>'. $artist_genres.'</span>'; }
			echo'</div>';

			echo '</div>';// .custompost_entry
			echo '</div>';// .artist-post
			
			
		if( $column_index == $columns ){
			$column_index = 0;
			echo '<div class="clear"></div>';
		}
		$error = false;
		endwhile; 
		
		echo '<div class="clear"></div>';
		
		// Artist pagination
		$ar_pagenum_link = html_entity_decode( get_pagenum_link() );
		$ar_format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $ar_pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$ar_format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'paged3/%#%', 'paged3' ) : '?paged3=%#%';

		 $ar_page_args = array(
						'base' 		=> add_query_arg( 'paged3', '%#%' ),
						'format'  	=> $ar_format,
						'current' 	=> $paged3,
						'prev_next' => false,
						'total'   	=> $iva_artist_query->max_num_pages,
						'add_args'  => array( 'paged4' => $paged4 )
					);
		if( $search_pagination_option == 'on'){
			echo '<div class="pagination">'.paginate_links( $ar_page_args ).'</div>';
		}
		echo '</div>';// .artists-search
		$error = false;
		wp_reset_query();
		else :
		endif;
		// Artist Search Ends
		if( $error ){
			echo '<div class="empty-search"><p>'.__('No Results Found','musicplay').'</p></div>';
		}
	}
	?>
	</div><!-- #post-<?php the_ID(); ?> -->
<?php get_footer(); ?>