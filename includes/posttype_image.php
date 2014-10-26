<?php if( has_post_thumbnail()){ 
	global $post_id;
	?>
	<!-- .postimg -->
	<div class="postimg">
		<figure>
		<a href="#"><?php
			if(atp_generator('sidebaroption',get_the_id()) != "fullwidth"){ $width='630'; }else{ $width='1000';  }
			$post_thumbnail_id = get_post_thumbnail_id(get_the_id());
			echo atp_resize($post_id,'',$width,'','imgborder','');
		?>
		</a>
		</figure>
	</div>
	<!-- .postimg -->
<?php } ?>