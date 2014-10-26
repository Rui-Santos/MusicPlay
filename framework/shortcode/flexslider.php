<?php
	// FLEX SLIDER - Attachments
	//--------------------------------------------------------
	function iva_flexslider($atts, $content = null) {
		extract(shortcode_atts(array(
			'id'		=> '1',
			'width'		=> '630',
			'height'	=> '350',
			'effect'	=> 'fade',
			'speed'		=> 'fade',
			'limits'	=> '',
			'navigation'=> 'true',
			'cat'		=> '',
		), $atts));
		
		wp_print_scripts( 'atp-flexslider' );
		wp_enqueue_style( 'flexslider' );
		
		$pausetime = '';
		$id = rand(1,200);
		$width=(int) $width;
		$height=(int) $height;
		sys_flexslider_scripts($height, $speed, $width, $id, $effect, $pausetime, $navigation );
		
		$out = '<div class="flexslider'.$id.' flexslider">';
		$out .= '<ul class="slides">';
		if ( $cat ) {
			$loop = new WP_Query(array( 'cat' => $cat, 'posts_per_page' =>$limits));
		}
		if ( $cat == "" ){  
			$loop = new WP_Query(array( 'post_type'	=> 'slider'));
		}
		
		while ($loop->have_posts()) : $loop->the_post(); 
			
			global $post;

			$attachments = get_children("post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=$limits&orderby=menu_order ASC, ID ASC");	
			$img_alt_title 		= get_the_title();
			foreach ( $attachments as $id => $attachment ) {
					$full_attachment = wp_get_attachment_image_src( $attachment->ID, 'full' );
					$out .= '<li>';
					$out .= atp_resize('', $full_attachment['0'], $width, $height, '', $img_alt_title );
					$out .= '</li>';
			}
			
		endwhile;
		wp_reset_query();
		$out .= '</ul></div>';
		return $out;
	}
	add_shortcode('slider','iva_flexslider');

	// FLEX SLIDER SCRIPT 
	//--------------------------------------------------------
	function sys_flexslider_scripts($height,$speed,$width,$id,$effect,$pausetime,$navigation) { 
	echo'<script type="text/javascript">
	jQuery(window).load(function() {
		jQuery(".flexslider'.$id.'").flexslider({
			animation: "'.$effect.'",
			controlsContainer: ".flex-container",
			slideshow: true,					
			slideshowSpeed: '.$speed.',		
			animationDuration: 400,			
			directionNav: false,				
			controlNav: '.$navigation.',		
			mousewheel: true					
		});
	});
	</script>';
	}
	
	// FLEX SLIDER POST 
	//--------------------------------------------------------
	function iva_post_fslider($atts, $content = null) {
		extract(shortcode_atts(array(
			'id'		=> '1',
			'width'		=> '300',
			'height'	=>'150',
			'effect'	=> 'fade',
			'speed'		=> '500',
			'limits'	=> '',
			'navigation'=> 'true',
			'cat'		=>'',
		), $atts));
			wp_print_scripts( 'jquery_flex' );
		wp_enqueue_style( 'flexslider-style' );
		
		$pausetime = '';
		$id = rand(20,200);
		post_postflex_scripts($height,$speed,$width,$id,$effect,$pausetime,$navigation);
		$out = '<div class="flexslider'.$id.' flexslider">';
		$out .= '<ul class="slides">';
		
		global $post;
		$pid = $post->ID;
		$attachments = get_children("post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=$limits&orderby=menu_order ASC, ID ASC");	
		$img_alt_title 		= get_the_title();
		$width=(int) $width;
		$height=(int) $height;
		foreach ( $attachments as $id => $attachment ) {
				$full_attachment=wp_get_attachment_image_src($attachment->ID, 'full');
				$out .= '<li>';
				$out .= atp_resize('',$full_attachment[0],$width,$height,'', $img_alt_title );
				$out .= '</li>';
		
		}
		$out .= '</ul></div>';

		return $out;
		wp_reset_query();
	}
	add_shortcode('postslider','iva_post_fslider');

	// POST SLIDER SCRIPT 
	//--------------------------------------------------------
	function post_postflex_scripts($height,$speed,$width,$id,$effect,$pausetime,$navigation) {
	echo'<script type="text/javascript">
	/* <![CDATA[ */
	jQuery(window).load(function() {
		jQuery(".flexslider'.$id.'").flexslider({
			controlsContainer: ".flex-container",
			animation: "'.$effect.'",
			slideshow: true,					//Boolean: Animate slider automatically
			slideshowSpeed: '.$speed.',				//Integer: Set the speed of the slideshow cycling, in milliseconds
			animationDuration: 1200,			//Integer: Set the speed of animations, in milliseconds
			directionNav: false,				//Boolean: Create navigation for previous/next navigation? (true/false)
			controlNav: '.$navigation.',					//Boolean: Create navigation for paging control of each clide? Note: Leave true for	
			mousewheel: true,					//Boolean: Allow slider navigating via mousewheel				  
			start: function(slider) {
				jQuery(".total-slides").text(slider.count);
			},
			after: function(slider) {
				jQuery(".current-slide").text(slider.currentSlide);
			}
		});
	});
	/* ]]> */
	</script>';
	}
?>