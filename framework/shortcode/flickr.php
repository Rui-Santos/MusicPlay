<?php

	// F L I C K R 
	//--------------------------------------------------------
	function iva_flickr ($atts, $content= null){
		extract(shortcode_atts(array(
			'limit'		=> '5',
			'id'		=> '52617155@N08',
			'display'	=> 'latest',
			'size'		=> 's',
			'layout'	=> 'x',
			'type'		=> 'user',	        
		), $atts));

		if( $type==="user" ) {
			$out = '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' .$limit. '&amp;display=' .$display. '&amp;size=' .$size. '&amp;layout=x&amp;source=user&amp;user=' .$id. '"></script><div class="clear"></div>';
		}
		if( $type==="group" ) {
			$out = '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' .$limit. '&amp;display=' .$display. '&amp;size=' .$size. '&amp;layout=x&amp;source=group&amp;group=' .$id. '"></script><div class="clear"></div>';
		}
		return $out;
	}
	add_shortcode('flickr', 'iva_flickr');
?>