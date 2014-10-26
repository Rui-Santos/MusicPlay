<?php

	add_action( 'wp_enqueue_scripts', 'owl_carousel_scripts' );

	// Testimonials
	//--------------------------------------------------------
	function iva_tesimonialcarousel($atts, $content = null) {
		extract(shortcode_atts(array(
			'cat'		=> '',
			'limit'		=> '5',
			'title'		=> '',
			'items'     => ''
		), $atts));
		global $post;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$query = array(
			'post_type'			=> 'testimonialtype', 
			'posts_per_page'	=> $limit, 
			'taxonomy'			=> 'testimonial_cat', 
			'paged'				=> $paged,
			'term'				=> $cat, 
			'order'				=> 'DESC'
		);

		$tesimonial_query = new WP_Query( $query );

		$testimonial_gravatar_image = '';
		$carousel_id = rand(10,99);
		
		$out = '<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#carousel-'.$carousel_id.'").owlCarousel({
				autoPlay: 3000,
				items :'.$items.',
				itemsDesktop : [1199,4],
				itemsDesktopSmall : [979,4],
				itemsTablet : [768,2],
				itemsMobile : [479,1]
			});
		});	
		</script>';
	$out .= '<div class="list_jcarousel tesimonial">';
	if( $title !='' ){
		$out .= '<h2 class="carousel-title fancyheading textcenter"><span>'.$title.'</span></h2>';
	}
	$out .= '<div id="carousel-'.$carousel_id.'"  class="owl-carousel">';
		if ($tesimonial_query->have_posts()) : while ($tesimonial_query->have_posts()) : $tesimonial_query->the_post();

		$website_name				= get_post_meta( $post->ID, 'websitename', true );
		$website_url				= get_post_meta( $post->ID, 'website_url', true );
		$testimonial_image_option	= get_post_meta( $post->ID, 'testimonial_image_option',true );
		$target_link        =  get_post_meta($post->ID, 'target_link', true) != 'on' ? '' :"target='_blank'";
		$testimonial_content		= get_the_content( $post->ID );
		switch( $testimonial_image_option ){
			case 'gravatar':
							$testimonial_email=get_post_meta($post->ID,'testimonial_email',true);
							$testimonial_gravatar_image=get_avatar($testimonial_email, 40);
							break;
			case 'customimage':
							if( has_post_thumbnail()){
								$testimonial_gravatar_image= atp_resize($post->ID,'','40','40','imageborder','');
							}
							break;
		}
		$before = $after = '';

		// post title
		$out .= '<div class="item">';
		$out .= '<div class="testimonial-box">';
		if( $testimonial_gravatar_image != '' ){
			$out .= '<div class="client-image">'.$testimonial_gravatar_image.'</div>';
		}
		$out .= '<div class="testimonial-content"><p>'.$testimonial_content.'</p></div>';
		if( $website_url != '' ){
			$before = '<a href="'.esc_url($website_url).'" '.$target_link.'>';
			$after = '</a>';
		}
		$clientname = '<strong class="client-name">'.get_the_title().'</strong>';
		if( $website_name != '' ){
			$out .= '<div class="client-meta">'.$clientname.$before.$website_name.$after.'</div>';
		}

		$out .= '</div>'; 
		$out .= '</div>'; 
		endwhile;
		endif;
		$out .= '</div>';
		$out .= '</div><div class="clear"></div>';

		wp_reset_query();
		return $out;
		
	}
	//end caroufredsel_slider function

	add_shortcode('testimonialcarousel','iva_tesimonialcarousel');

	// Testimonials
	//--------------------------------------------------------

		function iva_tesimoniallist ($atts, $content = null) {
		extract(shortcode_atts(array(
			'cat'		=> '',
			'limit'		=> '5',
			'title'		=> ''
		), $atts));
		global $post;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$query = array(
			'post_type'			=> 'testimonialtype', 
			'posts_per_page'	=> $limit, 
			'taxonomy'			=> 'testimonial_cat', 
			'paged'				=> $paged,
			'order'				=> 'DESC'
		);
	
		$tm_speed = get_option('atp_tm_speed') ? get_option('atp_tm_speed') : '3000';
		$tesimonial_query = new WP_Query( $query );

		$testimonial_gravatar_image = $rand = '';
		$eventcarousel_id=rand(10,99);

		echo'<script type="text/javascript">
		jQuery(document).ready(function() {
		atpcustom.MySlider('.$tm_speed.',"testimonial'.$rand.'");
		});
		</script>';
		$out = '';
		$out .= '<div id="testimonial'.$rand.'" class="testimonial_list"><ul class="testimonials">';

		if ($tesimonial_query->have_posts()) : while ($tesimonial_query->have_posts()) : $tesimonial_query->the_post();

		$website_name				= get_post_meta( $post->ID, 'websitename', true );
		$website_url				= get_post_meta( $post->ID, 'website_url', true );
		$testimonial_image_option	= get_post_meta( $post->ID, 'testimonial_image_option',true );
		$target_link        =  get_post_meta($post->ID, 'target_link', true) != 'on' ? '' :"target='_blank'";
		$testimonial_content		= get_the_content( $post->ID );
		switch( $testimonial_image_option ){
			case 'gravatar':
							$testimonial_email=get_post_meta( $post->ID,'testimonial_email',true );
							$testimonial_gravatar_image=get_avatar( $testimonial_email, 40 );
							break;
			case 'customimage':
							if( has_post_thumbnail()){
								$testimonial_gravatar_image= atp_resize($post->ID,'','40','40','imageborder','');
							}							
							break;
		}
		$before = $after = '';

		// post title
		$out .= '<li>';
		$out .= '<div class="testimonial-box">';
		$out .= '<div class="testimonial-content"><p>'.$testimonial_content.'</p></div>';
		if( $testimonial_gravatar_image != '' ){
			$out .= '<div class="client-image">'.$testimonial_gravatar_image.'</div>';
		}		
		if( $website_url != '' ){
			$before = '<a href="'.esc_url($website_url).'" '.$target_link.'>';
			$after = '</a>';
		}
		$clientname = '<strong class="client-name">'.get_the_title().'</strong>';
		if( $website_name != '' || $clientname != '' ){
			$out .= '<div class="client-meta">'.$clientname.$before.$website_name.$after.'</div>';
		}
		$out .= '<div class="testimonial-arrow"></div>'; 
		$out .= '</div>'; 
		$out .='</li>'; 

		endwhile;
		endif;
		$out .= '</ul></div><div class="clear"></div>';

		wp_reset_query();
		return $out;
		
	} //end caroufredsel_slider function
	add_shortcode( 'testimoniallist', 'iva_tesimoniallist' );
?>