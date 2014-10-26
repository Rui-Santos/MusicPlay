<div id="featured_slider">
	<div class="slider_stretched">
		<div class="staticslider">
		
		<?php
			$pageslider = get_post_meta($post->ID,'page_slider', true);
			if( get_option('atp_layoutoption') == "stretched"){ $width='1920'; }else{ $width='1000';  }
			if( $pageslider != "" ) {
				$src = get_post_meta($post->ID,'staticimage', true);
				$link = esc_url( get_post_meta($post->ID,'cimage_link', true));
				$target_link        =  get_post_meta($post->ID, 'target_link', true) != 'on' ? '' :"target='_blank'";
				$img_alt_title 		= get_post_meta($post->ID, 'cimage_title', true) ? get_post_meta($post->ID, 'cimage_title', true)  :"";

			}else{ 
				$src = get_option( 'atp_static_image_upload' ); 
				$link = esc_url( get_option( 'atp_static_link' ) );
				$target_link = get_option( 'atp_target_link' ) != 'on' ? '' :'target="_blank"';
				$img_alt_title 		=  get_option('atp_static_linktitle') ?  get_option('atp_static_linktitle') :'';

			}
			$img_alt_title 		= get_the_title();
			if( $link != "" ) {
				echo '<a href="'.$link.'" '.$target_link.' title="'. $img_alt_title.'" ><figure>'.atp_resize( '', $src, '1000', '430', '', $img_alt_title  ).'</figure></a>';
			}else {
				echo '<figure>'.atp_resize( '', $src, '1000', '430', '', $img_alt_title  ).'</figure>';
			}
		?>
		
		</div><!-- .staticslider -->
	</div><!-- .slider_stretched -->
</div><!-- #featured_slider -->