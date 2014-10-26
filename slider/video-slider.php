<div id="featured_slider" class="clearfix">
	<div class="slider_stretched">
		<div class="videoslider">
		
		<?php 
		$pageslider = get_post_meta($post->ID,'page_slider', true);
		if( $pageslider != "" ) {
			$video = get_post_meta($post->ID,'videoslider', true);
		  }else{
				$video = get_option( 'atp_video_id' ); 
		}
		echo do_shortcode($video); 
		?>
		
		</div><!-- .videoslider -->
	</div><!-- .slider_stretched -->
</div><!-- #featured_slider -->