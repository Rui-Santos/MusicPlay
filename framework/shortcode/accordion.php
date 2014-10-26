<?php
// Accordion
//--------------------------------------------------------
function iva_accordion($atts, $content)
{
    extract(shortcode_atts(array(
		'animation' => ''
	), $atts));
    if (!preg_match_all("/(.?)\[(accordion)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion\])?(.?)/s", $content, $matches)) {
        return do_shortcode($content);
    } else {
        for ($i = 0; $i < count($matches[0]); $i++) {
            $matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
        }
		
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';
        $out = '<div '.$animation.' id="accordion' . rand(1, 9) . '" class="ac_wrap iva_anim">';
        
        for ($i = 0; $i < count($matches[0]); $i++) {
            $active = (isset($matches[3][$i]['active']) == 'true') ? 'active' : '';
            $out .= '<div class="ac_title ' . $active . '"><span class="arrow"></span>';
            if ((isset($matches[3][$i]['icon']))) {
                $out .= '<i class="' . $matches[3][$i]['icon'] . '"></i>';
            }
            
            $out .= $matches[3][$i]['title'] . '</div>';
            $out .= '<div class="ac_content ' . $active . '">' . do_shortcode(trim($matches[5][$i])) . '</div>';
        }
        $out .= '</div>';
        
        return $out;
    }
}
add_shortcode('accordion-wrap', 'iva_accordion');
add_shortcode('accordion', 'iva_accordion');
?>