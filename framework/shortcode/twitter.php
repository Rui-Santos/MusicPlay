<?php
	// T W I T T E R 
	//--------------------------------------------------------
	function iva_twitter ($atts, $content = null) {
		$username=get_option('sys_twitter_username');
		extract(shortcode_atts(array(
			'limit'				=> '',
			'username'			=> $username,
			'animation' 		=> '',			
		), $atts));
			
		$twitter_array = array(
		'username' 				=> $username,
		'limit' 				=> $limit,
		'encode_utf8' 			=> 'false',
		'twitter_cons_key' 		=> get_option('atp_consumerkey'),
		'twitter_cons_secret' 	=> get_option('atp_consumersecret'),
		'twitter_oauth_token' 	=> get_option('atp_accesstoken'),
		'twitter_oauth_secret' 	=> get_option('atp_accesstokensecret')
	);
			// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';
		$out = '<div '.$animation.' class="iva_anim">';
		ob_start();
		$out .= twitter_parse_cache_feed($twitter_array);
		$out .= ob_get_contents();
		ob_clean();
		$out .= '</div>';
		return $out;
	}
	add_shortcode( 'twitter', 'iva_twitter' );
?>