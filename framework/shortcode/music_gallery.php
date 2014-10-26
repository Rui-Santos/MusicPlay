<?php
function iva_musicgallery($atts, $content = null,$code) {
		extract(shortcode_atts(array(
			'cat'			=> '',
			'postid_g'		=> '',
			'limit'			=> '-1',
			'columns'		=> '',
			'pagination'	=> ''
		), $atts));

		$column_index = 0;
		if( $columns == '4' ) { $class = 'col_fourth'; }
		if( $columns == '3' ) { $class = 'col_third'; }
		if( $columns == '2' ) { $class = 'col_two'; }
		if( $columns == '' ) { $class = ''; }

		//Album Image Sizes
		$width='470'; $height = '470';
		$out = '';

		if ( get_query_var('paged') ) { 
			$paged = get_query_var('paged'); 
		} elseif ( get_query_var('page') ) { 
			$paged = get_query_var('page');
		}else {
			$paged = 1;
		}

		if($cat !='null'){
			$query = array(
				'post_type'			=> 'gallery', 
				'showposts'			=> $limit, 
				'taxonomy'			=> 'gallery_type', 
				'term'				=> $cat, 
				'paged'				=> $paged
			);
		}
		$postid_array = array();
		$postid_array = explode(',',$postid_g);
		if($postid_g!=''){
			$query = array(
					'post_type'	=> 'gallery', 
					'post__in'	=> $postid_array
			);
		}

	query_posts($query); //get the results
	global $post;
	if(have_posts()) : while(have_posts()) : the_post();
	$audio_genre_music		= get_post_meta( $post->ID, 'audio_genre_music', true );
	$gallery_venue			= get_post_meta( $post->ID, 'gallery_venue', true );
	$gallery_upload			= get_the_term_list( $post->ID, 'gallery_upload', '', ',', '' );
	$img_alt_title 		= get_the_title();
	$column_index++;
	$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';

	$permalink	= get_permalink( get_the_id() );
	$image		= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', true );

	$out .= '<div class="gallery-list '.$class.' '. $last.'">'; 
	$out .= '<div class="custompost_entry">';
	if(has_post_thumbnail()){
		$out .='<div class="custompost_thumb port_img">';
		$out .='<figure>';
		$out .=atp_resize( $post->ID, '', $width, $height, '', $img_alt_title 	 );
		$out .='</figure>'; 
		$out .='<div class="hover_type">';
		$out .='<a class="hovergallery"  href="' .$permalink. '" title="' . get_the_title() . '"></a>';
		$out .='</div>'; 
		$out .='</div>';
	}
	$out .= '<div class="gallery-desc">';
	$out .= '<h2 class="entry-title"><a href="' .$permalink. '">'.get_the_title().'</a></h2>';
	if ( $gallery_venue != '' ) {
		$out .= '<span>'.$gallery_venue.'</span>';
	}
	$out .= '</div>';
	$out .= '</div>';
	$out .= '</div>';
	if( $column_index == $columns ){
		$column_index = 0;
		$out.='<div class="clear"></div>';
	}
	endwhile;
	$out .='<div class="clear"></div>';
	if(!function_exists('atp_pagination')){
		if($pagination == 'true') {
			$out .=atp_pagination(); 
		}
	}
	wp_reset_query();
	endif; 
	return $out;
}
add_shortcode('musicgallery','iva_musicgallery'); //add shortcode
?>