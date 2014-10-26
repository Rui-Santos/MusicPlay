<?php 
	
global $atp_readmoretxt;
/** 
 * The Header for our theme.
 * Includes the header.php template file. 
 */

get_header(); ?>

	<div id="primary" class="pagemid">
	<div class="inner">

		<div class="content-area">

			<?php $format = get_post_format($post->ID); ?>
			<?php if ( false === $format ) { $format = 'standard'; } ?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div <?php post_class('post');?> id="post-<?php the_ID(); ?>">
				<div class="post_content">

					<?php
					if( get_option( 'atp_blogfeaturedimg' ) !='on')  {
						get_template_part( 'includes/' . $format ); 
					}?>

					<?php if( $format != 'quote') { ?>
					<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } ?>

					<?php if( get_option('atp_postmeta') != 'on' ) { ?>
					<div class="post-info">
						<?php echo atp_generator('postmetaStyle'); ?>
					</div>
					<?php } ?>
						
					<div class="post-entry">

						<?php the_content();?>

						<?php the_tags('<div class="tags">'.__('<strong>Tags</strong>','musicplay').': ',',&nbsp; ','</div>');?>
						<?php get_template_part('musicband/share','link'); ?>
					</div><!-- .post-entry -->

				</div><!-- .post-content -->
			</div><!-- #post-<?php the_ID(); ?> -->

			<?php  
			if ( get_option( 'atp_aboutauthor' ) != "on" ) {
				echo atp_generator( 'aboutauthor' ); 
			} ?>

			<?php
			if ( get_option( 'atp_relatedposts' ) != "on" ) {
				echo atp_generator( 'relatedposts', $post->ID);
			} ?>

			<?php edit_post_link( __( 'Edit', 'musicplay' ), '<span class="edit-link">', '</span>' ); ?>

			<?php
			if ( get_option( 'atp_commentstemplate' ) == "posts" ||  get_option( 'atp_commentstemplate' ) == "both" ) {
				comments_template( '', true ); 
			} ?>

			<?php
			if ( get_option( 'atp_singlenavigation' ) != "on" ) { ?>
				<div id="nav-below" class="navigation">
					<div class="nav-previous"><?php previous_post_link('&larr; %link') ?></div>
					<div class="nav-next"><?php next_post_link('%link &rarr;') ?></div>
				</div><!-- #nav-below-->
			
			<?php
			} else {
				posts_nav_link();
			}
			?>

			<?php endwhile; ?>
				
			<?php else: ?>

			<?php '<p>'.__('Sorry, no posts matched your criteria.', 'musicplay').'</p>';?>

			<?php endif; ?>

		</div>	<!-- .content-area -->

		<?php if ( atp_generator( 'sidebaroption', $post->ID ) != "fullwidth" ){ get_sidebar(); } ?>			

	</div><!-- inner -->
	</div><!-- #primary.pagemid -->


<?php get_footer(); ?>