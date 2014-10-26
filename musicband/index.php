<?php // E N Q U E U E   S C R I P T S   I N   A D M I N 
if(!class_exists('ATP_theme_musicband')){
	class ATP_theme_musicband extends ATP_Theme {
	
		function _construct() {
			add_action( 'after_setup_theme', array($this,'atp_theme_setup' ));
		}
		
		function atp_variable($type) {
		
			$iva_options = parent::atp_variable($type);
			
			switch($type) {
			
				case 'artists': // Get Artists Name/Slug
								$args = array(
									'posts_per_page'   => -1,
									'offset'           => 0,
									'category'         => '',
									'orderby'          => 'post_date',
									'order'            => 'DESC',
									'include'          => '',
									'exclude'          => '',
									'meta_key'         => '',
									'meta_value'       => '',
									'post_type'        => 'artists',
									'post_mime_type'   => '',
									'post_parent'      => '',
									'post_status'      => 'publish',
									'suppress_filters' => true 
								); 
							
								$atp_entries = get_posts($args);
								foreach ($atp_entries as $key => $entry) {
									$iva_options[$entry->ID] = $entry->post_title;
								}
								break;
					case 'album': // Get album Slug and Name
								$atp_entries = get_terms( 'genres', 'orderby=name&hide_empty=0' );
								foreach ( $atp_entries as $atpalbum ) {
									$iva_options[$atpalbum->slug] = $atpalbum->name;
									$album_ids[] = $atpalbum->slug;
								}
								break;
					case 'album_label': // Get album Slug and Name
								$atp_entries = get_terms( 'label', 'orderby=name&hide_empty=0' );
								foreach ( $atp_entries as $atpalbum ) {
									$iva_options[$atpalbum->slug] = $atpalbum->name;
									$album_ids[] = $atpalbum->slug;
								}
								break;
					case 'album_genres': // Get album Slug and Name
								$atp_entries = get_terms( 'genres', 'orderby=name&hide_empty=0' );
								foreach ( $atp_entries as $atpalbum ) {
									$iva_options[$atpalbum->slug] = $atpalbum->name;
									$album_ids[] = $atpalbum->slug;
								}
								break;	
					case 'gallery': // Get Gallery Slug and Name
							$atp_entries = get_terms( 'gallery_type', 'orderby=name&hide_empty=0' );
							foreach ( $atp_entries as $atpalbum ) {
								$iva_options[$atpalbum->slug] = $atpalbum->name;
								$album_ids[] = $atpalbum->slug;
							}
							break;
					case 'video': // Get Gallery Slug and Name
								$atp_entries = get_terms( 'video_type', 'orderby=name&hide_empty=0' );
								foreach ( $atp_entries as $atpvideo ) {
									$iva_options[$atpvideo->slug] = $atpvideo->name;
									$video_ids[] = $atpvideo->slug;
								}
								break;
					case 'artist_cat': // Get Events Slug and Name
								$atp_entries = get_terms( 'artist_cat','orderby=name&hide_empty=0' );
								if(is_array($atp_entries)){
									foreach ( $atp_entries as $atpArtist ) {
										$iva_options[$atpArtist->slug] = $atpArtist->name;
										$artist[] = $atpArtist->slug;
									}
							}
							break;
					case 'djmix': // Get Slider Slug and Name
								$atp_entries = get_terms( 'djmix_cat', 'orderby=name&hide_empty=0' );
								foreach ( $atp_entries as $atpDjmix ) {
									$iva_options[$atpDjmix->slug] = $atpDjmix->name;
									$djmix_ids[] = $atpDjmix->slug;
								}
								break;
				}
				return $iva_options;
			}
			function atp_theme_setup() {
				atp_theme_setup();
				load_theme_textdomain( 'musicplay', get_template_directory() . '/languages' );
			}
			
			function atp_post_types() {
					parent::atp_post_types();
					require_once( MUSIC_DIR . 'events/events.php');
					require_once( MUSIC_DIR . 'artists/artist.php');
					require_once( MUSIC_DIR . 'albums/album.php');
					require_once( MUSIC_DIR . 'video/video.php');
					require_once( MUSIC_DIR . 'gallery/gallery.php');
					require_once( MUSIC_DIR . 'djmix/djmix.php');
			}
			
			function atp_custom_meta() {
			
					parent::atp_custom_meta();
					
					require_once( MUSIC_DIR . 'events/events-meta.php');
					require_once( MUSIC_DIR . 'artists/artist-meta.php');
					require_once( MUSIC_DIR . 'albums/allbum-meta.php');
					require_once( MUSIC_DIR . 'video/video-meta.php');
					require_once( MUSIC_DIR . 'gallery/gallery-meta.php');
					require_once( MUSIC_DIR . 'djmix/djmix-meta.php');
			
			}
			
	}
	
	$atp_theme = new ATP_theme_musicband();
}	
$url =  FRAMEWORK_URI . 'admin/images/';
define( 'MUSIC_URI', get_template_directory_uri() . '/musicband/');
global $iva_options, $atp_options, $url, $shortname,$atp_theme ;

//POST TYPE LANG OPTIONS
//---------------------------------------------------------------------------
require_once( MUSIC_DIR . 'posttype_lang_options.php' );

//Localization Text
//---------------------------------------------------------------------------
function atp_localize($text="",$before="",$after=""){
	$output = $before.$text.$after;
	return $output;
}

//S I N G L E  P O S T T Y P E S
//---------------------------------------------------------------------------
function atp_single_posttypes() {
	global $wp_query, $post;  
	$customtype = $post->post_type;
	if(file_exists( MUSIC_DIR .$customtype.'/'. 'single-'.$customtype.'.php')){
		return MUSIC_DIR . $customtype.'/'. 'single-'.$customtype.'.php';
	}
	elseif(file_exists( THEME_DIR . '/single-'.$customtype.'.php')){
		return THEME_DIR . '/single-'.$customtype.'.php';
	}else{
		return THEME_DIR .'/single.php';
	}
}
add_filter('single_template', 'atp_single_posttypes');

//Retrieve path of taxonomy template in current or parent template. 
function atp_taxonomy_posttypes() 
{
 global $wp_query, $post;  
 $customtype = $post->post_type;
 $name = get_queried_object()->taxonomy;
 if(file_exists( MUSIC_DIR .$customtype.'/'. 'taxonomy-'.$name.'.php')){
  return MUSIC_DIR . $customtype.'/'. 'taxonomy-'.$name.'.php';
 }
 elseif(file_exists( THEME_DIR . '/taxonomy-'.$name.'.php')){
  return THEME_DIR . '/taxonomy-'.$name.'.php';
 }else{
  return THEME_DIR .'/archive.php';
 } 
}
add_filter('taxonomy_template', 'atp_taxonomy_posttypes');

// A D M I N  E N Q U E U E   S T Y L E S  A N D  S C R I P T S
//---------------------------------------------------------------------------
function admin_enqueue_custompostscripts(){
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-slider');
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-droppable');
	wp_enqueue_script('admin-timepickeraddon', MUSIC_URI . 'events/js/jquery-ui-timepicker-addon.js',false,false,'all');
	wp_enqueue_script('atp-custompost', MUSIC_URI . 'js/custompost.js', false,false,'all' ); 
	wp_enqueue_script('atp-button', MUSIC_URI . 'js/buttons.js', false,false,'all' );
	wp_enqueue_style('atp-jquery-timepicker-addon', MUSIC_URI . 'events/css/jquery-ui-timepicker-addon.css', false,false,'all' ); 
	wp_enqueue_style('atp-jquery-ui', MUSIC_URI . 'events/css/jquery-ui.css', false,false,'all' ); 
}
add_action( 'admin_enqueue_scripts', 'admin_enqueue_custompostscripts' );

// EVENTS
//------------------------------------------------------------------------
add_filter( 'custompost_themeoptions','atp_custompost_options' );
function atp_custompost_options( $iva_options ) 
{
	global $iva_options, $atp_options, $url, $shortname,$atp_theme;
	
	
	//------------------------------------------------------------------------------------------------
	$iva_options[] = array( 'name' => 'Music Settings', 'icon' => $url.'nav-icon.png', 'type' => 'heading' );
	//------------------------------------------------------------------------------------------------

		//---------------------------------------------------------------------------------------------------
			$iva_options[] = array( 'name'	=> 'Select search  Properties', 'desc' => '<h3>Search Properties</h3> Select  Pagination,Limit settings.', 'type' => 'subsection');
		//---------------------------------------------------------------------------------------------------
	

		$iva_options[] = array(
				'name'			=> 'Custom Search Enable/Disable',
				'desc'			=> 'Check this if you wish to Enable/Disable ( Default: Disable ).',
				'id'			=> $shortname.'_custom_search',
				'class'			=> '',
				'std'			=> 'disable',
				'options'		=> array('enable' => 'Enable','disable' => 'Disable'),
				'type'			=> 'radio',
		);
	
		$iva_options[] = array(
					'name'			=> 'Search Pagination',
					'desc'			=> 'Check this if you wish to display pagination in search results page',
					'id'			=> $shortname.'_search_pagination',
					'class'			=> 'search_pagination',
					'std'			=> '',
					'type'			=> 'checkbox',
					'inputsize'		=> '',
		);
	
		$iva_options[] = array(
					'name'			=> 'Albums Limit',
					'desc'			=> 'Type the limits for Albums you wish to limit on the search results page  (e.g: 3)',
					'id'			=> $shortname.'_search_album_limits',
					'class'			=> 'search_limits',
					'std'			=> '',
					'type'			=> 'text',
					'inputsize'		=> '',
		);
		
		$iva_options[] = array(
					'name'			=> 'Artists Limit',
					'desc'			=> 'Type the limits for Artists you wish to limit on the search results page  (e.g: 3)',
					'id'			=> $shortname.'_search_artist_limits',
					'class'			=> 'search_limits',
					'std'			=> '',
					'type'			=> 'text',
					'inputsize'		=> '',
		);
		
		$iva_options[] = array(
					'name'			=> 'Tracks Limit',
					'desc'			=> 'Type the limits for Tracks you wish to limit on the search results page  (e.g: 3)',
					'id'			=> $shortname.'_search_track_limits',
					'class'			=> 'search_limits',
					'std'			=> '',
					'type'			=> 'text',
					'inputsize'		=> '',
		);
	

		//---------------------------------------------------------------------------------------------------
					$iva_options[] = array( 'name'	=> 'Select Albums  Properties', 'desc' => '<h3>Albums Properties</h3> Select  Pagination,Limit,Orderby and Order settings.', 'type' => 'subsection');
		//---------------------------------------------------------------------------------------------------
		

		$iva_options[] = array(	'name' => 'Add Playlist Button',
								'desc' => 'Check this if you wish to enable the Add To Playlist in player ( Default: Disabled ).',
								'id'   => $shortname.'_playlist_enable',
								'std'  => '',
								'type' => 'checkbox',
		);

		$iva_options[] = array(	'name'	=> 'Add Playlist Button Color',
								'desc'	=> 'Select the custom color for Add to Playlist Button appears in Albums Single page.',
								'id'	=> $shortname.'_playlist_btncolor',
								'std'	=> '', 
								'type'	=> 'color');

		$iva_options[] = array(	'name'	=> 'Post Likes Button',
								'desc'	=> 'Check this if you wish to disable the Post Likes Button on Albums Single page',
								'id'	=> $shortname.'_like_btn',
								'std'	=> '', 
								'type'	=> 'checkbox');

		$iva_options[] = array(	'name'	=> 'Post Likes Button Color',
								'desc'	=> 'Select the custom color for Post Likes Button appears in Albums Single page.',
								'id'	=> $shortname.'_like_btncolor',
								'std'	=> '', 
								'type'	=> 'color');
		/**
		 * Albums
		 * ------------------------
		 */
		
		$iva_options[] = array(
					'name'			=> 'Album Pagination',
					'desc'			=> 'Check this if you wish to display pagination in Albums page template',
					'id'			=> $shortname.'_audio_pagination',
					'class'			=> 'audio_pagination',
					'std'			=> '',
					'type'			=> 'checkbox',
					'inputsize'		=> '',
		);
	
		$iva_options[] = array(
					'name'			=> 'Albums Limit',
					'desc'			=> 'Type the limits for Albums you wish to limit on the page  (e.g: 5)',
					'id'			=> $shortname.'_audio_limits',
					'class'			=> 'audio_limits',
					'std'			=> '',
					'type'			=> 'text',
					'inputsize'		=> '',
		);
		$iva_options[] = array(
				'name'			=> 'Album Orderby',
				'desc'			=> 'Select the orderby  which you want to use  Id ,title,date or menu order in Albums page template',
				'id'			=> $shortname.'_album_orderby',
				'class'			=> 'album_orderby',
				'std'			=> '',
				'type'			=> 'select',
				'class'			=> 'select300',
				'inputsize'		=> '',
				'options'		=> array( 
										'ID' 					=> 'ID',
										'title'					=> 'Title',
										'audio_release_date' 	=> 'Audio Release Date',
										'menu_order'			=> 'Menu Order'
									),
		);
		$iva_options[] = array(
				'name'			=> 'Album Order',
				'desc'			=> 'Select the order which you wish to display in Albums Page Template',
				'id'			=> $shortname.'_album_order',
				'class'			=> 'album_order',
				'std'			=> 'ASC',
				'type'			=> 'radio',
				'inputsize'		=> '',
				'options'		=> array( 
										'ASC' 			=> 'Ascending',
										'DSC'			=> 'Descending'
									),

		);
	
		

			$iva_options[] = array(
				'name'			=> 'Lyrics Lightbox/Toggle',
				'desc'			=> 'Check this if you wish to Lightbox/Toggle ( Default: Lightbox ).',
				'id'			=> $shortname.'_lyrics_option',
				'class'			=> '',
				'std'			=> 'lightbox',
				'options'		=> array('lightbox' => 'Lightbox','toggle' => 'Toggle'),
				'type'			=> 'radio',
		);

		$iva_options[] = array(
				'name'			=> 'Comments Enable/Disable',
				'desc'			=> 'Check this if you wish to Enable/Disable ( Default: Disable ).',
				'id'			=> $shortname.'_album_comments',
				'class'			=> '',
				'std'			=> 'disable',
				'options'		=> array('enable' => 'Enable','disable' => 'Disable'),
				'type'			=> 'radio',
		);
	
		//---------------------------------------------------------------------------------------------------
		$iva_options[] = array( 'name'	=> 'Select Artist Properties', 'desc' => '<h3>Artist Properties</h3> Select  Pagination,Limit,Orderby and Order settings ', 'type' => 'subsection');
		//---------------------------------------------------------------------------------------------------
				
	/**
	 * Artist
	 * ------------------------
	 */
	$iva_options[] = array(
				'name'			=> 'Artists Pagination',
				'desc'			=> 'Check this if you wish to display pagination in Artists page template',
				'id'			=> $shortname.'_artist_pagination',
				'class'			=> 'artist_pagination',
				'std'			=> '',
				'type'			=> 'checkbox',
				'inputsize'		=> '',
	);

	$iva_options[] = array(
				'name'			=> 'Artists Limit',
				'desc'			=> 'Type the limits for Artits you wish to limit on the page  (e.g: 5)',
				'id'			=> $shortname.'_artist_limits',
				'class'			=> 'artist_limits',
				'std'			=> '',
				'type'			=> 'text',
				'inputsize'		=> '',
				
	);
	$iva_options[] = array(
				'name'			=> 'Artist Orderby',
				'desc'			=> 'Select the orderby  which you want to use  Id ,title,date or menu order in Artist page template',
				'id'			=> $shortname.'_artist_orderby',
				'class'			=> 'artist_orderby',
				'std'			=> '',
				'class'			=> 'select300',
				'type'			=> 'select',
				'inputsize'		=> '',
				'options'		=> array( 
										'ID' 			=> 'ID',
										'title'			=> 'Title',
										'date' 			=> 'Date',
										'menu_order'	=> 'Menu Order'
									),
	);
	$iva_options[] = array(
				'name'			=> 'Artist Order',
				'desc'			=> 'Select the order which you wish to display in Artists Page Template',
				'id'			=> $shortname.'_artist_order',
				'class'			=> 'artist_order',
				'std'			=> 'ASC',
				'type'			=> 'radio',
				'inputsize'		=> '',
				'options'		=> array( 
										'ASC' 			=> 'Ascending',
										'DSC'			=> 'Descending'
									),
	);


	$iva_options[] = array(
				'name'			=> 'Comments Enable/Disable',
				'desc'			=> 'Check this if you wish to Enable/Disable ( Default: Disable ).',
				'id'			=> $shortname.'_artist_comments',
				'class'			=> '',
				'std'			=> 'disable',
				'options'		=> array('enable' => 'Enable','disable' => 'Disable'),
				'type'			=> 'radio',
	);
	
	//---------------------------------------------------------------------------------------------------
	$iva_options[] = array( 'name'	=> 'Select Djmix Properties', 'desc' => '<h3>Djmix Properties</h3> Select  Pagination,Limit,Orderby and Order settings ', 'type' => 'subsection');
	//---------------------------------------------------------------------------------------------------
	
	/**
	 * DjMix
	 * ------------------------
	 */

	$iva_options[] = array(
				'name'			=> 'DJMix Pagination',
				'desc'			=> 'Check this if you wish to display pagination in DJMix page template',
				'id'			=> $shortname.'_djmix_pagination',
				'class'			=> 'djmix_pagination',
				'std'			=> '',
				'type'			=> 'checkbox',
				'inputsize'		=> '',
	);
	$iva_options[] = array(
				'name'			=> 'DJMix Limit',
				'desc'			=> 'Type the limits for DJMix you wish to limit on the page  (e.g: 5)',
				'id'			=> $shortname.'_djmix_limits',
				'class'			=> 'djmix_limits',
				'std'			=> '',
				'type'			=> 'text',
				'inputsize'		=> '',
				
	);
	$iva_options[] = array(
				'name'			=> 'Djmix Orderby',
				'desc'			=> 'Select the orderby  which you want to use  Id ,title,date or menu order in Djmix page template',
				'id'			=> $shortname.'_djmix_orderby',
				'class'			=> 'djmix_orderby',
				'std'			=> '',
				'class'			=> 'select300',
				'type'			=> 'select',
				'inputsize'		=> '',
				'options'		=> array( 
										'ID' 			=> 'ID',
										'title'			=> 'Title',
										'date' 			=> 'Date',
										'menu_order'	=> 'Menu Order'
									),
	);

	$iva_options[] = array(
				'name'			=> 'Djmix Order',
				'desc'			=> 'Select the order which you wish to display in DJMix Page Template',
				'id'			=> $shortname.'_djmix_order',
				'class'			=> '',
				'std'			=> 'ASC',
				'type'			=> 'radio',
				'inputsize'		=> '',
				'options'		=> array( 
										'ASC' 			=> 'Ascending',
										'DSC'			=> 'Descending'
									),
	);

	//---------------------------------------------------------------------------------------------------
	$iva_options[] = array( 'name'	=> 'Select Events Properties', 'desc' => '<h3>Events Properties</h3> Select  Pagination,Limit,Orderby and Order settings ', 'type' => 'subsection');
	//---------------------------------------------------------------------------------------------------
	
	/**
	 * Events
	 * ------------------------
	 */

	$iva_options[] = array(
			'name'		=> 'Time Format',
			'desc'		=> __('Select time format which appears at the admin events meta and front page','ATP_ADMIN_SITE'),
			'id'		=> $shortname.'_timeformat',
			'std'		=> '',
			'type'		=> 'select',
			'class'		=> 'select300',
			'inputsize'	=> '',
			'options' 	=> array( '12' => '12 Hours', '24' => '24 Hours' )
	);

	$iva_options[] = array(
				'name'			=> 'Events Pagination',
				'desc'			=> 'Check this if you wish to display pagination in Artists page template',
				'id'			=> $shortname.'_event_pagination',
				'class'			=> 'event_pagination',
				'std'			=> '',
				'type'			=> 'checkbox',
				'inputsize'		=> '',
	);

	$iva_options[] = array(
				'name'			=> 'Events Limit',
				'desc'			=> 'Type the limits for Artits you wish to limit on the page  (e.g: 5)',
				'id'			=> $shortname.'_event_limits',
				'class'			=> 'event_limits',
				'std'			=> '',
				'type'			=> 'text',
				'inputsize'		=> '',
				
	);
	$iva_options[] = array(
				'name'			=> 'Comments Enable/Disable',
				'desc'			=> 'Check this if you wish to Enable/Disable ( Default: Disable ).',
				'id'			=> $shortname.'_events_comments',
				'class'			=> '',
				'std'			=> 'disable',
				'options'		=> array('enable' => 'Enable','disable' => 'Disable'),
				'type'			=> 'radio',
	);
	
	//---------------------------------------------------------------------------------------------------
	$iva_options[] = array( 'name'	=> 'Select Gallery Properties', 'desc' => '<h3>Gallery Properties</h3> Select  Pagination,Limit,Orderby and Order settings ', 'type' => 'subsection');
	//---------------------------------------------------------------------------------------------------
	
	/**
	 * Gallery
	 * ------------------------
	 */

	$iva_options[] = array(
				'name'			=> 'Gallery Pagination',
				'desc'			=> 'Check this if you wish to display pagination in Gallery page template',
				'id'			=> $shortname.'_gallery_pagination',
				'class'			=> 'gallery_pagination',
				'std'			=> '',
				'type'			=> 'checkbox',
				'inputsize'		=> '',
	);
	$iva_options[] = array(
				'name'			=> 'Galleries Limit',
				'desc'			=> 'Type the limits for Gallery you wish to limit on the page  (e.g: 5)',
				'id'			=> $shortname.'_gallery_limits',
				'class'			=> 'gallery_limits',
				'std'			=> '',
				'type'			=> 'text',
				'inputsize'		=> '',
	);
	$iva_options[] = array(
				'name'			=> 'Gallery Orderby',
				'desc'			=> 'Select the orderby  which you want to use  Id ,title,date or menu order in Gallery page template',
				'id'			=> $shortname.'_gallery_orderby',
				'class'			=> 'gallery_orderby',
				'std'			=> '',
				'type'			=> 'select',
				'class'			=> 'select300',
				'inputsize'		=> '',
				'options'		=> array( 
										'ID' 			=> 'ID',
										'title'			=> 'Title',
										'date' 			=> 'Date',
										'menu_order'	=> 'Menu Order'
									),
	);
	$iva_options[] = array(
				'name'			=> 'Gallery Order',
				'desc'			=> 'Select the order which you wish to display in Gallery Page Template',
				'id'			=> $shortname.'_gallery_order',
				'class'			=> 'gallery_order',
				'std'			=> 'ASC',
				'type'			=> 'radio',
				'inputsize'		=> '',
				'options'		=> array( 
										'ASC' 			=> 'Ascending',
										'DSC'			=> 'Descending'
									),
	);
	$iva_options[] = array(
				'name'			=> 'Comments Enable/Disable',
				'desc'			=> 'Check this if you wish to Enable/Disable ( Default: Disable ).',
				'id'			=> $shortname.'_gallery_comments',
				'class'			=> '',
				'std'			=> 'disable',
				'options'		=> array('enable' => 'Enable','disable' => 'Disable'),
				'type'			=> 'radio',
	);
	$iva_options[] = array(
				'name'			=> 'Single page Galleries Limit',
				'desc'			=> 'Type the limits for Gallery you wish to limit on the page  (e.g: 5)',
				'id'			=> $shortname.'_single_gallery_limits',
				'class'			=> 'gallery_limits',
				'std'			=> '',
				'type'			=> 'text',
				'inputsize'		=> '',
	);
	$iva_options[] = array(
				'name'			=> 'Single Page Gallery Pagination',
				'desc'			=> 'Check this if you wish to display pagination in Gallery page template',
				'id'			=> $shortname.'_single_gallery_pagination',
				'class'			=> 'gallery_pagination',
				'std'			=> '',
				'type'			=> 'checkbox',
				'inputsize'		=> '',
	);
	//---------------------------------------------------------------------------------------------------
		$iva_options[] = array( 'name'	=> 'Select Video Properties', 'desc' => '<h3>Video Properties</h3> Select  Pagination,Limit,Orderby and Order settings ', 'type' => 'subsection');
	//---------------------------------------------------------------------------------------------------


	/**
	 * Video
	 * ------------------------
	 */

	$iva_options[] = array(
				'name'			=> 'Video Pagination',
				'desc'			=> 'Check this if you wish to display pagination in Video page template',
				'id'			=> $shortname.'_video_pagination',
				'class'			=> 'video_pagination',
				'std'			=> '',
				'type'			=> 'checkbox',
				'inputsize'		=> '',
	);

	$iva_options[] = array(
				'name'			=> 'Video Limits',
				'desc'			=> 'Type the limits for Videos you wish to limit on the page  (e.g: 5)',
				'id'			=> $shortname.'_video_limits',
				'class'			=> 'video_limits',
				'std'			=> '',
				'type'			=> 'text',
				'inputsize'		=> '',
				
	);
	$iva_options[] = array(
				'name'			=> 'Video Orderby',
				'desc'			=> 'Select the orderby  which you want to use  Id ,title,date or menu order in Video page template',
				'id'			=> $shortname.'_video_orderby',
				'class'			=> 'video_orderby',
				'std'			=> '',
				'type'			=> 'select',
				'class'			=> 'select300',
				'inputsize'		=> '',
				'options'		=> array( 
										'ID' 			=> 'ID',
										'title'			=> 'Title',
										'date' 			=> 'Date',
										'menu_order'	=> 'Menu Order'
									),
	);
	$iva_options[] = array(
				'name'			=> 'Video Order',
				'desc'			=> 'Select the order which you wish to display in Video Page Template',
				'id'			=> $shortname.'_video_order',
				'class'			=> 'video_order',
				'std'			=> 'ASC',
				'type'			=> 'radio',
				'inputsize'		=> '',
				'options'		=> array( 
										'ASC' 			=> 'Ascending',
										'DSC'			=> 'Descending'
									),
	);
	$iva_options[] = array(
				'name'			=> 'Comments Enable/Disable',
				'desc'			=> 'Check this if you wish to Enable/Disable ( Default: Disable ).',
				'id'			=> $shortname.'_video_comments',
				'class'			=> '',
				'std'			=> 'disable',
				'options'		=> array('enable' => 'Enable','disable' => 'Disable'),
				'type'			=> 'radio',
	);
	//Music Player
	//------------------------------------------------------------------------
	$iva_options[] = array( 'name' => 'Player Options', 'icon' => $url.'music-icon.png', 'type' => 'heading' );
	//------------------------------------------------------------------------------------------------

	

	$iva_options[] = array(
				'name'			=> 'Audio Enable/Disable',
				'desc'			=> 'Check this if you wish to enable the Audio Player in the footer ( Default: Disabled ).',
				'id'			=> $shortname.'_audio_enable',
				'class'			=> 'audio_visible',
				'std'			=> '',
				'type'			=> 'checkbox',
	);




	$iva_options[] = array(
				'name'			=> 'Audio Player Toggle',
				'desc'			=> 'Check this if you wish the enable the toggle option for the Audio Player in bottom',
				'id'			=> $shortname.'_audio_visible',
				'class'			=> 'audio_visible',
				'std'			=> '',
				'type'			=> 'checkbox',
				
	);

	$iva_options[] = array(
				'name'			=> 'Audio Autoplay',
				'desc'			=> 'Check this if you wish to Play the audio automatically after the page is loaded.',
				'id'			=> $shortname.'_audio_autoplay',
				'class'			=> 'audio_autoplay',
				'std'			=> '',
				'type'			=> 'checkbox'
	);

	$iva_options[] = array(
				'name'			=> 'Audio Player Volume',
				'desc'			=> 'Select Audio Player Volume ( Default: 50% ).',
				'id'			=> $shortname.'_playlist_volume',
				'std'			=> '0.5',
				'class'			=> 'select300',
				'options'		=> array(	'0.1'=>'10%',
											'0.2'=>'20%',
											'0.3'=>'30%',
											'0.4'=>'40%',
											'0.5'=>'50%',
											'0.6'=>'60%',
											'0.7'=>'70%',
											'0.8'=>'80%',
											'0.9'=>'90%',
											'1'=>'100%'
									),
				'type'			=> 'select',
		);
	$iva_options[] = array(
				'name'			=> 'Play Next',
				'desc'			=> 'Check this if you wish to play next song and loop in the Audio Player.',
				'id'			=> $shortname.'_audio_player_next',
				'class'			=> 'audio_player_next',
				'std'			=> '',
				'type'			=> 'checkbox'
	);
	
		$iva_options[] = array(
				'name'			=> 'Enable  Pop-up player Button',
				'desc'			=> 'Check this if you wish to Enable a pop-up player button the Audio Player.',
				'id'			=> $shortname.'_popup_player_button',
				'std'			=> '',
				'type'			=> 'checkbox'
	);

	$iva_options[] = array( 'name'	=> 'Player Type',
						'desc'	=> 'Select how you wish to populate the sticky player in the footer with Radio, Albums or DJMix. If selected as radio the radio settings will be there in the bottom and if Albums Selected the Album Page ID should be added and same for the DJMixes as well',
						'id'	=> $shortname.'_audio_player',
						'std'	=> '',
						'class'	=> 'select300',
						'options' => array( 
										'album'   => 'Album',
										'djmix'   => 'Djmix',
										'radio'	=> 'Radio'  ),
						'type'	=> 'select');

	$iva_options[] = array(
				'name'			=> 'Album Page ID',
				'desc'			=> 'Type the album ID(s) comma separated if more than 1 Album ID to hold the audios to play in Audio Player',
				'id'			=> $shortname.'_audio_page_id',
				'class'			=> 'audio_player album',
				'std'			=> '',
				'type'			=> 'text',
				'inputsize'		=> '',
	);
	$iva_options[] = array(
				'name'			=> 'Djmix Page ID',
				'desc'			=> 'Type the DJMix ID(s) comma separated if more than 1 DJmix ID to hold the audios to play in Audio Player',
				'id'			=> $shortname.'_djmix_page_id',
				'class'			=> 'audio_player djmix',
				'std'			=> '',
				'type'			=> 'text',
				'inputsize'		=> '',
	);
	
	$iva_options[] = array(
				'name'			=> 'Radio Streaming IP',
				'desc'			=> 'Type the Streaming IP/Domain to play Radio Player.',
				'id'			=> $shortname.'_radiostream_id',
				'class'			=> 'audio_player radio',
				'std'			=> '',
				'type'			=> 'text',
				'inputsize'		=> '',
	);
	$iva_options[] = array(
				'name'			=> 'Radio Enable/Disable',
				'desc'			=> 'Check this if you wish to enable the Audio Player in the footer ( Default: Disabled ).',
				'id'			=> $shortname.'_radio_enable',
				'class'			=> 'audio_player radio',
				'std'			=> '',
				'type'			=> 'checkbox',
	);

	$iva_options[] = array(
				'name'			=> 'Radio AutoPlay',
				'desc'			=> 'Check this if you wish to Play the audio automatically after the page is loaded.',
				'id'			=> $shortname.'_radio_autoplay',
				'class'			=> 'audio_player radio',
				'std'			=> '',
				'type'			=> 'checkbox'
	);
	$iva_options[] = array(
				'name'			=> 'Radio Player Title',
				'desc'			=> 'Type the Title for the Radio Player',
				'id'			=> $shortname.'_radio_title',
				'class'			=> 'audio_player radio',
				'std'			=> '',
				'type'			=> 'text',
				'inputsize'		=> '',
	);
	$iva_options[] = array(
				'name'			=> 'Radio Player Information',
				'desc'			=> 'Type the short summary for the Radio Player which will be displayed below the Radio Player Title.',
				'id'			=> $shortname.'_radio_desc',
				'class'			=> 'audio_player radio',
				'std'			=> '',
				'type'			=> 'text',
				'inputsize'		=> '',
	);

	$iva_options[] = array(	'name'	=> 'Player Background',
						'desc'	=> 'Background color for the Sticky Player',
						'id'	=> $shortname.'_playerBG',
						'std'	=> '', 
						'type'	=> 'color');

	$iva_options[] = array(	'name'	=> 'Player Border',
						'desc'	=> 'Border color for the Sticky Player',
						'id'	=> $shortname.'_playerBr',
						'std'	=> '', 
						'type'	=> 'color');

	$iva_options[] = array(	'name'	=> 'Player Buttons',
						'desc'	=> 'Buttons color for the Sticky Player',
						'id'	=> $shortname.'_playerBtnBG',
						'std'	=> '', 
						'type'	=> 'color');

	$iva_options[] = array(	'name'	=> 'Player Title',
						'desc'	=> 'Title color for the Sticky Player',
						'id'	=> $shortname.'_playerTitle',
						'std'	=> '', 
						'type'	=> 'color');
	
	$iva_options[] = array(	'name'	=> 'Player Volume Bar',
						'desc'	=> 'Volume Bar color for the Sticky Player',
						'id'	=> $shortname.'_playerVolBG',
						'std'	=> '', 
						'type'	=> 'color');

	$iva_options[] = array(	'name'	=> 'Player Meta Colors',
						'desc'	=> 'Player Meta Data, Switcher x mark, Player Timing text, color for the Sticky Player',
						'id'	=> $shortname.'_playerMeta',
						'std'	=> '', 
						'type'	=> 'color');

	
	//Shareing Options
	//------------------------------------------------------------------------
	$iva_options[] = array( 'name' => 'Sharing', 'icon' => $url.'link-icon.png', 'type' => 'heading' );
	//------------------------------------------------------------------------------------------------
	$iva_options[] = array(
				'name'			=> 'Google+',
				'desc'			=> 'Check this to enable Google+ Icon for Post Sharing',
				'id'			=> $shortname.'_google_enable',
				'std'			=> '',
				'type'			=> 'checkbox',
				
	);
	$iva_options[] = array(
				'name'			=> 'LinkedIn',
				'desc'			=> 'Check this to enable LinkedIn Icon for Post Sharing',
				'id'			=> $shortname.'_linkedIn_enable',
				'std'			=> '',
				'type'			=> 'checkbox',
				
	);
	$iva_options[] = array(
				'name'			=> 'Digg',
				'desc'			=> 'Check this to enable Digg Icon for Post Sharing',
				'id'			=> $shortname.'_digg_enable',
				'std'			=> '',
				'type'			=> 'checkbox',
				
	);
	$iva_options[] = array(
				'name'			=> 'StumbleUpon',
				'desc'			=> 'Check this to enable StumbleUpon Icon for Post Sharing',
				'id'			=> $shortname.'_stumbleupon_enable',
				'std'			=> '',
				'type'			=> 'checkbox',
				
	);
	$iva_options[] = array(
				'name'			=> 'Pinterest',
				'desc'			=> 'Check this to enable Pinterest Icon for Post Sharing',
				'id'			=> $shortname.'_pinterest_enable',
				'class'			=> 'pinterest_sharing',
				'std'			=> '',
				'type'			=> 'checkbox',
				
	);
	$iva_options[] = array(
				'name'			=> 'Twitter',
				'desc'			=> 'Check this to enable Twitter Icon for Post Sharing',
				'id'			=> $shortname.'_twitter_enable',
				'std'			=> '',
				'type'			=> 'checkbox',
				
	);
	$iva_options[] = array(
				'name'			=> 'Facebook',
				'desc'			=> 'Check this to enable Facebook Icon for Post Sharing',
				'id'			=> $shortname.'_facebook_enable',
				'std'			=> '',
				'type'			=> 'checkbox',
				
	);


	return $iva_options;
}


//Custom Post types
//-------------------------------------------------

//Post Type Label Options
require_once( MUSIC_DIR . 'posttype_label_options.php' );

//Postype Meta Cases
require_once( MUSIC_DIR . 'meta_cases.php' );

//Follow Social Network for Artists
function follow_social_networks( $sociables ){
	$sociable_icon = array(
		'fa fa-facebook fa-fw fa-lg'	=> 'facebook',
		'fa fa-twitter fa-fw fa-lg'		=> 'twitter' ,
		'fa fa-google-plus fa-fw fa-lg'	=> 'plus.google',
		'fa fa-pinterest fa-fw fa-lg'	=> 'pinterest' ,
		'fa fa-youtube fa-fw fa-lg'		=> 'youtube' ,
		'fa fa-vimeo fa-fw fa-lg'		=> 'vimeo',
		'fa fa-flickr fa-fw fa-lg'		=> 'flickr' ,
		'fa fa-instagram fa-fw fa-lg'	=> 'instagram',
		'fa fa-soundcloud fa-fw fa-lg'	=> 'soundcloud',
		'fa fa-foursquare fa-fw fa-lg'	=> 'foursquare'
	);
	$output ='';
	$sociable_path = explode("\n",$sociables);
	$output .= '<div class="iva_follow">';
	$output .= '<ul class="follow">';

	foreach ( $sociable_path as $sociable_url ){
		$sociableurl 	= preg_replace("/http:\/\/www.||https:\/\/www.||https:\/\/||http:\/\/||www./", "" ,$sociable_url);
		$sociable_host 	= preg_split("/[\s.]+/",$sociableurl);
		$sociable_host_names =  $sociable_host[0];
		
		foreach ($sociable_icon as $key => $sociableicon){
			if( trim($sociableicon) === trim(strtolower($sociable_host_names))) {
				$sociable_url = trim($sociableurl);
				$output .= '<li class="'.$sociableicon.'"><a href="'.esc_url($sociable_url).'" target="_blank"><i class="'.$key.'"></i></a></li>';
			}
		}
	}
	$output .= '</ul>';
	$output .= '</div>';

	return $output;
}
?>