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
			<?php 	$lyrics_option	= get_option('atp_lyrics_option') ?  get_option('atp_lyrics_option') : 'lightbox';
				if($lyrics_option ==="lightbox") { $lyrics_box ="prettyPhoto";}else{ $lyrics_box ="lyrics"; }  
			?>		
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>			
			<div <?php post_class( 'custompost-single' );?> id="post-<?php the_ID(); ?>">
				<?php
				$audio_upload 				= get_post_meta( $post->ID, 'audio_upload', true );
				$audio_release_date			= get_post_meta( $post->ID, 'audio_release_date', true );
				$audio_label				= get_the_terms( $post->ID , 'label');
				$audio_genre_music 			= get_the_terms( $post->ID , 'genres' );
				$audio_video				= get_post_meta( $post->ID, 'audio_video', true );
				$audio_catalog_id			= get_post_meta( $post->ID, 'audio_catalog_id', true );
				$albumupload 				= explode( ',', $audio_upload );
				$audio_soundcloud_code 		= get_post_meta( $post->ID, 'audio_soundcloud_code', true );
				$audio_posttype_option		= get_post_meta( $post->ID, 'audio_posttype_option', true ) ?  get_post_meta( $post->ID, 'audio_posttype_option', true ) :'player';
				$audio_auto_play			= get_option('atp_audio_autoplay') ? get_option('atp_audio_autoplay') : 'true';
				$audio_button_disable 		= get_post_meta( $post->ID, 'audio_button_disable', true );
				$audio_buttons   = get_post_meta( $post->ID, 'audio_buttons', true );
				$img_alt_title 		= get_the_title();	
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
 		
				$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full', false, '' );
				$music_image = aq_resize( $imagesrc[0], '80', '80', true );
				$permalink = get_permalink( get_the_id());
				$playlisttitle = get_the_title( get_the_id());
				$post_date = get_post_meta(get_the_id(),'audio_release_date',true);
				if($post_date !='') { 
					if(is_numeric($post_date)){
						 $post_date= date_i18n($default_date,$post_date);
					}	
				}
				if( atp_generator( 'sidebaroption',$post->ID ) != "fullwidth" ){ $width = '670'; }else{ $width = '960'; }			

				?>
			
				<div class="custompost_entry">				
					<div class="custompost_details">					
						
						<div class="col_fourth">

							<?php if( has_post_thumbnail()){ ?>
							<div class="custompost_thumb port_img">
							<?php
								echo '<figure>'. atp_resize($post->ID,'','470','470','', $img_alt_title  ). '</figure>';
								echo '<div class="hover_type">';
								echo '<a data-rel="prettyPhoto" class="hoverimage" href="'.$imagesrc[0].'" title="'. get_the_title().'"></a>';
								echo '</div>';
							?>
							</div>
							<?php } ?>
						
							<div class="album-details">
						
								<?php if($audio_release_date != '' ) { ?>
								<div class="album-meta"><?php echo atp_localize($atp_album_releasedate_txt,'<span>','</span>') . $post_date; ?></div>
								<?php } ?>
								
								<?php if($audio_label != '' ) { ?>
								<div class="album-meta">
								<?php echo atp_localize($atp_album_label_txt,'<span>','</span>') . get_the_term_list( $post->ID, 'label', '','' );?>
								</div>
								<?php } ?>
			
								<?php if($audio_catalog_id != '' ) { ?>
								<div class="album-meta"><?php echo atp_localize($atp_album_catid_txt,'<span>','</span>') . $audio_catalog_id; ?></div>
								<?php } ?>
								
								<?php if($audio_genre_music != '' ) { ?>
								<div class="album-meta"><?php echo atp_localize($atp_album_genre_txt,'<span>','</span>') ?>
								<?php echo get_the_term_list( $post->ID, 'genres', '','' );?>
								</div>
								<?php } ?>

								<?php get_template_part('musicband/share','link'); ?>
	
							</div><!-- .album-details -->
						</div><!-- .col_fourth -->
					
						<div class="col_three_fourth end">
							<?php
								echo '<div class="iva-np-headwrap">';				
								echo '<div class="iva-np-title"><h2 class="album-title">'.get_the_title() .'</h2></div>';
								echo '<div class="iva-np-navs">';
								echo '<div class="iva-np-pagination">';
								echo previous_post_link( $link = '%link','<i class="fa fa-angle-left fa-2x"></i>');
								echo next_post_link( $link = '%link', '<i class="fa fa-angle-right fa-2x"></i>');
								echo '</div>';
								echo '</div>';
								echo '</div>';
							?>
							<div class="arts_name"><?php echo $audio_artist_name; ?></div>
							<?php
							if ( $audio_button_disable != 'on' ) {
								if ( $audio_buttons != '' ){
									echo '<div class="buttons-wrap">';
									foreach ($audio_buttons as $buttons){ ?>
										<a href="<?php echo $buttons['buttonurl'] ?>" target="_blank" <?php if($buttons['buttoncolor']!=''){?> style="background-color:<?php echo $buttons['buttoncolor'] ?>"<?php } ?> class="btn medium orange flat"><span><?php echo  $buttons['buttonname'];?></span></a>
						    				<?php	
									}
								 	$post_likes_option = get_option('atp_like_btn');
									if($post_likes_option != 'on'){
										if(function_exists('iva_get_post_like')){
											echo iva_get_post_like($post->ID);
										}
									}
									echo '</div>';
								}
							} 
							?>
							<?php if(get_option('atp_playlist_enable') =='on' ) {  ?>
							 <a href="#" class="fap-add-playlist btn small orange flat alldata-playlist "  data-enqueue="yes" data-playlist="any-playlist">Add playlist to player</a>
							<?php }

							if($audio_posttype_option == 'player'){
								$audiolist=get_post_meta($post->ID,'audio_upload',true) ? get_post_meta($post->ID,'audio_upload',true) :'';

								$audio_list=array();
								$audio_list=explode(',',$audiolist);$count=count($audio_list);
								$audio_id=array();
								foreach ($audio_list as $attachment_id) {
									$attachment = get_post( $attachment_id );
									if(count($attachment) >0 ){
										$audio_id[]=$attachment->ID;
									}
									}
									
									if(!empty($audio_id)){
									$count=count($audio_id);
									}
								/*** Album Details for MusicPlayer
								 * permalink, title, release date, audio playlist
								 */
								
								?>

								<?php if($audiolist !='') { if($count > 0) { echo '<span class="tracks">'.$count.' Tracks In Total</span>'; } } ?>
								<ul data-playlist="any-playlist" class="fap-my-playlist album-playlist">
								<?php
								if($audiolist !='') {
								if($count > 0) { 
									$i = 1;
									foreach($audio_list as $attachment_id) {
										$attachment = get_post( $attachment_id );
										if(count($attachment) > 0) {
											$attachment_title=$attachment->post_title;
											$attachment_caption=$attachment->post_excerpt;

											$lyricsdesc=$attachment->post_content;
											$buy=$attachment->buy;
											$download= $attachment->download;
											 ?>
											<li><a class="fap-single-track no-ajaxy" data-meta="#single-player-meta" href="<?php  echo $attachment->guid;?>"  title="<?php echo $attachment_title; ?>"  rel="<?php echo $music_image; ?>">
											<i class="fa fa-play-circle fa-2x play_icon"></i><?php echo $attachment_title; ?> </a>
											<div class="mp3options">
											<?php
											if($buy !='') { 
												echo '<span class="buy"><a href="'. esc_url($buy) .'" target="_blank"><i class="fa fa-shopping-cart"></i></a></span>';
											}
											if($download !='' && $download !='#' ) { 
												echo '<span class="download music_download "  data-download="'. $download.'"><i class="fa fa-cloud-download"></i></span></span>';
											}
											if($lyricsdesc !=''){ 
												echo '<span class="lyrics"><a href="#'. preg_replace('/\s+/', '-', $attachment_title) .'" data-rel="'. $lyrics_box .'"><i class="fa fa-file-text"></i></a></span>';
											}
											?>
											</div>
											<?php if($lyricsdesc !=''){ ?>
												<div id="<?php echo preg_replace('/\s+/', '-', $attachment_title) ; ?>" class="lyricdesc">
													<?php 
													echo '<p><strong>'.$attachment_title.'</strong></p>';
													//echo wpautop($attachment->post_content); 
													$content = apply_filters('the_content', $attachment->post_content); 
													echo $content;
													?>
												</div>
												<?php } ?>
											<?php }
										echo'</li>';
										}
									}
								}
								?>
								</ul>
								
								<?php 
								echo '<div id="single-player-meta">
									<a href="'.$permalink.'">'.$playlisttitle.'</a>
									<div>'.get_the_term_list( $post->ID, 'label', '', ',', '' ).' | '.$post_date.'</div></div>'; 
								
								// Fetch Soundcloud if assign in meta
							}elseif($audio_posttype_option == 'externalmp3'){
							$audiolist=get_post_meta($post->ID,'audio_mp3',true) ? get_post_meta($post->ID,'audio_mp3',true) :'';
							$count=count($audiolist);
							//print_r($audiolist);
							?>
							<?php if($audiolist !='') { if($count > 0) { echo '<span class="tracks">'.$count.' Tracks In Total</span>'; } } ?>
							<ul data-playlist="any-playlist" class="album-playlist">
								<?php
								if($audiolist !='') {
								
								if($count > 0) {
									$i = 1;
									foreach($audiolist as $mp3_list) {
										//$attachment = get_post( $attachment_id );
										$mp3_title=$mp3_list['mp3title'];
										$lyricsdesc=$mp3_list['lyrics'];
										$buy=$mp3_list['buylink'];
										$download=$mp3_list['download'];
										 ?>
										<li><i class="fa fa-play-circle fa-2x play_icon"></i><a class="fap-single-track no-ajaxy" data-meta="#single-player-meta" href="<?php  echo esc_attr($mp3_list['mp3url']);?>"  title="<?php echo $mp3_title; ?>"  rel="<?php echo $music_image; ?>">
										<?php echo $mp3_title; ?></a>
										<div class="mp3options">
										<?php
										if($buy !='') { 
											echo '<span class="buy"><a href="'. esc_url($buy) .'" target="_blank"><i class="fa fa-shopping-cart"></i></a></span>';
										}
										if($download !='') { 
											echo '<span class="download music_download" data-download="'. $download.'"><i class="fa fa-cloud-download"></i></span>';
										}
										if($lyricsdesc !=''){ 
											echo '<span class="lyrics"><a href="#'. preg_replace('/\s+/', '-', $mp3_title) .'" data-rel="'. $lyrics_box .'"><i class="fa fa-file-text"></i></a></span>';
										}
										?>
										</div>
										<?php if($lyricsdesc !=''){ ?>
											<div id="<?php echo preg_replace('/\s+/', '-', $mp3_title) ; ?>" class="lyricdesc">
												<?php 
												echo '<p><strong>'.$mp3_title.'</strong></p>';
												$content = apply_filters('the_content', $mp3_list['lyrics']); 
												echo $content;
												?>
											</div>
											<?php } ?>
										<?php }
									echo'</li>';
									}
								}
								?>
								</ul>
								
							<?php
							echo '<div id="single-player-meta">
									<a href="'.$permalink.'">'.$playlisttitle.'</a>
									<div>'.get_the_term_list( $post->ID, 'label', '', ',', '' ).' | '.$post_date.'</div></div>'; 
							}else {
								$audio_soundcloud_title = get_post_meta($post->ID,'audio_soundcloud_title',true);
								$audio_soundcloud_title_label = $audio_soundcloud_title ? $audio_soundcloud_title :'Title Label';
								$audio_soundcloud_url = get_post_meta($post->ID,'audio_soundcloud_url',true); ?>
								<?php if($audio_soundcloud_url !='') {  echo '<span class="tracks"> 1 Track In Total</span>';  } ?>
								<ul class="fap-my-playlist album-playlist"   data-playlist="any-playlist">
									<li><i class="fa fa-play-circle fa-2x play_icon"></i><a href="<?php echo $audio_soundcloud_url; ?>" class="fap-single-track no-ajaxy"><?php echo $audio_soundcloud_title; ?></a></li>
								</ul>
							<?php } ?>
							<?php the_content(); ?>	
							<?php if (  $audio_video != '' ) {  echo $audio_video;  } ?>	
						</div><!-- .col_three_fourth -->
						
					</div><!-- .custompost_details -->
				</div><!-- .custompost_entry -->
				
			</div><!-- #post-<?php the_ID();?> -->
			<?php endwhile; ?>

			<?php else: ?>
			<?php '<p>'.__('Sorry, no projects matched your criteria.', 'musicplay').'</p>';?>
			<?php endif; ?>
			
			<?php edit_post_link(__('Edit', 'musicplay'), '<span class="edit-link">', '</span>'); ?>

			<?php 
			$comments = get_option('atp_album_comments');
			if ( $comments == 'enable' ) {
				comments_template( '', true ); 
			}?>
			
			</div><!-- .content-area -->
			<?php if ( atp_generator( 'sidebaroption', $post->ID ) != "fullwidth" ){ get_sidebar(); } ?>
	</div><!-- inner -->
	</div><!-- #primary.pagemid -->

	<?php 
	if($audio_label != '' ) {
		get_template_part('musicband/albums/audio','label');
	}

	if($audio_genre_music !='') {
		get_template_part('musicband/albums/audio','genres');
	}
	?>


<?php get_footer(); ?>