<?php $quote = get_post_meta($post->ID, 'postformatmetabox-quote', TRUE); ?>
<blockquote class="quote"><?php echo $quote; ?>
	<span><?php the_title(); ?></span>
</blockquote>