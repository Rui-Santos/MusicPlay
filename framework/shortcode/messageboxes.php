<?php
	// M E S S A G E   B O X 
	//--------------------------------------------------------
	function iva_message_box($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'align'	=> false,
			'close'	=> '',
			'animation' => ''
		), $atts));

		$align = $align?' '.$align:'';
		$animation = $animation ? ' data-id="' . $animation . '"' : '';	
		$out ='<div '.$animation.' class="messagebox ' . $code . $align . ' clearfix iva_anim">';
		$out .=do_shortcode($content);
		if($close == "true" ) { $out .='<span class="close">x</span>';}
		$out .='</div>';
		return $out;
	}
	add_shortcode('error','iva_message_box');
	add_shortcode('info','iva_message_box');
	add_shortcode('alert','iva_message_box');
	add_shortcode('success','iva_message_box');

	// N O T E   B O X 
	//--------------------------------------------------------
	function iva_notes($atts, $content = null) {
		extract(shortcode_atts(array(
			'align' => false,
			'title' => '',
			'width' => false,
			'animation'	=> '',
		), $atts));
		
		$align = $align?' align'.$align:'';
		$width = $width?' style="width:'.$width.'"':'';
		
		if( ! empty( $title )){
			$title = '<h4 class="notes_title">'.$title.'</h4>';
		}
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';
		return '<div '.$animation.' class="iva_anim notes' . $align . '"'.$width.'><div class="notes_content">'.$title .do_shortcode($content). '</div></div>';
	}
	add_shortcode('note','iva_notes');
?>