<?php
function iva_artist($atts, $content = null,$code) {
	extract(shortcode_atts(array(
			'cat'			=> '',
			'limit'			=> '-1',
			'columns'		=> '',
			'postid'		=> '',
			'pagination'	=> ''
		), $atts));
		
		$column_index = 0;
		if( $columns == '4' ) { $class = 'col_fourth'; }
		if( $columns == '3' ) { $class = 'col_third'; }
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

		$query = array(
				'post_type'			=> 'artists', 
				'showposts'			=> $limit, 
				'tax_query' => array(
								'relation' => 'OR',
							
								),
			
				'paged'		=> $paged
				);
		if($cat !=''){
				$tax_artist	=	array(
									'taxonomy' => 'artist_cat',
									'field' => 'slug',
									'terms' => $cat
								);
				array_push( $query['tax_query'],$tax_artist);
			}
						
		
		if($postid!=''){
			$postid_array = array();
			$postid_array = explode(',',$postid);
			$query = array(
				'post_type'	=> 'artists', 
				'post__in'	=> $postid_array
			);
		}		
	query_posts($query); //get the results
	global $post;
	if(have_posts()) : while(have_posts()) : the_post();
		$artist_bornplace	= get_post_meta( $post->ID, 'artist_bornplace', true );
		$artist_genres		= get_post_meta( $post->ID, 'artist_genres', true );
		$artist_year_active	= get_post_meta( $post->ID, 'artist_year_active', true );
		$artist_website_url	= get_post_meta( $post->ID, 'artist_website_url', true );
		//$artist_label		= get_the_term_list( $post->ID, 'label', '', ',', '' );
		$img_alt_title 		= get_the_title();

		$column_index++;
		$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';

		$permalink = get_permalink( get_the_id() );
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', true );

		$out .= '<div class="artist-list '.$class.' '. $last.'">'; 
		$out .= '<div class="custompost_entry">';
				if(has_post_thumbnail()){
					$out .='<div class="custompost_thumb port_img">';
					$out .='<figure>';
					$out .= atp_resize( $post->ID, '', $width, $height, '', $img_alt_title );
					$out .='</figure>'; 
					$out .='<div class="hover_type">';
					$out .='<a class="hoverartist"  href="' .$permalink. '" title="' . get_the_title() . '"></a>';
					$out .='</div>'; 
					$out .='</div>';
				}
		$out .='<div class="artist-desc">';
		$out .='<h2 class="entry-title"><a href="' .$permalink. '">'.get_the_title().'</a></h2>';
		if ( $artist_genres != '' ) {
			$out .='<span>'.$artist_genres.'</span>';
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
add_shortcode('artist','iva_artist'); //add shortcode
?>