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

			//Full Width Album Image Sizes
			if( $columns == '4' ) { $width='470'; $height = '470' ; }
			if( $columns == '3' ) { $width='470'; $height = '470' ; }

			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			}
			elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;  
			}

			if ( have_posts()) : while (  have_posts()) :  the_post(); 

				$audio_artist_name	= get_post_meta( $post->ID, 'audio_artist_name', true );
				$audio_catalog_id	= get_post_meta( $post->ID, 'audio_catalog_id', true );
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'full', true );

				$column_index++;
				$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';
				?>

				<div class="album-list  <?php echo $class. ' ' .$last; ?>" >
					<div class="custompost_entry">

						<?php if( has_post_thumbnail()){ ?>
						<div class="custompost_thumb port_img">
							<?php
							echo '<figure>'. atp_resize( $post->ID, '', $width, $height, '', '' ). '</figure>'; 
							echo '<div class="hover_type">';
							echo '<a class="hoveraudio"  href="' .get_permalink(). '" title="' . get_the_title() . '"></a>';
							echo '</div>';
							?>
						</div><!-- .custompost_thumb -->
						<?php } ?>

						<div class="album-desc">
							<h2 class="entry-title">
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a>
							</h2>
							<span><?php echo strip_tags(get_the_term_list( $post->ID, 'label', '', ', ', '' ));?></span>
						</div><!-- .album-desc-->

					</div><!-- .custompost_entry -->
				</div><!-- .album_list -->

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

	</div><!-- inner -->
	</div><!-- #primary.pagemid -->

<?php get_footer(); ?>