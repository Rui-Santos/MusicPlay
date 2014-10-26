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
			$imagesPerPage= get_option('atp_single_gallery_limits') ? get_option('atp_single_gallery_limits') :  '5'; 
			$pagination = get_option('atp_single_gallery_pagination');
		?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div <?php post_class( 'custompost-single' );?> id="post-<?php the_ID(); ?>">
					<?php
					$gallery_venue			= get_post_meta( $post->ID, 'gallery_venue', true );
					$gallery_upload			= get_post_meta( $post->ID, 'gallery_upload', true );
					if( atp_generator( 'sidebaroption',$post->ID ) != "fullwidth" ){ $width = '670'; }else{ $width = '960';  } ?>
					<div class="custompost_entry">
						<div class="custompost_details">
							<div class="custompost_thumb">

							<?php if( has_post_thumbnail()){ ?>
								<h2 class="album-title "><span><?php echo get_post_meta( $post->ID, 'gallery_venue', true ); ?></span></h2>
							<?php } ?>

							<?php
							$gallery_list = get_post_meta($post->ID,'gallery_upload',true) ? get_post_meta($post->ID,'gallery_upload',true) :'';
							$gallery_upload_img= array();
							$gallery_upload_img	 = explode( ',', $gallery_list );
							$out='';
							
							if($gallery_list) {
								global $wpdb;
								$gallery_list = $wpdb->get_col("
									SELECT ID FROM {$wpdb->posts}
									WHERE post_type = 'attachment'
									AND ID in ({$gallery_list})
									ORDER BY menu_order ASC
								");
							}
							if($pagination == "on"){
								if ( empty($gallery_list) ) return false;
								$imageCount = count($gallery_list);
								$pageCount = ceil($imageCount / $imagesPerPage);
								$page_gallery = isset($_GET['page']) ? $_GET['page'] : '';
								$currentPage = intval($page_gallery);
								
								if ( get_query_var('paged') ) {
									$currentPage = get_query_var('paged');
								}
								elseif ( get_query_var('page') ) {
									$currentPage = get_query_var('page');
								} else {
									$currentPage = 1;  
								}
								if ( empty($currentPage) || $currentPage<=0 ) $currentPage=1;
								
								$maxImage = $currentPage * $imagesPerPage;
								$minImage = ($currentPage-1) * $imagesPerPage;
								if ($pageCount > 1){
									$page_link= get_permalink();
									$page_link_perma= true;
									if ( strpos($page_link, '?')!==false )
									$page_link_perma= false;
							
									$gplist= '<div class="clear"></div><div class="pagination pagination2">'.__('Pages').'&nbsp; ';
									for ( $j=1; $j<= $pageCount; $j++)
									{
										if ( $j==$currentPage )
											$gplist .= '<span class="current"> '.$j.' </span>';
										else
											$gplist .= '<a class="inactive" href="'.$page_link. ( ($page_link_perma?'?':'&amp;') ). 'page='.$j.'">'.$j.'</a>';
									}
									$gplist .= '</div>';
								}else{
									$gplist= '';
								}
								if($gallery_list !=''){
									$i = 0;
									$k = 0;
									foreach($gallery_upload_img as $attachment_id) {
										if ($k >= $minImage && $k < $maxImage) {
											$attachment = get_post( $attachment_id );
											$image_attributes = wp_get_attachment_image_src( $attachment_id,'full'); // returns an array
											$alt = $attachment->post_title ;
											$out .='<div class="gallery-postimg port_img">';
											$out .= atp_resize('',$image_attributes[0],'180','180','',$alt);										
											$out .='<div class="hover_type">';
											$out .='<a data-rel="prettyPhoto[gal-mixed]" class="hoverimage"   href="' . $image_attributes[0] . '" title="' .$alt . '">';
											$out .='</a>';
											$out .='</div>'; 
											$out .='</div>';
										}
										$k++;
									}
								}
								$out .= $gplist;
							}else{
								if($gallery_list !=''){
									foreach($gallery_upload_img as $attachment_id) {
										$attachment = get_post( $attachment_id );
										if( count($attachment) > 0){
											$image_attributes = wp_get_attachment_image_src( $attachment_id,'full'); // returns an array
											$alt = $attachment->post_title ;
											$out .='<div class="gallery-postimg port_img">';
											$out .= atp_resize('',$image_attributes[0],'180','180','',$alt);										
											$out .='<div class="hover_type">';
											$out .='<a data-rel="prettyPhoto[gal-mixed]" class="hoverimage"   href="' . $image_attributes[0] . '" title="' . $alt. '">';
											$out .='</a>';
											$out .='</div>'; 
											$out .='</div>';
										}
									}
								}
							
							}
							echo $out;
							?>
						</div><!-- .custompost_details -->

					</div> <!-- custompost_entry -->

					<div class="demospace" style="height:20px;"></div>

					<?php the_content(); ?>

					<?php get_template_part('musicband/share','link'); ?>

					<div class="demospace" style="height:20px;"></div>

					</div>

				</div>
				<!-- #post-<?php the_ID();?> -->
				<?php edit_post_link(__('Edit', 'musicplay'), '<span class="edit-link">', '</span>'); ?>

				<?php endwhile; ?>
				<?php else: ?>
				<?php '<p>'.__('Sorry, no projects matched your criteria.', 'musicplay').'</p>';?>
				<?php endif; ?>

			<?php 
				$comments = get_option('atp_gallery_comments');
			if ( $comments == 'enable'  ) {
				comments_template( '', true ); 
			}?>

			</div><!-- .content-area -->
	
			<?php if ( atp_generator( 'sidebaroption', $post->ID) != "fullwidth" ){ get_sidebar(); } ?>

	</div><!-- inner -->
	</div><!-- #primary.pagemid -->

<?php get_footer(); ?>