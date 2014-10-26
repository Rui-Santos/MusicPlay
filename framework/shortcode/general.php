<?php
	// CUSTOM ANIMATION
	//--------------------------------------------------------
	function iva_custom_animation($atts, $content = null) {
		extract(shortcode_atts(array(
			'animation' => '',
		), $atts));

		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';			
		return '<div '.$animation.' class="custom-animation iva_anim">' . do_shortcode($content) . '</div>';
	}
	add_shortcode('custom_animation', 'iva_custom_animation');


	// DIVIDER
	//--------------------------------------------------------
	function iva_divider( $atts, $content = null ) {
			extract(shortcode_atts(array(
			'margin' 		=> '',
			'type'  	 	=> '',
			'style'   		=> '',
			'bordercolor'   => ''
		), $atts));
		
		$bordercolor 	= $bordercolor ? 'border-color:'.$bordercolor.';':'';
		$margin 		= $margin ? 'margin:'.$margin.';':'';
		if( ! empty( $bordercolor ) || ! empty( $margin ) ){
			$extras = ' style="'.$bordercolor.$margin.'"';
		}else{
			$extras = '';
		}

		return '<div class="divider '.$type.' '.$style.'" '.$extras.'></div>';
	}
	add_shortcode('divider', 'iva_divider');

	// DIVIDER SPACE
	//--------------------------------------------------------

	function iva_demo_space( $atts, $content = null ) {
		extract(shortcode_atts (array (
			'height'	=> '15'
		), $atts));

		return '<div class="demo_space" '.($height ? ' style="height:' . (int)$height . 'px"' : '').'></div>';
	}
	add_shortcode('demo_space', 'iva_demo_space');
	
	// CUSTOM DIVIDER
	//--------------------------------------------------------
	function iva_custom_divider( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'img'		=> '',
			'margin' 	=> '',
		), $atts));
		return '<div class="customdivider" '.($margin ? ' style="margin:' . (int)$margin . 'px"' : '').'><img src="'.$img.'" alt=""></div>';
	}
	add_shortcode('custom_divider', 'sys_custom_divider');
	
	// DIVIDER WITH SPACE
	//--------------------------------------------------------
	function sys_divider_space( $atts, $content = null ) {
		return '<div class="divider_space"></div>';
	}
	add_shortcode('divider_space', 'iva_divider_space');

	// DIVIDER LINE
	//--------------------------------------------------------
	function iva_divider_line( $atts, $content = null ) {
			extract(shortcode_atts(array(
			'bgcolor' => '',
		), $atts));
		$bgcolor = $bgcolor?'background-color:'.$bgcolor.';':'';
		if( !empty($bgcolor)){
			$extras = ' style="'.$bgcolor.'"';
		}else{
			$extras = '';
		}

		return '<div class="divider_line" '.$extras.'></div>';
	}
	add_shortcode('divider_line', 'iva_divider_line');

	// CLEAR
	//--------------------------------------------------------
	function sys_clear( $atts, $content = null ) {
		return '<div class="clear"></div>';
	}
	add_shortcode('clear', 'sys_clear');

	// A L I G N M E N T
	//--------------------------------------------------------
	function iva_align($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'position' => '',
		), $atts));
		return '<div class="'.$position.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode('align', 'iva_align');

	// G O O G L E   F O N T
	//--------------------------------------------------------
	function iva_googlefont($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'font'		=> 'Lobster',
			'size'		=> '32px',
			'margin'	=> '0px',
			'color'		=> '',
			'style'		=> '',
			'animation' => '',
		), $atts));
		
		$google = preg_replace ("/ /","+",$font);
		
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';	
		$protocol = (is_ssl()) ? 'https://' : 'http://';
		return '<link href="'. $protocol .'fonts.googleapis.com/css?family='.$google.':'.$style.'" rel="stylesheet" type="text/css">
				<div '.$animation.' class="iva_anim google-font" style="font-family:\'' .$font. '\', serif !important; font-size:' .$size. ' !important; margin:' .$margin. ' !important; color:' .$color. ' !important;">'. do_shortcode($content) . '</div>';
	}
	add_shortcode('googlefont', 'iva_googlefont');

	// H I G H L I G H T
	//--------------------------------------------------------
	function iva_highlight($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'bgcolor'	=> '',
			'textcolor'	=> '',
		), $atts));
		
		$bgcolor = $bgcolor?'background-color:'.$bgcolor.';':'';
		$textcolor = $textcolor?'color:'.$textcolor.';':'';
		if( !empty($textcolor) || !empty($bgcolor)){
			$extras = ' style="'.$bgcolor.$textcolor.'"';
		}else{
			$extras = '';
		}
		return '<span class="highlight" '.$extras.'>'.do_shortcode($content).'</span>';
	}
	add_shortcode('highlight', 'iva_highlight');

	// H I G H L I G H T
	//--------------------------------------------------------
	function iva_highlight2($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'textcolor'	=> '',
		), $atts));
		
		$textcolor = $textcolor?' style="color:'.$textcolor.'"':'';
		if($textcolor){
			$textcolor = ' '.$textcolor;
		}

		return '<span class="highlight2" '.$textcolor.'>'.do_shortcode($content).'</span>';
	}
	add_shortcode('highlight2', 'iva_highlight2');

	// HEADING
	//--------------------------------------------------------
	function iva_heading($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'bgcolor'	=> '',
			'textcolor'	=> '',
			'fontsize'  => '',
		), $atts));
		
		$bgcolor = $bgcolor ? 'background-color:'.$bgcolor.';':'';
		$textcolor = $textcolor ? 'color:'.$textcolor.';':'';
		$fontsize = $fontsize ? 'font-size:'.$fontsize.';':'';
		if( !empty($textcolor) || !empty($bgcolor)){
			$extras = ' style="'.$bgcolor.$textcolor.$fontsize.'"';
		}else{
			$extras = '';
		}
		return '<div ><span class="heading" '.$extras.'>'.do_shortcode($content).'</span></div>';
	}
	add_shortcode('heading', 'iva_heading');

	// F A N C Y   H E A D I N G 
	//--------------------------------------------------------
	function iva_fancy_heading($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'textcolor'	=> '',
			'heading'   => '',
			'align'     => 'textleft',
			'bgcolor'   => '',
				), $atts));
		
		$textcolor = $textcolor?'color:'.$textcolor.';':'';
		$bgcolor = $bgcolor?'background-color:'.$bgcolor.';':'';
		if( !empty($textcolor) || !empty($bgcolor) ){
			$extras = ' style="'.$textcolor.$bgcolor.'"';
		}else{
			$extras = '';
		}

	
		$before = $after = $out = '';
		if($heading != '') {
			$before = '<'.$heading.' class="fancy-title '.$align.'" '.$extras.'>';
			$after = '</'.$heading.'>';
		}
			$out .= $before.do_shortcode($content).$after;

		return $out;
	}
	add_shortcode('fancyheading', 'iva_fancy_heading');
	
	// D R O P C A P 
	//--------------------------------------------------------
	function iva_dropcap_1($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'color'		=> '',
			'animation' => '',
		), $atts));
		if($color){
			$color = ' '.$color;
		}
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';			
		return '<span '.$animation.' class="' . $code.$color . ' iva_anim" '.isset($bgcolor).'>' . do_shortcode($content) . '</span>';
	}
	add_shortcode('dropcap1', 'iva_dropcap_1');
	
	// D R O P C A P   2
	//--------------------------------------------------------
	function iva_dropcap_2($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'bgcolor'	=> '',
			'animation' => '',
		), $atts));
		$bgcolor = $bgcolor?' style="background-color:'.$bgcolor.'"':'';
		if($bgcolor){
			$bgcolor = ' '.$bgcolor;
		}
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';			
		return '<span '.$animation.' class="' . $code . ' iva_anim" '.$bgcolor.'>' . do_shortcode($content) . '</span>';
	}
	add_shortcode('dropcap2', 'iva_dropcap_2');
	
	// D R O P C A P   3 
	//--------------------------------------------------------
	function iva_dropcap_3($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'color'		=> '',
			'animation' => '',
		), $atts));
	
		$color = $color?' style="color:'.$color.'"':'';
		if($color){
			$color = ' '.$color;
		}
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';			
		return '<span '.$animation.' class="' . $code . ' iva_anim" '.$color.'>' . do_shortcode($content) . '</span>';
	}
	add_shortcode('dropcap3', 'iva_dropcap_3');
	
	// B L O C K Q U O T E
	//--------------------------------------------------------
	function iva_blockquote($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'align' 	=> 'left',
			'cite'  	=> false,
			'citelink'	=> false,
			'width'		=> '',
			'animation' => '',
		), $atts));
		
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';
		$citelinkurl = $citelink ? ', <span class="citelink ">'.$citelink.'</span>' : '';
		return '<blockquote' .  ($align ? ' class="align' . $align . ' iva_anim"' : '').($width ? ' style="width:' . $width . '"' : '') .' ' .$animation. '><p>' . do_shortcode($content) .'</p>'. ($cite ? '<cite>' . $cite.$citelinkurl. '</cite>' : '') . '</blockquote>';
	}
	add_shortcode('blockquote', 'iva_blockquote');

	// F A N C Y   T A B L E 
	//--------------------------------------------------------
	function iva_fancy_table( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'width'	=> '',
			'align'	=> false,
		), $atts));
		
		$width = $width?' style="width:'.$width.'"':'';
		if($width){
			$width = ' '.$width;
		}
		if($align){
			$align = ' align'.$align;
		}
		$content = str_replace('<table>', '<table class="fancy_table '.$align.'" '.$width.'>', do_shortcode($content));
		return $content;
	}
	add_shortcode('fancytable', 'iva_fancy_table');
	
	// L I S T   S T Y L E S 
	//--------------------------------------------------------
	function iva_list($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'style'	=> false,
			'color'	=> '',
			'cols'	=> '',
		), $atts));
		
		if($style){
			$style = 'list-'.$style;
		}
		return str_replace('<ul>', '<ul class="'.$style.' '.$cols.' '.$color.'">', do_shortcode($content));
	}
	add_shortcode('list', 'iva_list');
	
	// I C O N S 
	//--------------------------------------------------------
	function iva_awesomefont($atts, $content = null, $code) {
			extract(shortcode_atts(array(
			'bgcolor'		=> '',
			'bordercolor'	=> '',
			'color'			=> '',
			'size'			=> '',
			'style'			=> 'circle',
			'icon'			=> '',
			'align' 		=> 'center',
			'animation' 	=> '',
		), $atts));
	
		$color = $color?'color:'.$color.';':'';
		$bgcolor = $bgcolor?'background-color:'.$bgcolor.';':'';
		$bordercolor = $bordercolor?'border-color:'.$bordercolor.';':'';
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';	
		if($style =='normal') {
		$out = '<i style="'.$color.'" class="fa '.$icon.' fa-lg"></i>';
		}else{
		$out = '<span '.$animation.' class="iva_anim '.$size.' '.$align.'" style="'.$bgcolor.' '.$bordercolor.'"><i style="'.$color.'" class="fa '.$icon.' fa-lg"></i></span>';
		}

		return $out;

	}
	add_shortcode('icons', 'iva_awesomefont');

	// F A N C Y   A M P E R S A N D
	//--------------------------------------------------------
	function iva_fancy_ampersand($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'color'		=> '',
			'size'		=> '',
		), $atts));
		
			$color = $color?'color:'.$color.';':'';
			$size = $size ?'font-size:'.(int)$size.'px;':'';
		
		return '<span class="fancy_ampersand" style="'.$color.' '.$size.'">&amp;</span>';
	}
	add_shortcode('fancy_ampersand', 'iva_fancy_ampersand');	

	// Section
	//--------------------------------------------------------
	function iva_section($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'bgcolor'	=> '',
			'image'	=> '',
			'textcolor'	=> '',
			'padding'	=> ''
		), $atts));
		
		$bgcolor = $bgcolor ? 'background-color:'.$bgcolor.';':'';

		$image = $image ? 'background-image:url('.$image.');':'';

		$textcolor = $textcolor ? 'color:'.$textcolor.';':'';
		$padding = $padding ? 'padding:'.$padding.';' : '' ;
		if( !empty($textcolor) || !empty($bgcolor) || !empty($padding) || !empty($image)){
			$extras = ' style="'.$bgcolor.$textcolor.$padding.$image.'"';
		}else{
			$extras = '';
		}
		return '<div class="section_row clearfix" '.$extras.'><div class="section_inner">'.do_shortcode($content).'</div></div>';
	}
	add_shortcode('section', 'iva_section');
?>