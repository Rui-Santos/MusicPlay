<?php
$fs_slidelimit = get_option('atp_flexslidelimit') ? get_option('atp_flexslidelimit') : '3';
$fs_slidespeed = get_option('atp_flexslidespeed') ? get_option('atp_flexslidespeed') : '3000';
$fs_slideffect = get_option('atp_flexslideffect') ? get_option('atp_flexslideffect') : 'fade';
$fs_slidednav = get_option('atp_flexslidednav') ? get_option('atp_flexslidednav') : 'true';
$pageslider = get_post_meta($post->ID,'page_slider', true);

if ( $pageslider != "" ) {
	$slider_cat = get_post_meta($post->ID, 'flexslidercat', true);
}else{
	$slider_cat = get_option( 'atp_flexslidercat' );
}
?>
<?php
echo '<script type="text/javascript">
jQuery(document).ready(function($) {
	jQuery(".flexslider").flexslider({
		animation: "'.$fs_slideffect.'",
		controlsContainer: ".flex-container",
		slideshow: true,
		slideshowSpeed: '.$fs_slidespeed.',
		animationDuration: 400,
		directionNav: '.$fs_slidednav.',
		controlNav: false,
		mousewheel: true,
		smoothHeight :true,
		start: function(slider) {
			jQuery(".total-slides").text(slider.count);
		},
		after: function(slider) {
			jQuery(".current-slide").text(slider.currentSlide);
		}
	});
});	
</script>';
?>
<div id="featured_slider" class="clearfix">
	<div class="slider_stretched">
		<div class="flexslider">
		
			<ul class="slides">
				<?php
				if( is_array( $slider_cat ) && count($slider_cat)>0) { 
					$slider_cat = implode( ",",$slider_cat );
				}
				$query = array(
					'post_type'			=> 'slider', 
					'posts_per_page'	=> $fs_slidelimit, 
					'taxonomy'			=> 'slider_cat', 
					'term'				=> $slider_cat, 
					'orderby'			=> 'menu_order',
					'order'				=> 'ASC'
				);
				query_posts($query);
				while (have_posts()) :the_post();

					$terms = get_the_terms(get_the_ID(), 'slider_cat');
					$terms_slug = array();
					if (is_array($terms)) {
						foreach($terms as $term) {
							$terms_slug[] = $term->slug;
						}
					}
					if( get_option('atp_layoutoption') == "stretched"){ $width='1920'; }else{ $width='1000'; }

					$postlinktype_options = get_post_meta($post->ID, "postlinktype_options", true);
					$flex_sliderdescription= get_post_meta($post->ID, "slider_desc", true);
					$desc_enable = get_post_meta($post->ID, 'desc_enable', true);
					$img_alt_title 		= get_the_title();
					$postlinkurl = atp_generator('atp_getPostLinkURL',$postlinktype_options);
					$target_link        =  get_post_meta($post->ID, 'target_link', true) != 'on' ? '' :"target='_blank'";
					echo '<li>';
					if ($postlinkurl != 'nolink' ) {
						echo '<a href="'.$postlinkurl.'" '.$target_link.'  title="'.$img_alt_title.'" >'. atp_resize($post->ID,'',$width,'430','', $img_alt_title ) .'</a>';
					} else {
						echo atp_resize($post->ID,'','1000','430','', $img_alt_title );
					}
					?>
					<?php if ($desc_enable != 'on') { ?>
					<div class="flex-caption fadeInDown">
						<div class="flex-title">
							<h5><span><?php the_title();?></span></h5>
							<?php if ( $flex_sliderdescription != '' ) { ?>
							<h6><span><?php echo do_shortcode($flex_sliderdescription); ?></span></h6>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
					<?php
					echo '</li>';
					endwhile;
					wp_reset_query(); ?> 
			</ul>
		</div><!-- .flex_slider -->
	</div><!-- .slider_stretched -->
</div><!-- #featured_slider -->