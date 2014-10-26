<?php 
	global $atp_readmoretxt;
	
	//Includes the header.php template file from your current theme's directory
	get_header(); 

?>
<?php
//Includes the recipe advancesearch results page
$iva_search_bar = isset( $_GET['iva_search_keyword'] ) ? $_GET['iva_search_keyword'] : '';
if( $iva_search_bar == 'Musicplay_Custom_Search' ) {
	require_once( MUSIC_DIR.'search_albumartisttracks.php');
	exit;
}
?>
<div id="primary" class="pagemid">
		<div class="inner">
			<div class="content-area">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div <?php post_class('searchresults');?> id="post-<?php the_ID(); ?>">

				<h2 class="entry-title">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</h2>

				<?php the_excerpt(); ?>

				<a href="<?php the_permalink() ?>" class="more-link"><?php echo atp_localize($atp_readmoretxt,'',''); ?></a>

				</div>
				<!-- #post-<?php the_ID();?> -->

				<?php endwhile; ?>

				<?php
				if ( function_exists( 'atp_pagination' ) ) { 
					echo atp_pagination(); 
				}?>
					
				<?php else : ?>
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'musicplay' ); ?></p>
				<?php get_search_form(); ?>
				<?php endif; ?>

			</div><!-- .entry-content -->

		<?php get_sidebar();?>

		</div><!-- .inner -->
	</div><!-- #primary.pagemid -->

<?php get_footer(); ?>