<?php
/**
 * Plugin Name: Recent Posts Widget
 * Description: A widget used for displaying recent posts.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
class recentpost_widgets extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_postslist', 'description' => __( "The most recent posts on your site",'ATP_ADMIN_SITE') );
		parent::__construct('recentpost_entries', __(THEMENAME.'-Recent Posts','ATP_ADMIN_SITE'), $widget_ops);
		$this->alt_option_name = 'recentpost_entries';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('recentpost_widgets', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts','ATP_ADMIN_SITE') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;
		if ( empty( $instance['description_length'] ) || ! $description_length = absint( $instance['description_length'] ) )
 			$description_length = 40;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$imagedisable = isset( $instance['recentpost_imagedisable'] ) ? $instance['recentpost_imagedisable'] : false;
		$cat = isset( $instance['cat'] ) ? $instance['cat'] : '';
		$r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'cat' =>$cat ,'ignore_sticky_posts' => true,'orderby'=>'ID') ) );
		if ($r->have_posts()) :
?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
			<?php
				if($imagedisable != "true") {
					$thumb = get_post_thumbnail_id(); 
					if ($thumb ){
						$post_thumbnail_id = get_post_thumbnail_id();
						?>
						<div class="thumb"><a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>"> 
						<?php echo atp_resize(get_the_ID(),'','50','50','imgborder',''); ?>
						</a>
						</div>
				<?php }
				}
				?>
				<div class="pdesc">
				<a href="<?php the_permalink() ?>" title="<?php echo esc_attr( get_the_title() ? get_the_title() : get_the_ID() ); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a>
			<?php if ( $show_date == "true" ) : ?>
				<div class="w-postmeta"><?php echo get_the_date(); ?></div>
			<?php else:?>
						<p><?php echo  wp_html_excerpt(get_the_content(),$description_length); ?>...</p>
				<?php endif;//end Description Length ?>
			</div>
			
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('recentpost_widgets', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = $new_instance['number'];
		$instance['description_length'] = (int) $new_instance['description_length'];
		$instance['show_date'] = (bool) $new_instance['show_date'];
		$instance['recentpost_imagedisable'] = (bool) $new_instance['recentpost_imagedisable'];
		$this->flush_widget_cache();
		$instance['cat'] = $new_instance['cat'];
		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['recentpost_widgets']) )
			delete_option('recentpost_widgets');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$description_length    = isset( $instance['description_length'] ) ? absint( $instance['description_length'] ) : 40;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$imagedisable = isset( $instance['show_date'] ) ? (bool) $instance['recentpost_imagedisable'] : false;
		$cat    = isset( $instance['cat'] ) ?  esc_attr($instance['cat'])  : '';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','ATP_ADMIN_SITE'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:','ATP_ADMIN_SITE' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<p><label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php _e( 'Category Id:','ATP_ADMIN_SITE' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" type="text" value="<?php echo $cat; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date','ATP_ADMIN_SITE' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?','ATP_ADMIN_SITE' ); ?></label></p>
		<p><label for="<?php echo $this->get_field_id( 'description_length' ); ?>"><?php _e( 'Length of Description to show:','ATP_ADMIN_SITE' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'description_length' ); ?>" name="<?php echo $this->get_field_name( 'description_length' ); ?>" type="text" value="<?php echo $description_length; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $imagedisable ); ?> id="<?php echo $this->get_field_id( 'recentpost_imagedisable' ); ?>" name="<?php echo $this->get_field_name( 'recentpost_imagedisable' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'recentpost_imagedisable' ); ?>"><?php _e( 'Disable Post Thumbnail?','ATP_ADMIN_SITE' ); ?></label></p>
<?php
	}
}
// Register Widget 
	function recentpost_widgets() {
		register_widget( 'recentpost_widgets' );
	}

add_action( 'widgets_init', 'recentpost_widgets' );		
 ?>