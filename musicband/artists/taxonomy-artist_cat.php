<?php

/** 
 * The Header for our theme.
 * Includes the header.php template file. 
 */

get_header(); ?>

	
	<div id="primary" class="pagemid">
	<div class="inner">

		<div class="content-area">

			<?php
			//Columns for Album Thumbs
			$column_index = 0; $columns = 4;
			if( $columns == '4' ) { $class = 'col_fourth'; }
			if( $columns == '3' ) { $class = 'col_third'; }

			//Full Width Artist Image Sizes
			if( $columns == '4' ) { $width='470'; $height = '470' ; }
			if( $columns == '3' ) { $width='470'; $height = '470' ; }
			$orderby = get_option('atp_album_orderby') ? get_option('atp_artist_orderby') : 'date';
			$order   = get_option('atp_album_order') ? get_option('atp_artist_order') : 'ASC';
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			}
			elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;  
			}		


			if ( have_posts()) : while (  have_posts()) :  the_post(); 
				$artist_nick_name	= get_post_meta( $post->ID, 'artist_nick_name', true );
				$artist_born_date	= get_post_meta( $post->ID, 'artist_born_date', true );
				$artist_bornplace	= get_post_meta( $post->ID, 'artist_bornplace', true );
				$artist_genres 		= get_post_meta( $post->ID, 'artist_genres', true );
				$artist_year_active	= get_post_meta( $post->ID, 'artist_year_active', true );
				$artist_website_url	= get_post_meta( $post->ID, 'artist_website_url', true );
				$img_alt_title 		= get_the_title();
				$column_index++;
				$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';

				?>
				<div class="artist-list <?php echo $class. ' ' .$last; ?>">
					<div class="custompost_entry">
						
						<?php if( has_post_thumbnail()){ ?>
						<div class="custompost_thumb port_img">
							<?php
							echo '<figure>'. atp_resize( $post->ID, '', $width, $height, '', $img_alt_title ) .'</figure>'; 
							echo '<div class="hover_type">';
							echo '<a class="hoverartist"  href="' .get_permalink(). '" title="' . get_the_title() . '"></a>';
							echo '</div>';
							?>
						</div>
						<?php } ?>

						<div class="artist-desc">
							<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a></h2>
							<?php if ( $artist_genres !='' ) { echo '<span>'. $artist_genres.'</span>'; } ?>
						</div>

					</div><!-- .custompost_entry -->
				</div><!-- .artist-post-->
				
				<?php 
				if( $column_index == $columns ){
					$column_index = 0;
					echo '<div class="clear"></div>';
				}
				?>
			<?php endwhile; ?>
			<div class="clear"></div>

			<?php 
			if(function_exists('atp_pagination')) { 
				echo atp_pagination(); 
			} ?>

			<?php wp_reset_query(); ?>

			<?php else : ?>

			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'musicplay' ); ?></p>

			<?php get_search_form(); ?>
				
			<?php endif;?>
			
			</div><!-- .content-area -->
		<?php if ( atp_generator( 'sidebaroption', $post->ID) != "fullwidth" ){ get_sidebar(); }  ?>
	</div><!-- inner -->
	</div><!-- #primary.pagemid -->

<?php get_footer(); ?>