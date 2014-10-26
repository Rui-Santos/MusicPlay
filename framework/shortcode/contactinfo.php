<?php
// CONTACT INFO 
//--------------------------------------------------------
function iva_contact_info( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'name'			=> '',
		'address'		=> '',
		'phone'			=> '',
		'link'			=> '',
		'email'			=> '',
		'animation' 	=> '',
	), $atts));

	// Animation Effects
	//--------------------------------------------------------					
	$animation = $animation ? ' data-id="' . $animation . '"' : '';	
	$out = '<div '.$animation.' class="contactinfo-wrap iva_anim">';
	if( $name ) {
		$out .= '<h5>'.$name.'</h5>';
	}
	if( $address ) {
		$out .= '<p><i class="fa fa-map-marker"></i>';
		$out .= '<span class="details">'.stripslashes(nl2br($address)).'</span>';
		$out .= '</p>';
	}
	if( $phone ) {
		$out .= '<p><i class="fa fa-phone"></i>'.$phone.'</p>';
	}
	if( $email ) {
		$out .= '<p><i class="fa fa-envelope"></i><a href="mailto:'.$email.'">'.$email.'</a></p>';
	}
	if( $link ) {
		$out .= '<p><i class="fa fa-link"></i><a href="'.esc_url($link).'">'.esc_url($link).'</a></p>';
	}
	$out .= '</div>';
	
	return $out;
}

add_shortcode('contactinfo', 'iva_contact_info');

?>