<?php
function atp_resize( $atppostid = null ,$src = null , $width, $height, $class = null, $alt = null ) {
	$title = $atppostid ? get_the_title ( $atppostid ) :'';

	if ( $class ) {
		$class = ' class="'.$class.'"';
	}
	if ( $alt ) {
		$alt_txt = ' alt="'.$alt.'"';
	} else {
	    $alt_txt = ' alt="'.$title.'"';
	}

	if( $src == "") {
		$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id($atppostid), 'full', false, '' );
		$src = $imagesrc[0];
	}

	$out ='';

	$image = aq_resize( $src, $width, $height, true );

	if( $image !='' ) {
		$out .= '<img  '.$class.' '.$alt_txt.' src="'.$image.'">';
	}
	return  $out;
}

function aq_resize( $url, $width, $height = null, $crop = null, $single = true ) {
	
	//validate inputs
	//if(!$url OR !$width ) return false;
	
	//define upload path & dir
	$upload_info = wp_upload_dir();
	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];
	
	//check if $img_url is local
	//if(strpos( $url, $upload_url ) === false) return false;
	
	//define path of image
	$rel_path = str_replace( $upload_url, '', $url);
	$img_path = $upload_dir . $rel_path;
	
	//check if img path exists, and is an image indeed
	//if( !file_exists($img_path) OR !getimagesize($img_path) ) return false;
	
	//get image info
	$info = pathinfo($img_path);
	$ext = @$info['extension'];
	list($orig_w,$orig_h) = @getimagesize($img_path);
	
	//get image size after cropping
	$dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
	$dst_w = $dims[4];
	$dst_h = $dims[5];
	
	//use this to check if cropped image already exists, so we can return that instead
	$suffix = "{$dst_w}x{$dst_h}";
	$dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
	$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";
	
	if(!$dst_h) {
		//can't resize, so return original url
		$img_url = $url;
		$dst_w = $orig_w;
		$dst_h = $orig_h;
	}
	//else check if cache exists
	elseif(file_exists($destfilename) && getimagesize($destfilename)) {
		$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
	} 
	//else, we resize the image and return the new resized image url
	else {
		
		// Note: This pre-3.5 fallback check will edited out in subsequent version
		if(function_exists('wp_get_image_editor')) {
		
			$editor = wp_get_image_editor($img_path);
			
			if ( is_wp_error( $editor ) || is_wp_error( $editor->resize( $width, $height, $crop ) ) )
				return false;
			
			$resized_file = $editor->save();
			
			if(!is_wp_error($resized_file)) {
				$resized_rel_path = str_replace( $upload_dir, '', $resized_file['path']);
				$img_url = $upload_url . $resized_rel_path;
			} else {
				return false;
			}
			
		} else {
		
			$resized_img_path = image_resize( $img_path, $width, $height, $crop ); // Fallback foo
			if(!is_wp_error($resized_img_path)) {
				$resized_rel_path = str_replace( $upload_dir, '', $resized_img_path);
				$img_url = $upload_url . $resized_rel_path;
			} else {
				return false;
			}
		
		}
		
	}
	
	//return the output
	if($single) {
		//str return
		$image = $img_url;
	} else {
		//array return
		$image = array (
			0 => $img_url,
			1 => $dst_w,
			2 => $dst_h
		);
	}
	
	return $image;
}
?>