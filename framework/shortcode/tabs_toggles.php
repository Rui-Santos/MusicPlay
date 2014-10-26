<?php

	// F A N C Y   T O G G L E
	//--------------------------------------------------------
	function iva_fancytoggle_content( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'heading'		=> '',
			'animation' 	=> '',
		), $atts));
		
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';		
		$out  = '<div '.$animation.' class="fancytoggle iva_anim">';
		$out .= '<div class="toggle-title"><span class="arrow"></span>' .$heading. '</div>';
		$out .= '<div class="toggle_content" style="display: none;">';
		$out .= '<div class="toggleinside">';
		$out .= do_shortcode( $content );
		$out .= '</div></div>';
		$out .= '</div>';
		
		return $out;
	}
	add_shortcode('toggle', 'iva_fancytoggle_content');

	// T A B S  G R O U P
 	//--------------------------------------------------------
	function iva_tabs($atts, $content = null, $code) {
		extract(shortcode_atts(array(
			'type'		=> '',
			'position'	=> '',
			'animation' => '',
		), $atts));

		$icons = $out = $customtabcolor = $customtabtextcolor = '';
		if ( $type == "vertical" ) {
			$type = 'vertical';
		} else { 
			$type = "";
		}
		switch($position){
			case 'centertabs':
							$positiontype = "centertabs";
							break;
			case 'righttabs':
							$positiontype = "righttabs";
							break;
			default:
							$positiontype = "";
		}

        if ( !preg_match_all("/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches) ) {
			return do_shortcode($content);
        } else {
			for($i = 0; $i < count($matches[0]); $i++) {
				$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
			}
			
			// Animation Effects 
			//--------------------------------------------------------	
			$animation = $animation ? ' data-id="' . $animation . '"' : '';	
			$tabid='tab'.rand(1,99);		
			$out .= '<div '.$animation.' id="'.$tabid.'" class="iva_anim systabspane '.$type.'">';
			$out .= '<ul  class="tabs">';
				for($i = 0; $i < count($matches[0]); $i++) {
					if( isset( $matches[3][$i]['tabcolor'] ) ){
						if ( strpos($matches[3][$i]['tabcolor'], '#') !== false ) {
						$customtabcolor = ' style="background-color:'.$matches[3][$i]['tabcolor'].'"';
						}
					}
					if( isset( $matches[3][$i]['textcolor'] ) ){
						if ( strpos($matches[3][$i]['textcolor'], '#') !== false ) {
							$customtabtextcolor = ' style="color:'.$matches[3][$i]['textcolor'].'"';
						}
					}
					if( isset($matches[3][$i]['icon']) ){
						$icons=$matches[3][$i]['icon'];
					}
					$out .= '<li class="'.$icons.'"  id="#'.$tabid.$i.'" ' .$customtabcolor. '  ><a '.$customtabtextcolor.'>' . $matches[3][$i]['title'] . '</a></li>';
				}
			$out .= '</ul>';
			$out .= '<div class="panes">';
			for($i = 0; $i < count($matches[0]); $i++) {
				$out .= '<div  class="tab_content" id="'.$tabid.$i.'" >' .pre_process_shortcode( do_shortcode(trim($matches[5][$i])) ) . '</div>';
			}
			$out .= '</div></div>';
		       
			return $out;
		}
	}
	add_shortcode( 'tab', 'iva_tabs' );
	add_shortcode( 'tabs', 'iva_tabs' );
?>