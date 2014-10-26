<?php
	/***
	 *
	 */
	global $postid,$width;
	if(is_single()) {
		echo atp_generator('getPostAttachments',$postid,'','',$width,'300','');
	}else{
		echo atp_generator('getPostAttachments',$postid,'','',$width,'300','');
	}
?>