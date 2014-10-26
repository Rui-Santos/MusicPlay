<?php
	// P R O G R E S S B A R
	//--------------------------------------------------------
	function iva_progressbar( $atts, $content = null ){
		extract(shortcode_atts(array(
			'progress'	=> '',
			'title'		=> '',
			'color'		=> '',
			'bgcolor'	=> '',
			'animation'	=> '',			
		), $atts));
		
		$progress1 = (int)$progress;
		$progressvalue  = $progress1   ? ' width:'.$progress1.'%':'';
		$barcolor 		= $color  ? 'background-color:'.$color.';':'';
		$bgcolor 		= $bgcolor  ? 'background-color:'.$bgcolor.';':'';
	
		$extras =	( $barcolor!=='' || $progressvalue!='' ) ? ' style="'.$barcolor.'"':'';
		$extrasbg =	( $bgcolor!='' ) ? ' style="'.$bgcolor.'"':'';

		$out = '';

		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';	
		$out .= '<div '.$animation.' class="progress_wrap iva_anim">';
		$out .= '<h4>'.$title.'</h4>';
		$out .= '<div class="progress_container" '.$extrasbg.'>';
		$out .= '<div  data_width="'.$progress1.'%" class="progress_bar" '.$extras.'>';
		$out .= '<span class="percentage">'.$progress1.'%</span>';
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';
	
		return $out;
	}
	add_shortcode('progressbar', 'iva_progressbar');
?>