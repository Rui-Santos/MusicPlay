<div id="featured_slider">
	<div class="slider_stretched">
		<?php 
		$pageslider = get_post_meta($post->ID,'page_slider', true);
		if( $pageslider != "" ) {
			$slider = get_post_meta($post->ID,'customslider', true);
		  }else{
				$slider = get_option( 'atp_customslider' ); 
		}
		echo do_shortcode($slider); 
		?>
	</div><!-- .slider_stretched -->
</div><!-- #featured_slider -->