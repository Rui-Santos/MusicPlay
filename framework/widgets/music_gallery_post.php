<?php
/**
 * Plugin Name: Gallery Post  Widget
 * Description: A widget used for displaying Gallery  Info.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
	// Register Widget 
	function gallery_post_widgets() {
		register_widget( 'gallery_post_widgets' );
	}
	
	// Define the Widget as an extension of WP_Widget
	class gallery_post_widgets extends WP_Widget {

		function gallery_post_widgets() {
			
			/* Widget settings. */
			$widget_ops = array(
				'classname'		=> 'gallery_post-wg',
				'description'	=> __('Add Post Gallery to your widget  .', 'ATP_ADMIN_SITE')
			);

			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'gallery_post_widgets'
			);

			/* Create the widget. */
			$this->WP_Widget( 'gallery_post_widgets',THEMENAME.' - Post Gallery', $widget_ops, $control_ops );
		}
	
		// outputs the content of the widget
		function widget( $args, $instance ) {
			global $post;
			extract( $args );
			$title = $instance['gallery_post_title'];
			$gallerypost_id = $instance['gallery_post_postid'];
			
			echo $before_widget;
			if( $title ) {
				echo $before_title.$title.$after_title; 
			}
			
			$postid_array  	= array();
			$postid_array  	= explode(',',$gallerypost_id);
			$post_args     	= array(
			'post_type' 	=> 'gallery',
			'post__in'		=> $postid_array,
			'post_per_page'	=>'1'
			);
		
			$the_query = new WP_Query( $post_args );
			if ($the_query->have_posts()) :
				echo '<div class="gallery-list">';
				while ($the_query->have_posts()):$the_query->the_post();
					$gallery_venue			= get_post_meta( $post->ID, 'gallery_venue', true );
					$gallery_upload			= get_post_meta( $post->ID, 'gallery_upload', true );
					$img_alt_title 		= get_the_title();
					?>
					<div class="custompost_thumb port_img">
						<?php if( has_post_thumbnail()){ ?>
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>">
							<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
								echo '<figure>';
								echo atp_resize( $post->ID, '', '470', '470', '', $img_alt_title );
								echo '</figure>'; 
								echo '<div class="hover_type">';
								echo '<a class="hovergallery"  href="' .get_permalink(). '" title="' . get_the_title() . '"></a>';
								echo '</div>'; ?>
							</a>
						<?php } ?>
						</div>
						<div class="gallery-desc">
							<h2 class="entry-title">
							<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a>
							</h2>
							<?php
							$gallery = get_post_meta($post->ID,'gallery_upload',true) ? get_post_meta($post->ID,'gallery_upload',true) :'';
							$gallery_img= array();
							$gallery_img = explode( ',', $gallery );
							$count = count($gallery_img);
							if ( $gallery_venue != '' ) { 
								echo '<span>'.$gallery_venue.'</span>';
							}
							?>
						</div>
				<?php 
				endwhile;
				echo '</div>';
			endif;
			echo $after_widget;
		}
		
		//processes widget options to be saved
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['gallery_post_title'] 			= strip_tags( $new_instance['gallery_post_title'] );
			$instance['gallery_post_postid'] 			= strip_tags( $new_instance['gallery_post_postid'] );
		
			return $instance;
		}

		// outputs the options form on admin
		function form( $instance ) {
			/* Set up some default widget settings. */
			$instance = wp_parse_args( (array) $instance, array( 'gallery_post_title' => '', 'gallery_post_postid' => '' ) );
			$title 					= strip_tags($instance['gallery_post_title']);
			$gallery_postid			= strip_tags($instance['gallery_post_postid']);
			
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'gallery_post_title' ); ?>"><?php _e('Title', 'ATP_ADMIN_SITE'); ?></label>
				<input id="<?php echo $this->get_field_id( 'gallery_post_title' ); ?>" name="<?php echo $this->get_field_name( 'gallery_post_title' ); ?>" value="<?php echo $title; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'gallery_post_postid' ); ?>"><?php _e('Post ID', 'ATP_ADMIN_SITE'); ?></label>
				<input id="<?php echo $this->get_field_id( 'gallery_post_postid' ); ?>" name="<?php echo $this->get_field_name( 'gallery_post_postid' ); ?>" value="<?php echo $gallery_postid; ?>" type="text" style="width:100%;" />
			</p>
			
			<?php 
		} 
	}

	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'gallery_post_widgets' );
?>