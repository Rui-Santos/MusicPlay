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
			//Columns for Video Thumbs
			$column_index = 0; $columns = 4;
			if( $columns == '4' ) { $class = 'col_fourth'; }
			if( $columns == '3' ) { $class = 'col_third'; }
			
			//Full Width Video Image Sizes
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

				$video_title			= get_post_meta( $post->ID, 'video_title', true );
				$video_description		= get_post_meta( $post->ID, 'video_description', true );
				$video_venue			= get_post_meta( $post->ID, 'video_venue', true );
				$video_youtube_link		= get_post_meta( $post->ID, 'video_youtube_link', true );
				$video_selfhost_video	= get_post_meta( $post->ID, 'video_selfhost_video', true );
				$img_alt_title 		= get_the_title();
				$column_index++;
				$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';

				?>
				<div class="video-list col_fourth <?php echo $class. ' ' .$last; ?>">

					<?php if( has_post_thumbnail()){ ?>
					<div class="custompost_thumb port_img">
						<?php
						echo '<figure>'. atp_resize( $post->ID, '', $width, $height, '', $img_alt_title ) .'</figure>'; 
						echo '<div class="hover_type">';
						echo '<a class="hovervideo"  href="' .get_permalink(). '" title="' . get_the_title() . '"></a>';
						echo '</div>';
						?>
					</div><!-- .custompost_thumb -->
					
					<?php 
					} elseif( $video_youtube_link!=''){ ?>
					<div class="custompost_thumb youtube">
						<?php echo $video_youtube_link; ?>
					</div><!-- .youtube-->
					
					<?php 
					} else { ?>
					<div class="custompost_thumb self_video">
						<?php echo $video_selfhost_video; ?>
					</div><!-- .custompost_thumb -->
					<?php } ?>
					
					<div class="custompost_entry">
						<div class="custompost_details">

							<div class="video-desc">
								<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a></h2>

							</div><!-- .video-desc -->

						</div><!-- .custompost_details-->
					</div><!-- .custompost_entry -->

				</div><!-- .video-list -->
				
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