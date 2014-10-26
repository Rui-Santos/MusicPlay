<?php
/*
Template Name: Site Map
*/

global $atp_readmoretxt;
/** 
 * The Header for our theme.
 * Includes the header.php template file. 
 */

get_header(); ?>

	<div id="primary" class="pagemid">
	<div class="inner">
			
		<div class="content-area">

			<?php if (have_posts()): while (have_posts()): the_post(); ?>

				<?php the_content(); ?> 

			<?php endwhile; ?>
			<?php endif; ?>

			<div class="one_fourth">
				<h3><?php _e('Pages', 'musicplay'); ?></h3>
				<ul class="sitemap"><?php $args = array('title_li' => '', 'depth' => 0); wp_list_pages($args); ?></ul>
			</div>

			<div class="one_fourth">
				<h3><?php _e('Feeds', 'musicplay'); ?></h3>
				<ul class="sitemap">
					<li><a title="<?php _e('Main RSS', 'musicplay'); ?>" href="<?php bloginfo('rss2_url'); ?>"><?php _e('Main RSS', 'musicplay'); ?></a></li>
					<li><a title="<?php _e('Comment Feed', 'musicplay'); ?>" href="<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comment Feed', 'musicplay'); ?></a></li>
				</ul>
			</div>

			<div class="one_fourth">
				<h3><?php _e('Categories', 'musicplay'); ?></h3>
				<ul class="sitemap"><?php $args = array('title_li' => ''); wp_list_categories($args); ?></ul>
			</div>

			<div class="one_fourth last">
				<h3><?php _e('Archives', 'musicplay'); ?></h3>
				<ul class="sitemap">
					<?php wp_get_archives('type=monthly&show_post_count=true'); ?>
				</ul>
			</div>

		</div><!-- .content-area -->


	</div><!-- inner -->
	</div><!-- #primary.pagemid -->
	
<?php get_footer(); ?>