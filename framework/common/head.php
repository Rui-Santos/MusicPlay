<?php
	// REGISTER AND ENQUEUE SCRIPTS
	//--------------------------------------------------------
	if(!function_exists('enqueue_scripts')){
		function enqueue_scripts() {
			wp_register_script('atp-sf-hover', THEME_JS .'/hoverIntent.js','jquery','','in_footer');
			wp_register_script('atp-sf-menu', THEME_JS .'/superfish.js','jquery','','in_footer');
			wp_enqueue_script('atp-gmap', 'http://maps.google.com/maps/api/js?sensor=false','jquery','','in_footer');
			wp_enqueue_script('atp-gmapmin', THEME_JS . '/jquery.gmap.js', 'jquery','','in_footer');
			wp_register_script('atp-flexslider', THEME_JS .'/jquery.flexslider.js', 'jquery','','in_footer');	
			wp_register_script('atp-progresscircle', THEME_JS .'/jquery.easy-pie-chart.js', 'jquery','','in_footer');
			wp_register_script('atp-excanvas', THEME_JS .'/excanvas.js', 'jquery','','in_footer');
			wp_register_script('atp-custom', THEME_JS . '/sys_custom.js', 'jquery','1.0','in_footer');
			wp_register_script('atp-waypoints', THEME_JS .'/waypoints.js', 'jquery','','in_footer');
			wp_register_script('atp-countdown', THEME_JS . '/countdown.js', 'jquery','1.0','in_footer');	
	
			// Enqueue Scripts
			//--------------------------------------------------------
	
			wp_enqueue_script('jquery');
			wp_enqueue_script('atp-easing', THEME_JS .'/jquery.easing.1.3.js','jquery','','in_footer');
			wp_enqueue_script('atp-countdown');
			wp_enqueue_script('atp-sf-hover');
			wp_enqueue_script('atp-sf-menu');
			wp_enqueue_script('atp-preloader', THEME_JS .'/jquery.preloadify.min.js','jquery','','in_footer');
			wp_enqueue_script('atp-prettyPhoto', THEME_JS .'/jquery.prettyPhoto.js','jquery','','in_footer');
			wp_enqueue_script('atp-fitvids', THEME_JS .'/jquery.fitvids.js','jquery','','in_footer');
			wp_enqueue_script('atp-custom');
			wp_enqueue_script('atp-flexslider');
			wp_enqueue_script('atp-waypoints');
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-widget');
			wp_enqueue_script('jquery-ui-mouse');
			wp_enqueue_script('jquery-ui-draggable');
			wp_enqueue_script('jquery-ui-sortable');
			wp_enqueue_script('jplayer.min', THEME_JS.'/jquery.jplayer.min.js',false,false,'all');
			if(get_option('atp_ajaxify') =='enable'){
				wp_enqueue_script('atp-history', THEME_JS.'/history.js','jquery','','in_footer');
				wp_enqueue_script('atp-ajaxify', THEME_JS.'/ajaxify.js','jquery','','in_footer');
						
				$aws_data = array(
						'rootUrl' 		=> site_url() . '/',
						'ThemeDir'     => get_template_directory_uri() . '/',
					);
					
				wp_localize_script('atp-ajaxify', 'aws_data', $aws_data);
			}
	
		//AJAX URL
		$data["ajaxurl"] = admin_url("admin-ajax.php");	
	
		//HOME URL
		$data["home_url"] = get_home_url();
		
		//pass data to javascript
		$params = array(
			'l10n_print_after' => 'iva_panel = ' . json_encode($data) . ';'
		);
	
		wp_localize_script('jquery', 'iva_panel', $params);	
	
			if(is_singular( 'albums' ))
				{
				wp_enqueue_script('atp-jqurydownload', THEME_JS.'/jquerydownload.js','jquery','','in_footer');
				
				}
			wp_enqueue_script('jplayer.playlist', THEME_JS.'/jplayer.playlist.min.js',false,false,'all');
			if ( get_option( 'atp_audio_enable' ) == 'on' ) {
				wp_enqueue_script('atp-soundmanager2', THEME_JS.'/soundmanager2-nodebug-jsmin.js','jquery','','in_footer');
				wp_enqueue_script('atp-soundcloud', 'https://connect.soundcloud.com/sdk.js','jquery','','in_footer');
				wp_enqueue_script('atp-amplify', THEME_JS .'/amplify.min.js','jquery','','in_footer');
				wp_enqueue_script('atp-fullwidthAudioPlayer', THEME_JS .'/jquery.fullwidthAudioPlayer.min.js','jquery','','in_footer');
				wp_enqueue_style('fullwidthAudioPlayer', THEME_CSS.'/jquery.fullwidthAudioPlayer.css', false, false, 'all');
			}
			wp_localize_script( 'jquery', 'atp_panel', array(
				'SiteUrl' =>get_template_directory_uri()
			));
			
			//--------------------------------------------------------
			wp_register_style( 'responsive', THEME_CSS . '/responsive.css', array(), '1', 'all' ); 
	
			// E N Q U E U E   S T Y L E S 
			//--------------------------------------------------------
			wp_enqueue_style( 'musicplay-style', get_stylesheet_uri() );
			wp_enqueue_style('animate', THEME_CSS.'/animate.css', false, false, 'all');
			wp_enqueue_style('prettyphoto', THEME_CSS.'/prettyPhoto.css', false, false, 'all');
			wp_register_style( 'flexslider', THEME_CSS . '/flexslider.css', array(), '1', 'all' ); 
	
			wp_enqueue_style('jplayer.pink.flag', THEME_CSS.'/skin/premium-pixels/premium-pixels.css',false,false,'all');
		
			if( get_option('atp_responsive') != 'on') {
				wp_enqueue_style( 'responsive' );
			}
			wp_enqueue_style( 'datepicker', FRAMEWORK_URI.'admin/css/datepicker.css', false, false, 'all');
			wp_enqueue_style('flexslider');
			//wp_enqueue_style('fullwidthAudioPlayerresponsive', THEME_CSS.'/jquery.fullwidthAudioPlayer-responsive.css', false, false, 'all');
			if ( is_singular() ){
				wp_enqueue_script( 'comment-reply' );
			}
			if(get_option('atp_style') != '0'){
				$atp_style=get_option('atp_style');
				wp_enqueue_style('atp-style', THEME_URI.'/colors/'.$atp_style, false, false, 'all');
			}
		}  
		add_action( 'wp_enqueue_scripts','enqueue_scripts');
	}
	// E N Q U E U E   S C R I P T S   I N   A D M I N 
	//--------------------------------------------------------
	if(!function_exists('admin_enqueue_scripts')){
		function admin_enqueue_scripts(){
			wp_enqueue_script('theme-script',FRAMEWORK_URI . 'admin/js/script.js');
			wp_enqueue_script( 'wp-color-picker');
			wp_enqueue_script('theme-shortcode',FRAMEWORK_URI . 'admin/js/shortcode.js');
			wp_enqueue_script('jquery-ui-core');
			wp_enqueue_script('jquery-ui-datepicker');
			wp_enqueue_script('media-upload');
			wp_enqueue_script('thickbox');
			wp_enqueue_script('atp-chosen', FRAMEWORK_URI . 'admin/js/chosen.jquery.min.js');
	
			wp_localize_script( 'theme-script', 'atp_panel', array(
				'SiteUrl' =>get_template_directory_uri()
			));
			wp_enqueue_style('thickbox');
			wp_enqueue_style( 'wp-color-picker');
			wp_enqueue_style('atpadmin', FRAMEWORK_URI . 'admin/css/atpadminnew.css');
			wp_enqueue_style('appointment-style', FRAMEWORK_URI.'admin/css/datepicker.css', false, false, 'all');
			wp_enqueue_style( 'atp-chosen', FRAMEWORK_URI . 'admin/css/chosen.css', false, false, 'all' ); 
		}
		add_action( 'admin_enqueue_scripts', 'admin_enqueue_scripts' );
	}

	// Owl Carousel script and style
	//--------------------------------------------------------
	if(!function_exists('owl_carousel_scripts')){
		function owl_carousel_scripts() {
			wp_enqueue_style( 'atp-owl', THEME_CSS.'/owl.carousel.css', false, '1.24', 'all');
			wp_enqueue_script( 'atp-owl', THEME_JS . '/owl.carousel.min.js', array(), '1.0.0', true );
		}
	}
?>