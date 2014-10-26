<?php
$path = __FILE__;
$pathwp = explode( 'wp-content', $path );
$wp_url = $pathwp[0];
// Loading the wp core functions and variables
require_once( $wp_url.'/wp-load.php' );
global $shortname;

	// Do not edit this if you are not familiar with php
	error_reporting (E_ALL ^ E_NOTICE);
	$post = ( !empty($_POST) ) ? true : false;
	$testimonial_thankyou_msg = $_POST['testimonial_thankyou_msg'];
	$captcha_text			= $_POST['captchatext'];
	$testimonial_captcha	= $_POST['testimonial_captcha'];
	$error = "";
	// Validation for Name
	if( $_POST['title'] != ""){
	
	}else{
		$error .= '<p>Enter  Title</p>';
	}
	if (filter_var($_POST['testimonial_email'], FILTER_VALIDATE_EMAIL)) {
		$testimonial_email = $_POST['testimonial_email'];
	}else {
		$error .= '<p>Enter a valid  E-mail ID</p>';
	}
	// Validation for captcha
	if ( $testimonial_captcha == $captcha_text ) {
		
	}else{
		$error.='Enter a Correct Captcha<br/>';
	}
	
	if( !$error ){
	$testimonialdata = array(
								'post_title'  => $_POST['title'], 
								'post_type'   => 'testimonialtype', 
								'post_content'	=> $_POST['text'],
								'post_status' => 'pending'
								);
			$testimonial_fields = array( 'testimonial_email','websitename','website_url','text' );
		$testimonial_id = wp_insert_post( $testimonialdata );
		
		foreach( $testimonial_fields as $testimonial_field ){
			
			update_post_meta( $testimonial_id,$testimonial_field,$_POST[$testimonial_field] );
		}
		$response = '<div class="messagebox success"><div class="messagebox_content">'.$testimonial_thankyou_msg.'</div></div>';

	}else{ //if error occurs in validation
		$response = '<div class="messagebox error"><div class="messagebox_content">'.$error.'</div></div>';
	}
echo $response
?>