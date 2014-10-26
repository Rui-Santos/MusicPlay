<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;
	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
	{
		echo " | $site_description";
	}

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 ) {
		echo ' | ' . sprintf( __( 'Page %s', 'musicplay' ), max( $paged, $page ) );
		}

	?></title>
	
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo THEME_URI; ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php if(get_option('atp_custom_favicon')) { ?>
	<link rel="shortcut icon" href="<?php echo get_option('atp_custom_favicon'); ?>" type="image/x-icon" /> 
<?php } ?>

<?php
	if ( is_singular() && get_option( 'thread_comments' ) ){
		wp_enqueue_script( 'comment-reply' );
	}
	$themecolor = get_option( 'atp_themecolor' ) ? get_option( 'atp_themecolor' ) : '' ;
	wp_head();
?>
</head>

<?php if( is_search() ) { ?>
<body <?php body_class('custom-search'); ?>>
<?php }else{ ?>
<body <?php body_class(); ?>>
<?php } ?>

<div id="bodybg"></div>

	<?php
	if ( is_tag() || is_search() || is_404()) { 
		$frontpageid = '';
	} else { 
		$frontpageid = $post->ID;
	} 
	?>



	<?php if ( get_post_meta( $frontpageid, 'page_bg_image', true ) ) { ?>
		<img id="pagebg" style="background-image:url(<?php echo get_post_meta( $frontpageid, 'page_bg_image', true ); ?>)" />
	<?php } ?>
	
	<div class="layoutoption" id="<?php echo (get_option( 'atp_layoutoption' )) ? get_option( 'atp_layoutoption' ) : 'boxed'; ?>">
	
	<div class="bodyoverlay"></div><!-- .bodyoverlay -->

	<?php if ( get_option( 'atp_stickybar' ) != "on" &&  get_option( 'atp_stickycontent' ) != '' ) { ?>
		<div id="trigger" class="tarrow"></div>
		<div id="sticky"><?php echo  stripslashes( get_option( 'atp_stickycontent' ) ); ?></div><!-- #sticky -->
	<?php } ?>

	<div id="wrapper">
		<?php

		$headerstyle = get_option('atp_headerstyle','default');
			
		switch( $headerstyle ) {
			case 'headerstyle1':
								get_template_part('headers/header','style1');
								break;
			case 'headerstyle2':
								get_template_part('headers/header','style2');
								break;
			case 'headerstyle3':
								get_template_part('headers/header','style3');
								break;
			default:
								get_template_part('headers/header','default');
		}
		?>
		<div id="ajaxwrap">
		
		<?php
			if ( is_tag() || is_search() || is_404()) { 
				$frontpageid = '';
			} else { 
				$frontpageid = $post->ID;
			} 
				
		$pageslider = get_post_meta( $frontpageid, 'page_slider', true );

		if ( is_front_page() || $pageslider != "" ) {
			// Get Slider based on the option selected in theme options panel
			if( get_option( 'atp_slidervisble') != "on" ) {
				if( $pageslider == "" ) {
					$chooseslider = get_option( 'atp_slider' );
				} else {
					$chooseslider = $pageslider;
				}
				switch ( $chooseslider ) {
					case 'static_image':
										get_template_part( 'slider/static', 'slider' ); 
										break;
					case 'flexslider':
										get_template_part( 'slider/flex', 'slider' );
										break;
					case 'videoslider':
										get_template_part( 'slider/video', 'slider' );
										break;
					case 'customslider':
										get_template_part( 'slider/custom', 'slider' );
										break;
					default:
										get_template_part( 'slider/default', 'slider' );
				}
			}
			
			if ( is_front_page() ) {
				atp_generator( 'teaser_option' );
			}

			wp_reset_query();
		}

		/**
		 * Custom Search for Albums, Tracks and Artists
		 * since - Musicplay 2.4.1
		 */
		if ( ! is_front_page() ) {
			get_template_part('custom','search');
		}

		if ( !is_front_page() ) {
			
			if ( function_exists('tribe_is_event_query')) {
				if ( ! tribe_is_event_query() || ( tribe_is_event_query() && is_singular() ) AND !is_singular("albums") AND  !is_404() AND !is_singular("artists") AND !is_singular("gallery") AND !is_singular("video") ) {
					echo atp_generator( 'subheader', $frontpageid );
				}
			}else{
				if (!is_404() ) {
					echo atp_generator( 'subheader', $frontpageid );
				}
			}
		}
		?>
	<div id="main" class="<?php echo atp_generator( 'sidebaroption', $frontpageid ); ?>">