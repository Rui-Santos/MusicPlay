<?php
	/***
	 *
	 */
	 
	$embed = get_post_meta($post->ID, 'video_embed', true);
	if( !empty($embed) ) {
		echo "<div class='video-frame'>";
		echo stripslashes(htmlspecialchars_decode($embed));
		echo "</div>";
	} else {
		atp_generator('embed_media',$post->ID,'video');
	}
?>