<?php
/*
Template Name: Stretched
*/
?>
<?php get_header(); ?>

	<div class="pagemid_section">
	
		<?php while (have_posts()): the_post(); ?>

		<?php the_content(); ?> 

		<?php edit_post_link( __( 'Edit', 'THEME_FRONT_SITE' ), '<span class="edit-link">', '</span>' ); ?>

		<?php endwhile; ?>

	</div>
	<!-- .pagemid -->

<?php get_footer(); ?>