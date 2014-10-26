<?php
function iva_djmix($atts, $content = null,$code) {
	
	extract(shortcode_atts(array(
			'cat'			=> '',
			'limit'			=> '-1',
			'columns'		=> '',
			'postid'		=> '',	
			'pagination'	=> ''
		), $atts));
		global $default_date;
		$column_index = 0;
		if( $columns == '4' ) { $class = 'col_fourth'; }
		if( $columns == '3' ) { $class = 'col_third'; }
		if( $columns == '' ) { $class = ''; }
		
		//Album Image Sizes
		$width='470'; $height = '470';
		$out = $djmix_genre = $djtitle ='';

		if ( get_query_var('paged') ) { 
			$paged = get_query_var('paged'); 
		} elseif ( get_query_var('page') ) { 
			$paged = get_query_var('page');
		}else {
			$paged = 1;
		}

		$query = array(
			'post_type'	=> 'djmix', 
			'showposts'	=> $limit, 
			'tax_query' => array(
							'relation' => 'OR',
						),
						
			'paged'		=> $paged,
			'orderby'	=> 'date',
			'order'		=> 'DESC'
		);

		if($cat !=''){
			$tax_artist	=	array(
			'taxonomy'  => 'djmix_cat',
			'field' 	=> 'slug',
			'terms' 	=> $cat
			);
			array_push( $query['tax_query'],$tax_artist);
		}

		$postid_array = array();
		$postid_array = explode(',',$postid);
		if($postid!=''){
			$query = array(
					'post_type'	=> 'djmix', 
					'post__in'	=> $postid_array
			);
		}

		$start=rand(10,111);
		query_posts($query); //get the results
		global $post;;
		if ( have_posts()) : while (  have_posts()) :  the_post(); 

		$djmix_release_date = get_post_meta( $post->ID, 'djmix_release_date', true );
	
		if($djmix_release_date !='') { 
	     if(is_numeric($djmix_release_date)){
	      $djmix_release_date= date_i18n($default_date,$djmix_release_date);
	     } 
	    }
		$djmix_genre			= get_post_meta( $post->ID, 'djmix_genre', true );
		$djmix_buy_mix			= get_post_meta( $post->ID, 'djmix_buy_mix', true );
		$djmix_buy_url			= get_post_meta( $post->ID, 'djmix_buy_url', true );
		$djmix_download_url 	= get_post_meta( $post->ID, 'djmix_download_url', true );
		$djmix_download_text 	= get_post_meta( $post->ID, 'djmix_download_text', true ) ? get_post_meta( $post->ID, 'djmix_download_text', true ) : 'Download';
		$audio_posttype_option	= get_post_meta( $post->ID, 'audio_posttype_option', true )? get_post_meta( $post->ID, 'audio_posttype_option', true ) :'player';
		$djmix_upload_mix		= get_post_meta( $post->ID, 'djmix_upload_mix', true );
		$imagesrc				= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false, '' );
		$image					= aq_resize($imagesrc[0], '80', '80', true ); // Alaaeddin: support ticket set it to 80x80 (used to be 40 x 40)
		$djtitle				= get_the_title($post->ID);
		$img_alt_title 			= get_the_title();
		$post_date			= get_post_meta(get_the_id(),'djmix_release_date',true);
				
				if($post_date !='') { 
					if(is_numeric($post_date)){
						$post_date= date_i18n($default_date,$post_date);
					}	
				}
		$column_index++;
		$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';
		/*--------------------------------*/
		$out .= '<div class="album-list '.$class.' '. $last.'">'; 
		$out .= '<div class="custompost_entry">';
		$out .="<span class='fap-my-playlist album-playlist' data-playlist='unique-playlist-id'>";
		
		if($audio_posttype_option == 'player'){ 
			$djmix_list = get_post_meta($post->ID,'djmix_upload_mix',true) ? get_post_meta($post->ID,'djmix_upload_mix',true) :'';

			if( has_post_thumbnail($query->post->ID)){ 
				$out .='<div class="custompost_thumb port_img">';
				$out .='<figure>'. atp_resize( $post->ID, '', '500','500', '', $img_alt_title ).'</figure>';
				$out .='<div class="hover_type">';
				$attachment = get_post( $djmix_list );
				$title = $attachment->post_title;
				$playlisttitles = '<div id="single-player-meta'.$start.'">'.$djtitle.'<div>'.$djmix_genre.' | '.$post_date.'</div></div>';
				$out .='<div class="play mediamx"><a class="hoverdjmix fap-single-track no-ajaxy" data-meta="#single-player-meta'.$start.'" class="no-ajaxy" href="'.$attachment->guid.'" title="'.$title.'" rel="'.$image.'"><div class="hoverdjmix"></div></a></div>';
			
				$out .='</div>';
				$out .='<span class="imgoverlay"></span>'; 
				$out .='</div>';
			} 
			$out .='<div class="single-player-meta" id="single-player-meta'.$start.'">'.$djtitle.'<div>'.$djmix_genre.' | '.$post_date.'</div></div>'; 
			
		}elseif($audio_posttype_option == 'externalmp3'){
			if( has_post_thumbnail($query->post->ID)){ 
				$out .='<div class="custompost_thumb port_img">';
				$out .='<figure>'. atp_resize( $post->ID, '', '500','500', '', $img_alt_title ).'</figure>';
				$out .='<div class="hover_type">';
				//foreach($djmix_list as $attachment_id){
					$attachment = get_post( $attachment_id );
				//	$title = $attachment->post_title;
			
			
					$djmix_externalmp3url = get_post_meta($post->ID,'djmix_externalmp3',true); 
					$djmix_externalmp3urltitle = get_post_meta($post->ID,'djmix_externalmp3title',true); 
					// Alaaeddin: Original Line: $out .='<div class="play mediamx"><a class="hoverdjmix fap-single-track no-ajaxy "  data-meta="#single-player-meta'.$start.'" class="no-ajaxy" href="'.$djmix_externalmp3url.'" rel="'.$image.'" title="'.$djmix_externalmp3urltitle.'"><div class="hoverdmix"></div></a></div>';
								     $out .='<div class="play mediamx"><a class="hoverdjmix fap-single-track no-ajaxy "  data-meta="#single-player-meta'.$start.'" class="no-ajaxy" href="'.$djmix_externalmp3url.'" rel="'.$image.'" title="'.$djmix_externalmp3urltitle.'"></a><div class="hoverdmix"></div></a></div>';
				//}
				$out .='</div>';
				$out .='<span class="imgoverlay"></span>'; 
				$out .='</div>';
			} 
			// Alaaeddin: original line: $out .='<div class="single-player-meta" id="single-player-meta'.$start.'">'.$djtitle.'<div>'.$djmix_genre.' | '.$post_date.'</div></div>'; 
			$out .='<span class="single-player-meta" id="single-player-meta'.$start.'"><div><p style="font-size: 13px;">'.$djmix_genre.'</p></div></span>'; 
		}else{ 
			if( has_post_thumbnail($query->post->ID)){ 
				$out .='<div class="custompost_thumb port_img">';
				$out .='<figure>'. atp_resize( $post->ID, '', '500','500', '', $img_alt_title ).'</figure>';
				$out .='<div class="hover_type">';
					$attachment = get_post( $attachment_id );
					$title = $attachment->post_title;
					$audio_soundcloud_url = get_post_meta($post->ID,'audio_soundcloud_url',true);
					$out .='<div><a data-meta="#single-player-meta'.$start.'" class="hoverdjmix fap-single-track no-ajaxy" href="'.$audio_soundcloud_url.'" class="fap-single-track no-ajaxy"><div class="hoverdjmix"></div></a></div>';
				$out .='</div>';
				$out .='<span class="imgoverlay"></span>'; 
				$out .='</div>';
			
			}			
			$out .='<div class="single-player-meta" id="single-player-meta'.$start.'">'.$djtitle.'<div>'.$djmix_genre.' | '.$post_date.'</div></div>'; 
		}
		$out .="</span>";		
		$out .='<div class="album-desc">';
		$out .='<h2 class="entry-title">'.get_the_title().'</h2>';
		if ( $djmix_genre != '' ) { 
			$out .='<span>'.$djmix_genre.'</span>';
		} 
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
		
		if( $column_index == $columns ){
			$column_index = 0;
			$out.='<div class="clear"></div>';
		}
		$start++;
		endwhile;
	wp_reset_query();
		if(!function_exists('atp_pagination')){
			if ( $pagination == 'true' ) {
				$out .=atp_pagination();
			} 	
		}
		/*---------------------------------*/
		endif; 
	return $out;
}
add_shortcode('musicdjmix','iva_djmix'); //add shortcode
?>