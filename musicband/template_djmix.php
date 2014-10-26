<?php
/*
Template Name: Dj Mix
*/

get_header(); ?>
<?php
	global $default_date;
 ?>

<div id="primary" class="pagemid">
	<div class="inner">

		<div class="content-area">

			<?php while (have_posts()): the_post(); ?>
			<?php the_content(); ?> 
			<?php endwhile; ?>

			<?php
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			}
			elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;  
			}
			
			$start = 1;
			$orderby = get_option('atp_album_orderby') ? get_option('atp_djmix_orderby') : 'date';
			$order   = get_option('atp_album_order') ? get_option('atp_djmix_order') : 'ASC';	
			$pagination = get_option( 'atp_djmix_pagination' );

			if ( $pagination == 'on' ){
				$djmix_limit = get_option( 'atp_djmix_limits' );
			}else{
				$djmix_limit = '-1' ;
			}
			// EO pagination limit options

			$args = array(
				'post_type' 	=> 'djmix',
				'posts_per_page'=> $djmix_limit, 
				'paged' 		=> $paged,
				'orderby'		 =>	$orderby,
				'order'			 =>	$order
			);
			$wp_query = new WP_Query( $args );
					
			if ( $wp_query->have_posts()) : while (  $wp_query->have_posts()) :  $wp_query->the_post(); 
				$djmix_genre           = get_post_meta( $post->ID, 'djmix_genre', true );
				$djmix_buy_mix         = get_post_meta( $post->ID, 'djmix_buy_mix', true );
				$djmix_buy_url         = get_post_meta( $post->ID, 'djmix_buy_url', true );
				$djmix_download_url    = get_post_meta( $post->ID, 'djmix_download_url', true );
				$djmix_download_text   = get_post_meta( $post->ID, 'djmix_download_text', true ) ? get_post_meta( $post->ID, 'djmix_download_text', true ) : 'Download';
				$audio_posttype_option = get_post_meta( $post->ID, 'audio_posttype_option', true )? get_post_meta( $post->ID, 'audio_posttype_option', true ) :'player';
				$djmix_upload_mix      = get_post_meta( $post->ID, 'djmix_upload_mix', true );
				$post_date             = get_post_meta(get_the_id(),'djmix_release_date',true);
				
				if ( $post_date != '' ) { 
					if ( is_numeric( $post_date ) ) {
						$post_date = date_i18n( $default_date, $post_date );
					}
				}

				$imagesrc         = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'thumbnail', false, '' );
				$image            = aq_resize( $imagesrc[0], '80', '80', true );
				$djtitle          = get_the_title( $post->ID );
				$djmix_list       = get_post_meta( $post->ID, 'djmix_upload_mix', true ) ? get_post_meta( $post->ID, 'djmix_upload_mix', true ) : '';

				if ( $djmix_list ) {
					global $wpdb;
					$djmix_list = $wpdb->get_col("
						SELECT ID FROM {$wpdb->posts}
						WHERE post_type = 'attachment'
						AND ID in ({$djmix_list})
						ORDER BY menu_order ASC");
				}?>

				<div id="post-<?php the_ID(); ?>" class="djmix-list clearfix">

					<div class="djmix_thumb">
						<?php if ( has_post_thumbnail() ) { echo atp_resize( $post->ID, '', '60','60', '', $djtitle ); } ?>
					</div>

					<div class="djmix-content">
						<div class="djmix-details">

							<?php 
							if($audio_posttype_option == 'player'){
								if(!empty($djmix_list)){
									foreach($djmix_list as $attachment_id){
										$attachment = get_post( $attachment_id );
										$title = $attachment->post_title;
										echo '<span class="single-player-meta" id="single-player-meta'.$start.'">'.$djtitle.'<div>'.$djmix_genre.' | '.$post_date.'</div></span>';?>
										<div class="play mediamx"><a data-meta="#single-player-meta<?php echo $start; ?>" class="fap-single-track no-ajaxy" href="<?php  echo $attachment->guid;?>" title="<?php echo $title; ?>"  rel="<?php echo $image; ?>"><div class="play-btn"></div></a></div>
										<?php
									}
								} ?>
								<?php //echo $playlisttitles; ?>
								<?php 
							}
							elseif($audio_posttype_option == 'externalmp3'){
								echo '<span class="single-player-meta" id="single-player-meta'.$start.'">'.$djtitle.'<div>'.$djmix_genre.' | '.$post_date.'</div></span>';
								$djmix_externalmp3url = get_post_meta($post->ID,'djmix_externalmp3',true); 
								$djmix_externalmp3urltitle = get_post_meta($post->ID,'djmix_externalmp3title',true); ?>
								<div class="play mediamx"><a  data-meta="#single-player-meta<?php echo $start; ?>"	rel="<?php echo $image; ?>" title="<?php echo $djmix_externalmp3urltitle; ?>" href="<?php echo $djmix_externalmp3url; ?>" class="fap-single-track no-ajaxy"><div class="play-btn"></div></a></div>
							<?php
							}
							else {
								$audio_soundcloud_url = get_post_meta($post->ID,'audio_soundcloud_url',true); ?>
								<div class="play mediamx"><a href="<?php echo $audio_soundcloud_url; ?>" class="fap-single-track no-ajaxy"><div class="play-btn"></div></a></div>
							<?php } ?>
							<div class="djmix-postmeta">
								<!-- Title and Meta -->
								<?php the_title('<h2 class="entry-title">', '</h2>', TRUE); ?>
								<?php if (  $djmix_genre != '' ) { ?><span><?php echo $djmix_genre; ?></span><?php } ?>
								<?php if (  $post_date != '' ) { ?><span><?php echo $post_date; ?></span><?php } ?>
	
								<div class="djmix-buttons">
								<?php
								// BuyMix Button
								if ( $djmix_buy_mix != '' ) { ?>
									<div class="djbtn"><a href="<?php echo $djmix_buy_url; ?>" target="_blank"><button type="button" class="btn mini abestos"><span><?php echo $djmix_buy_mix; ?></span></button></a></div>
								<?php } ?>
								<?php
								// DjMix Download Button
								if ( $djmix_download_url != '' ) { ?>
									<div class="djbtn"><button type="button" class="btn mini abestos music_download" data-download="<?php echo $djmix_download_url; ?>"><span><?php echo $djmix_download_text; ?></span></button></span></div>
								<?php } ?>
								</div><!-- .djmix-buttons -->
							</div><!-- .djmix-postmeta -->
					</div><!-- .djmix-details -->
				</div><!-- .djmix-content -->

					<?php the_content(); ?>

				</div><!-- .djmix-list -->
			<?php $start++; ?>
			
			<?php endwhile; ?>
			
			<?php if ( $pagination == 'on' ) { echo atp_pagination(); } ?>
			
			<?php wp_reset_query(); ?>
				
			<?php else : ?>
	
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'musicplay' ); ?></p>
	
			<?php get_search_form(); ?>
	
			<?php endif;?>
					
			<div class="clear"></div>
	
			<?php edit_post_link( __( 'Edit', 'musicplay' ), '<span class="edit-link">', '</span>' ); ?>
	
		</div><!-- .content-area -->

		<?php if ( atp_generator( 'sidebaroption', $post->ID) != "fullwidth" ){ get_sidebar(); } ?>

	</div><!-- inner -->
</div><!-- #primary.pagemid -->

<?php get_footer(); ?>