<?php

	// F A N C Y B O X 
	//--------------------------------------------------------
	function iva_fancy_box( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title'			=> '',
			'titlecolor'	=> '',
			'titlebgcolor'	=> '',
			'ribbon'		=> '',
			'textcolor'		=> '',
			'boxbgcolor'	=> '',
			'animation' 	=> '',
			
		), $atts));
		
		$titlebgcolor = $titlebgcolor ? 'background-color:'.$titlebgcolor.';' : '';
		$titlecolor	= $titlecolor ? 'color:'.$titlecolor.';' : '';
		$boxbgcolor	= $boxbgcolor ? 'background-color:'.$boxbgcolor.';' : '';
		$textcolor = $textcolor ? 'color:'.$textcolor.';' : '';

		if( ! empty( $boxbgcolor ) || !empty( $textcolor )){
			$boxextras = ' style="'.$boxbgcolor.$textcolor.'"';
		}else{
			$boxextras = '';
		}

		if( ! empty( $titlebgcolor ) || !empty( $titlecolor )){
			$extras = ' style="'.$titlebgcolor.$titlecolor.'"';
		}else{
			$extras = '';
		}

		if ( $ribbon ) {
			$home = home_url();
			$rimage = '<div class="ribbon"><img src="'.THEME_URI.'/images/ribbons/'.$ribbon.'.png" alt=""/></div>';
		}

		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';
		$out = '<div '.$animation.' class="fancybox iva_anim">';
		
		if( isset( $rimage )) {
			$out .= ''.$rimage.'';
		}
		if( $title ){
			$out .= '<h4 class="fancytitle" '.$extras.'>' .$title. '</h4>';
		}
		
		$out .= '<div class="boxcontent"'.$boxextras.'>';
		$out .= do_shortcode($content) .'</div></div>';
		return $out;
	}
	add_shortcode('fancy_box', 'iva_fancy_box');

	// Teaser
	//--------------------------------------------------------
	function iva_teaser_box( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'bgcolor'		=> '',
			'textcolor'		=> '',
			'buttontext'	=> '',
			'color'			=> '',
			'buttonlink'	=> '',
			'buttonsize'	=> 'small',
			'linktarget'	=> '',
			'style'			=> 'flat',
			'animation' 	=> '',			
		), $atts));

		$buttonlink 	= $buttonlink 	? ' href="'.esc_url($buttonlink).'"':'';
		$linktarget 	= $linktarget 	? ' target="'.$linktarget.'"':'';
		$bgcolor 		= $bgcolor 		? ' background-color:'.$bgcolor.';' : '';
		$textcolor		= $textcolor 	? ' color:'.$textcolor.';' : '';

		if( !empty( $bgcolor ) || !empty( $textcolor )){
			$extras = ' style="'.$bgcolor.$textcolor.'"';
		}else{
			$extras = '';
		}

		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' .$animation. '"' : '';		
		$out = '<div '.$animation.' class="callOutBox iva_anim" '.$extras.'>';
		$out .= '<div class="teaser_Content">';
		$out .= '<div class="callOut_Text">';
		$out .= do_shortcode( $content );
		$out .= '</div>';
		$out .= '<div class="callOut_Button"><a '.$buttonlink.' class="btn '.$buttonsize.' '.$style.' '.$color.'" '.$linktarget.'><span>'.$buttontext.'</span></a></div>';
		$out .= '</div></div>';
		return $out;
	}
	add_shortcode('callout', 'iva_teaser_box');

	// Frame Box
	//--------------------------------------------------------
	function iva_frame_box( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'bgcolor'		=> '',
			'textcolor' 	=> '',
			'bordercolor'	=>'',
			'animation' 	=> '',			
		), $atts));

		$bgcolor 		= $bgcolor 		? ' background-color:'.$bgcolor.';' : '';
		$textcolor		= $textcolor 	? ' color:'.$textcolor.';' : '';
		$bordercolor	= $bordercolor 	? ' border-color:'.$bordercolor.';' : '';

		if( !empty( $bgcolor ) || !empty( $textcolor ) || !empty( $bordercolor)){
			$extras = ' style="'.$bgcolor.$textcolor.$bordercolor.'"';
		}else{
			$extras = '';
		}
		
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' .$animation. '"' : '';	
		$out = '<div '.$animation.' class="frame_box iva_anim clearfix"  '.$extras.'>';
		$out .= do_shortcode( $content );
		$out .= '</div>';

		return $out;
	}
	add_shortcode('frame_box', 'iva_frame_box');
?>