<?php
/**
 * Testimonial
 */

	class WP_Widget_testimonial extends WP_Widget {

	function __construct() {
		
		$widget_ops = array(
			'classname' => 'widget_testimonial',
			'description' => 'Testimonial'
		);
		
		parent::__construct('Testimonial',  THEMENAME.' - Testimonial', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base);
		$category = empty( $instance['tcategory'] ) ? '' : $instance['tcategory'];
		$limits = empty( $instance['limits'] ) ? '4' : $instance['limits'];

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		$args = array(
			'post_type' => 'testimonialtype',
			'posts_per_page' => $limits,
			'tax_query' => array(
				array(
					'taxonomy'	=> 'testimonial_cat',
					'field'		=> 'slug',
					'terms'		=> $category
				)
			)
		);
	
		$testimonial = new WP_Query( $args );
		$rand = rand(2,10);

		$tm_speed = get_option('atp_tm_speed') ? get_option('atp_tm_speed') : '3000';

echo'<script type="text/javascript">
jQuery(document).ready(function() {
atpcustom.MySlider('.$tm_speed.',"testimonial'.$rand.'");
});
</script>';
echo '<div id="testimonial'.$rand.'" class="testimonial_list"><ul class="testimonials">';

	while ($testimonial->have_posts()) : $testimonial->the_post();
	
	
		$website_name				= get_post_meta(get_the_ID(), 'websitename', true);
		$website_url				= get_post_meta(get_the_ID(), 'website_url', true);
		$testimonial_image_option	= get_post_meta(get_the_ID(), 'testimonial_image_option',true);
		$target_link        =  get_post_meta($post->ID, 'target_link', true) != 'on' ? '' :"target='_blank'";
		$testimonial_content		= get_the_content(get_the_ID());
		switch( $testimonial_image_option ){
			case 'gravatar':
							$testimonial_email=get_post_meta(get_the_ID(),'testimonial_email',true);
							$testimonial_gravatar_image=get_avatar($testimonial_email,40);
							break;
			case 'customimage':
							if( has_post_thumbnail()){
								$testimonial_gravatar_image= atp_resize($post->ID,'','40','40','imageborder','');
							}
							break;
		}
		$before = $after = '';

		// post title
		echo '<li>';
		echo '<div class="testimonial-box">';
		if( $testimonial_gravatar_image != '' ){
			echo '<div class="client-image">'.$testimonial_gravatar_image.'</div>';
		}
		echo '<div class="testimonial-content"><p>'.$testimonial_content.'</p></div>';
		if( $website_url != '' ){
			$before = '<a href="'.esc_url($website_url).'" '.$target_link.'>';
			$after = '</a>';
		}
			$clientname = '<strong class="client-name">'.get_the_title().'</strong>';
		if( $website_name != '' || $clientname != '' ){
			echo '<div class="client-meta">'.$clientname.$before.$website_name.$after.'</div>';
		}
	
		echo'</div>'; 
		echo '</li>'; 
		 endwhile; 
		echo '</ul>';
		echo '</div>';
		wp_reset_query();
			echo $after_widget;
		
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['tcategory'] = strip_tags( $new_instance['tcategory'] );

		$instance['limits'] = strip_tags( $new_instance['limits'] );

		return $instance;
	}

	function form( $instance ) {
	$testimonial_array = get_terms('testimonial_cat','orderby=name&hide_empty=0');
	$dynamic_testimonial = array();
	foreach ($testimonial_array as $testimonial ){
		$dynamic_testimonial[$testimonial->slug] = $testimonial->name;
		$testimonial_ids[] = $testimonial->slug;
	}
	
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'tcategory' => '', 'title' => '','limits' => '') );
		$title = esc_attr( $instance['title'] );
$limits = esc_attr( $instance['limits'] );
		
	?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','ATP_ADMIN_SITE'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id('Category'); ?>"><?php _e( 'Category:','ATP_ADMIN_SITE' ); ?></label>
			<select name="<?php echo $this->get_field_name('tcategory'); ?>" id="<?php echo $this->get_field_id('tcategory'); ?>" class="widefat">
				
			<?php foreach( $dynamic_testimonial as $key => $value) {  ?>
				<option value="<?php echo $key; ?>" <?php selected( $instance['tcategory'], $key ); ?>><?php echo $value; ?></option>
				
				<?php
				}
				?>
						
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('limits'); ?>"><?php _e( 'limits:','ATP_ADMIN_SITE' ); ?></label> <input type="text" value="<?php echo $limits; ?>" name="<?php echo $this->get_field_name('limits'); ?>" id="<?php echo $this->get_field_id('limits'); ?>" class="widefat" />
			<br />
			<small><?php _e( 'Limits','ATP_ADMIN_SITE' ); ?></small>
		</p>
<?php
	}

}
function wp_widgets_testimonial() {	
register_widget('WP_Widget_testimonial');
do_action('widgets_init');
}
add_action('init', 'wp_widgets_testimonial', 1);
?>