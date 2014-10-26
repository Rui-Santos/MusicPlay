<?php 
if( (function_exists('has_post_thumbnail')) && (has_post_thumbnail()) ) {
global $post_id;
$img_alt_title 		= get_the_title();
?>
	<div class="postimg">
        <figure>
			<a title="<?php printf(__('Permanent Link to %s', 'musicplay'), get_the_title()); ?>" href="<?php the_permalink(); ?>">
				<?php echo atp_resize($post_id,'','670','300','imgborder', $img_alt_title );?>
			</a>
		</figure>
	</div>
<?php } ?>