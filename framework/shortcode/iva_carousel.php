<?php

	//  Carousel List
	//--------------------------------------------------------

	add_action( 'wp_enqueue_scripts', 'owl_carousel_scripts' );

	function iva_carousel($atts, $content = null) {
		extract(shortcode_atts(array(
			'type'			=> '',	
			'limit'			=> '',
			'items'		 	=> '3',
			'genres'		=> '',
			'labels'		=> '',
			'artist_cat'		=> '',
			'video_cat'		=> '',
			'gallery_cat'	=> ''
		), $atts));

		global $readmoretxt, $post;

		$iva_carousel_id = rand(10,99);
		$query = array(
				'post_type'			=> $type, 
				'showposts'			=> $limit, 
				'tax_query' => array(
							'relation' => 'OR',
						
						),
				'paged'		=> $paged,
				'orderby'	=> $orderby,
				'order'		=> $order
			);
			
			if( $genres ){
				$tax_genres	=	array(
						'taxonomy' => 'genres',
						'field' => 'slug',
						'terms' => $genres
				);
				
				array_push( $query['tax_query'],$tax_genres );
			}
			
			if( $labels ){
				$tax_label	=	array(
						'taxonomy' => 'label',
						'field' => 'slug',
						'terms' => $labels
					);
					
				array_push( $query['tax_query'],$tax_label );
			}
			
			if( $video_cat ) {
			
							$tax_video	=	array(
									'taxonomy' => 'video_type',
									'field' => 'slug',
									'terms' => $video_cat
							);
							
							array_push( $query['tax_query'],$tax_video );
			}
						
			if( $artist_cat ){
				$tax_artist	=	array(
									'taxonomy' => 'artist_cat',
									'field' => 'slug',
									'terms' => $artist_cat
								);
				array_push( $query['tax_query'],$tax_artist);
			}
			
			if( $gallery_cat ) {
				$tax_artist	=	array(
									'taxonomy' => 'gallery_type',
									'field' => 'slug',
									'terms' => $gallery_cat
								);
				array_push( $query['tax_query'],$tax_artist);
			}

		query_posts($query); //get the results
		global $post;	
		$out = '<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#carousel-'.$iva_carousel_id.'").owlCarousel({
				autoPlay: 300000,
				items :'.$items.',
				itemsDesktop : [1199,4],
				itemsDesktopSmall : [979,4],
				itemsTablet : [768,2],
				itemsMobile : [479,1]
			});
		});		
		
		
		</script>';

		$out .= '<div class="container">';
		$out .= '<div id="carousel-'.$iva_carousel_id.'" class="owl-carousel" >';
	
		if ( have_posts() ) : 
			
			while (have_posts()) : the_post();
			
					if($type =="gallery" ) {
					
						$extra	= get_post_meta( $post->ID, 'gallery_venue', true );
						
					}
					
					if($type =="artists" ){
					
						$extra 	= get_post_meta( $post->ID, 'artist_genres', true );
					}
					
					if($type =="albums" ) {
					
						$audio_artist = array();
						$audio_artist_name =get_post_meta($post->ID,'audio_artist_name',true);
						if ( is_array( $audio_artist_name ) && count( $audio_artist_name ) > 0 ) {
							foreach( $audio_artist_name as $audio_artist_id){
								$permalink = get_permalink(  $audio_artist_id);
								$playlisttitle = get_the_title(  $audio_artist_id);
								$audio_artist[]= '<a href="'.$permalink.'">'.$playlisttitle.'</a>';
							}
							$extra = implode( ', ', $audio_artist );
						}
	
					}
					
					$out .= '<div class="item post-list">';
					if( has_post_thumbnail( $post->ID )){
						$out .=	'<div class="custompost_thumb port_img">';
						$out .=	'<figure>'.atp_resize($post->ID,'','470','470','','').'</figure>';
						$out .=	'<div class="hover_type">';
						$out .=	'<a class="hover'.$type.'"  href="' .get_permalink(). '" title="' . get_the_title() . '"></a>';
						$out .=	 '</div>';
						$out .=	'</div>';
					}else{
						$out .=	'<div class="no-image custompost_thumb port_img">';
						$out .=	'<figure><img src="'. THEME_URI.'/images/no-image.png" width="470" height="470"></figure>';
						$out .=	'<div class="hover_type">';
						$out .=	'<a class="hover'.$type.'"  href="' .get_permalink(). '" title="' . get_the_title() . '"></a>';
						$out .=	 '</div>';
						$out .=	'</div>';
					}
					$out .='<div class="custompost_entry">';
					$out .='<div class="custompost_details">';
					$out .='<div class="post-desc">';
					$out .= '<h2 class="entry-title"><a href="'.get_permalink($post->ID).'" class="more-link">'. get_the_title() .'</a></h2>';
					if ( $extra != '' ) { 
						$out .= '<span>'.$extra.'</span>'; 
					}
					if( $type == "albums" )
					{
						$out .='<span class="label-text">'. strip_tags(get_the_term_list( $post->ID, 'label', '', ', ', '' )).'</span>';
					}
					$out .='</div>';
					$out .='</div>';
					$out .='</div>';
					$out .='</div>';
			endwhile;
		endif;
			
		$out .= '</div>';
		$out .= '</div>';
		wp_reset_query();
			
		return $out;
	} 
	add_shortcode('iva_carousel','iva_carousel');
?>