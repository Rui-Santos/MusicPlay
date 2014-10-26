<?php $link = get_post_meta($post->ID, 'link_url', TRUE); ?>
<h2 class="entry-title"><a href="<?php echo esc_url($link); ?>"><?php the_title(); ?></a></h2>
<span class="sub-title">&mdash; <?php echo $link; ?></span>