<?php
	// P O S T  M E T A B O X
	//--------------------------------------------------------
	$prefix = '';
	global $layout_option;
	$sidebarwidget = get_option('atp_customsidebar');
	$this->meta_box[] = array(
		'id'		=> 'post-meta-box',
		'title'		=> THEMENAME.'&nbsp;Post Options',
		'page'		=> array('post'),
		'context'	=> 'normal',
		'priority'	=> 'core',
		'fields'	=> array(

			// Q U O T E
			//--------------------------------------------------------
			array( 
				'name' 	=>  __('The Quote','ATP_ADMIN_SITE'),
				'desc' 	=> 'Write your blockquote in above textarea.',
				'id' 	=> $prefix.'postformatmetabox-quote',
				'class'	=> 'postformatmetabox-quote',
				'std' 	=> '',
				'type' 	=> 'textarea',
			),
			// L I N K 
			//--------------------------------------------------------
			array( 
				'name' 	=>  __('The URL','ATP_ADMIN_SITE'),
				'desc' 	=> 'Insert the URL you wish to link to.',
				'class'	=> 'postformatmetabox-link',
				'id' 	=> $prefix.'link_url',
				'std' 	=> '',
				'type' 	=> 'text',
			),
			// S T A T U S  
			//--------------------------------------------------------
			array(
				'name' 	=> __('The Status','ATP_ADMIN_SITE'),
				'desc' 	=> 'Write your status in above textarea.',
				'id' 	=> $prefix.'status',
				'class'	=> 'postformatmetabox-status',
				'std' 	=> '',
				'type' 	=> 'textarea',
			),
			// A U D I O 
			//--------------------------------------------------------
			array(
				'name' 	=>  __('MP3 File URL','ATP_ADMIN_SITE'),
				'desc'	=> 'The URL to the .mp3 file.',
				'id' 	=> $prefix.'audiopost_mp3',
				'class'	=> 'postformatmetabox-audio',
				'std' 	=> '',
				'type'  => 'text',
			),
			array( 
				'name'	=> __('OGA File URL','ATP_ADMIN_SITE'),
				'desc'	=> 'The URL to the .oga or .ogg audio file.',
				'id'	=> $prefix.'audio_ogg',
				'class'	=> 'postformatmetabox-audio',
				'std'	=> '',
				'type'	=> 'text',
			),
			array( 
				'name' 	=> __('Audio Poster Image', 'ATP_ADMIN_SITE'),
				'desc' 	=> 'Poster Image for the audio.',
				'id' 	=> $prefix . 'audio_poster',
				'class'	=> 'postformatmetabox-audio',	
				'std' 	=> '',
				'type' 	=> 'text',
			),
			array( 
				'name' 	=> __('Poster Image Height', 'ATP_ADMIN_SITE'),
				'desc' 	=> 'If the poster image is added above then mention the height of the image you want to display..',
				'id' 	=> $prefix . 'poster_height',
				'class'	=> 'postformatmetabox-audio',
				'std' 	=> '300',
				'type' 	=> 'text',
			),
			// V I D E O 
			//--------------------------------------------------------
			array(
				'name' 	=> __('Video Height','ATP_ADMIN_SITE'),
				'desc' 	=> 'The video height.',
				'id' 	=> $prefix.'video_height',
				'class'	=> 'postformatmetabox-video',
				'std' 	=> '',
				'type' 	=> 'text',
			),
			array(
				'name' 	=> __('M4V File URL','ATP_ADMIN_SITE'),
				'desc' 	=> 'The URL to the .m4v video file',
				'id' 	=> $prefix.'video_m4v',
				'class'	=> 'postformatmetabox-video',
				'std' 	=> '',
				'type' 	=> 'text',
			),
			array(
				'name' 	=> __('OGV File URL','ATP_ADMIN_SITE'),
				'desc' 	=> 'The URL to the .ogv video file',
				'id' 	=> $prefix.'video_ogv',
				'class'	=> 'postformatmetabox-video',
				'std' 	=> '',
				'type' 	=> 'text',
			),
			array(
				'name' 	=> __('Poster Image','ATP_ADMIN_SITE'),
				'desc' 	=> 'The preivew image before the video plays.',
				'id' 	=> $prefix.'video_poster',
				'class'	=> 'postformatmetabox-video',
				'std' 	=> '',
				'type' 	=> 'text',
			),
			array( 
				'name' 	=> __('Embeded Code','ATP_ADMIN_SITE'),
				'desc' 	=> 'If you\'re not using any of the video formats above or self hosted videos then you can add embeded code here. Max Width 580px for blog posts',
				'id' 	=> $prefix.'video_embed',
				'class'	=> 'postformatmetabox-video',
				'std' 	=> '',
				'type' 	=> 'textarea',
			),
			
			// C U S T O M   S U B H E A D E R   T E A S E R 
			//--------------------------------------------------------
			array(
				'name'	=> __('Subheader Options','ATP_ADMIN_SITE'),
				'desc'	=> 'Select the Teaser type you wish to display in subheader of the this Post/Page',
				'id'	=> $prefix . 'subheader_teaser_options',
				'std'	=> '',
				'class'		=> 'select300',
				'type'	=> 'select',
				'options'=> array(
							'default'	=> 'Default ( Options Panel )',
							'twitter'	=> 'Twitter', 	
							'custom'	=> 'Custom', 
							'googlemap'	=> 'Google Map',
							'disable'	=> 'Disable')
			),
			// T E A S E R   T E X T 
			//--------------------------------------------------------
			array(
				'name'	=> __('Teaser Text','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the text you wish to display in the subheader of this page/post. If you wish to use bold text then use strong element example &lt;strong&gt;bold text &lt;/strong&gt;',
				'id'	=> 'page_desc',
				'title'	=> 'Title &amp; Teaser Text',
				'class'	=> 'sub_teaser_option custom',
				'std'	=> '',
				'type'	=> 'textarea',
			),
			// GOOGLE MAP
			//--------------------------------------------------------
			array(
				'name'	=> __('Google Map Shortcode','ATP_ADMIN_SITE'),
				'desc'	=> 'Type Google Map shortcode you wish to display in the subheader area. Use the shortcode generator in a page to create your google map and then place the shortcode here.',
				'id'	=> 'sub_gmap',
				'title'	=> 'Google Map / Shortcode',
				'class'	=> 'sub_teaser_option googlemap',
				'std'	=> '',
				'type'	=> 'textarea',
			),
			// P A G E   B A C K G R O U N D
			//--------------------------------------------------------
			array(
				'name'	=> __('Page Background Image','ATP_ADMIN_SITE'),
				'desc'	=> 'Upload the background image for this page. This will be applied only if the layout is boxed mode. Select Layout option from Options Panel > Styling - Layout Option',
				'id'	=> 'page_bg_image',
				'std'	=> '',
				'title'	=> 'Background Image',
				'type'	=> 'upload',
			),
			// S U B H E A D E R   C O L O R
			//--------------------------------------------------------
			array(
				'name'	=> __('Subheader','ATP_ADMIN_SITE'),
				'desc'	=> 'Choose the color for subheader background color',
				'id'	=> 'subheader_bg_color',
				'std'	=> '',
				'title'	=> 'Subheader Background',
				'type'	=> 'color',
			),
			//--------------------------------------------------------
				// S U B H E A D E R   B A C K G R O U N D 
			//--------------------------------------------------------
			array(
					'name'		=> __('Subheader Image','ATP_ADMIN_SITE'),
					'desc'		=> 'Upload Subheader Image',
					'id'		=> $prefix.'subheader_img',
					'type'		=> 'background',
					'std' 		=> '',
					'options'	=> array(
								'image'		=> '',
								'color'		=> '',
								'repeat' 	=> 'repeat',
								'position'	=> 'center top',
								'attachment'=> 'scroll'
					),
			),
				
			// Subheader Text Color
			//--------------------------------------------------------
			array(
					'name'		=> __('Subheader Text Color','ATP_ADMIN_SITE'),
					'desc'		=> 'Select the color for the content inthe subheader',
					'id'		=> $prefix.'sh_txtcolor',
					'std'		=> '',
					'type'		=> 'color',
			),

			// Subheader Padding
			//--------------------------------------------------------
			array(
					'name'		=> __('Subheader Padding','ATP_ADMIN_SITE'),
					'desc'		=> 'Enter the padding for the subheader area. Padding should be in the following format - 20px 0 20px 0 - directions are Top Right Bottom Left',
					'id'		=> $prefix.'sh_padding',
					'std'		=> '20px 0',
					'type'		=> 'text',
			),

			// C U S T O M   S I D E B A R 
			//--------------------------------------------------------
			array(
				'name'	=> __('Custom Sidebar','ATP_ADMIN_SITE'),
				'desc'	=> 'Select the Sidebar you want to assign for this page.',
				'id'	=> $prefix . 'custom_widget',
				'std'	=> '',
				'type'	=> 'customselect',
				'class'		=> 'select300',
				'options'=> $sidebarwidget
			),
			// S I D E B A R   P O S I T I O N 
			//--------------------------------------------------------
			array(
				'name'	=> __('Layout Option','ATP_ADMIN_SITE'),
				'desc'	=> 'Select the Layout style you wish to use for this page, Left Sidebar, Right Sidebar or Full Width.',
				'id'	=> $prefix . 'sidebar_options',
				'std'	=> $layout_option,
				'type'	=> 'layout',
				'options'=> array(
								'rightsidebar'	=>  FRAMEWORK_URI . 'admin/images/right-sidebar.png', 
								'leftsidebar'	=>  FRAMEWORK_URI . 'admin/images/left-sidebar.png',
								'fullwidth'	=>  FRAMEWORK_URI . 'admin/images/fullwidth.png')	
			),
			// B R E A D C R U M B 
			//--------------------------------------------------------
			array(
				'name'	=> __('Breadcrumb','ATP_ADMIN_SITE'),
				'desc'	=> 'Check this if you wish to disable the breadcrumb for this page.',
				'id'	=> $prefix.'breadcrumb',
				'std' 	=> 'off',
				'type'	=> 'checkbox',
			),
		)
	);
?>