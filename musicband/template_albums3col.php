<?php
/*
Template Name: Albums 3 Column
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
			//Columns for Album Thumbs
			$column_index = 0; $columns = 3;
			if( $columns == '4' ) { $class = 'col_fourth'; }
			if( $columns == '3' ) { $class = 'col_third'; }

			//Full Width Album Image Sizes
			if( $columns == '4' ) { $width='470'; $height = '470' ; }
			if( $columns == '3' ) { $width='470'; $height = '470' ; }

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$orderby = get_option('atp_album_orderby') ? get_option('atp_album_orderby') : 'date';
			$order   = get_option('atp_album_order') ? get_option('atp_album_order') : 'ASC';
			//Pagination
			$pagination			= get_option('atp_audio_pagination');
			if ( $pagination == 'on' ){
				$audio_limit	= get_option( 'atp_audio_limits' );
			}else{
				$audio_limit	= '-1' ;
			}
			
			if($orderby == 'audio_release_date'){
				$meta_key = 'audio_release_date';
			}else{
				$meta_key = "";
			}
			$args = array(
				'post_type' 	 => 'albums',
				'posts_per_page' => $audio_limit, 
				'paged' 		 => $paged,
				'orderby'		 =>	$orderby,
				'meta_key'    => $meta_key,
				'order'			 =>	$order
			);
			
				$wp_query = new WP_Query( $args );

				if ( $wp_query->have_posts()) : while (  $wp_query->have_posts()) :  $wp_query->the_post(); 

					$audio_artist = array();
					$audio_artist_name =get_post_meta($post->ID,'audio_artist_name',true);
					if ( is_array( $audio_artist_name ) && count( $audio_artist_name ) > 0 ) {
						foreach( $audio_artist_name as $audio_artist_id){
							$permalink = get_permalink(  $audio_artist_id);
							$playlisttitle = get_the_title(  $audio_artist_id);
							$audio_artist[]= '<a href="'.$permalink.'">'.$playlisttitle.'</a>';
						}
						$audio_artist_name = implode( ', ', $audio_artist );
					}
					$audio_catalog_id	= get_post_meta( $post->ID, 'audio_catalog_id', true );
					$img_alt_title 		= get_the_title();

					$column_index++;
					$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';

					?>
					
					<div class="album-list  <?php echo $class. ' ' .$last; ?>" >
						<div class="custompost_entry">
						
							<?php if( has_post_thumbnail()){ ?>
							<div class="custompost_thumb port_img">
								<?php 
								echo '<figure>'.atp_resize( $post->ID, '', $width, $height, '', $img_alt_title ).'</figure>';
								echo '<div class="hover_type">';
								echo '<a class="hoveraudio"  href="' .get_permalink(). '" title="' . get_the_title() . '"></a>';
								echo '</div>';
								?>
							</div>
							<?php } ?>
							
							<div class="album-desc">
							
								<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a></h2>
								<span class="label-text"><?php echo strip_tags(get_the_term_list( $post->ID, 'label', '', ', ', '' ));?></span>
								<span class="label-text"><?php echo $audio_artist_name;?></span>
							</div><!-- .album-desc-->

						</div><!-- .custompost_entry -->
					</div><!-- .album_list -->
				
					<?php 
					if( $column_index == $columns ){
						$column_index = 0;
						echo '<div class="clear"></div>';
					}?>

				<?php endwhile; ?>

				<div class="clear"></div>
				
				<?php if ( $pagination == 'on' ) { 	echo atp_pagination(); } ?>
				
				<?php wp_reset_query();?>

				<?php else : ?>
				
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'musicplay' ); ?></p>

				<?php get_search_form(); ?>
				
				<?php endif;?>
				
				<?php edit_post_link( __( 'Edit', 'musicplay' ), '<span class="edit-link">', '</span>' ); ?>

		</div><!-- .content-area -->
		<?php if ( atp_generator( 'sidebaroption', $post->ID ) != "fullwidth" ){ get_sidebar(); } ?>
	</div><!-- inner -->
	</div><!-- #primary.pagemid -->

<?php get_footer(); ?>