<?php
	global $post;
	$the_query = new WP_Query( array(
									'post_type' => 'albums',
									'post_status' => 'publish',
									'posts_per_page' => 5,
									'meta_key' => 'audio_artist_name',
									'meta_value' => $post->ID,
									'meta_compare' => 'like',
									'order' => 'ASC'
							));

					if($the_query->found_posts >=1 ) {?>

<div class="more-labels">
	<div class="inner">
		
		<h3 class="fancy-title"><?php _e('More albums from:','musicplay'); ?>&nbsp;<?php the_title(); ?></h3>

		<?php
		
		// Columns for Album Thumbs
		$column_index = 0;
		$columns = 5;
		if ($columns == '5') { $class = 'col_fifth'; }
		if ($columns == '4') { $class = 'col_fourth'; }
		if ($columns == '3') { $class = 'col_third'; }			

		// Full Width Album Image Sizes
		if ($columns == '5') { $width = '470'; $height = '470'; }
		if ($columns == '4') { $width = '470'; $height = '470'; }
		if ($columns == '3') { $width = '470'; $height = '470'; }

		/**
		* Get posts based on meta key 
		* meta_key = audio_artist_name
		* post_type = albums
		*/

		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$art_postID			= $the_query->post->ID;
			$audio_catalog_id	= get_post_meta( $art_postID, 'audio_catalog_id', true );
			$audio_label		= get_post_meta( $art_postID, 'audio_label', true );
			$image				= wp_get_attachment_image_src(get_post_thumbnail_id($art_postID) , 'full', true);
			$column_index++;
			$last = ( $column_index == $columns && $columns != 1 ) ? 'end ' : '';
			?>
		
			<div class="album-list <?php echo $class . ' ' . $last; ?>">
				<div class="artistpost_entry">

					<?php if ( has_post_thumbnail() ) { ?>
						<div class="custompost_thumb port_img">
						<?php
						echo '<figure>'. atp_resize($the_query->post->ID, '', $width, $height, '', '') .'</figure>';
						echo '<div class="hover_type">';
						echo '<a class="hoverartist"  href="' . get_permalink() . '" title="' . get_the_title() . '"></a>';
						echo '</div>';
						?>
						</div>
					<?php } ?>

				</div><!-- .artistpost_entry -->

				<div class="album-desc">
					<h2 class="entry-title">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__("Permanent Link to %s", 'musicplay') , esc_attr(get_the_title())); ?>"><?php the_title(); ?></a>
					</h2>
					<span class="label-text"><?php echo strip_tags(get_the_term_list( $art_postID , 'label','',', ','' )) ?></span>
				</div><!-- .album-desc -->
				
			</div><!-- .album_list -->
			
			<?php
			if ( $column_index == $columns ) {
				$column_index = 0;
				echo '<div class="clear"></div>';
			}?>
		
		<?php } ?>
	</div> <!-- inner close -->
</div> <!-- morelabel end -->
<?php } ?>