<?php wp_reset_query(); ?>
	
	<div id="sidebar">
		<div class="sidebar-inner widget-area">
		
			<?php 
			$widget = '';
			/**
			 * Check if widget pages are there
			 * then display opted widgets for that page's sidebar
			 * else display default sidebar
			 */
			if ( is_archive() || is_search() ) {
				//
			} else {
				$widgets = get_post_meta( $post->ID, 'custom_widget', true);
				$widget = strtolower( preg_replace('/\s+/', '-',$widgets ) );
				//loop through the widget pages
			}
			/**
			 * If current page falls under widget pages
			 * then display sidebar widgets accordingly
			 * Otherwise display default widgets
			 */
			
			if ( $widget ) {
				if ( function_exists( 'dynamic_sidebar' ) && dynamic_sidebar( 'sidebar-'.$widget ) ) : endif;
			} else {
				if ( !dynamic_sidebar( 'defaultsidebar' )) : 
			endif;
			}
			?>
		</div><!-- .widget-area -->
	</div><!-- #sidebar -->