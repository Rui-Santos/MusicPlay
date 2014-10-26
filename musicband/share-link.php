<?php

	// Google+
	$out = $output = '';
	if ( get_option( 'atp_google_enable' ) == 'on' ) { 
		//$out .= '<li class="google"><a target="_blank" href="http://www.google.com/bookmarks/mark?op=edit&amp;bkmk='.get_permalink().'&amp;title='.get_the_title().'&amp;annotation='.get_the_title().'"><img src="'.THEME_URI.'/images/sociables/google.png" alt="Google+"  /></a></li>';
		$out .= '<li class="google"><a target="_blank" href="http://plus.google.com/share?url='.get_permalink().'&amp;title='.get_the_title().'&amp;annotation='.get_the_title().'"><img src="'.THEME_URI.'/images/sociables/google.png" alt="Google+"  /></a></li>';
	}
	
	// Linkdedin
	if ( get_option('atp_linkedIn_enable') == 'on' ) { 
		$out .= '<li class="linkedin"><a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.get_permalink().'&amp;title='.get_the_title().'&amp;summary='.get_the_title().'"><img src="'.THEME_URI .'/images/sociables/linkedin.png" alt="Linkdedin"  /></a></li>';
	}
	
	// DiggIt
	if ( get_option('atp_digg_enable') == 'on') { 
		$out .= '<li class="digg"><a target="_blank" href="http://digg.com/submit?phase=2&amp;url='.get_permalink().'&amp;title='.get_the_title().'&amp;bodytext='.get_the_title().'"><img src="'.THEME_URI .'/images/sociables/digg.png" alt="Digg"  /></a></li>';
	}
	
	// StumbleUpon
	if ( get_option('atp_stumbleupon_enable') =='on'){ 
		$out .= '<li class="stumbleupon"><a target="_blank" href="http://www.stumbleupon.com/submit?url='.get_permalink().'&amp;title='.get_the_title().'" rel="nofollow external"><img src="'. THEME_URI.'/images/sociables/stumbleupon.png" alt="StumbleUpon"  /></a></li>';
	}
	
	// Pinterest
	if ( get_option('atp_pinterest_enable') == 'on') { 
		$out .= '<li class="pinterest"><a target="_blank" href="http://pinterest.com/pin/create/button/?url='.get_permalink().'&title='.get_the_title().'"><img src="'.THEME_URI.'/images/sociables/pinterest.png" alt="Pinterest"  /></a></li>';
	}
	
	// Twitter
	if ( get_option('atp_twitter_enable') == 'on' ) { 
		$out .= '<li class="twitter"><a target="_blank" href="http://twitter.com/home?status='.get_the_title().' - '.get_permalink().'"><img src="'.THEME_URI.'/images/sociables/twitter.png" alt="Twitter"  /></a></li>';
	}
	
	// Facebook
	if ( get_option('atp_facebook_enable') == 'on' ){ 
		$out .='<li class="facebook"><a target="_blank" href="http://www.facebook.com/share.php?u='.get_permalink().'&amp;t='.get_the_title().'"><img src="'.THEME_URI.'/images/sociables/facebook.png" alt="Facebook"  /></a></li>';
	}
	
	if( !empty( $out ) ) {
	
		$output .= '<div style="height: 20px;"></div>';
		$output .= '<div class="iva_sharing"><ul class="atpsocials share">';
		$output .= $out;
		$output .= '</ul></div>';
		
		echo $output;
	}
?>