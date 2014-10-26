<?php

	// B U T T O N 
	//--------------------------------------------------------
	function iva_button( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'id'			=> '',
			'class'			=> '',
			'link'			=> '',
			'icon'			=> '',
			'linktarget'	=> '',
			'fullwidth'		=> '',
			'color'			=> 'abestos',
			'align'			=> '',
			'bgcolor'		=> '',
			'hoverbgcolor'	=> '',
			'hovertextcolor'=> '',
			'textcolor'		=> '',
			'lightbox'		=> '',
			'size'			=> 'medium',
			'width'			=> '',
			'style'			=> 'flat',
			'animation' 	=> '',
		), $atts));
		$rel='';
		$hoverbgcolor	= $hoverbgcolor 	? ($bgcolor ? ' btn-bg="'.$bgcolor.'"':'').' btn-hoverBg="'.$hoverbgcolor.'"':'';
		$hovertextcolor	= $hovertextcolor	? ($textcolor ? ' btn-color="'.$textcolor.'"':'').' btn-hoverColor="'.$hovertextcolor.'"':'';
		$bgcolor 		= $bgcolor 			? ' style="background-color:'.$bgcolor.'"':'';
		$color 			= $color			? ' '.$color:'';
		$id 			= $id 				? ' id="'.$id.'"':'';
		$class 			= $class 			? ' '.$class:'';
		$link 			= $link 			? ' href="'.esc_url($link).'"':'';
		$linktarget 	= $linktarget 		? ' target="'.$linktarget.'"':'';
		$textcolor 		= $textcolor 		? 'color:'.$textcolor.';':'';
		$width 			= $width 			? 'width:'.$width.';':'';

		$extras =	($textcolor!==''||$width!='') ? ' style="'.$textcolor.$width.'"':'';
		$button = "btn";
		if( $fullwidth == 'true' ){
			$fullwidth = 'full';
		}else{
			$fullwidth = '';
		}
		if( $lightbox =="true" ) { $rel = 'data-rel="prettyPhoto[iframes]"'; }
		if($icon !='') {
		$a_icon = '<i class="fa '.$icon.' fa-lg"></i>    ';
		}else{
		$a_icon='';
		}
		// Animation Effects 
		//--------------------------------------------------------	
		$animation = $animation ? ' data-id="' . $animation . '"' : '';			
		$content = "<a $animation $rel $id $link $linktarget $bgcolor  $hoverbgcolor $hovertextcolor class=' $button $align $size $fullwidth $color $class $style iva_anim '><span $extras>" .$a_icon.trim($content). "</span></a>";
		if( $align === 'center' ){
			return '<p class="center">'.$content.'</p>';
		}else {
			return $content;	
		}
	}
	add_shortcode('button', 'iva_button');
?>