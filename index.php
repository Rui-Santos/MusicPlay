<?php 

/** 
 * The Header for our theme.
 * Includes the header.php template file. 
 */

get_header(); ?>

	<div id="primary" class="pagemid">
	<div class="inner">

		<div class="content-area">

			<?php get_template_part( 'loop' ); ?>

		</div><!-- .content-area -->

	<?php get_sidebar(); ?>

	</div><!-- inner -->
	</div><!-- #primary.pagemid -->
	
<?php get_footer(); ?>