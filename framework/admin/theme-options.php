<?php
add_action('init','atp_options');
// Get theme version from style.css
	if (!function_exists('atp_options')) {
		$iva_options = array();
		function atp_options(){
		global $iva_options, $atp_options, $url, $shortname,$atp_theme ;
			//More Options
			$uploads_arr = wp_upload_dir();
			$all_uploads_path = $uploads_arr['path'];
			$all_uploads = get_option('atp_uploads');
			$easeing_options = array(
				'linear'	 		=>	'linear',
				'swing'				=>	'swing',
				'jswing'	 		=>	'jswing',
				'easeInQuad' 		=>	'easeInQuad',
				'easeInCubic'		=>	'easeInCubic',
				'easeInQuart'   	=> 	'easeInQuart',
				'easeInQuint'   	=>  'easeInQuint',
				'easeInSine' 		=>	'easeInSine',
				'easeInExpo' 		=> 	'easeInExpo',
				'easeInCirc' 		=>	'easeInCirc',
				'easeInElastic' 	=>	'easeInElastic',
				'easeInBack' 		=>	'easeInBack',
				'easeInBounce'		=>	'easeInBounce',
				'easeOutQuad' 		=>	'easeOutQuad',
				'easeOutCubic' 		=>	'easeOutCubic',
				'easeOutQuart' 		=>	'easeOutQuart',
				'easeOutQuint' 		=>	'easeOutQuint',
				'easeOutSine' 		=>	'easeOutSine',
				'easeOutExpo' 		=>	'easeOutExpo',
				'easeOutCirc' 		=>	'easeOutCirc',
				'easeOutElastic'	=>  'easeOutElastic',
				'easeOutBounce' 	=>  'easeOutBounce',
				'easeInOutQuad' 	=>  'easeInOutQuad',
				'easeInOutCubic'	=>  'easeInOutCubic',
				'easeInOutQuart'	=>  'easeInOutQuart',
				'easeInOutQuint'	=>  'easeInOutQuint',
				'easeInOutSine' 	=>  'easeInOutSine',
				'easeInOutExpo' 	=>  'easeInOutExpo',
				'easeInOutCirc' 	=>  'easeInOutCirc',
				'easeInOutElastic' 	=>  'easeInOutElastic',
				'easeInOutBack' 	=>  'easeInOutBack',
				'easeInOutBounce' 	=>  'easeInOutBounce'
			);

			$fontface = array(
				' ' 										=> 'Select a font',
				'Arial'										=> 'Arial',
				'Verdana'									=> 'Verdana',
				'Tahoma'									=> 'Tahoma',
				'Sans-serif'								=> 'Sans-serif',
				'Lucida Grande'								=> 'Lucida Grande',
				'Georgia, serif'							=> 'Georgia',
				'Trebuchet MS, Tahoma, sans-serif'			=> 'Trebuchet',
				'Times New Roman, Geneva, sans-serif'		=> 'Times New Roman',
				'Palatino,Palatino Linotyp,serif'			=> 'Palatino',
				'Helvetica Neue, Helvetica, sans-serif'		=> 'Helvetica'
			);
			// Slider speed
			$slider_speed=array();
				for($i=100;$i<=9000;$i+=100) {
				$slider_speed[$i]=$i;
			}

			// Slider Interval
			$slider_interval=array();
				for($i=1000;$i<=9000;$i+=100) {
				$slider_interval[$i]=$i;
			}
			$colors = array();
			if(is_dir(THEME_DIR . "/colors/")) {
				if($style_dirs = opendir(THEME_DIR . "/colors/")) {
					while(($color = readdir($style_dirs)) !== false) {
						if(stristr($color, ".css") !== false) {
							$colors[$color] = $color;
						}
					}
				}
			}
			$colors_select = $colors;
			array_unshift($colors_select,'Default Color');

			/** END: prepare options for both homepages and page options **/
		
			// ***** Image Alignment radio box
			$options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center");
			
			// ***** Image Links to Options
			$options_image_link_to = array(
					'image'	=> 'The Image',
					'post'	=> 'The Post'); 
			$body_repeat = array(
					'repeat'	=> 'Repeat',
					'no-repeat'	=> 'No Repeat',
					'repeat-x'	=> 'Repeat X',
					'repeat-y'	=> 'Repeat Y');
			$body_pos = array(
					'left top'		=> 'Left Top',
					'left_center'	=> 'Left Center',
					'left_bottom'	=> 'Left Bottom',
					'right_top'		=> 'Right Top',
					'right_center'	=> 'Right Center',
					'right_bottom'	=> 'Right Bottom',
					'center top'	=> 'Center Top',
					'center_center'	=> 'Center Center',
					'center_bottom'	=> 'Center Bottom');
			$body_attachment_style=array(
					'fixed'		=> 'Fixed',
					'scroll'	=> 'Scroll');
			
			// G E N E R A L ################################################################################
			//-----------------------------------------------------------------------------------------------
			$iva_options[] = array( 'name' => 'General','icon' => $url.'general-icon.png','type' => 'heading');
			//-----------------------------------------------------------------------------------------------

					$iva_options[] = array( 'name'	=> 'Custom Logo',
										'desc'	=> 'Select the Logo style you want to use title or image.',
										'id'	=> $shortname.'_logo',
										'std'	=> 'title',
										'class'	=> 'select300',
										'options' => array(
														'logo'	=> 'Logo',
														'title'	=> 'Title',
														),
										'type'	=> 'select');

					$iva_options[] = array( 'name'	=> 'Logo Image',
										'desc'	=> 'Upload a logo for your theme, or specify the image url of your online logo. (http://yoursite.com/logo.png)',
										'id'	=> $shortname.'_header_logo',
										'std'	=> '',
										'class' => 'atplogo logo',
										'type'	=> 'upload');

					$iva_options[] = array( 'name'	=> 'Admin Login Logo',
										'desc'	=> 'Upload a logo for your wordpress admin area which displays only when the login screen appears, make sure the logo size is 274x63 and should not exceed the size.',
										'id'	=> $shortname.'_admin_logo',
										'std'	=> '',
										'class' => 'atplogo logo',
										'type'	=> 'upload');

					$iva_options[] = array(	'name'	=> 'Site Title',
										'desc'	=> 'Site Title Color Properties',
										'id'	=> $shortname.'_logotitle',
										'std'	=> array(	
														'size'		=> '',
														'lineheight'=> '',
														'face'		=> '',
														'style'		=> '',
														'fontvariant' => ''),
										'class' => 'atplogo title',
										'type'	=> 'typography');

					$iva_options[] = array(	'name'	=> 'Site Description',
										'desc'	=> 'Site Description Color and properties',
										'id'	=> $shortname.'_tagline',
										'std'	=> array(
														'size'		=> '',
														'lineheight'=> '',
														'face'		=> '',
														'style'		=> '',
														'fontvariant' => ''),
										'class' => 'atplogo title',
										'type'	=> 'typography');
									
					$iva_options[] = array( 'name'	=> 'Custom Favicon',
										'desc'	=> 'Upload a 16px x 16px ICO icon format that will represent your website favicon.',
										'id'	=> $shortname.'_custom_favicon',
										'std'	=> '',
										'type'	=> 'upload'); 

					$iva_options[] = array( 'name'	=> 'Ajax / No-Ajax Theme',
										'desc'	=> 'Enable/Disable the theme ajaxified or non ajaxified.',
										'id'	=> $shortname.'_ajaxify',
										'std'	=> '',
										'class'	=> 'select300',
										'options' => array( 
														'enable'	=> 'Enable',
														'disable'   => 'Disable'),
										'type'	=> 'select');

					$iva_options[] = array( 'name'	=> 'Subheader Teaser',
										'desc'	=> 'Teaser call out for the subheader section of the theme.',
										'id'	=> $shortname.'_teaser',
										'std'	=> 'default',
										'class'	=> 'select300',
										'options' => array( 
														'default'	=> 'Default (post title)',
														'twitter'   => 'Twitter Tweets',
														'disable'	=> 'Disable Subheader'),
										'type'	=> 'select');

								
					$iva_options[] = array( 'name'	=> 'Breadcrumbs',
										'desc'	=> 'Check this if you wish to disable the breadcrumbs option for the theme which appears in the subheader. If you wish to disable the 																breadcrumb for a specific page then go to edit page',
										'id'  	=> $shortname.'_breadcrumbs',
										'std' 	=> 'true',
										'type' 	=> 'checkbox');

					$iva_options[] = array( 'name'	=> 'Responsive Mode',
										'desc'	=> 'Check this if you wish to disable the Responsive Mode',
										'id'  	=> $shortname.'_responsive',
										'std' 	=> 'true',
										'type' 	=> 'checkbox');

					$iva_options[] = array( 'name'	=> 'Testimonial Fade Speed',
											'desc'	=> 'Enter the testimonial fade speed. 1000 = 1ms',
											'id'  	=> $shortname.'_tm_speed',
											'std' 	=> '',
											'inputsize' => '300',
											'type'	=> 'text');


					$iva_options[] = array(	'name'	=> 'Google Analytics',
											'desc'	=> 'Paste your Google Analytics code here which starts from &lt;script> here. This will be added into the footer of your theme.',
											'id'	=> $shortname.'_googleanalytics',
											'std'	=> '',
											'type'	=> 'textarea');


					$iva_options[] = array( 'name'			=> 'Album Slug',
											'desc'			=> 'Type album single page title which you want to wish to display in the album single page',
											'id'			=> $shortname.'_album_slug',
											'class'			=> '',
											'std'			=> '',
											'type'			=> 'text',
											'inputsize'		=> '' );

				
					$iva_options[] = array( 'name'			=> 'Artist Slug',
											'desc'			=> 'Type artist single page title which you want to wish to display in the artist single page',
											'id'			=> $shortname.'_artist_slug',
											'class'			=> '',
											'std'			=> '',
											'type'			=> 'text',
											'inputsize'		=> '');

					
					$iva_options[] = array( 'name'			=> 'Video Slug',
											'desc'			=>'Type video single page title which you want to wish to display in the video single page',
											'id'			=> $shortname.'_video_slug',
											'class'			=> '',
											'std'			=> '',
											'type'			=> 'text',
											'inputsize'		=> '' );

					
					$iva_options[] = array(	'name'			=> 'Gallery Slug',
											'desc'			=> 'Type gallery single page title which you want to wish to display in the gallery single page',
											'id'			=> $shortname.'_gallery_slug',
											'class'			=> '',
											'std'			=> '',
											'type'			=> 'text',
											'inputsize'		=> '' );

					$iva_options[] = array(	'name'			=> 'Djmix Slug',
											'desc'			=> 'Type djmix single page title which you want to wish to display in the djmix single page',
											'id'			=> $shortname.'_djmix_slug',
											'class'			=> '',
											'std'			=> '',
											'type'			=> 'text',
											'inputsize'		=> '' );


					
					$iva_options[] = array( 'name'			=> 'Events Slug',
											'desc'			=>'Type event single page title which you want to wish to display in the Event single page',
											'id'			=> $shortname.'_events_slug',
											'class'			=> '',
											'std'			=> '',
											'type'			=> 'text',
											'inputsize'		=> '' );

				// TWITER #########################################################################################
				//---------------------------------------------------------------------------------------------------
				$iva_options[] = array( 'name' => 'Twitter','icon' => $url.'twitter-icon.png','type' => 'heading');
				//---------------------------------------------------------------------------------------------------
							$iva_options[] = array( 'name'	=> 'Twitter Username',
											'desc'	=> 'Enter Twitter username to display tweets in subheader area of the theme. <br>You will need to visit <a href="https://dev.twitter.com/apps/" target="_blank">https://dev.twitter.com/apps/</a>, sign in with your account and create your own keys.',
											'id'	=> $shortname.'_teaser_twitter',
											'std'	=> '',
											'inputsize' => '300',
											'type'	=> 'text');
										
						$iva_options[] = array( "name"	=> "Twitter API key",
											"desc"	=> "Twitter Consumer key",
											"id"	=> $shortname."_consumerkey",
											'inputsize' => '300',
											"std"	=> "",
											"type"	=> "text");
						$iva_options[] = array( "name"	=> "Twitter API  secret",
											"desc"	=> "Twitter Consumer secret",
											"id"	=> $shortname."_consumersecret",
											'inputsize' => '300',
											"std"	=> "",
											"type"	=> "text");

						$iva_options[] = array( "name"	=> "Twitter Access token",
											"desc"	=> "Twitter Access token",
											"id"	=> $shortname."_accesstoken",
											'inputsize' => '300',
											"std"	=> "",
											"type"	=> "text");
						$iva_options[] = array( "name"	=> "Twitter Token secret",
											"desc"	=> "Twitter Access secret",
											"id"	=> $shortname."_accesstokensecret",
											'inputsize' => '300',
											"std"	=> "",
											"type"	=> "text");
											
			// HOMEPAGE #########################################################################################
			//---------------------------------------------------------------------------------------------------
			$iva_options[] = array( 'name' => 'Homepage','icon' => $url.'home-icon.png','type' => 'heading');
			//---------------------------------------------------------------------------------------------------
				$iva_options[] = array( "name"	=> "Teaser",
									"desc"	=> 'Check this if you wish to disable the Teaser on Homepage below the slider.',
									"id"	=> $shortname."_teaser_frontpage",
									"std"	=> "",
									"type"	=> "checkbox");
	

				$iva_options[] = array( "name"	=> "Teaser Text",
									"desc"	=> "Custom HTML and Text that will appear in the teaser area of your Homepage below Slider.",
									"id"	=> $shortname."_teaser_frontpage_text",
									"std"	=> '<div style="padding:40px 0 ;">
[one_third]
[servicesicon align="left" icon="fa-tablet" color="#01749F" title="Responsive Design"]
MusicPlay is <strong style="color:#01749F;">fully responsive</strong> and can adapt to any screen size, <strong style="color:#01749F;">its incredibly flexible</strong>. Try resizing your browser window to see the adaptation in action.
[/servicesicon]
[/one_third]

[one_third]
[servicesicon align="left" icon="fa-music " color="#01749F" title="Best Music Theme"]
MusicPlay is the badass WordPress theme for all who love music, such as <strong style="color:#01749F;">music bands, musicians, DJs, producers,</strong> events and festivals. 
[/servicesicon]
[/one_third]

[one_third_last]
[servicesicon align="left" icon="fa-tint" color="#01749F" title="Unlimited Colors"]
We included a back-end <strong style="color:#01749F;">color picker for unlimited color options</strong>. Any of the elements can be changed, including the <strong style="color:#01749F;">Google Fonts for headings, menu, etc.</strong>
[/servicesicon]
[/one_third_last]
</div>',
									"type"	=> "textarea");
				
				$iva_options[] = array(	'name'	=> 'Homepage Teaser Background',
										'desc'	=> 'Background Color for the Homepage Teaser Area Below the Slider.',
										'id'	=> $shortname.'_teaser_bg',
										'std'	=> '', 
										'type'	=> 'color');
				$iva_options[] = array(	'name'	=> 'Homepage Teaser Color',
										'desc'	=> 'Color for the Homepage Teaser Area Below the Slider.',
										'id'	=> $shortname.'_teaser_color',
										'std'	=> '', 
										'type'	=> 'color');

				// HEADER STYLE #########################################################################################
				//---------------------------------------------------------------------------------------------------
				$iva_options[] = array( 'name' => 'Headers','icon' => $url.'header-icon.png','type' => 'heading');
			
				$iva_options[] = array( "name"	=> "Header Style",
										"desc"	=> 'Select the style you want to choose for the Header.',
										"id"	=> $shortname."_headerstyle",
										"std"	=> "",
										'class'	=> 'select300',
										"options" => array(
											'' => 'Choose Header Style',
											'headerstyle1' => 'Header Style1',
											'headerstyle2' => 'Header Style2',
											'headerstyle3' => 'Header Style3',
											),
										"type"	=> "select");

				$iva_options[] = array(	'name'	=> 'Header Background Properties',
									'desc'	=> 'Select the Background Image for Header and assign its Properties according to your requirements.',
									'id'	=> $shortname.'_headerproperties',
									'std'	=> array(
													'image'		=> '',
													'color'		=> '',
													'style' 	=> 'repeat',
													'position'	=> 'center top',
													'attachment'=> 'scroll'),
									'type'	=> 'background');

				$iva_options[] = array( "name"	=> "Header Custom Height",
									"desc"	=> 'Enter the numeric value (pixels) into the input for the custom height for your header. This does not applies for fixed header style.',
									"id"	=> $shortname."_headerHeight",
									"std"	=> "",
									'inputsize' => '300',
									"type"	=> "text");


				$iva_options[] = array( "name"	=> "Top Bar",
									"desc"	=> 'Check this if you wish to disable the Top Bar.',
									"id"	=> $shortname."_topbar",
									"std"	=> "",
									"type"	=> "checkbox");
		
				$iva_options[] = array( "name"	=> "Topbar Left",
									"desc"	=> "Custom HTML and Text that will appear in the Topbar in Left side.",
									"id"	=> $shortname."_top_lefttext",
									"std"	=> '<i class="fa fa-envelope-o fa-lg"></i> support@yourdomain.com',
									"type"	=> "textarea");

				$iva_options[] = array( "name"	=> "Topbar Right",
									"desc"	=> "Custom HTML and Text that will appear in the Topbar in Right side. If you want you can use text as well instead of sociables",
									"id"	=> $shortname."_top_righttext",
									"std"	=> 'CALL FOR A TOUR: 1-000-000-8000',
									"type"	=> "textarea");

				$iva_options[] = array( "name"	=> "Topbar Background Color",
									"desc"	=> "This will apply the background color to the topbar.",
									"id"	=> $shortname."_topbar_bgcolor",
									"std"	=> "",
									"type"	=> "color");

				$iva_options[] = array(	'name'	=> 'Topbar Text Color',
										'desc'	=> 'This will apply text color to the topbar',
										'id'	=> $shortname.'_topbar_text',
										'std'	=> '', 
										'type'	=> 'color');


			// COLORS ###########################################################################################
			//---------------------------------------------------------------------------------------------------
			$iva_options[] = array( 'name' => 'Styling', 'icon' => $url.'colors-icon.png','type' => 'heading');
			//---------------------------------------------------------------------------------------------------
			
					//---------------------------------------------------------------------------------------------------
					$iva_options[] = array( 'name'	=> 'General Elements', 'type' => 'subnav');
					//---------------------------------------------------------------------------------------------------
					$iva_options[] = array( 'name' 		=> 'Layout Option',
											'desc'	=> 'Select the layout option BOXED/STRETCHED',
											'id'	=> $shortname.'_layoutoption',
											'std' 		=> 'stretched',
											'type'  	=> 'images',
											'class' => 'select300',
											'options' 	=> array(
												   'stretched' 	=>  FRAMEWORK_URI . 'admin/images/columns/stretched.png',
												   'boxed'  	=>  FRAMEWORK_URI . 'admin/images/columns/boxed.png')
											);		

					$iva_options[] =array(	'name'	=> 'Colors',
										'desc'	=> 'Select your themes alternative color scheme for this Theme Current theme has no extra custom made skins',
										'id'	=> $shortname.'_style',
										'std'	=> '', 
										'class'	=> 'select300',
										'options'=> $colors_select,
										'type'	=> 'select');


					$iva_options[] = array(	'name'	=> 'Theme Color',
										'desc'	=> 'Theme Color set to default with theme if you choose color from here it will change all the links and backgrounds used in the theme.',									
										'id'	=> $shortname.'_themecolor',
										'std'	=> '', 
										'type'	=> 'color');


					$iva_options[] = array(	'name'	=> 'Body Background Properties',
										'desc'	=> 'Select the Background Image for Body and assign its Properties according to your requirements.',
										'id'	=> $shortname.'_bodyproperties',
										'std'	=> array(
														'image'		=> '',
														'color'		=> '#371218',
														'style' 	=> '',
														'position'	=> '',
														'attachment'=> ''),
										'type'	=> 'background');
		
					$iva_options[] = array( 'name' => 'Background Pattern Images',
										'desc' => 'Patter overlay on the body background color or image, displays on if the layout is selected as boxed in General Options Panel',
										'id'   => $shortname.'_overlayimages',
										'std'  => '',
										'type' => 'images',
										'options' => array(
														''			   => $url . 'patterns/pat0.png',
														'pattern1.png' => $url . 'patterns/pat1.png',
														'pattern2.png' => $url . 'patterns/pat2.png',
														'pattern3.png' => $url . 'patterns/pat3.png',
														'pattern4.png' => $url . 'patterns/pat4.png',
														'pattern5.png' => $url . 'patterns/pat5.png',
														'pattern6.png' => $url . 'patterns/pat6.png',
														'pattern7.png' => $url . 'patterns/pat7.png',
														'pattern8.png' => $url . 'patterns/pat8.png',
														'pattern9.png' => $url . 'patterns/pat8.png'),
												);
				

					$iva_options[] = array(	'name'	=> 'Subheader Background Properties',
										'desc'	=> 'Select the Background Image for Subheader and assign its Properties according to your requirements.',
										'id'	=> $shortname.'_subheaderproperties',
										'std'	=> array(
														'image'		=> '',
														'color'		=> '',
														'style' 	=> 'repeat',
														'position'	=> 'center top',
														'attachment'=> 'scroll'),
										'type'	=> 'background');

					$iva_options[] = array(	'name'	=> 'Subheader',
										'desc'	=> 'Subheader Text Color',
										'id'	=> $shortname.'_subheader_textcolor',
										'std'	=> '', 
										'type'	=> 'color');

					$iva_options[] = array(	'name'	=> 'Content Area',
										'desc'	=> 'This will apply color to the primary content area of theme.',
										'id'	=> $shortname.'_wrapbg',
										'std'	=> '', 
										'type'	=> 'color');

					$iva_options[] = array(	'name'	=> 'Breadcrumb',
										'desc'	=> 'Breadcrumb Text Color.',
										'id'	=> $shortname.'_breadcrumbtext',
										'std'	=> '', 
										'type'	=> 'color');

					$iva_options[] = array(	'name'	=> 'Footer Background',
										'desc'	=> 'Footer background properties includes the sidebar footer widgets area as well. If you wish to disable footer area you can go to Footer Tab and do that..',
										'id'	=> $shortname.'_footerbg',
										'std'	=> array(
														'image'		=> '',
														'color'		=> '',
														'style' 	=> 'repeat',
														'position'	=> 'center top',
														'attachment'=> 'scroll'),
										'type'	=> 'background');

	
					//---------------------------------------------------------------------------------------------------
					$iva_options[] = array( 'name' => 'Menu', 'type' => 'subnav');
					//---------------------------------------------------------------------------------------------------

					$iva_options[] = array(	'name'	=> 'Menu Font and Link Color',
										'desc'	=> 'Select the Color and Font Properties for Menu Parent Lists.',
										'id'	=> $shortname.'_topmenu',
										'std'	=> array(
														'size' 		=> '',
														'lineheight'=> '',
														'face' 		=> '',
														'style' 	=> '',
														'color' 	=> ''),
										'type'	=> 'typography');
									
					$iva_options[] = array(	'name'	=> 'Menu Hover BG',
										'desc'	=> 'Select the Color for Menu Hover BG.',
										'id'	=> $shortname.'_topmenu_hoverbg',
										'std'	=> '', 
										'type'	=> 'color');

					$iva_options[] = array(	'name'	=> 'Menu Hover Text',
										'desc'	=> 'Select the Color for Menu Hover Text.',
										'id'	=> $shortname.'_topmenu_linkhover',
										'std'	=> '', 
										'type'	=> 'color');

					$iva_options[] = array(	'name'	=> 'Menu Dropdown Background Color',
										'desc'	=> 'Select the Color for Dropdown Menu Background Color',
										'id'	=> $shortname.'_topmenu_sub_bg',
										'std'	=> '', 
										'type'	=> 'color');

					$iva_options[] = array(	'name'	=> 'Menu Dropdown Text Color',
										'desc'	=> 'Select the Color for Dropdown Menu Text Color',
										'id'	=> $shortname.'_topmenu_sub_link',
										'std'	=> '', 
										'type'	=> 'color');
		
					$iva_options[] = array(	'name'	=> 'Menu Dropdown Text Hover Color',
										'desc'	=> 'Select the Color for Dropdown Menu Text Hover Color',
										'id'	=> $shortname.'_topmenu_sub_linkhover',
										'std'	=> '', 
										'type'	=> 'color');

					$iva_options[] = array(	'name'	=> 'Menu Dropdown Hover Background Color',
										'desc'	=> 'Select the Color for Dropdown Menu Hover Background Color',
										'id'	=> $shortname.'_topmenu_sub_hoverbg',
										'std'	=> '', 
										'type'	=> 'color');

					$iva_options[] = array(	'name'	=> 'Menu Active Link Color',
										'desc'	=> 'Select the Color for Active Link Color',
										'id'	=> $shortname.'_topmenu_active_link',
										'std'	=> '', 
										'type'	=> 'color');

					$iva_options[] = array(	'name'	=> 'Menu Dropdown Border Color',
										'desc'	=> 'Select the Color for Dropdown Menu Border Color ',
										'id'	=> $shortname.'_topmenu_bordercolor',
										'std'	=> '', 
										'type'	=> 'color');

					//---------------------------------------------------------------------------------------------------
					$iva_options[] = array( 'name' => 'Link Colors', 'type' => 'subnav');
					//---------------------------------------------------------------------------------------------------

					$iva_options[] = array(	'name'	=> 'Link Color',
										'desc'	=> 'Select the Color for Theme links',
										'id'	=> $shortname.'_link',
										'std'	=> '', 
										'type'	=> 'color');
			
					$iva_options[] = array(	'name'	=> 'Link Hover Color',
										'desc'	=> 'Select the Color for Theme links hover',
										'id'	=> $shortname.'_linkhover',
										'std'	=> '', 
										'type'	=> 'color');
			
					$iva_options[] = array(	'name'	=> 'Subheader Link Color',
										'desc'	=> 'Links under subheader section',
										'id'	=> $shortname.'_subheaderlink',
										'std'	=> '', 
										'type'	=> 'color');

					$iva_options[] = array(	'name'	=> 'Subheader Link Hover Color',
										'desc'	=> 'Links Hover under subheader section',
										'id'	=> $shortname.'_subheaderlinkhover',
										'std'	=> '', 
										'type'	=> 'color');

					$iva_options[] = array(	'name'	=> 'Footer Link Color',
										'desc'	=> 'Footer containing links under widget or text widget, (link color).',
										'id'	=> $shortname.'_footerlinkcolor',
										'std'	=> '', 
										'type'	=> 'color');
			
					$iva_options[] = array(	'name'	=> 'Footer Link Hover Color',
										'desc'	=> 'Footer content containing any links under widget or text widget, (link hover color).',
										'id'	=> $shortname.'_footerlinkhovercolor',
										'std'	=> '', 
										'type'	=> 'color');

					$iva_options[] = array(	'name'	=> 'Copyright Link Color',
										'desc'	=> 'Copyright content containing any links color. (link color).',
										'id'	=> $shortname.'_copylinkcolor',
										'std'	=> '', 
										'type'	=> 'color');

					//---------------------------------------------------------------------------------------------------
					$iva_options[] = array( 'name'	=> 'Typography', 'type' => 'subnav');
					//---------------------------------------------------------------------------------------------------
					//---------------------------------------------------------------------------------------------------
					$iva_options[] = array( 'name'	=> 'Select Font Family', 'desc' => '<h3>Font Family</h3> Select the Fonts as standards fonts or google webfonts. If you select the headings font it will replace all the heading font family for the whole theme including footer and sidebar widget titles.', 'type' => 'subsection');
					//---------------------------------------------------------------------------------------------------
					
					$iva_options[] = array( 
										"name" => "Body Font Face",
										"desc" => "Select a font family for body text",
										"id" => $shortname.'bodyfont',
										"options" =>$fontface,
										'class'	=> 'select300',
										"preview" 	 => array(
															"text" 		=> "This is my preview text!", //this is the text from preview box
															"size" 		=> "25px"
										),
										"type" => "atpfontfamily");

					$iva_options[] = array( 
										"name" => "Headings Font Face",
										"desc" => "Select a font family for Headings ( h1, h2, h3, h4, h5, h6 )",
										"id" => $shortname.'_headings',
										"options" =>$fontface,
										'class'	=> 'select300',
										"preview" 	 => array(
															"text" 		=> "This is my preview text!", //this is the text from preview box
															"size" 		=> "25px"
										),
										"type" => "atpfontfamily");
										
					$iva_options[] = array( 
										"name" => "Menu Font Face",
										"desc" => "Select a font family for Top Navigation Menu",
										"id" => $shortname.'_mainmenufont',
										"options" =>$fontface,
										'class'	=> 'select300',
										"preview" 	 => array(
															"text" 		=> "This is my preview text!", //this is the text from preview box
															"size" 		=> "25px"
										),
										"type" => "atpfontfamily");


					//---------------------------------------------------------------------------------------------------
					$iva_options[] = array( 'name'	=> 'Select Font Properties', 'desc' => '<h3>Font Properties</h3> Select the front properties like font size, line-height, font-style and font-weight.', 'type' => 'subsection');
					//---------------------------------------------------------------------------------------------------
					
					$iva_options[] = array(	'name'	=> 'Body',
										'desc'	=> 'Select the Color and Font Properties for Body Font.',
										'id'	=> $shortname.'_bodyp',
										'std'	=> array(
														'color'		=> '',
														'size'		=> '',	
														'lineheight'=> '',
														'style'		=> '',
														'fontvariant' => ''),
										'type'	=> 'typography');


					$iva_options[] = array(	'name'	=> 'H1',
										'desc'	=> 'Select the Color and Font Properties for H1 Heading.',
										'id'	=> $shortname.'_h1',
										'std'	=> array(
														'color'		=> '',
														'size' 		=> '',
														'lineheight'=> '',
														'style' 	=> '',
														'fontvariant' => ''),
										'type'	=> 'typography');

					$iva_options[] = array(	'name'	=> 'H2',
										'desc'	=> 'Select the Color and Font Properties for H2 Heading.',
										'id'	=> $shortname.'_h2',
										'std'	=> array(
														'color'		=> '',
														'size' 		=> '',
														'lineheight'=> '',
														'style'		=> '',
														'fontvariant' => ''),
										'type'	=> 'typography');

					$iva_options[] = array(	'name'	=> 'H3',
										'desc'	=> 'Select the Color and Font Properties for H3 Heading.',
										'id'	=> $shortname.'_h3',
										'std'	=> array(
														'color'		=> '',
														'size' 		=> '',
														'lineheight'=> '',
														'style' 	=> '',
														'fontvariant' => ''),
										'type'	=> 'typography');

					$iva_options[] = array(	'name'	=> 'H4',
										'desc'	=> 'Select the Color and Font Properties for H4 Heading.',
										'id'	=> $shortname.'_h4',
										'std'	=> array(
														'color'		=> '',
														'size' 		=> '',
														'lineheight'=> '',
														'style' 	=> '',
														'fontvariant' => ''),
										'type'	=> 'typography');

					$iva_options[] = array(	'name'	=> 'H5',
										'desc'	=> 'Select the Color and Font Properties for H5 Heading.',
										'id'	=> $shortname.'_h5',
										'std'	=> array(
														'color'		=> '',
														'size'		=> '',
														'lineheight'=> '',
														'style'		=> '',
														'fontvariant' => ''),
										'type'	=> 'typography');

					$iva_options[] = array(	'name'	=> 'H6',
										'desc'	=> 'Select the Color and Font Properties for H6 Heading.',
										'id'	=> $shortname.'_h6',
										'std'	=> array(
														'color'		=> '',
														'size'		=> '',
														'lineheight'=> '',
														'style'		=> '',
														'fontvariant' => ''),
										'type'	=> 'typography');

					$iva_options[] = array(	'name'	=> 'Sidebar Widget Titles',
										'desc'	=> 'Select the Color and Font Properties for sidebar Widget Titles.',
										'id'	=> $shortname.'_sidebartitle',
										'std'	=> array(
														'color'		=> '',
														'size'		=> '',
														'lineheight'=> '',
														'style'		=> '',
														'fontvariant' => ''),
										'type'	=> 'typography');

					$iva_options[] = array(	'name'	=> 'Footer Widget Titles',
										'desc'	=> 'Select the Color and Font Properties for Footer Widget Titles.',
										'id'	=> $shortname.'_footertitle',
										'std'	=> array(
														'color'		=> '',
														'size'		=> '',
														'lineheight'=> '',
														'style'		=> '',
														'fontvariant' => ''),
										'type'	=> 'typography');

	
					$iva_options[] = array(	'name'	=> 'Footer Text',
										'desc'	=> 'Select the Color &amp; Font Properties for Footer Section',
										'id'	=> $shortname.'_footertext',
										'std'	=> array(
														'color'		=> '',
														'size'		=> '',
														'lineheight'=> '',
														'style'		=> '',
														'fontvariant' => ''),
										'type'	=> 'typography');

					$iva_options[] = array(	'name'	=> 'Copyright Text',
										'desc'	=> 'Select the Color &amp; Font Properties for Copyright Section.',
										'id'	=> $shortname.'_copyrights',
										'std'	=> array(
														'color'		=> '',
														'size'		=> '',
														'lineheight'=> '',
														'style'		=> '',
														'fontvariant' => ''),
										'type'	=> 'typography');
					
					//---------------------------------------------------------------------------------------------------
					$iva_options[] = array( 'name' => 'Custom Font', 'type' => 'subnav');
					//---------------------------------------------------------------------------------------------------

					$iva_options[] = array(	'name'	=> 'Custom Font <strong>.woff</strong>',
										'desc'	=> 'Upload Custom Font .woff.',
										'id'	=> $shortname.'_fontwoff',
										'std'	=> '', 
										'type'	=> 'upload');

					$iva_options[] = array(	'name'	=> 'Custom Font <strong>.ttf</strong>',
										'desc'	=> 'Upload Custom Font .ttf',
										'id'	=> $shortname.'_fontttf',
										'std'	=> '', 
										'type'	=> 'upload');

					$iva_options[] = array(	'name'	=> 'Custom Font <strong>.svg</strong>',
										'desc'	=> 'Upload Custom Font .svg',
										'id'	=> $shortname.'_fontsvg',
										'std'	=> '', 
										'type'	=> 'upload');

					$iva_options[] = array(	'name'	=> 'Custom Font <strong>.eot</strong>',
										'desc'	=> 'Upload Custom Font .eot',
										'id'	=> $shortname.'_fonteot',
										'std'	=> '', 
										'type'	=> 'upload');

					$iva_options[] = array(	'name'	=> 'Font Name',
										'desc'	=> 'Enter Font Name Select the name as mentioned in fontface css in the downloaded readme file of your custom font',
										'id'	=> $shortname.'_fontname',
										'std'	=> '', 
										'inputsize' => '300',
										'type'	=> 'text');

					$iva_options[] = array(	'name'	=> 'Custom Fonts Headings and class Names',
										'desc'	=> 'Enter your own custom elements to which you want to assign this custom font. Ex: h1,h2,h3, .class1,.class2',
										'id'	=> $shortname.'_fontclass',
										'std'	=> '', 
										'inputsize' => '',
										'type'	=> 'textarea');


					//---------------------------------------------------------------------------------------------------
					$iva_options[] = array( 'name' => 'Custom CSS', 'type' => 'subnav');
					//---------------------------------------------------------------------------------------------------

					$iva_options[] = array( 'name'	=> 'Custom CSS',
										'desc'	=> 'Quickly add some CSS of your own choice to this theme by adding it in this block.',
										'id'	=> $shortname.'_extracss',
										'std'	=> '',
										'type'	=> 'textarea');
		
			// S L I D E R S
			//------------------------------------------------------------------------
			$iva_options[] = array( 'name'	=> 'Sliders',
								'icon'	=> $url.'slider-icon.png',
								'type'	=> 'heading');

					$iva_options[]=	array(	'name'	=> 'Slider',
										'desc'	=> 'Check this if you wish to disable the Slider',
										'id'	=> $shortname.'_slidervisble',
										'std'	=> '',
										'type'	=> 'checkbox');

					$iva_options[] = array( 'name'	=> 'Select Slider',
										'desc'	=> 'Select which slider you want to use for the Frontpage of the theme.',
										'id'	=> $shortname.'_slider',
										'std'	=> 'flexslider',
										'class'	=> 'select300',
										'options' => $atp_theme->atp_variable('slider_type'),
										'type'	=> 'select');

					$iva_options[] = array( 'name'	=> 'Slider Category',
										'desc'	=> 'Select Slider Categories to hold the slides from.',
										'id'	=> $shortname.'_flexslidercat',
										'class' => 'atpsliders flexslider',
										'std'	=> 'flexslider',
										'options' => $atp_theme->atp_variable('slider'),
										'type'	=> 'multiselect');

					$iva_options[] = array( 'name'	=> 'FlexSlider Slides Limits',
										'desc'	=> 'Enter the limit for Slides you want to hold on the Flex Slider',
										'id'	=> $shortname.'_flexslidelimit',
										'std'	=> '',
										'class' => 'atpsliders flexslider',
										'type'	=> 'text',
										'inputsize' => '70');

					$iva_options[] = array( 'name'	=> 'FlexSlider Slides Speed',
										'desc'	=> 'Select the slide speed you want to set',
										'id'	=> $shortname.'_flexslidespeed',
										'std'	=> '3000',
										'class' => 'atpsliders flexslider',
										'type'	=> 'text',
										'inputsize' => '70'
										);

					$iva_options[] = array( 'name'	=> 'Slider Effect',
										'desc'	=> 'Select your animation type, "fade" or "slide"',
										'id'	=> $shortname.'_flexslideffect',
										'std'	=> 'flexslider',
										'class' => 'atpsliders flexslider select300',
										'options' => array( 
														'fade'	=> 'Fade',
														'slide'	=> 'Slide'
													),
										'type'	=> 'select');

					$iva_options[] = array( 'name'	=> 'Direction Nav',
										'desc'	=> 'Navigation for previous/next arrows',
										'id'	=> $shortname.'_flexslidednav',
										'class' => 'atpsliders flexslider select300',
										'std'	=> '',
										'options' => array( 
														'true'	=> 'True',
														'false'	=> 'False'
													),
										'type'	=> 'select');

					$iva_options[] = array( 'name'	=> 'Slider Category',
										'desc'	=> 'Select Slider Categories to hold the slides from.',
										'id'	=> $shortname.'_nivolidercat',
										'class' => 'atpsliders nivoslider',
										'std'	=> 'flexslider',
										'options' =>$atp_theme->atp_variable('slider'),
										'type'	=> 'multiselect');


					$iva_options[] = array( 'name'	=> 'Video Embed Code',
										'desc'	=> 'Enter the video embed code which will display on your frontpage slider area.',
										'id'	=> $shortname.'_video_id',
										'std'	=> '',
										'class' => 'atpsliders videoslider',
										'type'	=> 'textarea',
										'inputsize' => '' );

					$iva_options[] = array( 'name'	=> 'Static Image',
										'desc'	=> 'Upload the image size 1920 x 750 pixels to display on the homepage instead of slider.',
										'id'	=> $shortname.'_static_image_upload',
										'std'	=> '',
										'class' => 'atpsliders static_image',
										'type'	=> 'upload');
					$iva_options[] = array( 'name'		=> 'Static Image Slider URL',
										'desc'		=> 'Enter the external link to site or any URL to link to this static image which clicked.',
										'id'		=> $shortname.'_static_link',
										'std'		=> '',
										'class' 	=> 'atpsliders static_image',
										'type'		=> 'text',
										'inputsize' => '');

					$iva_options[] = array( 'name'	=> 'Custom Slider',
										'desc'	=> 'Use in Your custom slider Plugin shortcodes Example : [revslider id="1"]',
										'id'	=> $shortname.'_customslider',
										'std'	=> '',
										'class' => 'atpsliders customslider',
										'type'	=> 'textarea',
										'inputsize' => '');
		
									
			// P O S T   O P T I O N S 
			//------------------------------------------------------------------------
			$iva_options[] = array( 'name'	=> 'Blog',
								'icon'	=> $url.'post-icon.png',
								'type'	=> 'heading');

					$iva_options[] = array( 'name'	=> 'Blog Page Categories',
										'desc'	=> 'Selected categories will hold the posts to display in blog page template. ( template : template_blog.php)',
										'id'	=> $shortname.'_blogacats',
										'std'	=> '',
										'type'	=> 'multicheck',
										'options'	=> $atp_theme->atp_variable('categories') );

					$iva_options[] = array(	'name'	=> 'About Author',
										'desc'	=> 'Check this if you wish to disable the Author Info in post single page',
										'id'	=> $shortname.'_aboutauthor',
										'std'	=> '',
										'type'	=> 'checkbox' );	

					$iva_options[] = array(	'name'	=> 'Related Posts',
										'desc'	=> 'Check this if you wish to disable the related posts in post single page (based on tags).',
										'id'	=> $shortname.'_relatedposts',
										'std'	=> '',
										'type'	=> 'checkbox' );	

					$iva_options[] = array(	'name'	=> 'Comments',
										'desc'	=> 'Select where you wish to display comments on posts or pages.',
										'id'	=> $shortname.'_commentstemplate',
										'std'	=> 'fullpage',
										'class'	=> 'select300',
										'options'	=> array(
														'posts'	=> 'Posts Only',
														'pages'	=> 'Pages Only', 
														'both'	=> 'Pages/posts',
														'none'	=> 'None'),
										'type'	=> 'select' );

					$iva_options[] = array(	'name'	=> 'Post Pagination',
										'desc'	=> 'Check this if you wish to disable next/previous Post Pagination',
										'id'	=> $shortname.'_singlenavigation',
										'std'	=> '',
										'type'	=> 'checkbox');

					$iva_options[] = array(	"name"	=> "Single Page Featured Image",
										"desc"	=> 'Check this if you wish to disable Featured Image on Post Single Page',
										"id"	=> $shortname."_blogfeaturedimg",
										"std"	=> "",
										"type"	=> "checkbox");
		
					$iva_options[] = array(	"name"	=> "Blog Post Meta",
										"desc"	=> 'Check this if you wish to disable Blog Post Meta in Blog Page',
										"id"	=> $shortname."_postmeta",
										"std"	=> "",
										"type"	=> "checkbox");

															
			// C U S T O M   S I D E B A R 
			//------------------------------------------------------------------------
			$iva_options[] = array( 'name'	=> 'Sidebars',
								'icon'	=> $url.'sidebar-icon.png',
								'type'	=> 'heading');

					$iva_options[] = array( 'name'	=> 'Custom Sidebars',
										'desc'	=> 'Create the desired name for your site sidebars and go to widgets which will appear in rightside below the footer column widgets. After assigning the widgets in the prefered sidebar you can assign the sidebar to individual pages/posts. ',
										'id'	=> $shortname.'_customsidebar',
										'std'	=> '',
										'type'	=> 'customsidebar');

					$iva_options[] = array( 'name'	=> 'Sidebar Layout',
										'desc'	=> 'Please Choose default sidebar ',
										'id'	=> $shortname.'_defaultlayout',
										'std'	=> 'rightsidebar',
										'type'		=> 'images',
										'options'	=> array(
															'rightsidebar'	=>  FRAMEWORK_URI . 'admin/images/columns/rightsidebar.png', 
															'leftsidebar'	=>  FRAMEWORK_URI . 'admin/images/columns/leftsidebar.png',
															'fullwidth'		=>  FRAMEWORK_URI . 'admin/images/columns/fullwidth.png')
										);

			// F O O T E R 
			//------------------------------------------------------------------------
			$iva_options[] = array( 'name'	=> 'Footer',
								'icon'	=> $url.'footer-icon.png',
								'type'	=> 'heading');										

					$iva_options[] = array(	'name'	=> 'Footer Sidebar',	
										'desc'	=> 'Check this if you wish to disable the Footer Sidebar',
										'id'	=> $shortname.'_footer_sidebar',
										'std'	=> '',
										'type'	=> 'checkbox');
				
					$iva_options[] = array( 'name' => 'Footer Columns',
										'desc' => 'Select the Columns Layout Style from below images to display footer sidebar area. After selecting save the options and go to your widgets panel to assign the widgets in each column',
										'id'   => $shortname.'_footerwidgetcount',
										'std'  => '4',
										'type' => 'images',
										'options' => array(
														'1' => $url . 'columns/1col.png',
														'2' => $url . 'columns/2col.png',
														'3' => $url . 'columns/3col.png',
														'4' => $url . 'columns/4col.png',
														'5' => $url . 'columns/5col.png',
														'6' => $url . 'columns/6col.png',
														'half_one_half'		=> $url . 'columns/half_one_half.png',
														'half_one_third'	=> $url . 'columns/half_one_third.png',
														'one_half_half'		=> $url . 'columns/one_half_half.png',
														'one_third_half'	=> $url . 'columns/one_third_half.png')
											);
										
					$iva_options[] = array(	'name'	=> 'Copyright Left Content',	
										'desc'	=> 'Enter the content that you wish the display on the footer Left side',
										'id'	=> $shortname.'_leftcopyright',
										'std'	=> '&copy; Copyright : 2013 - 2014 - All Rights Reserved',
										'type'	=> 'textarea');

					$iva_options[] = array(	'name'	=> 'Copyright Right Content',	
										'desc'	=> 'Enter the content that you wish the display on the footer Right side',
										'id'	=> $shortname.'_rightcopyright',
										'std'	=> 'Designed by <a href="http://www.aivahthemes.com">AivahThemes</a> and Powered by <a href="http://www.wordpress.org">WordPress</a>',
										'type'	=> 'textarea');
			// S O C I A B L E S
			//------------------------------------------------------------------------
			$iva_options[] = array( 'name'	=> 'Sociables',
								'icon'	=> $url.'share-icon.png',
								'type'	=> 'heading');

					$iva_options[] = array(	'name'	=> 'Sociables',	
										'desc'	=> 'Click Add New to add sociables where you can edit/add/delete.<br> If you want to have a different icon please you icon png or gif file in sociables directory located in theme images directory',
										'id'	=> $shortname.'_social_bookmark',
										'std'	=> '',
										'type'	=> 'custom_socialbook_mark');
			//Sticky Bar
			// -----------------------------------------------------------------------
			
			$iva_options[] = array( 'name'	=> 'Sticky Bar',
								'icon'	=> $url.'sticky-icon.png',
								'type'	=> 'heading');
			
				$iva_options[] = array( 'name'	=> 'Sticky Notice Bar',
									'desc'	=> 'Check this if you wish to hide the sticky bar on top.',
									'id'	=> $shortname.'_stickybar',
									'std'	=> '',
									'type'	=> 'checkbox');

				$iva_options[] = array( 'name'	=> 'Show By Default',
									'desc'	=> 'Check this if you wish to Dispaly the sticky bar  by Default.',
									'id'	=> $shortname.'_stickybarenable',
									'std'	=> '',
									'type'	=> 'checkbox');
	
				$iva_options[] = array( 'name'	=> 'Sticky Content',
									'desc'	=> 'Enter the content which will be displayed in sticky bar',
									'id'	=> $shortname.'_stickycontent',
									'std'	=> 'Enter the content which will be displayed in sticky bar',
									'type'	=> 'textarea');
									
				$iva_options[] = array( 'name'	=> 'Sticky Bar Background Color',
									'desc'	=> 'Select the color you want to assign for the Sticky Bar',
									'id'	=> $shortname.'_stickybarcolor',
									'std'	=> '',
									'type'	=> 'color');

				$iva_options[] = array( 'name'	=> 'Sticky Bar Font Color',
									'desc'	=> 'Select the color you want to assign for the Sticky Bar Font Color',
									'id'	=> $shortname.'_stickybarfontcolor',
									'std'	=> '',
									'type'	=> 'color');
			
			
			// L A N G U A G E S
			//------------------------------------------------------------------------
			$iva_options[] = array( 'name'	=> 'Localization',
								'icon'	=> $url.'lang-icon.png',
								'type'	=> 'heading');


					$iva_options[] = array( 'name'	=> '404 Page',
										'desc'	=> 'Custom text which appears on 404 Error page',
										'id'	=> $shortname.'_error404txt',
										'std'	=> '',
										'type'	=> 'textarea',
										'inputsize'=> '333');

					$iva_options[] = array(	'name'	=> 'Read More',	
										'desc'	=> 'Read more text on sliders and other different areas of the theme',
										'id'	=> $shortname.'_readmoretxt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '333');

					$iva_options[] = array( 'name'	=> 'Testimonial Submit Button',
										'desc'	=> 'Testimonial Submission Widget Button Text',
										'id'	=> $shortname.'_testimonialsformtxt',
										'std'	=> '',
										'type'	=> 'text',
										'inputsize'=> '333');

					// MusicBand Theme Localization
					//-----------------------
					$iva_options = apply_filters('posttypelabel_options', $iva_options);

					// MusicBand Theme Options
					//-----------------------
					$iva_options = apply_filters('custompost_themeoptions', $iva_options);
		
			}
	}
?>