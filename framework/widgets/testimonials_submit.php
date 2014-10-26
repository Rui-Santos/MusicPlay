<?php
/**
 * Testimonials Widget
 *
 * @since 2.8.0
 */
class WP_Widget_Testimonials_submission extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'atp_submission sysform', 'description' => __('Testimonials submission','ATP_ADMIN_SITE'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('testimonialssubmission',THEMENAME. __('-Testimonials submission','ATP_ADMIN_SITE'), $widget_ops, $control_ops);
	}

	function widget( $args, $instance ) {

	extract($args);
	echo $before_widget;
	$thankyou_msg = isset( $instance['testimonial_thankyou_msg'] ) ? $instance['testimonial_thankyou_msg'] : 'Thank You';
		if ( !empty( $instance['title'] ) ) { echo $before_title . $instance['title'] . $after_title; } ?>
	<?php 
	function random_string( $length ) {
		$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$size = strlen( $chars );
		$str ='';
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}
		
		return $str;
	}
	$captcha = random_string( 6 );
	?>
	<div id="testimonialstatus"></div>
		<form id="testimonialid" name="testimonialform" action="<?php echo THEME_URI;?>/includes/testimonial_insert.php" method="post">
		<p>
		<input value="Name" class="widefat txtfield" id="Name" name="title" type="text"  onblur="if (this.value == '') {this.value = '<?php _e('Name', 'musicplay') ?>';}" onfocus="if(this.value == '<?php _e('Name', 'musicplay') ?>') {this.value = '';}" /></p>
		
		<p>
		<textarea class="widefat" rows="5" cols="30" id="text" name="text" onfocus="if(this.value == '<?php _e('Content', 'musicplay') ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Content', 'musicplay') ?>';}">Content</textarea></p>
		<p>
		<input value="Email" class="widefat txtfield" id="testimonial_email" name="testimonial_email" type="text" onfocus="if(this.value == '<?php _e('Email', 'musicplay') ?>') {this.value = '';}" value="" onblur="if (this.value == '') {this.value = '<?php _e('Email', 'musicplay') ?>';}" /></p>
			<input id="testimonial_thankyou_msg" name="testimonial_thankyou_msg" type="hidden" value="<?php echo $thankyou_msg;?>" />
		<p>
		<input value="Websitename" class="widefat txtfield" id="websitename" name="websitename"  onfocus="if(this.value == '<?php _e('Websitename', 'musicplay') ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Websitename', 'musicplay') ?>';}" type="text" value="" /></p>
		<p>
		<input value="WebsiteUrl" class="widefat txtfield" id="website_url" name="website_url" type="text" onfocus="if(this.value == '<?php _e('WebsiteUrl', 'musicplay') ?>') {this.value = '';}"  value="" onblur="if (this.value == '') {this.value = '<?php _e('WebsiteUrl', 'musicplay') ?>';}" /></p>
		<p><input type="text" name="testimonial_captcha" id="testimonial_captcha" class="widefat txtfield" placeholder="Enter Captcha"></p>
		<p>
		<span class="atpcaptcha"><?php echo $captcha; ?></span>
		<input type="hidden" id="captcha_text" name="captchatext" value="<?php echo $captcha; ?>">
		</p>
		<p class="submit"><button type="button" class="btn small belizehole flat" id="testimonialsubmit" value="submit"><span><?php echo get_option('atp_testimonialsformtxt') ? get_option('atp_testimonialsformtxt') :'Testimonials Submit'; ?></span></button></p>
		
		</form>
		<?php echo $after_widget; ?>
	<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['testimonial_thankyou_msg'] =strip_tags($new_instance['testimonial_thankyou_msg']);
	
		return $instance;
	}

	function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '','testimonial_thankyou_msg' => '') );
			$title = esc_attr( $instance['title'] );
			$testimonial_thankyou_msg = esc_attr( $instance['testimonial_thankyou_msg'] );
			
		
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','ATP_ADMIN_SITE'); ?></label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('testimonial_thankyou_msg'); ?>"><?php _e('Thank you Message:','ATP_ADMIN_SITE'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('testimonial_thankyou_msg'); ?>" name="<?php echo $this->get_field_name('testimonial_thankyou_msg'); ?>" type="text" value="<?php echo esc_attr($testimonial_thankyou_msg); ?>" /></p>

<?php
	}
}
function WP_Widget_Testimonials_submission() {	
register_widget('WP_Widget_Testimonials_submission');
do_action('widgets_init');
}
add_action('init', 'WP_Widget_Testimonials_submission', 1);
?>