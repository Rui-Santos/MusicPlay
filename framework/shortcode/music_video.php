<?php
function iva_musicvideo($atts, $content = null,$code) {
	extract(shortcode_atts(array(
			'cat'			=> '',
			'postid'		=> '',
			'limit'			=> '-1',
			'columns'		=> '',
			'pagination'	=> ''
	), $atts));

	$column_index = 0;
	if( $columns == '4' ) { $class = 'col_fourth'; }
	if( $columns == '3' ) { $class = 'col_third'; }
	if( $columns == '' ) { $class = ''; }
	//Album Image Sizes
	$width	='470'; $height = '470' ;
	$out 	= '';

	if ( get_query_var('paged') ) { 
		$paged = get_query_var('paged'); 
	} elseif ( get_query_var('page') ) { 
		$paged = get_query_var('page');
	}else {
		$paged = 1;
	}

	
	$query = array(
				'post_type'			=> 'video', 
				'showposts'			=> $limit, 
				'tax_query' => array(
								'relation' => 'OR',
							
							),
				'term'				=> $cat, 
				'paged'				=> $paged
	);
	if($cat !=''){
		$tax_video	=	array(
				'taxonomy' => 'video_type',
				'field' => 'slug',
				'terms' => $cat
		);
		array_push( $query['tax_query'],$tax_video );
	}
						
	$postid_array = array();
	$postid_array = explode(',',$postid);
	if($postid!=''){
		$query = array(
				'post_type'	=> 'video', 
				'post__in'	=> $postid_array
		);
	}					

	query_posts($query); //get the results
	global $post,$default_date;
	if(have_posts()) : while(have_posts()) : the_post();

		$video_venue		= get_post_meta( $post->ID, 'video_venue', true );
		$video_type_option	= get_post_meta( $post->ID, 'video_type_option', true );
		$img_alt_title 		= get_the_title();
		$column_index++;
		$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';

		$permalink	= get_permalink( get_the_id() );
		$image 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', true );

		$out .= '<div class="video-list '.$class.' '. $last.'">'; 
		$out .= '<div class="custompost_entry">';
			if(has_post_thumbnail()){
				$out .='<div class="custompost_thumb port_img">';
				$out .='<figure>';
				$out .= atp_resize( $post->ID, '', $width, $height, '', $img_alt_title  );
				$out .='</figure>'; 
				$out .='<div class="hover_type">';
				$out .='<a class="hovervideo"  href="' .$permalink. '" title="' . get_the_title() . '"></a>';
				$out .='</div>'; 
				$out .='</div>';
			}
			$out .='<div class="video-desc">';
			$out .='<h2 class="entry-title"><a href="' .$permalink. '">'.get_the_title().'</a></h2>';
			$out .='</div>';
		$out .='</div>';
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
add_shortcode('musicvideo','iva_musicvideo'); //add shortcode
?>