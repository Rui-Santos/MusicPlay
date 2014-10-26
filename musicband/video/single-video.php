<?php

/** 
 * The Header for our theme.
 * Includes the header.php template file. 
 */

get_header(); ?>
	<?php global $default_date; ?>
	
	<div id="primary" class="pagemid">
	<div class="inner">

		<div class="content-area">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div <?php post_class( 'custompost-single' );?> id="post-<?php the_ID(); ?>">
				
				<?php

				$video_venue			= get_post_meta( $post->ID, 'video_venue', true );
				$video_type_option		= get_post_meta( $post->ID, 'video_type_option', true );
				$video_selfhost_video	= get_post_meta( $post->ID, 'video_selfhost_video', true );

				if( atp_generator( 'sidebaroption',$post->ID ) != "fullwidth" ){ $width = '670'; }else{ $width = '960';  }

				?>

				<div class="custompost_entry">
					<div class="custompost_details">

						<h2 class="album-title ">
							<span><?php echo get_post_meta( $post->ID, 'video_venue', true ); ?></span>
						</h2>
						
						<?php
						if( $video_type_option != '' ){
						switch( $video_type_option ) {
							case 'youtubelink':
											$clipid = get_post_meta( $post->ID, 'video_youtube_link', true );
											echo iva_youtube( array(
																'clipid' =>$clipid ,
																'width' => '',
																'height' => '600' 
															));
											break;
							case 'vimeolink':
											$clipid = get_post_meta( $post->ID, 'video_vimeo_link', true );
											echo iva_vimeo(	array(
																'clip_id' =>$clipid ,
																'width' => '',
																'height' => '600'
															));
											break;
							case 'selfvideo':
											$clipid = get_post_meta( $post->ID, 'video_selfhost_video', true );
											echo  wp_video_shortcode( array(
																'src'      => $clipid,
																'autoplay' => '',
																'height'   => 470,
																'width'    => empty( $content_width ) ?740 : $content_width,
															));
											break;
						}
									 } ?>
					</div><!-- .custompost_details -->

				</div><!-- .custompost_entry -->
			
			<div class="demospace" style="height:20px;"></div>

			<?php the_content(); ?>

			<?php get_template_part('musicband/share','link'); ?>

			<div class="demospace" style="height:20px;"></div>

			<?php edit_post_link(__('Edit', 'musicplay'), '<span class="edit-link">', '</span>'); ?>

			</div><!-- #post-<?php the_ID();?> -->

				<?php endwhile; ?>
				<?php else: ?>
				<?php '<p>'.__('Sorry, no projects matched your criteria.', 'musicplay').'</p>';?>
				<?php endif; ?>

			<?php 
			$comments = get_option('atp_video_comments');
			if ( $comments == 'enable' ) {
				comments_template( '', true ); 
			}?>

			</div><!-- .content-area -->
	
			<?php if ( atp_generator( 'sidebaroption', $post->ID) != "fullwidth" ){ get_sidebar(); } ?>

	</div><!-- inner -->
	</div><!-- #primary.pagemid -->

<?php get_footer(); ?>