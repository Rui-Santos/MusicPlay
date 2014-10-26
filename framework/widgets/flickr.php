<?php
/**
 * Plugin Name: Flickr Widget
 * Description: A widget used for displaying flickr photos.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
	// Register Widget 
	function flickr_widgets() {
		register_widget( 'flickr_widgets' );
	}
	
	// Define the Widget as an extension of WP_Widget
	class flickr_widgets extends WP_Widget {

		function flickr_widgets() {

			/* Widget settings. */
			$widget_ops = array(
				'classname'		=> 'flickr-wg',
				'description'	=> __('Use this widget to display your flickr gallery.', 'ATP_ADMIN_SITE')
			);

			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'flickr_widget'
			);

			/* Create the widget. */
			$this->WP_Widget( 'flickr_widget',THEMENAME.' - Flickr Photos', $widget_ops, $control_ops );
		}

		// outputs the content of the widget
		function widget( $args, $instance ) {
			extract( $args );

			$flickr_id 		= $instance['flickr_id'];
			$flickr_limits 	= $instance['flickr_limits'];
			$title 			= $instance['flickr_title'];

			echo $before_widget;
			if(	$title	) {
			echo $before_title.$title.$after_title;
			}?>
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $flickr_limits; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_id; ?>"></script>
			<?php
			echo $after_widget;
		}
		
		//processes widget options to be saved
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['flickr_title'] 	= strip_tags( $new_instance['flickr_title'] );
			$instance['flickr_id'] 		= strip_tags( $new_instance['flickr_id'] );
			$instance['flickr_limits'] 	= strip_tags( $new_instance['flickr_limits'] );
		
			return $instance;
		}

		// outputs the options form on admin
		function form( $instance ) {
			$instance 		= wp_parse_args( (array) $instance, array( 'flickr_title' => '','sys_subtitle' =>'','flickr_id' => '','flickr_limits' => '') );
			$title 			= strip_tags($instance['flickr_title']);
			$flickr_id 		= strip_tags($instance['flickr_id']);
			$flickr_limits 	= strip_tags($instance['flickr_limits']);
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'flickr_title' ); ?>"><?php _e('Title:', 'ATP_ADMIN_SITE'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'flickr_title' ); ?>" name="<?php echo $this->get_field_name( 'flickr_title' ); ?>" value="<?php echo $title; ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>"><?php _e('Flickr ID: <small>Find your ID from <a href="http://idgettr.com" target="_blank">idGettr</a></small>', 'ATP_ADMIN_SITE'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" value="<?php echo $flickr_id; ?>" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'flickr_limits' ); ?>"><?php _e('How many photos you would like to display?:', 'ATP_ADMIN_SITE'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'flickr_limits' ); ?>" name="<?php echo $this->get_field_name( 'flickr_limits' ); ?>" value="<?php echo $flickr_limits; ?>" style="width:100%;" />
			</p>
		<?php 
		} 
	} 
	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'flickr_widgets' );
?>