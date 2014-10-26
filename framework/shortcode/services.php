<?php
	// S E R V I C E S
	//--------------------------------------------------------
	function iva_services_content( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'image'		=> '',
			'align' 	=> 'center',
			'animation' => '',
			'title'		=> '',
		), $atts));

		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';	
		$out = '<div '.$animation.' class="service-box iva_anim">';
		if( $image !='' ) {
			$out .= '<div class="service-icon '.$align.' iva_anim">';
			$out .= '<img src="'.$image.'" alt="">';
			$out .= '</div>';
		}
		$out .= '<div class="service-box-heading '.$align.'">';
		if ( $title) {
		$out .= '<h3>'.$title.'</h3>';
		}		
		$out .= '<div class="service-content">';
		$out .= do_shortcode( $content );
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
		
		return $out;
	}

	add_shortcode('services', 'iva_services_content');

	//  S E R V I C E S  I C O N 
	function iva_services_icon( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'title'		=> '',
			'icon'		=> '',
			'bgcolor'	=> '',
			'color'		=> '',
			'align'		=> 'left',
			'animation' => '',
		), $atts));

		$iconbgcolor 		= $bgcolor 		? ' background-color:'.$bgcolor.';':'';
		$iconcolor 			= $color 		? ' color:'.$color.';':'';

		$extras =	($iconbgcolor!==''||$iconcolor!='') ? ' style="'.$iconbgcolor.$iconcolor.'"':'';

		$iconbgcolor = $bgcolor?' style="background-color:'.$bgcolor.'"':'';
		$iconcolor = $color?' style="color:'.$color.'"':'';

		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';		
		$out  = '<div '.$animation.' class="atp-services iva_anim">';
		$out .= '<div class="services-heading">';
		$out .= '<i class="fa '.$icon.' fa-2x services-icon" '.$extras.'></i>';
		$out .= '<h3>'.$title.'</h3>';
		$out .= '</div>';
		$out .= '<div class="services-content">'.do_shortcode($content).'</div>';
		$out .= '</div>';
		
		return $out;
	}
	add_shortcode('servicesicon', 'iva_services_icon');
?>