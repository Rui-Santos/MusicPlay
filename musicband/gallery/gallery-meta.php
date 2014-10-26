<?php
	//E V E N T S   M E T A B O X 
	//--------------------------------------------------------
	$prefix = '';
	$this->meta_box[] = array(
		'id'		=> 'gallery-upload',
		'title'		=>  'Gallery Upload Option',
		'page'		=> array('gallery'),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(
			array(
				'name'		=> __('Gallery upload','ATP_ADMIN_SITE'),
				'desc'		=> 'Upload the images you wish to display at the front page',
				'id'		=> 'gallery_upload',
				'title'		=> 'Gallery &amp Title',
				'class'		=> 'gallery',
				'std'		=> '',
				'multiple' 	=> 'true',
				'format'	=> 'jpg,jpeg,gif,png',
				'type'		=> 'multiupload',
			),
		),
	);
	
	$this->meta_box[] = array(
		'id'		=> 'gallery-meta-box',
		'title'		=>  'Gallery Options',
		'page'		=> array('gallery'),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(
			array(
				'name'	=> __('Venue','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the text you wish to display in the venue element',
				'id'	=> 'gallery_venue',
				'title'	=> 'Venue',
				'std'	=> '',
				'type'	=> 'text',
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
					'desc'		=> 'Upload the background image for this page. This will be applied only if the layout is boxed mode. Select Layout option from Options Panel > Styling - Layout Option',
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
			
			// S U B H E A D E R T E X T C O L O R 
			//--------------------------------------------------------
			array(
					'name'		=> __('Subheader Text Color','ATP_ADMIN_SITE'),
					'desc'		=> 'Select the color for the content inthe subheader',
					'id'		=> $prefix.'sh_txtcolor',
					'std'		=> '',
					'type'		=> 'color',
			),

			// S U B H E A D E R  P A D D I N G
			//--------------------------------------------------------
			array(
					'name'		=> __('Subheader Padding','ATP_ADMIN_SITE'),
					'desc'		=> 'Enter the padding for the subheader area. Padding should be in the following format - 20px 0 20px 0 - directions are Top Right Bottom Left',
					'id'		=> $prefix.'sh_padding',
					'std'		=> '20px 0',
					'type'		=> 'text',
			),
			
			//L A Y O U T   O P T I O N S 
			//--------------------------------------------------------
			array(
				'name'		=> __('Layout Option','ATP_ADMIN_SITE'),
				'desc'		=> 'Select the Layout style you wish to use for this page, Left Sidebar or Right Sidebar or Full Width.',
				'id'		=> $prefix . 'sidebar_options',
				'std'		=> 'fullwidth',
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