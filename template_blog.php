<?php
/*
Template Name: Blog
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

		
			<?php
			$cats = '';
			if ( is_array( $blog_all_cats = get_option( 'atp_blogacats' ) ) && count( $blog_all_cats ) > 0 ) {
				$cats = implode( ', ', $blog_all_cats );
			}
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			} elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;  
			}
			$args = array(
				'cat' => $cats,
				'paged' => $paged
			);

			$wp_query = new WP_Query( $args );
			?>

			<?php if ( $wp_query->have_posts()) : while (  $wp_query->have_posts()) :  $wp_query->the_post(); ?>
			<?php if ( atp_generator( 'sidebaroption', get_the_id()) != "fullwidth" ){ $width = '670'; } else { $width = '960';  } ?>

			<?php $format = get_post_format($post->ID);?>
			<?php if( false === $format ) { $format = 'standard'; } ?>

			<div <?php post_class();?> id="post-<?php the_ID(); ?>">
				<div class="post_content">

					<?php get_template_part( 'includes/' . $format ); ?>

					<?php if( $format != 'link' && $format != 'quote' && $format != 'aside') { ?>
					<h2 class="entry-title">
					<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>">
					<?php the_title(); ?></a></h2>
					<?php } ?>

					<?php if ( get_option( 'atp_postmeta' ) != "on" ) { ?>
					<div class="post-info">
						<?php if( $format != 'aside' ){ ?>
						<?php echo atp_generator('postmetaStyle'); ?>
						<?php } ?>
					</div><!-- post-info -->
					<?php } ?>

					<?php if ( $format != 'quote' ){ ?>
					<div class="post-entry">

						<?php the_excerpt(); ?>
						<?php if ( $format != 'quote'   && $format != 'aside' && $format != 'link' ) { ?>
						<a href="<?php the_permalink() ?>"><?php echo atp_localize($atp_readmoretxt,'<span>','</span>'); ?></a>
						<?php  } ?>

					</div>
					<?php } ?>

				</div><!-- .post_content -->
			</div><!-- #post-<?php the_ID();?> -->

			<?php endwhile; ?>

			<?php 
			if( get_option('atp_singlenavigation') != 'on' ) {
				echo atp_pagination(); 
			}?>

			<?php else : ?>

			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'musicplay' ); ?></p>

			<?php get_search_form(); ?>
	
			<?php endif; ?>

			<?php wp_reset_query();  ?>

			<?php edit_post_link( __( 'Edit', 'musicplay' ), '<span class="edit-link">', '</span>' ); ?>

		</div><!-- .content-area -->

	<?php if ( atp_generator( 'sidebaroption', $post->ID ) != "fullwidth" ){ get_sidebar(); } ?>

	</div><!-- inner -->
	</div><!-- #primary.pagemid -->
	
<?php get_footer(); ?>