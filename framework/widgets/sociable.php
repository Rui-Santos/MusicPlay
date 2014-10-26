<?php
/**
 * Plugin Name: Sociable Widget
 * Description: A widget used for displaying Sociable.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
	// Register Widget 
	function sociable_widgets() {
		register_widget( 'sociable_widget' );
	}

	// Define the Widget as an extension of WP_Widget
	class sociable_widget extends WP_Widget {

		function sociable_widget() {
			
			/* Widget settings. */
			$widget_ops = array( 
				'classname'		=> 'socials-wg',
				'description'	=> __('Sociable widget for sidebar.', 'ATP_ADMIN_SITE')
			);
	
			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'sociable_widget'
			);

			/* Create the widget. */
			$this->WP_Widget( 'sociable_widget',THEMENAME.' - Sociables', $widget_ops, $control_ops );
		}

		// outputs the content of the widget
		function widget( $args, $instance ) {
			extract( $args );

			$title = $instance['title'];
			echo $before_widget;
			if ($title) {
				echo $before_title.$title.$after_title;
			}
			$color = $instance['color'];
			//echo atp_social();
			$atp_sociable="[sociable color=$color]";
			echo do_shortcode($atp_sociable);
			
			echo $after_widget;
		}
		
		//processes widget options to be saved
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['color'] = strip_tags( $new_instance['color'] );
			
			return $instance;
		}
		
		// outputs the options form on admin
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '','color' =>'') );
			$title = strip_tags($instance['title']);
			$color = strip_tags($instance['color']);			
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'Title' ); ?>"><?php _e('Title:', 'ATP_ADMIN_SITE'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" style="width:100%;" />
				<label for="<?php echo $this->get_field_id( 'Color' ); ?>"><?php _e('Color:', 'ATP_ADMIN_SITE'); ?></label>
				<select id="<?php echo $this->get_field_id( 'color' ); ?>" name="<?php echo $this->get_field_name( 'color' );?>" >
					<option value="black" <?php if($color=="black") { echo 'selected="selected"'; } ?>>Black</option>
					<option value="white" <?php if($color=="white") { echo 'selected="selected"'; } ?>>White</option>
				</select>
				
			</p>
		<?php 
		} 
	} 
	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'sociable_widgets' );
?>
