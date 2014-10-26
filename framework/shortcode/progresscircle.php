<?php
	// ProgressBar
	function iva_progresscirclewrap( $atts, $content = null ){
		extract(shortcode_atts(array(
			'percent'	=> '',
			'title'	=> '',
			'color'	=> '',
			'trackcolor'	=>'',
			'size'	=> '',
			'linewidth'	=> '',				
		), $atts));
		
		$count = 0;
		$percentage = (int)$percent;
		$datacolor = ( $color !== '' ) ? ' data-bar-color="'.$color.'"' : '' ;
		$datasize = ( $size !== '' ) ? ' data-size="'.$size.'"' : '' ;
		$datawidth = ( $linewidth !== '' ) ? ' data-line-width="'.$linewidth.'"' : '' ;
		$trackcolor = ( $trackcolor !== '' ) ? ' data-track-color="'.$trackcolor.'"' : '' ;
		$datapercentage = ( $percentage !== '' ) ? ' data-percent="'.$percentage.'"' : '' ;

		$out = 	'<div class="chart">';
		$out .= '<div data-percent="'.$percentage.'" class="CircleBar" '.$datacolor.' '.$datasize.' '.$datawidth.' '.$datapercentage.' '.$trackcolor.'>';
		if( $content !='' ){
			$out .= '<span>'.do_shortcode($content).'</span>';
			}else{
				$out .= '<span>'.$percent.'%</span>';
			}
		$out .= '</div>';
		$out .= '<div class="label">'.$title.'</div>';
		$out .=	'</div>';
		return $out;
	}
	add_shortcode('progress', 'iva_progresscirclewrap');

	function progresscircle_script() {
		wp_print_scripts( 'atp-progresscircle' );
		wp_print_scripts( 'atp-excanvas' );

		//$size='400';
		echo '<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery(".CircleBar").each(function () {
					jQuery(this).easyPieChart({
						barColor: function(percent) {
							percent /= 100;
							return "rgb(" + Math.round(255 * (1-percent)) + ", " + Math.round(255 * percent) + ", 0)";
	                    },
						animate: 4000,	
						scaleColor: false,
						lineCap: "butt",
						rotate: 0

					});
				});
			});
		</script>';
	}
	function iva_progresscircle( $atts, $content = null ) {
		extract(shortcode_atts(array(
					'animation'	=> '',
		), $atts));
		echo ($color);
		add_action('wp_footer', 'progresscircle_script');
	
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';	
		$out = '<div '.$animation.' class="CircleBarWrap  iva_anim">'. do_shortcode($content) . '</div><div style="clear:both;"></div>';
		return $out;
	}
	add_shortcode('progresscircle', 'iva_progresscircle');
?>