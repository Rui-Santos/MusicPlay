<?php $status = get_post_meta($post->ID, 'status', TRUE); ?>
<?php $format = get_post_format(); if( false === $format ) { $format = 'standard'; } ?>
<?php if($status !='') { ?>
<div class="status-format">
	<div class="status-content">
		<p><?php echo $status; ?></p>
	</div>
</div>
<?php } ?>