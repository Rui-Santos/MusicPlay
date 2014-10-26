<?php
/**
 * Plugin Name: Artist Widget
 * Description: A widget used for displaying Gallery  Info.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
	// Register Widget 
	function artist_widgets() {
		register_widget( 'artist_widgets' );
	}
	
	// Define the Widget as an extension of WP_Widget
	class artist_widgets extends WP_Widget {

		function artist_widgets() {
			
			/* Widget settings. */
			$widget_ops = array(
				'classname'		=> 'artist-wg',
				'description'	=> __('Add Gallery Info to your widget  .', 'ATP_ADMIN_SITE')
			);

			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'artist_widgets'
			);

			/* Create the widget. */
			$this->WP_Widget( 'artist_widgets',THEMENAME.' - Artist ', $widget_ops, $control_ops );
		}
	
		// outputs the content of the widget
		function widget( $args, $instance ) {
			global $post;
			extract( $args );
			$title 				= $instance['artist_title'];
			 $artist_postid		= $instance['artist_postid'];
			
			echo $before_widget;
			if( $title ) {
				echo $before_title.$title.$after_title; 
			}
			
			$postid_array  	= array();
			$postid_array  	= explode(',',$artist_postid);
			$post_args     	= array(
			'post_type' 	=> 'artists',
			'post__in'		=> $postid_array,
			);
		
			$the_query = new WP_Query( $post_args );
			if ($the_query->have_posts()) :
				echo '<div class="artist-list">';
				while ($the_query->have_posts()):$the_query->the_post();
					$artist_genres 		= get_post_meta( $post->ID, 'artist_genres', true );
					$thumb = get_post_thumbnail_id($the_query->post->ID);
					$img_alt_title 		= get_the_title();
					$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full', true );
					if ($thumb ){
						?>
						<div class="custompost_thumb port_img">
							<a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"> 
								<?php echo atp_resize($the_query->post->ID,'','470','470','', $img_alt_title ); ?>
							</a>
							<?php 
							echo '<div class="hover_type">';
							echo '<a class="hoverartist"  href="' .get_permalink(). '" title="' . get_the_title() . '"></a>';
							echo '</div>'; ?>
						</div>
						<div class="artist-desc">
							<h2 class="entry-title">
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a>
							</h2>
							<?php if ( $artist_genres !='' ) { ?>
								<span><?php echo $artist_genres; ?></span>
							<?php } ?>
						</div>
						<?php 
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
			$instance['artist_title'] 			= strip_tags( $new_instance['artist_title'] );
			$instance['artist_postid'] 			= strip_tags( $new_instance['artist_postid'] );
		
			return $instance;
		}

		// outputs the options form on admin
		function form( $instance ) {
			/* Set up some default widget settings. */
			$instance = wp_parse_args( (array) $instance, array( 'artist_title' => '', 'artist_postid' => '' ) );
			$title 					= strip_tags($instance['artist_title']);
			$artist_postid 			= strip_tags($instance['artist_postid']);
			
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'artist_title' ); ?>"><?php _e('Title', 'ATP_ADMIN_SITE'); ?></label>
				<input id="<?php echo $this->get_field_id( 'artist_title' ); ?>" name="<?php echo $this->get_field_name( 'artist_title' ); ?>" value="<?php echo $title; ?>" type="text" style="width:100%;" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id( 'artist_postid' ); ?>"><?php _e('Post ID', 'ATP_ADMIN_SITE'); ?></label>
				<input id="<?php echo $this->get_field_id( 'artist_postid' ); ?>" name="<?php echo $this->get_field_name( 'artist_postid' ); ?>" value="<?php echo $artist_postid; ?>" type="text" style="width:100%;" />
			</p>
			
			<?php 
		} 
	}

	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'artist_widgets' );
?>