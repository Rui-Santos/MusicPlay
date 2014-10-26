<?php
/**
 * Plugin Name: Gallery Widget
 * Description: A widget used for displaying Gallery  Info.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
	// Register Widget 
	function gallery_photos_widgets() {
		register_widget( 'gallery_photos_widgets' );
	}
	
	// Define the Widget as an extension of WP_Widget
	class gallery_photos_widgets extends WP_Widget {

		function gallery_photos_widgets() {
			
			/* Widget settings. */
			$widget_ops = array(
				'classname'		=> 'gallery_photos-wg',
				'description'	=> __('Add Gallery Info to your widget  .', 'ATP_ADMIN_SITE')
			);

			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'gallery_photos_widgets'
			);

			/* Create the widget. */
			$this->WP_Widget( 'gallery_photos_widgets',THEMENAME.' - Gallery Photos', $widget_ops, $control_ops );
		}
	
		// outputs the content of the widget
		function widget( $args, $instance ) {
			extract( $args );
			$title 				= $instance['gallery_title'];
			$gallery_postid		= $instance['gallery_postid'];
			$number_of_photos	= $instance['number_of_photos'] ? $instance['number_of_photos'] : '9';
			
			
			echo $before_widget;
			if( $title ) {
				echo $before_title.$title.$after_title; 
			}
			$gallery = new WP_Query();
			$gallery->query('post_type=gallery&p=' . $gallery_postid);
			if ($gallery->have_posts()) :
				echo '<div class="gallery-wrap">';;
				while ($gallery->have_posts()):$gallery->the_post();
					$gallery_photos = get_post_meta($gallery_postid,'gallery_upload',true);
					$gallery_upload_img= array();
					$gallery_upload_img	 = explode( ',', $gallery_photos );
					$out='';
					$out .='<div class="label_space"></div>';
					if($gallery_photos) {
						global $wpdb;
						$gallery_photos = $wpdb->get_col("
							SELECT ID FROM {$wpdb->posts}
							WHERE post_type = 'attachment'
							AND ID in ({$gallery_photos})
							ORDER BY ID ASC
						");
					}
					if($gallery_photos !=''){
						$count = 0; 
						foreach($gallery_photos as $attachment_id) {
							$count ++; 
							if($number_of_photos >= $count){
								$attachment = get_post( $attachment_id );
								$image_attributes = wp_get_attachment_image_src( $attachment_id,'full'); // returns an array
								$alt = get_the_title( $attachment->post_title );
								$out ='<div class="gallery-postimg">';
								$out .= '<a href="'.$image_attributes['0'].'" data-rel="prettyPhoto[gallery]">';
								$out .= atp_resize('',$image_attributes[0],'80','80','',$alt);
								$out .= '</a>';
								$out .= '</div>';
								echo $out;
							}
						} 
					}
					
				endwhile;
				echo '</div>';
				
			endif;

			echo $after_widget;
		}
		
		//processes widget options to be saved
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['gallery_title'] 			= strip_tags( $new_instance['gallery_title'] );
			$instance['gallery_postid'] 		= strip_tags( $new_instance['gallery_postid'] );
			$instance['number_of_photos'] 		= strip_tags( $new_instance['number_of_photos'] );
			return $instance;
		}

		// outputs the options form on admin
		function form( $instance ) {
			/* Set up some default widget settings. */
			$instance = wp_parse_args( (array) $instance, array( 'gallery_title' => '', 'gallery_postid' => '', 'number_of_photos' => '', ) );
			$title 					= strip_tags($instance['gallery_title']);
			$gallery_postid 		= strip_tags($instance['gallery_postid']);
			$number_of_photos 		= strip_tags($instance['number_of_photos']);
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'gallery_title' ); ?>"><?php _e('Title', 'ATP_ADMIN_SITE'); ?></label>
				<input id="<?php echo $this->get_field_id( 'gallery_title' ); ?>" name="<?php echo $this->get_field_name( 'gallery_title' ); ?>" value="<?php echo $title; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'gallery_postid' ); ?>"><?php _e('Post ID', 'ATP_ADMIN_SITE'); ?></label>
				<input id="<?php echo $this->get_field_id( 'gallery_postid' ); ?>" name="<?php echo $this->get_field_name( 'gallery_postid' ); ?>" value="<?php echo $gallery_postid; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'number_of_photos' ); ?>"><?php _e('Number Of Photos', 'ATP_ADMIN_SITE'); ?></label>
				<input id="<?php echo $this->get_field_id( 'number_of_photos' ); ?>" name="<?php echo $this->get_field_name( 'number_of_photos' ); ?>" value="<?php echo $number_of_photos; ?>" type="text" style="width:100%;" />
			</p>
		<?php 
		} 
	}
	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'gallery_photos_widgets' );
?>