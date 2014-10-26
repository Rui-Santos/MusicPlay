<?php
	// STAFF BOX
	//--------------------------------------------------------
	function iva_staff($atts, $content= null){
		extract(shortcode_atts(array(
			'photo'			=> '',
			'title'			=> '',
			'role'			=> '',
			'blogger'		=> '',
			'delicious'		=> '',
			'digg'			=> '',
			'facebook'		=> '',
			'flickr'		=> '',
			'forrst'		=> '',
			'google'		=> '',
			'linkedin'		=> '',
			'pinterest'		=> '',
			'skype'			=> '',
			'stumbleupon'	=> '',
			'twitter'		=> '',
			'dribbble'		=> '',
			'yahoo'			=> '',
			'youtube'		=> '',
			'animation' 	=> '',
		), $atts));
		
		global $staff_social;

		$before_staff = $after_staff = $out = '';
		
		// Animation Effects
		//--------------------------------------------------------					
		$animation = $animation ? ' data-id="' . $animation . '"' : '';		
		$out .= '<div '.$animation.' class="bio iva_anim">';
		
		if( $photo != '' ){
			$image_photo = atp_resize('',$photo,'450','','','');
			$out .= $image_photo;	
		}
		$out .= '<div class="details bio_meta">';
		if( $title != '' ){
			$out .= '<hgroup>';
			$out .= '<h4>'.$title.'</h4>';
			if( $role != '' ){
				$out .= '<span class="staff-role">'.$role.'</span>';	
			}
			$out .= '</hgroup>';
		}

		if( $content != '' ){
			$out .= do_shortcode( $content );
		}
		$out .= '</div>';	
		$count=0;
		foreach( $staff_social as $key => $value ){
			if($key !=''){
				if( $$key != '' ){
					if( $count<1 ){
						$before_staff = '<div class="sociables"><ul class="atpsocials">';
						$after_staff = '</ul></div>';
					}
					$count++;
				}
			}
		}
		
		$out .= $before_staff;
		foreach( $staff_social as $key => $value )	{ 
			if($key !=''){
					if( $$key != '' ){
						$out .= '<li><a class="'.$key.'" href="'.$$key.'"></a><span class="ttip">'.ucfirst($key).'</span></li>';	
					}
			}
		}
		$out .= $after_staff;
	
		$out .= '</div><div class="clear"></div>';
		
		return $out;
	}
	add_shortcode( 'staff', 'iva_staff' );
?>