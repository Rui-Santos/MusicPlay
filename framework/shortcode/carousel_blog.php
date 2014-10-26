<?php
	// Carousel List
	//--------------------------------------------------------

	add_action( 'wp_enqueue_scripts', 'owl_carousel_scripts' );

	function iva_blog_carousel($atts, $content = null) {
		extract(shortcode_atts(array(
			'cat'		 => '',
			'limit'		 => '',
			'title'		 => '',
			'charlimits' => '200',
			'items'		 => '',
			'style'		 => 'style1'
		), $atts));

		global $readmoretxt, $post;

		$blogcarousel_id = rand(10,99);

		$events_order = get_option( 'atp_eventsorder' ) ? get_option( 'atp_eventsorder' ) : 'id';
		$blogstyle = (($style == "style1") ? ' blog-carousel-plain' : 'blog-carousel');

		$paged = (get_query_var( 'paged' )) ? get_query_var( 'paged' ) : 1;
		$args = array ( 'category_name' => $cat, 'paged' => $paged, 'posts_per_page' => $limit);
		$bcarousel_query = new WP_Query( $args );	
		$format = get_post_format(get_the_ID());  if( false === $format ) { $format = 'standard'; } 
		$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false, '' );

		$out = '<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#carousel-'.$blogcarousel_id.'").owlCarousel({
				autoPlay: 300000,
				items :'.$items.',
				itemsDesktop : [1199,4],
				itemsDesktopSmall : [979,4],
				itemsTablet : [768,2],
				itemsMobile : [479,1]
			});
		});		
		
		
		</script>';

		$out .= '<div class="container '.$blogstyle.'">';
		$out .= '<div class="container">';
		$out .= '<h2 class="carousel-title fancyheading textcenter"><span>'.$title.'</span></h2>';
		$out .= '<div id="carousel-'.$blogcarousel_id.'" class="owl-carousel" >';
	
		if ($bcarousel_query->have_posts()) : 
			
			while ($bcarousel_query->have_posts()) : $bcarousel_query->the_post();
			
			if( $format != 'link' && $format != 'quote' ) {

				// Blog Style 2 Output
				if($style == "style2") {
					
					$out .= '<div class="item style2">';
	
					if( has_post_thumbnail( $post->ID )){
						$out .=	'<figure>'.atp_resize($post->ID,'','500','500','','').'</figure>';
					}else{
						$out .=	'<div class="no-image">';
						$out .=	'<figure><img src="'. THEME_URI.'/images/no-image.png" width="500" height="500"></figure>';
						$out .=	'</div>';
					}
					
					$out .='<div class="post_list">';
					$out .= '<h5 class="blog-carousel-item-title"><a href="'.get_permalink($post->ID).'" class="more-link">'. get_the_title() .'</a></h5>';
					$out .='</div>';
					
					$out .='</div>';
				
				}else{
				// Blog Style 1 Output
					$out .= '<div class="item">';
					
					$out .='<div class="post_list">';
					$out .= '<h5 class="blog-carousel-item-title"><a href="'.get_permalink($post->ID).'" class="more-link">'. get_the_title() .'</a></h5>';
					$out .= '<div class="post-info">';
					$out .= '<div class="postmeta">';
					$out .= '<span>'. get_the_time('M  j   Y', get_the_id()) .'</span>/ ';
					ob_start();
					$out .= '<span>';
					echo comments_popup_link( __( '0 Comment', 'musicplay' ), __( '1 Comment', 'musicplay' ), __( '% Comments', 'musicplay' ) );
					$out .= ob_get_clean();	
					$out .=	'</span>';	
					$out .='</div>';
					$out .='</div>';
					$out .='</div>';
					$out .= '<div class="post-entry">';
					$out .= wp_html_excerpt(get_the_excerpt(''),120);
					$out .= '</div>';
					$out .='</div>';
				}
			}
			endwhile;
		endif;
			
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
		wp_reset_query();
			
		return $out;
	} 

	add_shortcode('blog_carousel','iva_blog_carousel');


?>