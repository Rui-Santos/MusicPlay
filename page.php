<?php 
//Includes the header.php template file from your current theme's directory
get_header(); 
?>

<div id="primary" class="pagemid">
		<div class="inner">
			<div class="content-area">

			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php the_content(); ?>

				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'musicplay' ), 'after' => '</div>' ) ); ?>
			
			</div><!-- #post-<?php the_ID(); ?> -->
			<div class="clear"></div>
			<?php edit_post_link( __( 'Edit', 'musicplay' ), '<span class="edit-link">', '</span>' ); ?>

			<?php endwhile; ?>

			<?php 
			$comments = get_option('atp_commentstemplate');
			if ( $comments == 'pages' ||  $comments == 'both' ) {
				comments_template( '', true ); 
			}?>

		</div><!-- .content-area -->

		<?php if ( atp_generator( 'sidebaroption', $post->ID ) != 'fullwidth' ) { get_sidebar(); } ?>

		</div><!-- .inner -->
	</div><!-- #primary.pagemid -->

<?php get_footer(); ?>