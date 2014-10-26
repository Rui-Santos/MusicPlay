<?php
/**
 * Plugin Name: Latest Video Widget
 * Description: A widget used for displaying Latest Video.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
	// Register Widget 
	function latestvideo_widgets() {
		register_widget( 'latestvideo_widgets' );
	}
	
	// Define the Widget as an extension of WP_Widget
	class latestvideo_widgets extends WP_Widget {

		function latestvideo_widgets() {
			
			/* Widget settings. */
			$widget_ops = array(
				'classname'		=> 'latestvideo-wg',
				'description'	=> __('Add Contact Info to your widget  .', 'ATP_ADMIN_SITE')
			);

			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 100,
				'height'	=> 150,
				'id_base'	=> 'latestvideo_widgets'
			);

			/* Create the widget. */
			$this->WP_Widget( 'latestvideo_widgets',THEMENAME.' - Video', $widget_ops, $control_ops );
		}
	
		// outputs the content of the widget
		function widget( $args, $instance ) {
			extract( $args );
			$title 					= $instance['latestvideo_title'];
			$post_id 				= $instance['post_id'];
			
			global $post;
			echo $before_widget;
			if( $title ) {
				echo $before_title.$title.$after_title; 
			}
			$postid_array = array();
			$postid_array 	= explode(',',$post_id);

			$post_args 		= array(
				'post_type' => 'video',
				'post__in'	=> $postid_array,
			);
		
			$query = new WP_Query( $post_args );
			while ($query->have_posts() ) : $query->the_post();
			$varb =$query->post->ID;
			$video_list 		= get_post_meta($varb,'video_youtube_link',true);
			$video_vimeolist 	= get_post_meta($varb,'video_vimeo_link',true);
			$video_selfhost_video  = get_post_meta($varb,'video_selfhost_video',true);
			$video_type_option		= get_post_meta( $varb, 'video_type_option', true );
			$video_venue			= get_post_meta( $post->ID, 'video_venue', true );
			$alt 				= get_the_title( $varb );
			
			// Generate Output
			$out = '<div class="video-list">';
			$out .= '<div class="custompost_thumb port_img">';
			$out .= '<figure>'.atp_resize($varb,'','470','470','',$alt).'</figure>';
			$out .= '<div class="hover_type">';
			if( $video_type_option!=''){
 				switch($video_type_option) {
						case 'youtubelink':
										$out .= '<a class="hovervideo" href="http://www.youtube.com/watch?v='.$video_list.'" data-rel="prettyPhoto[video]">';
										break;
						case 'vimeolink':
										$out .= '<a class="hovervideo" href="http://vimeo.com/'.$video_vimeolist.'" data-rel="prettyPhoto[video]">';
										break;
						case 'selfvideo':
										$out .= '<a class="hovervideo" href="'.$video_selfhost_video.'" data-rel="prettyPhoto[custom]">';
										break;
				}
				$out .='</a>';	
			}
			$out .= '</div>';
			$out .= '</div>';
			$out .= '<div class="video-desc"><h2 class="entry-title">'. $alt .'</h2><span>'. $video_venue .'</span>';
			$out .= '</div>';

			echo $out;

			endwhile;  

			echo $after_widget;
		}
		
		//processes widget options to be saved
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['latestvideo_title'] 	= strip_tags( $new_instance['latestvideo_title'] );
			$instance['post_id'] 			= strip_tags( $new_instance['post_id'] );
			return $instance;
		}

		// outputs the options form on admin
		function form( $instance ) {
			/* Set up some default widget settings. */
			$instance = wp_parse_args( (array) $instance, array( 'latestvideo_title' => '', 'post_id' => '' ));
			$title    = strip_tags($instance['latestvideo_title']);
			$post_id  = strip_tags($instance['post_id']);
			
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'latestvideo_title' ); ?>"><?php _e('Title', 'ATP_ADMIN_SITE'); ?></label>
				<input id="<?php echo $this->get_field_id( 'latestvideo_title' ); ?>" name="<?php echo $this->get_field_name( 'latestvideo_title' ); ?>" value="<?php echo $title; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e('Post ID', 'ATP_ADMIN_SITE'); ?></label>
				<input id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>" value="<?php echo $post_id; ?>" type="text" style="width:100%;" />
			</p>
			
		<?php 
		} 
	}
	/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'latestvideo_widgets' );
?>