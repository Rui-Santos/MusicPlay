<?php
/** 
 * The Header for our theme.
 * Includes the header.php template file. 
 */

get_header(); ?>

	
	<div id="primary" class="pagemid">
	<div class="inner">

		<div class="content-area">
		
			<?php if (have_posts()): while (have_posts()): the_post(); ?>	
			
			<div <?php post_class('custompost-single'); ?> id="post-<?php the_ID(); ?>">
				
				<?php
				$relatedpostid=$post->ID;
				global $default_date;
				$meta_key = array(
					'artist_nick_name',
					'audio_artist_name',
					'artist_born_date',
					'audio_genre_music',
					'artist_bornplace',
					'artist_genres',
					'audio_catalog_id',
					'artist_year_active',
					'artist_website_url'				
				);
					
				foreach ($meta_key as $value) {
					$$value = get_post_meta($post->ID, $value, true);
				}
				$iva_sociables 	=  get_post_meta( $post->ID, 'artist_follow_sociables', true );
				$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );	
				$img_alt_title 		= get_the_title();
				?>
				
				<div class="custompost_entry">
					<div class="custompost_details">			
						
						<div class="col_third">	
							<?php if (has_post_thumbnail()) { ?>
							<div class="custompost_thumb port_img">
								<?php echo atp_resize($post->ID, '', '470', '470', '', $img_alt_title  ); ?>
								<div class="hover_type">
								<a data-rel="prettyPhoto" class="hoverimage" href="<?php echo $imagesrc[0]; ?>" title="<?php echo get_the_title(); ?>"></a>
								</div>
							</div>
							<?php } ?>
							<!-- .custompost_thumb -->
							
							<div class="artist-details">
								<?php 
								if ( $artist_nick_name != '' ) { 
									echo '<div class="artist-meta">'. atp_localize($atp_artist_nickname_txt,'<span>','</span>') . $artist_nick_name .'</div>';
								}
								
								if ( $artist_born_date != '' ) {
									if(is_numeric($artist_born_date)){
						 				$artist_born_date= date_i18n($default_date,$artist_born_date);
									}	
									echo '<div class="artist-meta">'. atp_localize($atp_artist_borndate_txt,'<span>','</span>') . $artist_born_date .'</div>';
								}
								
								if ( $artist_bornplace != '' ) {
									echo '<div class="artist-meta">'. atp_localize($atp_artist_birthplace_txt,'<span>','</span>') . $artist_bornplace .'</div>';
								}
								
								if ( $artist_genres != '' ) { 
									echo '<div class="artist-meta">'. atp_localize($atp_artist_genres_txt,'<span>','</span>') . $artist_genres .'</div>';
								}
								
								if ( $artist_year_active != '' ) { 
									echo '<div class="artist-meta">'. atp_localize($atp_artist_yearactive_txt,'<span>','</span>') . $artist_year_active .'</div>';
								}
								
								if ( $artist_website_url != '' ) { 
									echo '<div class="artist-meta">'. atp_localize($atp_artist_siteurl_txt,'<span>','</span>');
									echo '<a href="'. esc_url($artist_website_url) .'" target="_blank">'.$artist_website_url.'</a>';
									echo '</div>';
								}
								if( $iva_sociables !='' ) {
									if ( function_exists( 'follow_social_networks' ) ) {
										echo '<div class="artist-meta">'. atp_localize($atp_follow_social_txt,'<span>','</span>');
										echo follow_social_networks( $iva_sociables );
										echo '</div>';
									}
								}
								?>
							</div><!-- artist-details -->
						</div><!-- .col_third -->
					
						<div class="col_twothird end">
							<?php
								echo '<div class="iva-np-headwrap">';				
								echo '<div class="iva-np-title"><h2 class="album-title">'.get_the_title() .'&nbsp;&nbsp;' .atp_localize($atp_artist_biography_txt,'','').'</h2></div>';
								echo '<div class="iva-np-navs">';
								echo '<div class="iva-np-pagination">';
								echo previous_post_link( $link = '%link','<i class="fa fa-angle-left fa-2x"></i>');
								echo next_post_link( $link = '%link', '<i class="fa fa-angle-right fa-2x"></i>');
								echo '</div>';
								echo '</div>';
								echo '</div>';
							?>

							<?php the_content(); ?>			
							<?php echo get_post_meta($post->ID, 'video_content', true); ?>

							<?php get_template_part('musicband/share','link'); ?>

						</div><!-- .col_twothird -->
					
					</div><!-- .custompost_details -->
				</div><!-- .custompost_entry -->
			</div><!-- #post-<?php the_ID();?> -->
			
			<?php endwhile; ?>
			<?php else: ?>
			<?php '<p>' . __('Sorry, no projects matched your criteria.', 'musicplay') . '</p>';?>
			<?php endif; ?>

			<?php edit_post_link(__('Edit', 'musicplay'), '<span class="edit-link">', '</span>'); ?>

			<?php 
			$comments = get_option('atp_artist_comments');
			if ( $comments == 'enable' ) {
				comments_template( '', true ); 
			}?>
			</div><!-- .content-area -->
			<?php if ( atp_generator( 'sidebaroption', $post->ID ) != "fullwidth" ){ get_sidebar(); } ?>

	</div><!-- inner -->

	</div><!-- #primary.pagemid -->
	<?php	
		$artistcat				= get_the_term_list( $relatedpostid , 'artist_cat');
        if($artistcat != '' ) {
		    get_template_part('musicband/artists/artist','related');
	    }	
	get_template_part('musicband/artists/artists','albums');?>

<?php get_footer(); ?>