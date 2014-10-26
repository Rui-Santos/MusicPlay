<?php


	/* Get Options from Theme Options */
	$atp_style				= get_option('atp_style');
	$atp_readmoretxt		= get_option('atp_readmoretxt') ? get_option('atp_readmoretxt') : 'Read more';
	$atp_searchformtxt      = get_option('atp_searchformtxt') ? get_option('atp_searchformtxt') : 'Search';
	$atp_projectDesc		= get_option('atp_projectDesc',"") ? get_option('atp_projectDesc') : 'Project Description';
	
	$starttimetxt			= get_option('atp_starttime') ? get_option('atp_starttime') : 'Starts';
	$endtimetxt				= get_option('atp_endtime') ? get_option('atp_endtime') : 'Ends';
	$datetxt				= get_option('atp_date') ? get_option('atp_date') : 'Date';	
	$venuetxt				= get_option('atp_venue') ? get_option('atp_venue') : 'Venue';
	$locationtxt			= get_option('atp_location') ? get_option('atp_location') : 'Location';
	$projectdatetxt			= get_option('atp_project_date') ? get_option('atp_project_date') : 'Project Date:';
	$projecturltxt			= get_option('atp_project_url') ? get_option('atp_project_url') : 'Project Url:';
	$skillstxt				= get_option('atp_skills') ? get_option('atp_skills') : 'Skills:';
	$visitsitetxt			= get_option('atp_visitsitetxt') ? get_option('atp_visitsitetxt'):'Visit Site';
	$categoriestxt			= get_option('atp_category') ? get_option('atp_category') : 'Category:';
	$breadcrumb_separator	= get_option('atp_breadcrumbsep',"") ? get_option('atp_breadcrumbsep') : '';
	$atp_singlenavigation	= get_option('atp_singlenavigation' );
	$projectDetails			= get_option('atp_projectDetails',"") ? get_option('atp_projectDetails') : 'Project Details';
	$layout_option= get_option('atp_defaultlayout');
	// Corner Ribbons
	require_once( get_template_directory() . '/framework/includes/ribbons_array.php' );
	
	// Animation Effects Array
	$iva_anim = array(
		''  => 'Select Animation',
		'flash'		=>	'flash',
		'shake'		=>	'shake',
		'bounce'	=>	'bounce',
		'tada'		=>	'tada',
		'swing'		=>	'swing',
		'wobble'	=>	'wobble',
		'flip'		=>	'flip',
		'flipInX'	=>	'flipInX',
		'flipInY'	=>	'flipInY',
		'fadeIn'		=>	'fadeIn',
		'fadeInUp'		=>	'fadeInUp',
		'fadeInDown'	=>	'fadeInDown',
		'fadeInLeft'	=> 	'fadeInLeft',
		'fadeInRight'	=>	'fadeInRight',
		'slideInDown'	=>	'slideInDown',
		'slideInLeft'	=>	'slideInLeft',
		'slideInRight'	=>	'slideInRight',
		'bounceIn'		=>	'bounceIn', 
		'bounceInDown'	=>	'bounceInDown', 
		'bounceInUp' 	=>	'bounceInUp',
		'bounceInLeft'	=>	'bounceInLeft',
		'bounceInRight'	=>	'bounceInRight',
		'lightSpeedIn'	=>	'lightSpeedIn',
	);

	// Sociable Icons Array
	$staff_social = array(
		''				=> 'Select Sociable',
		'blogger'		=> 'Blogger',
		'delicious'		=> 'Delicious',
		'digg'			=> 'Digg',
		'facebook'		=> 'Facebook',
		'flickr'		=> 'Flickr',
		'forrst'		=> 'Forrst',
		'google'		=> 'Goolge',
		'linkedin'		=> 'Linkedin',
		'pinterest'		=> 'Pinterest',
		'skype'			=> 'Skype',
		'stumbleupon'	=> 'Stumbleupon',
		'twitter'		=> 'Twitter',
		'dribbble'		=> 'Dribbble',
		'yahoo'			=> 'Yahoo',
		'youtube'		=> 'Youtube'
	);
	ksort($staff_social); // Sort Sociabls by Alphabetical Order
	
	$default_date = get_option('date_format');
	switch($default_date){
		case 'F j, Y':
					$atp_defaultdate = 'MM d, yy';
					break;
		case 'Y/m/d':
					$atp_defaultdate = 'yy/mm/dd';
					break;
		case 'm/d/Y':
					$atp_defaultdate = 'mm/dd/yy';
					break;
		case 'd/m/Y':
					$atp_defaultdate = 'dd/mm/yy';
					break;
		case 'j F Y':
					$atp_defaultdate = 'd MM, yy';
					break;
	}

	// Theme Class
	if ( ! class_exists('ATP_Theme') ) {
		
		class ATP_Theme
		{
			public $theme_name;
			public $meta_box;
		
			public function __construct()
			{
				$this->atp_constant();
				$this->atp_themesupport();
				$this->atp_head();
				$this->atp_themepanel();
				$this->atp_widgets();
				$this->atp_post_types();
				$this->atp_custom_meta();
				$this->atp_meta_generators();
				$this->atp_shortcodes();
				$this->atp_common();
			}
			function atp_constant()
			{
				// Framework General Variables and directory paths
				$theme_data;
				if ( function_exists('wp_get_theme') ) {
					$theme_data = wp_get_theme();
					$themeversion = $theme_data->Version;
					$theme_name = $theme_data->Name;
				} else {
					$theme_data = (object) wp_get_theme(get_template_directory() . '/style.css');
					$themeversion = $theme_data->Version;
					$theme_name = $theme_data->Name;
				}
				/**
				 * Set the file path based on whether the Options 
				 * Framework is in a parent theme or child theme
				 * Directory Structure
				 */
				define( 'FRAMEWORK', '2.0' ); //  Theme Framework
				define( 'THEMENAME', $theme_name );
				define( 'THEMEVERSION', $themeversion );
				define( 'THEME_URI', get_template_directory_uri() );
				define( 'THEME_DIR', get_template_directory() );
				define( 'THEME_JS', THEME_URI . '/js' );
				define( 'THEME_CSS', THEME_URI . '/css' );
				define( 'FRAMEWORK_DIR', THEME_DIR. '/framework/' );
				define( 'FRAMEWORK_URI', THEME_URI. '/framework/' );
				define( 'CUSTOM_META', FRAMEWORK_DIR. '/custom-meta/' );
				define( 'CUSTOM_PLUGINS', FRAMEWORK_DIR. '/custom-plugins/' );
				define( 'CUSTOM_POST', FRAMEWORK_DIR. '/custom-post/' );
				
				define( 'THEME_SHORTCODES', FRAMEWORK_DIR . 'shortcode/' );
				define( 'THEME_WIDGETS', FRAMEWORK_DIR . 'widgets/' );
				define( 'THEME_PLUGINS', FRAMEWORK_DIR . 'plugins/' );
				define( 'THEME_POSTTYPE', FRAMEWORK_DIR .'custom-post/' );
				define( 'THEME_CUSTOMMETA', FRAMEWORK_DIR.'custom-meta/' );

				define( 'THEME_PATTDIR', THEME_URI. '/images/patterns/' );
			}

			/** 
			 * Allows a theme to register its support of a certain features
			 */
			function atp_themesupport() {
				add_theme_support( 'post-formats', array( 'aside', 'audio', 'link', 'image', 'gallery', 'quote', 'status', 'video' ) );
				add_theme_support( 'post-thumbnails' );
				add_theme_support( 'automatic-feed-links' );
				add_theme_support( 'editor-style' );
				add_theme_support( 'menus' );
				
				/* Register Menu */
				register_nav_menus( array(
					'primary-menu' => __( 'Primary Menu','ATP_ADMIN_SITE' )
				));

				/* Define Content Width */
				if ( ! isset( $content_width ) ) $content_width = 900;
			}

			/* Scripts and Styles Enqueue */
			function atp_head() {
				require_once( FRAMEWORK_DIR . 'common/head.php' );
			}

			/* Admin Interface */
			function atp_themepanel() {
				require_once( FRAMEWORK_DIR . 'common/atp_googlefont.php' );
				require_once( FRAMEWORK_DIR . 'admin/admin-interface.php' );
				require_once( FRAMEWORK_DIR . 'admin/theme-options.php' );

				if( isset( $_GET['page'] ) == 'advance' ) {
					require_once( FRAMEWORK_DIR . 'admin/advance-options.php' );
				}
			}

			/* Widgets */
			function atp_widgets() {
				$atp_widgts = array(
					'register_widget', 'contactinfo',
					'flickr', 'twitter', 'sociable',
					'popularpost','recentpost', 
					'testimonial', 'testimonials_submit',
					'music_album','music_artist',
					'music_gallery_photos',
					'music_video','music_gallery_post','events'
				);

				foreach( $atp_widgts as $widget ) {
					require_once( THEME_WIDGETS .$widget.'.php' );
				}
			}

			/**
			 * Load Custom Post Types Templates
			 * @files slider, events, testimonials, portfolio
			 */
			function atp_post_types() {
				require_once( THEME_POSTTYPE . '/slider.php' );
				require_once( THEME_POSTTYPE . '/testimonial.php' );
			}

			/** Load Meta Generator Templates
			 * @files Slider, Events, Menus, Testimonial, Page, Posts, Shortcodes Generator
			 */
			function atp_custom_meta() {
				require_once( THEME_CUSTOMMETA . '/page-meta.php' );
				require_once( THEME_CUSTOMMETA . '/post-meta.php' );
				require_once( THEME_CUSTOMMETA . '/slider-meta.php' );
				require_once( THEME_CUSTOMMETA . '/testimonial-meta.php' );	
			}
 
			function atp_meta_generators() {
			
				require_once( THEME_CUSTOMMETA . '/meta-generator.php' );
				require_once( THEME_CUSTOMMETA . '/shortcode-meta.php' );
				require_once( THEME_CUSTOMMETA . '/shortcode-generator.php' );
	
			}
			
			/* Shortcodes */
			function atp_shortcodes() {
				$atp_short = array(
					'accordion', 'boxes','buttons', 'contactinfo', 'flickr', 'general','image', 
					'layout', 'lightbox', 'messageboxes', 'flexslider', 'tabs_toggles', 
					'twitter', 'gmap', 'testimonial', 'sociable', 'videos', 'staff', 
					'progressbar', 'services', 'carousel_blog', 'progresscircle','music_album','music_artist','music_gallery',
					'music_video','music_event','music_djmix','popularposts','recentposts','blog','iva_carousel'
				);
				
				foreach( $atp_short as $short ) {
					require_once( THEME_SHORTCODES .$short.'.php' );
				}
			}

			/** 
			 * Theme Functions
			 * @uses skin generator
			 * @uses twitter class
			 * @uses pagination
			 * @uses sociables
			 * @uses Aqua imageresize // Credits : http://aquagraphite.com/
			 * @uses TGM plugin activation class
			 */
			function atp_common() {
				require_once( THEME_DIR . '/css/skin.php' );
				require_once( FRAMEWORK_DIR . 'common/class_twitter.php' );
				require_once( FRAMEWORK_DIR . 'common/atp_generator.php' );
				require_once( FRAMEWORK_DIR . 'common/pagination.php' );
				require_once( FRAMEWORK_DIR . 'common/sociables.php' );
				require_once( FRAMEWORK_DIR . 'common/postlike.php' );
				require_once( FRAMEWORK_DIR . 'includes/image_resize.php' );
				require_once( FRAMEWORK_DIR . 'includes/class-activation.php' );
			}

			/** 
			 * Custom Switch case for fetching
			 * posts, post-types, custom-taxonomies, tags
			 */

			function atp_variable( $type ) {

				$iva_terms = array();

				switch( $type ){
					case 'pages': // Get Page Titles
								$atp_entries = get_pages( 'sort_column=post_parent,menu_order' );
								foreach ( $atp_entries as $atpPage ) {
									$iva_terms[$atpPage->ID] = $atpPage->post_title;
								}
								break;
					case 'slider': // Get Slider Slug and Name
								$atp_entries = get_terms( 'slider_cat', 'orderby=name&hide_empty=0' );
								foreach ( $atp_entries as $atpSlider ) {
									$iva_terms[$atpSlider->slug] = $atpSlider->name;
									$slider_ids[] = $atpSlider->slug;
								}
								break;
					case 'posts': // Get Posts Slug and Name
								$atp_entries = get_categories( 'hide_empty=0' );
								foreach ( $atp_entries as $atpPosts ) {
									$iva_terms[$atpPosts->slug] = $atpPosts->name;
									$atp_posts_ids[] = $atpPosts->slug;
								}
								break;
					case 'categories':
								$atp_entries = get_categories('hide_empty=true');
								foreach ($atp_entries as $atp_posts) {
									$iva_terms[$atp_posts->term_id] = $atp_posts->name;
									$atp_posts_ids[] = $atp_posts->term_id;
								}
								break;
					case 'postlink': // Get Posts Slug and Name
								$atp_entries = get_posts( 'hide_empty=0');
								foreach ( $atp_entries as $atpPosts ) {
									$iva_terms[$atpPosts->ID] = $atpPosts->post_title;
									$atp_posts_ids[] = $atpPosts->slug;
								}
								break;
					case 'events': // Get Events Slug and Name
								$atp_entries = get_terms( 'events_cat','orderby=name&hide_empty=1' );
								if(is_array($atp_entries)){
									foreach ( $atp_entries as $atpEvents ) {
										$iva_terms[$atpEvents->slug] = $atpEvents->name;
										$eventsvalue_id[] = $atpEvents->slug;
									}
								}
								break;
					case 'testimonial': // Get Testimonial Slug and Name
								$atp_entries = get_terms( 'testimonial_cat', 'orderby=name&hide_empty=0' );
								foreach ( $atp_entries as $atpTestimonial ) {
									$iva_terms[$atpTestimonial->slug] = $atpTestimonial->name;
									$testimonialvalue_id[] = $atpTestimonial->slug;
								}
								break;
					case 'tags': // Get Taxonomy Tags
								$atp_entries = get_tags( array( 'taxonomy' => 'post_tag' ) );
								foreach ( $atp_entries as $atpTags ) {
									$iva_terms[$atpTags->slug] = $atpTags->name;
								}
								break;
					case 'slider_type': // Slider Arrays for Theme Options
								$iva_terms = array(
									''				=> 'Select Slider',
									'flexslider'	=> 'Flex Slider',
									'videoslider'	=> 'Single Video',
									'static_image'	=> 'Static Image',
									'customslider'	=> 'Custom Slider'
								);
								break;
				}
				
				return $iva_terms;
			}
		}
	}

	$shortname = 'atp';	
	/** section to decide whether use child theme or parent theme **/
	define( 'MUSIC_DIR', get_template_directory() . '/musicband/');
	if(!defined('MUS_DIR')){
		define( 'MUS_DIR', get_template_directory() . '/musicband/');
	}

	if(defined('MUS_DIR')) {
		require_once( MUS_DIR . 'index.php' );
		add_action( 'after_setup_theme', 'atp_theme_setup' );
	} else {
		$atp_theme = new ATP_Theme();	
		$url =  FRAMEWORK_URI . 'admin/images/';
		add_action( 'after_setup_theme', 'atp_theme_setup' );
	}

	
	/**
	 * Filters for pre process shortcodes and text domain
	 */
	if(!function_exists('atp_theme_setup')){
		function atp_theme_setup() {
			load_theme_textdomain( 'musicplay', get_template_directory() . '/languages' );
			load_theme_textdomain( 'ATP_ADMIN_SITE', get_template_directory() . '/languages' );
			add_filter( 'the_content', 'pre_process_shortcode');
			add_filter( 'widget_text', 'do_shortcode' );
			add_filter( 'posts_where', 'multi_tax_terms');
			add_filter( 'wp_trim_excerpt', 'new_excerpt_more' );
			add_filter( 'upload_mimes', 'atp_custom_upload_mimes');
		}
	}
	// Admin Login Logo
	if(!function_exists('atp_custom_login_logo')){
		function atp_custom_login_logo() {
			if ( get_option('atp_admin_logo') ) {
				echo '<style type="text/css">.login h1 a { background-image:url('.get_option('atp_admin_logo').') !important; background-size:auto auto; }</style>';
			}
		}
		add_action('login_head', 'atp_custom_login_logo');
	}

	if(!function_exists('pre_process_shortcode')){
		function pre_process_shortcode($content) {
			global $shortcode_tags;
			foreach ($shortcode_tags as $key => $value){
				 if( @stristr($value, 'iva_') ) {
					//$sys_shortcode_name = str_replace('atp_', '' ,$value);
					$shortcode[$key]=$key;
				}
			}
	
	
			$block = join("|",$shortcode);
			 
			// opening tag
			$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
			// closing tag
			$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
			 
			return $rep;
		}
	}
	/**
	 * Multiple taxonomies
	 */
	if(!function_exists('multi_tax_terms')){
		function multi_tax_terms($where) {
			global $wp_query, $wpdb;
			$term_ids = array();
			
			if (isset($wp_query->query_vars['term']) && (strpos($wp_query->query_vars['term'], ',') !== false && strpos($where, "AND 0") !== false)) {
				//Get the terms
				$term_arr = explode(",", $wp_query->query_vars['term']);
				foreach ($term_arr as $term_item) {
					$terms[] = get_terms($wp_query->query_vars['taxonomy'], array(
						'slug' => $term_item
					));
				} //$term_arr as $term_item
					
				//Get the id of posts with that term in that taxonomy
				if ($terms){
					foreach ($terms as $term) {
						if($term){
							$term_ids[] = $term[0]->term_id;
						}
					} //$terms as $term
				}
				$post_ids = get_objects_in_term($term_ids, $wp_query->query_vars['taxonomy']);
				
				if (!is_wp_error($post_ids) && count($post_ids)) {
					// Build the new query
					$new_where = " AND $wpdb->posts.ID IN (" . implode(', ', $post_ids) . ") ";
					$where = str_replace("AND 0", $new_where, $where);
				}
				
			} //$wp_query
			
			return $where;
		}
	}
	// Excerpt removes ...
	if(!function_exists('new_excerpt_more')){
		function new_excerpt_more( $excerpt ) {
			return str_replace( '[...]', '...', $excerpt );
		}
	}
	if(!function_exists('add_posttype_counts')){
		add_action('right_now_content_table_end', 'add_posttype_counts');
		function add_posttype_counts(){
			$posttype=array('albums' => 'Albums','artists' => 'Artists','djmix' => 'Djmix','events'=>'Events','video' =>'Video','gallery'=>'Gallery');
			foreach($posttype as $key => $value){
		
		        if (!post_type_exists($key)) {
		             return;
		        }
		
		        $num_posts = wp_count_posts($key);
		        $num = number_format_i18n( $num_posts->publish );
		        $text = _n( $value, $value, intval($num_posts->publish) );
		        if ( current_user_can( 'edit_posts' ) ) {
		            $num = "<a href='edit.php?post_type=$key'>$num</a>";
		            $text = "<a href='edit.php?post_type=$key'>$text</a>";
		        }
		        echo '<tr>';
		        echo '<td class="first b b-'.$key.'">' . $num . '</td>';
		        echo '<td class="t '.$key.'">' . $text . '</td>';
		        echo '</tr>';
			}
		
		}
	}
	//  Custom Upload file extension for @font-face
	if(!function_exists('atp_custom_upload_mimes')){
		function atp_custom_upload_mimes( $existing_mimes ){
			$existing_mimes['eot']  = 'font/eot';
			$existing_mimes['ttf']  = 'font/ttf';
			$existing_mimes['woff'] = 'font/woff';
			$existing_mimes['svg']  = 'font/svg';
			
			return $existing_mimes;
		}
	}

	/** 
	 * Adding our custom fields to the $form_fields array 
	 *  
	 * @param array $form_fields 
	 * @param object $post 
	 * @return array 
	 */ 
	if(!function_exists('atp_media_add_custom_fields')){
		function atp_media_add_custom_fields($form_fields, $post) {
	
		    $form_fields["buy"] = array(
		        "label" => __("Buy Link", "musicplay"),
		        "input" => "text",
		        "value" => get_post_meta($post->ID, "buy", true),
		        "helps" => __("Enter the buy link for this song if you wish.", "musicplay"),
		    );
			$form_fields["download"] = array(
		        "label" => __("Download Link", "musicplay"),
		        "input" => "text",
		        "value" => get_post_meta($post->ID, "download", true),
		        "helps" => __("Enter the download link for this song if you wish.", "musicplay"),
		    );
		    return $form_fields;
			
		}
		add_filter("attachment_fields_to_edit", "atp_media_add_custom_fields", null, 2);
	}
	if ( ! function_exists( 'get_attachment_id_from_src' ) ) {
		 function get_attachment_id_from_src ($image_src) {

			global $wpdb;
			$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
			$id = $wpdb->get_var($query);
			return $id;

		}
	}
	/* Save custom field value */
	if ( ! function_exists( 'atp_media_save_custom_fields' ) ) {
		function atp_media_save_custom_fields($post, $attachment) {
		
		    if(isset($attachment['buy'])) {
		        update_post_meta($post['ID'], 'buy', $attachment['buy']);
		    } else {
		        delete_post_meta($post['ID'], 'buy');
		    }
			 if(isset($attachment['download'])) {
		        update_post_meta($post['ID'], 'download', $attachment['download']);
		    } else {
		        delete_post_meta($post['ID'], 'download');
		    }
		    return $post;
		}
		add_filter("attachment_fields_to_save", "atp_media_save_custom_fields", null , 2);
	}
	/***
	 * code that executes when theme is being activated
	 */
	if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' && get_option( 'atp_default_template_option_values','defaultoptionsnotexists' ) == 'defaultoptionsnotexists' ){
		$default_option_values = '';
		//add default values for the theme options
		add_option( 'atp_default_template_option_values', $default_option_values, '', 'yes' );
		atp_options();
		update_option_values( $iva_options,unserialize( base64_decode( $default_option_values ) ) );
	}
	
	$option_posts_per_page = get_option( 'posts_per_page' );
	if ( ! function_exists( 'iva_modify_posts_per_page' ) ) {
		//add_action( 'init', 'iva_modify_posts_per_page', 0);
		function iva_modify_posts_per_page() {
		   add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
		}
	}
	if ( ! function_exists( 'my_option_posts_per_page' ) ) {
		function my_option_posts_per_page( $value ) {
		    global $option_posts_per_page;
		    if ( is_tax( 'artist_cat') || is_tax( 'genre') || is_tax( 'label') || is_tax( 'events_cat') ) {
		        return 4;
		    } else {
		        return $option_posts_per_page;
		    }
		}
	}
function fb_ogg_metadata() {
  if (is_single()) {
	global $post;
	$post_var = get_post($post->ID);		      	
		        $raw_content = $post_var->post_content;	
		        if( $post_var->post_content != "" ):
		        	if( $post_var->post_excerpt != "" ):
		        		$fbcontent = wp_trim_words( strip_shortcodes( strip_tags( $post_var->post_excerpt ) ) );
		        	else:
		        		//$content = strip_tags( strip_shortcodes( $post_var->post_content ) ) . "asds";	
		        		$fbcontent = wp_trim_words( strip_shortcodes( strip_tags( $post_var->post_content ) ) );
		        	endif;
		        else:      
				$fbcontent = wp_trim_words( strip_shortcodes( strip_tags( $post_var->post_content ) ) );			
			endif;
    ?>
    	<!-- Open Graph Meta Tags for Facebook and LinkedIn Sharing !-->
		<meta property="fb:app_id" content="1531092043769781" />
		<meta property="og:title" content="<?php the_title(); ?>"/>
		<meta property="og:description" content="<?php echo $fbcontent; ?>" />
		<meta property="og:url" content="<?php the_permalink(); ?>"/>
		<?php $fb_image = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'thumbnail'); ?>
		<?php if ($fb_image) : ?>
			<meta property="og:image" content="<?php echo $fb_image[0]; ?>" />
			<link rel="image_src" href="<?php echo $fb_image[0]; ?>" />
			<?php endif; ?>
		<meta property="og:type" content="<?php if (is_single() || is_page()) { echo "article"; } else { echo "website";} ?>" />
		<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
		<!-- End Open Graph Meta Tags !-->
    <?php
  }
}
if ( get_option('atp_facebook_enable') == 'on' ){  add_action('wp_head', 'fb_ogg_metadata'); }
?>