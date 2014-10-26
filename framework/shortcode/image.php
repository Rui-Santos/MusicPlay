<?php
	// I M A G E  
	//--------------------------------------------------------
	function iva_image($atts, $content = null) {
		extract(shortcode_atts(array(
			'link'		=> '',
			'lightbox'	=> 'false',
			'title'		=> '',
			'class'		=> '',
			'align'		=> false,
			'width'		=> false,
			'height'	=> false,
			'caption'	=>'',
			'target'	=>'',
			'src'		=> '',
			'animation' => '',			
		), $atts));
		
		if(!$width||!$height){
			if(!$width){
				$width = '';
			}
			if(!$height){
				$height = '';
			}
		}
	
		$no_link = $rel = $out = '';
		$content= atp_resize('',$src,$width,$height,'',$title);

		if($lightbox == 'true'){
			if(preg_match_all('!http://.+\.(?:jpe?g|png|gif)!Ui',$link,$matches)){
			$src=$link;
			}
			$rel = ' data-rel="prettyPhoto[mixed]"';
			$link = $src;
		}else{
			if($link == ''){$no_link = 'image_no_link';}
			$target = ' target="'.$target.'"';
		}
		//If Lightbox is Enabled
		//-----------------------
		
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';
		if($lightbox=="true") {
			$out.='<div '.$animation.' class="iva_anim imageframe '.($align?' align'.$align:'').'" ><figure><a  '.$target.''.$rel.' '.($no_link? ' class="'.$no_link.'"':'').' title="'.$title.'" href="'.$link.'">' . $content;
			$out.='</a></figure>';
			if($caption){
			$out.='<span class="image_caption">'.$caption.'</span>';
			}
			$out.='</div>';
		} else {

		//If Lightbox is Disabled
		//-----------------------
			$out.='<div '.$animation.' class="iva_anim imageframe '.($align?' align'.$align:'').'" >' ;
			if($link!=''){
				if(preg_match_all('!http://.+\.(?:jpe?g|png|gif)!Ui',$link,$matches)){
				$link="";
			}
			$out.='<a  '.$target.''.$rel.' '.($no_link? ' class="'.$no_link.'"':'').' title="'.$title.'" href="'.esc_url($link).'">';
		}
		$out.='<figure>'.$content.'</figure>';
		if($link!=''){
			$out.='</a>';
		}
			
		if($caption){
			$out.='<span class="image_caption">'.$caption.'</span>';
		}
		$out.='</div>';
		}
		
		return $out;
	}

	add_shortcode('image', 'iva_image');

?>