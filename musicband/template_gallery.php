<?php
/*
Template Name: Gallery
*/

/** 
 * The Header for our theme.
 * Includes the header.php template file. 
 */

get_header(); ?>

	
	<div id="primary" class="pagemid">
	<div class="inner">

		<div class="content-area">

			<?php while (have_posts()): the_post(); ?>
			<?php the_content(); ?> 
			<?php endwhile; ?>

			<?php
			//Columns for Gallery Thumbs
			$column_index = 0; $columns = 4;
			if( $columns == '4' ) { $class = 'col_fourth'; }
			if( $columns == '3' ) { $class = 'col_third'; }

			//Full Width Gallery Image Sizes
			if( $columns == '4' ) { $width='470'; $height = '470' ; }
			if( $columns == '3' ) { $width='470'; $height = '470' ; }
			$orderby = get_option('atp_gallery_orderby') ? get_option('atp_gallery_orderby') : 'date';
			$order   = get_option('atp_gallery_order') ? get_option('atp_gallery_order') : 'ASC';	
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			}
			elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;  
			}

			$pagination = get_option('atp_gallery_pagination');
			if($pagination == 'on'){
				$gallery_limit = get_option( 'atp_gallery_limits' );
			}else{
				$gallery_limit = '-1' ;
			}

			$args = array(
				'post_type' 	=> 'gallery',
				'posts_per_page'=> $gallery_limit, 
				'paged' 		=> $paged,
				'orderby'		 =>	$orderby,
				'order'			 =>	$order
			);
			$wp_query = new WP_Query( $args );
				
			if ( $wp_query->have_posts()) : while (  $wp_query->have_posts()) :  $wp_query->the_post(); 

				$gallery_venue			= get_post_meta( $post->ID, 'gallery_venue', true );
				$gallery_upload			= get_post_meta( $post->ID, 'gallery_upload', true );
				$img_alt_title 		= get_the_title();
				$column_index++;
				$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';

				?>

				<div class="gallery-list col_third <?php echo $class. ' ' .$last; ?>">

					<div class="custompost_thumb port_img">
						<?php 
						if ( has_post_thumbnail()) { 
							echo '<figure>'. atp_resize( $post->ID, '', $width, $height, '', $img_alt_title ). '</figure>'; 
							echo '<div class="hover_type">';
							echo '<a class="hovergallery"  href="' .get_permalink(). '" title="' . get_the_title() . '"></a>';
							echo '</div>';
						} ?>
					</div><!-- .custompost_thumb -->

					<div class="gallery-desc">
						<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a></h2>
						<?php
						if ( $gallery_venue != '' ) { 
							echo '<span>'.$gallery_venue.'</span>'; 
						}?>
					</div><!-- .gallery_desc -->

				</div><!--.gallery-list -->

				<?php 
				if( $column_index == $columns ){
						$column_index = 0;
						echo '<div class="clear"></div>';
				}
				?>

				<?php endwhile; ?>

				<div class="clear"></div>

				<?php if ( $pagination == 'on' ) { echo atp_pagination(); }?>
				
				<?php wp_reset_query(); ?>
				
				<?php else : ?>
				
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'musicplay' ); ?></p>
				
				<?php get_search_form(); ?>

				<?php endif;?>

				<?php edit_post_link( __( 'Edit', 'musicplay' ), '<span class="edit-link">', '</span>' );?>

		</div><!-- .content-area -->

		<?php if ( atp_generator( 'sidebaroption', $post->ID) != "fullwidth" ){ get_sidebar(); } ?>

	</div><!-- inner -->
	</div><!-- #primary.pagemid -->

<?php get_footer(); ?>