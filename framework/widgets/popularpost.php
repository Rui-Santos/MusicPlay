<?php
/**
 * Plugin Name: Popular Posts Widget
 * Description: A widget used for displaying Popular Posts.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
	// Reset query 
	wp_reset_query();
	
	// Register Widget 
	function popular_widgets() {
		register_widget( 'popular_widgets' );
	}
	
	// Define the Widget as an extension of WP_Widget
	class popular_widgets extends WP_Widget {

		function popular_widgets() {

			/* Widget settings. */
			$widget_ops = array(
				'classname'		=> 'widget_postslist',
				'description'	=> __('Use this widget to display Popular Posts by tags, Thumbnail Enable/Disable.', 'ATP_ADMIN_SITE')
			);

			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'popular_widget'
			);

			/* Create the widget. */
			$this->WP_Widget( 'popular_widget',THEMENAME.' - Popular Posts', $widget_ops, $control_ops );
		}

		// outputs the content of the widget
		function widget( $args, $instance ) {
			extract( $args );
		
			$popular_imagedisable = $instance['popular_imagedisable'];
			$popular_limits = $instance['popular_limits'];
			$title = $instance['popular_title'];
			$popular_select = $instance['popular_select'];
			$popular_description_length = $instance['popular_description_length'];
			
			echo $before_widget;
			if($title) :
			echo $before_title.$title.$after_title;
			endif;
			global $post, $wpdb;
			$show_pass_post = false; 
			$request = "SELECT ID, post_title,post_date,post_content, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments";
			$request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'";
			if( !$show_pass_post ) $request .= " AND post_password =''";

			$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $popular_limits";
			$popular_posts = $wpdb->get_results($request);
			echo "<ul>";
			foreach($popular_posts as $post) {
				if($post){
					echo "<li>";
					$post_content=wp_html_excerpt($post->post_content,$popular_description_length);
					if($popular_imagedisable != "true") {
						$thumb = get_post_thumbnail_id($post->ID); 
						if ($thumb ) {
							$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
							?>
							<div class="thumb">
								<a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>">
								<?php echo atp_resize($post->ID,'','50','50','imgborder',''); ?>
								
								</a>
						<?php 
						echo'</div>';
						}
					}?>	
					<div class="pdesc">
					<a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo $post->post_title ?>">
						<?php echo $post->post_title ?></a>
						<?php if($popular_select == 'time'):?>
						<div class="w-postmeta"><?php echo get_the_date(); ?></div>
						<?php else:?>
						<p><?php echo $post_content; ?>...</p>
						<?php endif;//end Description Length ?>
						</div>
				<?php echo "</li>";
				}
			}
			echo "</ul>"; 
			/* After widget (defined by themes). */
			echo $after_widget;		
		}

		//processes widget options to be saved
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['popular_title'] = strip_tags( $new_instance['popular_title'] );
			$instance['popular_imagedisable'] = strip_tags( $new_instance['popular_imagedisable'] );
			$instance['popular_limits'] = strip_tags( $new_instance['popular_limits'] );
			$instance['popular_select'] = strip_tags( $new_instance['popular_select'] );
			$instance['popular_description_length'] = strip_tags( $new_instance['popular_description_length'] );
			
			return $instance;
		}

		// outputs the options form on admin
		function form( $instance ) {
				/* Set up some default widget settings. */
			$instance = wp_parse_args( (array) $instance, array( 'popular_title' => '','popular_imagedisable' => '') );
			$popular_select = isset( $instance['popular_select'] ) ? $instance['popular_select'] : 'time';
			if ( !isset($instance['popular_description_length']) || !$popular_description_length = (int) $instance['popular_description_length'] )
			$popular_description_length = 60;
			if ( !isset($instance['popular_limits']) || !$popular_limits = (int) $instance['popular_limits'] )
				$popular_limits = 3;
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'popular_title' ); ?>"><?php _e('Title:', 'ATP_ADMIN_SITE'); ?></label>
				<input id="<?php echo $this->get_field_id( 'popular_title' ); ?>" name="<?php echo $this->get_field_name( 'popular_title' ); ?>" value="<?php echo $instance['popular_title']; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'popular_select' ); ?>"><?php _e('Extra Information:', 'ATP_ADMIN_SITE'); ?></label>
				<select id="<?php echo $this->get_field_id( 'popular_select' ); ?>" name="<?php echo $this->get_field_name( 'popular_select' ); ?>">
					<option value="time" <?php selected($popular_select,'time');?>>Time</option>
					<option value="description" <?php selected($popular_select,'description');?>>Description</option>
				</select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'popular_description_length' ); ?>"><?php _e('Length of Description to show::', 'ATP_ADMIN_SITE'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'popular_description_length' ); ?>" name="<?php echo $this->get_field_name( 'popular_description_length' ); ?>" value="<?php echo $popular_description_length; ?>" size="3" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'popular_limits' ); ?>"><?php _e('Number of posts to show:', 'ATP_ADMIN_SITE'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'popular_limits' ); ?>" name="<?php echo $this->get_field_name( 'popular_limits' ); ?>" value="<?php echo $popular_limits; ?>" size="3" />
			</p>
			<p>
				<input type="checkbox" value="true" id="<?php echo $this->get_field_id( 'popular_imagedisable' ); ?>" name="<?php echo $this->get_field_name( 'popular_imagedisable' ); ?>" <?php  if( $instance['popular_imagedisable']=="true") { echo "checked"; } ?> class="checkbox" /> <label for="<?php echo $this->get_field_id( 'popular_imagedisable' ); ?>"><?php _e('Disable Post Thumbnail?', 'ATP_ADMIN_SITE'); ?></label>
			</p>
		<?php 
		} 
	}
	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'popular_widgets' );
	
	wp_reset_query();
?>