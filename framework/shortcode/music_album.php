<?php
function iva_album($atts, $content = null,$code) {
	extract(shortcode_atts(array(
			'genres'		=> '',
			'label'			=>'',
			'id'			=> '',
			'postid'		=> '',
			'limit'			=> '-1',
			'ordering'		=> '',
			'columns'		=> '4',
			'pagination'	=> ''
		), $atts));
		
		$column_index = 0;
		if( $columns == '4' ) { $class = 'col_fourth'; }
		if( $columns == '3' ) { $class = 'col_third'; }


		if ( get_query_var('paged') ) { 
			$paged = get_query_var('paged'); 
		} elseif ( get_query_var('page') ) { 
			$paged = get_query_var('page');
		}else {
			$paged = 1;
		}

		$albums_orderby = get_option('atp_album_orderby');
		$albums_order = get_option('atp_album_order');
		$orderby = ($ordering == 'yes') ? $albums_orderby : 'ID';
		$order   = ($ordering == 'yes') ? $albums_order   : 'ASC';
		//Album Image Sizes
		$width='470'; $height = '470';
		$out = '';
		if($genres !='null' ||  $label !=''){
			$query = array(
				'post_type'			=> 'albums', 
				'showposts'			=> $limit, 
				'tax_query' => array(
							'relation' => 'OR',
						
						),
				//'meta_key' => $orderby, // date order by
				'paged'		=> $paged,
				'orderby'	=> $orderby,
				'order'		=> $order
			);
		
			if($genres !=''){
				$tax_genres	=	array(
						'taxonomy' => 'genres',
						'field' => 'slug',
						'terms' => $genres
				);
				array_push( $query['tax_query'],$tax_genres );
			}
			if($label !=''){
				$tax_label	=	array(
						'taxonomy' => 'label',
						'field' => 'slug',
						'terms' => $label
					);
				array_push( $query['tax_query'],$tax_label );
			}
	
		}
		
		
		if($postid!=''){
		$postid_array = array();
		$postid_array = explode(',',$postid);
			$query = array(
					'post_type'	=> 'albums', 
					'post__in'	=> $postid_array
			);
		}

		if($id!=''){
			$query = array(
					'post_type'	=> 'albums', 
					'p'	=> $id
			);
		}
	query_posts($query); //get the results
	global $post,$default_date;
	if(have_posts()) : while(have_posts()) : the_post();
		$audio_genre_music	= get_post_meta( $post->ID, 'audio_genre_music', true );
		$audio_catalog_id	= get_post_meta( $post->ID, 'audio_catalog_id', true );
		$audio_id_display	= get_post_meta( $post->ID, 'audio_upload', true );
		$audio_label		= get_the_term_list( $post->ID, 'label', '', ', ', '' );
		$audio_labels = strip_tags( $audio_label );
		$audio_genres		= get_the_term_list( $post->ID, 'genres', '', ', ', '' );
		$audio_genres = strip_tags( $audio_genres );
		$img_alt_title 		= get_the_title();
		$audio_button_disable 		= get_post_meta( $post->ID, 'audio_button_disable', true );
		$audio_buttons   = get_post_meta( $post->ID, 'audio_buttons', true );
			
		$audio_release_date	= get_post_meta( $post->ID, 'audio_release_date', true );
		if($audio_release_date !='') { 
		 if(is_numeric($audio_release_date)){
		  $audio_release_date= date_i18n($default_date,$audio_release_date);
		 } 
		}
		$audio_artist=array();
			$audio_artist_name =get_post_meta($post->ID,'audio_artist_name',true);
			if ( is_array( $audio_artist_name ) && count( $audio_artist_name ) > 0 ) {
			foreach( $audio_artist_name as $audio_artist_id){
			
			  $permalink = get_permalink(  $audio_artist_id);
			  $playlisttitle = get_the_title(  $audio_artist_id);
			  $audio_artist[]= '<a href="'.$permalink.'">'.$playlisttitle.'</a>';
			 }
			$audio_artist_name = implode( ', ', $audio_artist );
			}
		$column_index++;
		$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';

		$permalink = get_permalink( get_the_id() );
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', true );
		$playlisttitles ='<div id="single-player-meta">
						<a href="'.$permalink.'">'.get_the_title($post->ID).'</a>
						<div>'.$audio_label.' | '.$audio_release_date.'</div></div>';

		//if($id!='' && $label== 'null' && $genres== 'null' && $postid =='null' ){
		if($id!=''){
			$audio_posttype_option		= get_post_meta( $post->ID, 'audio_posttype_option', true ) ?  get_post_meta( $post->ID, 'audio_posttype_option', true ) :'player';
			$imagesrc 	= wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full', false, '' );
			$image_dis 	= aq_resize($imagesrc[0], '80', '80', true );
			$out.= '<div class="album_widgetmeta">';
			$out .=atp_resize( $post->ID, '', 90, 90, 'album-thumb',$img_alt_title );
				$out .='<div class="album-widget-info">';
						$out .='<strong><a href="' .$permalink. '">'.get_the_title().'</a></strong>';
						$out .='<div class="album-widgetmeta">';
						$out .='<span>'.$audio_release_date.'</span>';
						$out .='<span>'.$audio_artist_name.'</span>';
						$out .='<span>'.get_the_term_list( $post->ID, 'genres', '', ',' , '' ).'</span>';
				$out.='</div>';
				$out .='</div>';
			$out .='</div>';
			$out .="<ul class='fap-my-playlist album-playlist' data-playlist='unique-playlist-id'>";
			$audio_display=array();
			$audio_display=explode(',',$audio_id_display);			
			
			if($audio_posttype_option =='player'){
				$count = count($audio_display);
				if($count > 1) {
					$i=1;
					foreach($audio_display as $attachment_id) { 
						$attachment 		= get_post( $attachment_id );
						if(count($attachment) > 0) {
						$attachment_title	= $attachment->post_title;
							$out .="<li><a class='fap-single-track no-ajaxy' data-meta='#single-player-meta' href=".$attachment->guid."  title='".$attachment_title."'  rel='".$image_dis."'><i class='fa fa-play-circle fa-2x play_icon'></i>".$attachment_title."</a></li>"; 
						}
					}
				} 
			
			}elseif($audio_posttype_option =='externalmp3'){		
					$audiolist=get_post_meta($post->ID,'audio_mp3',true) ? get_post_meta($post->ID,'audio_mp3',true) :'';
					$count=count($audiolist);
				if($count > 0) {
					$i=1;
					foreach($audiolist as $mp3_list) { 
						$mp3_title=$mp3_list['mp3title'];
								
						
						$out .="<li><a class='fap-single-track no-ajaxy' data-meta='#single-player-meta' href='".esc_attr($mp3_list['mp3url'])."' title='".$mp3_title."'  rel='".$image."'><i class='fa fa-play-circle fa-2x play_icon'></i>".$mp3_title."</a></li>"; 
					}
				}
			}elseif($audio_posttype_option =='soundcloud'){
				$audio_soundcloud_title = get_post_meta($post->ID,'audio_soundcloud_title',true);
				$audio_soundcloud_url = get_post_meta($post->ID,'audio_soundcloud_url',true);
				$out .="<li><a class='fap-single-track no-ajaxy' data-meta='#single-player-meta' href='".$audio_soundcloud_url."' title='".$audio_soundcloud_title."'  rel='".$image."'><i class='fa fa-play-circle fa-2x play_icon'></i>".$audio_soundcloud_title."</a></li>";
				
			} 
			$out .="</ul>";	
				echo $playlisttitles;
		 if ( $audio_button_disable != 'on' ) {
				if ( $audio_buttons != '' ){
					foreach ($audio_buttons as $buttons){ 
						 if($buttons['buttoncolor']!=''){
							$style= ' style="background-color:'.$buttons['buttoncolor'].'"';}
						$out.='<a href="'.$buttons['buttonurl'].'" target="_blank"><button '.$style.'  type="button" class="btn medium orange flat">
						<span>'.$buttons['buttonname'].'</span></button></a>';
			 }
		   } 
		 } 	
		 
		 }elseif( $postid !='')  {
			
			$out .= '<div class="album-list">'; 
			$out .= '<div class="custompost_entry">';
					if(has_post_thumbnail()){
						$out .='<div class="custompost_thumb port_img">';
						$out .='<figure>';
						$out .= atp_resize( $post->ID, '',$width, $height, '', $img_alt_title );
						$out .='</figure>'; 
						$out .='<div class="hover_type">';
						$out .='<a class="hoveraudio"  href="' .$permalink. '" title="' . get_the_title() . '"></a>';
						$out .='</div>'; 
						$out .='<span class="imgoverlay"></span>'; 
						$out .='</div>';
					}
			$out .='<div class="album-desc">';
			$out .='<h2 class="entry-title"><a href="' .$permalink. '">'.get_the_title().'</a></h2>';
			if ( $audio_label != '' ) {
				$out .='<span>'.$audio_labels.'</span>';
			}
			if ( $audio_genres != '' ) {
				$out .='<span>'.$audio_genres.'</span>';
			}
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
			
		}elseif($genres !='null' || $label !='null' || $postid =='')  {
			
			$out .= '<div class="album-list '.$class.' '. $last.'"">'; 
			$out .= '<div class="custompost_entry">';
					if(has_post_thumbnail()){
						$out .='<div class="custompost_thumb port_img">';
						$out .='<figure>';
						$out .= atp_resize( $post->ID, '',$width, $height, '', $img_alt_title );
						$out .='</figure>'; 
						$out .='<div class="hover_type">';
						$out .='<a class="hoveraudio"  href="' .$permalink. '" title="' . get_the_title() . '"></a>';
						$out .='</div>'; 
						$out .='<span class="imgoverlay"></span>'; 
						$out .='</div>';
					}
			$out .='<div class="album-desc">';
			$out .='<h2 class="entry-title"><a href="' .$permalink. '">'.get_the_title().'</a></h2>';
			if ( $audio_label != '' ) {
				$out .='<span>'.$audio_labels.'</span>';
			}
			if ( $audio_genres != '' ) {
				$out .='<span>'.$audio_genres.'</span>';
			}
			$out .= '</div>';
			$out .= '</div>';
			$out .= '</div>';
			
			if( $column_index == $columns ){
				$column_index = 0;
				$out.='<div class="clear"></div>';
			}
		}
	endwhile;
	$out .='<div class="clear"></div>';
	if(!function_exists('atp_pagination')){
		if($pagination == 'true') {   
			$out .= atp_pagination();  	
		}
	}
	wp_reset_query();
	endif; 
	return $out;
}
add_shortcode('album','iva_album');  // End Shortcode
?>