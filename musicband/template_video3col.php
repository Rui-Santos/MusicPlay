<?php
/*
Template Name: Video 3 Column
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
			//Columns for Video Thumbs
			$column_index = 0; $columns = 3;
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
			$orderby = get_option('atp_album_orderby') ? get_option('atp_video_orderby') : 'date';
			$order   = get_option('atp_album_order') ? get_option('atp_video_order') : 'ASC';	
			$pagination = get_option('atp_video_pagination');
			if ( $pagination == 'on' ){
				$video_limit = get_option( 'atp_video_limits' );
			}else{
				$video_limit = '-1' ;
			}
			$args = array(
					'post_type' 	=> 'video',
					'posts_per_page'=> $video_limit, 
					'paged' 		=> $paged,
					'orderby'		 =>	$orderby,
					'order'			 =>	$order
			);
			$wp_query = new WP_Query( $args );
			
			if ( $wp_query->have_posts()) : while (  $wp_query->have_posts()) :  $wp_query->the_post(); 

				$video_title			= get_post_meta( $post->ID, 'video_title', true );
				$video_description		= get_post_meta( $post->ID, 'video_description', true );
				$video_venue			= get_post_meta( $post->ID, 'video_venue', true );
				$video_youtube_link		= get_post_meta( $post->ID, 'video_youtube_link', true );
				$video_selfhost_video	= get_post_meta( $post->ID, 'video_selfhost_video', true );
				$img_alt_title 		= get_the_title();
				$column_index++;
				$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';
				
				?>
				<div class="video-list <?php echo $class. ' ' .$last; ?>">

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
				
				<?php if( $pagination == 'on' ) { echo atp_pagination(); }?>
				
				<?php else : ?>

				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'musicplay' ); ?></p>

				<?php get_search_form(); ?>
				
				<?php endif;?>
				
				<?php edit_post_link( __( 'Edit', 'musicplay' ), '<span class="edit-link">', '</span>' );?>

		</div><!-- .content-area -->


	</div><!-- inner -->
	</div><!-- #primary.pagemid -->

<?php get_footer(); ?>