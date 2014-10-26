<?php
	/***
	 * Image Post Format
	 */
	global $post;

	if( has_post_thumbnail()){
		
		if( atp_generator( 'sidebaroption', get_the_id() ) != "fullwidth" ) {
			$width = '670';
		} else {
			$width = '960';
		}
	?>
	<div class="postimg">
		<figure>
		<?php echo atp_resize($post->ID,'',$width,'300','','');?>
		</figure>
	</div>
<?php } ?>