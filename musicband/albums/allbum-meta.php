<?php
	//A U D I O  M E T A B O X 
	//--------------------------------------------------------
	$prefix = '';
	global $layout_option;
	$sidebarwidget = get_option('atp_customsidebar');
	$this->meta_box[] = array(
		'id'		=> 'albums_type_upload',
		'title'		=>  'Album upload option',
		'page'		=> array('albums'),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(
			array(
				'name'		=>  __('Audio Type','ATP_ADMIN_SITE'),
				'desc'		=> 'Select the audio type mode you want to use either player or soundcloud.',
				'id'		=> $prefix . 'audio_posttype_option',
				'std'		=> 'player',
				'class'		=> 'select300',
				'type'		=> 'select',
				'options'	=> array(
								"player"		=>"MUSIC PLAYER",
								"soundcloud"	=>"SOUNDCLOUD",
								"externalmp3"	=> "External MP3"
							)
			),

			array(
				'name'		=> __('MUSIC PLAYER','ATP_ADMIN_SITE'),
				'desc'		=> 'Upload the mp3 files only you wish to display.',
				'id'		=> $prefix .'audio_upload',
				'title'		=> 'Upload Audio',
				'class'		=> 'audiopost player',
				'std'		=> '',
				'multiple'	=> 'true',
				'format'	=> 'mp3',
				'type'		=> 'multiupload',
			),
			array(
				'name'	=> __('SOUNDCLOUD TITLE','ATP_ADMIN_SITE'),
				'desc'	=> 'Enter the Soundcloud URL which will display.',
				'id'	=> 	$prefix .'audio_soundcloud_title',
				'class'	=> 'audiopost soundcloud',
				'title'	=> 'Soundcloud Title',
				'std'	=> '',
				'type'	=> 'text',
			),
			array(
				'name'		=> __('External MP3','ATP_ADMIN_SITE'),
				'desc'		=> 'Add External Mp3 Url, Download Link, Caption and BuyLink.',
				'id'		=> $prefix .'audio_mp3',
				'title'		=> 'Upload Audio',
				'class'		=> 'audiopost externalmp3',
				'std'		=> '',
				'type'		=> 'external_mp3',
			),

			array(
				'name'	=> __('SOUNDCLOUD','ATP_ADMIN_SITE'),
				'desc'	=> 'Enter the Soundcloud url Ex: https://soundcloud.com/arminvanbuuren',
				'id'	=> 	$prefix .'audio_soundcloud_url',
				'class'	=> 'audiopost soundcloud',
				'title'	=> 'Soundcloud Url',
				'std'	=> '',
				'type'	=> 'text',
			),
		),
	);

	$this->meta_box[] = array(
		'id'		=> 'genres',
		'title'		=>  'Album Options',
		'page'		=> array('albums'),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			array(
				'name'	=> __('Artist Name','ATP_ADMIN_SITE'),
				'desc'	=> 'Select Artists you wish to assign for this album.',
				'id'	=> 'audio_artist_name',
				'title'	=> 'Artist',
				'std'	=> '',
				'class'	=> 'select300',
				'options' => $this->atp_variable( 'artists'),
				'type'	=> 'multiselect',
			),

			array(
				'name'	=> __('Release Date','ATP_ADMIN_SITE'),
				'desc'	=> 'Select the album release date.',
				'id'	=> 'audio_release_date',
				'title'	=> 'Relase Date',
				'std'	=> '',
				'type'	=> 'dateformat',
			),

			array(
				'name'	=> __('Catalog ID','ATP_ADMIN_SITE'),
				'desc'	=> 'Enter the Catalog ID (Optional)',
				'id'	=> 'audio_catalog_id',
				'title'	=> 'Catalog ID',
				'std'	=> '',
				'type'	=> 'text',
			),
			array(
				'name'	=> __('Add buttons','ATP_ADMIN_SITE'),
				'desc'	=> 'Type button name and url,you wish to display on front page ',
				'id'	=> 'audio_buttons',
				'title'	=> 'Buttons ',
				'std'	=> '',
				'type'	=> 'add_buttons',
			),

			array(
				'name'		=> __('Disable','ATP_ADMIN_SITE'),
				'desc'		=> 'Check this if you wish to disable above buttons',
				'id'		=> 'audio_button_disable',
				'title'		=> 'End  &amp; Time',
				'std'		=> '',
				'type'		=> 'checkbox',
			),
			array(
				'name'	=> __('Video','ATP_ADMIN_SITE'),
				'desc'	=> 'Enter the video embed code which will display on your frontpage',
				'id'	=> 'audio_video',
				'title'	=> 'Video Url',
				'std'	=> '',
				'type'	=> 'textarea',
			),
			
			// C U S T O M   S U B H E A D E R   T E A S E R 
			//--------------------------------------------------------
			array(
					'name'		=> __('Subheader Options','ATP_ADMIN_SITE'),
					'desc'		=> 'Select the Teaser type you wish to display in subheader of the this Post/Page',
					'id'		=> $prefix . 'subheader_teaser_options',
					'std'		=> '',
					'type'		=> 'select',
					'class'		=> 'select300',
					'options'	=> array(
								'default'	=> 'Default ( Options Panel )',
								'twitter'	=> 'Twitter', 	
								'custom'	=> 'Custom', 
								'disable'	=> 'Disable')
			),
			// T E A S E R   T E X T 
			//--------------------------------------------------------
			array(
					'name'		=> __('Teaser Text','ATP_ADMIN_SITE'),
					'desc'		=> 'Type the teaser text you wish to display in the subheader of this page/post. If you wish to use bold text then use strong element example &lt;strong&gt;bold text &lt;/strong&gt;',
					'id'		=> 'page_desc',
					'title'		=> 'Title &amp; Teaser Text',
					'class'		=> 'sub_teaser_option custom',
					'std'		=> '',
					'type'		=> 'textarea',
			),
			// P A G E   B A C K G R O U N D
			//--------------------------------------------------------
			array(
					'name'		=> __('Page Background','ATP_ADMIN_SITE'),
					'desc'		=> 'Upload the background image for this page. <strong>This will be applied only if the layout is boxed mode. Select Layout option from Options Panel > Styling - Layout Option</strong>',
					'id'		=> 'page_bg_image',
					'std'		=> '',
					'title'		=> 'Background Image',
					'type'		=> 'upload',
			),
			// S U B H E A D E R   B A C K G R O U N D 
			//--------------------------------------------------------
			array(
					'name'		=> __('Subheader Background','ATP_ADMIN_SITE'),
					'desc'		=> 'Upload Subheader Image and its properties',
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
		
			//  S U B H E A D E R   T E X T C O L O R 
			//--------------------------------------------------------
			array(
					'name'		=> __('Subheader Text Color','ATP_ADMIN_SITE'),
					'desc'		=> 'Select the color for the content inthe subheader',
					'id'		=> $prefix.'sh_txtcolor',
					'std'		=> '',
					'type'		=> 'color',
			),

			// S U B H E A D E R   P A D D I N G 
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
					'name'		=> __('Custom Sidebar','ATP_ADMIN_SITE'),
					'desc'		=> 'Select the Sidebar you wish to assign for this page.',
					'id'		=> $prefix . 'custom_widget',
					'type'		=> 'customselect',
					'class'		=> 'select300',
					'std'		=> '',
					
					'options'=> $sidebarwidget
			),
			// L A Y O U T   O P T I O N S 
			//--------------------------------------------------------
			array(
					'name'		=> __('Layout Option','ATP_ADMIN_SITE'),
					'desc'		=> 'Select the Layout style you wish to use for this page, Left Sidebar, Right Sidebar or Full Width.',
					'id'		=> $prefix . 'sidebar_options',
					'std'		=> $layout_option,
					'type'		=> 'layout',
					'options'	=> array(
							'rightsidebar'	=>  FRAMEWORK_URI . 'admin/images/right-sidebar.png', 
							'leftsidebar'	=>  FRAMEWORK_URI . 'admin/images/left-sidebar.png',
							'fullwidth'		=>  FRAMEWORK_URI . 'admin/images/fullwidth.png')	
				),
			// B R E A D C R U M B 
			//--------------------------------------------------------
			array(
					'name'		=> __('Breadcrumb','ATP_ADMIN_SITE'),
					'desc'		=> 'Check this if you wish to disable the breadcrumb for this page.',
					'id'		=> $prefix.'breadcrumb',
					'std' 		=> 'off',
					'type'		=> 'checkbox',
			),
		),
	);
?>