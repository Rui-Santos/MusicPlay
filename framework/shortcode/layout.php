<?php

	// C O L U M N   L A Y O U T S
	//--------------------------------------------------------
	function iva_shortcode_column($atts, $content = null, $code) {
		return '<div class="'.$code.'">' . do_shortcode(trim($content)) . '</div>';
	}
	function iva_shortcode_column_last($atts, $content = null, $code) {
		return '<div class="'.str_replace('_last','',$code).' last">' .do_shortcode(trim($content)) . '</div><div class="clear"></div>';
	}

	add_shortcode('one_half', 'iva_shortcode_column');
	add_shortcode('one_third', 'iva_shortcode_column');
	add_shortcode('one_fourth', 'iva_shortcode_column');
	add_shortcode('one_fifth', 'iva_shortcode_column');
	add_shortcode('one_sixth', 'iva_shortcode_column');

	add_shortcode('two_third', 'iva_shortcode_column');
	add_shortcode('three_fourth', 'iva_shortcode_column');
	add_shortcode('two_fifth', 'iva_shortcode_column');
	add_shortcode('three_fifth', 'iva_shortcode_column');
	add_shortcode('four_fifth', 'iva_shortcode_column');
	add_shortcode('five_sixth', 'iva_shortcode_column');

	add_shortcode('one_half_last', 'iva_shortcode_column_last');
	add_shortcode('one_third_last', 'iva_shortcode_column_last');
	add_shortcode('one_fourth_last', 'iva_shortcode_column_last');
	add_shortcode('one_fifth_last', 'iva_shortcode_column_last');
	add_shortcode('one_sixth_last', 'iva_shortcode_column_last');

	add_shortcode('two_third_last', 'iva_shortcode_column_last');
	add_shortcode('three_fourth_last', 'iva_shortcode_column_last');
	add_shortcode('two_fifth_last', 'iva_shortcode_column_last');
	add_shortcode('three_fifth_last', 'iva_shortcode_column_last');
	add_shortcode('four_fifth_last', 'iva_shortcode_column_last');
	add_shortcode('five_sixth_last', 'iva_shortcode_column_last');
	
?>