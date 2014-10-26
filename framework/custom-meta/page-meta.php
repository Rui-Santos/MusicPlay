<?php

	// P A G E   M E T A B O X 
	//--------------------------------------------------------
	$prefix = '';
	$this->meta_box = array();

	// Defines custom sidebar widget based on custom option
	$sidebarwidget = get_option('atp_customsidebar');
	global $staff_social, $atp_ribbons,$layout_option;
	$this->meta_box[] = array(
		'id'			=> 'page-meta-box',
		'title'			=> THEMENAME.'&nbsp;Page Options',
		'context'		=> 'normal',
		'page'			=> array('page'),
		'priority'		=> 'high',
		'fields'		=> array(

			// C U S T O M   S U B H E A D E R   T E A S E R 
			//--------------------------------------------------------
			array(
					'name'		=> __('Page Slider','ATP_ADMIN_SITE'),
					'desc'		=> 'Select the Slider you wish to use for the this page. Make sure you add the slide posts',
					'id'		=> $prefix . 'page_slider',
					'std'		=> '',
					'class'		=> 'select300',
					'type'		=> 'select',
					'options'	=> $this->atp_variable('slider_type')
			),
			array(
					'name'	    => __('FlexSlider Category','ATP_ADMIN_SITE'),
					'desc'		=> 'Select Slider Category to hold the posts from.',
					'id'		=> $prefix.'flexslidercat',
					'class' 	=> 'page_slider flexslider select300',
					'std'		=> '',
					'options' 	=> $this->atp_variable('slider'),
					'type'		=> 'multiselect'
			),
			array(
					'name'			=> __('Elastic Category','ATP_ADMIN_SITE'),
					'desc'		=> 'Select Slider Category to hold the posts from.',
					'id'		=> $prefix.'eislidercat',
					'class' 	=> 'page_slider eislider select300',
					'std'		=> '',
					'options' 	=> $this->atp_variable('slider'),
					'type'		=> 'multiselect'
			),
			array(
					'name'			=> __('NivoSlider Category','ATP_ADMIN_SITE'),
					'desc'		=> 'Select Slider Category to hold the posts from.',
					'id'		=> $prefix.'nivoslidercat',
					'class' 	=> 'page_slider nivoslider select300',
					'std'		=> '',
					'options' 	=> $this->atp_variable('slider'),
					'type'		=> 'multiselect'
			),

			array(
					'name'		=> __('Video Slider','ATP_ADMIN_SITE'),
					'desc'		=> 'Video Slider - Supports Custom Shortcodes too..',
					'id'		=> $prefix.'videoslider',
					'class' 	=> 'page_slider videoslider',
					'std'		=> '',
					'type'		=> 'textarea'
			),
			array(
					'name'		=> __('Static Image','ATP_ADMIN_SITE'),
					'desc'		=> 'Upload Image.',
					'id'		=> $prefix.'staticimage',
					'class' 	=> 'page_slider static_image',
					'std'		=> '',
					'type'		=> 'upload'
			),
			array(
					'name'		=> __('Image Link','ATP_ADMIN_SITE'),
					'desc'		=> 'Enter Image Link for the Static Slider Image (Optional)',
					'id'		=> $prefix.'cimage_link',
					'class' 	=> 'page_slider static_image',
					'std'		=> '',
					'type'		=> 'text'
			),

			array(
					'name'		=> __(' Title','ATP_ADMIN_SITE'),
					'desc'		=> 'Enter Title for the Static Slider Image (Optional)',
					'id'		=> $prefix.'cimage_title',
					'class' 	=> 'page_slider static_image',
					'std'		=> '',
					'type'		=> 'text'
			),
			
			array(
					'name'		=> __(' Open link in a new window/tab','ATP_ADMIN_SITE'),
					'desc'		=> 'Check this if you wish to Open link in a new window/tab',
					'id'		=> $prefix.'target_link',
					'class' 	=> 'page_slider static_image',
					'std'		=> '',
					'type'		=> 'checkbox'
			),

			array(
					'name'		=> __('Custom Slider','ATP_ADMIN_SITE'),
					'desc'		=> 'Use in Your custom slider Plugin shortcodes Example:[revslider id="1"].',
					'id'		=> $prefix.'customslider',
					'class' 	=> 'page_slider customslider',
					'std'		=> '',
					'type'		=> 'textarea'
			),

			// C U S T O M   S U B H E A D E R   T E A S E R 
			//--------------------------------------------------------
			array(
					'name'		=> __('Subheader Options','ATP_ADMIN_SITE'),
					'desc'		=> 'Select the Teaser type you wish to display in subheader of the this Post/Page',
					'id'		=> $prefix . 'subheader_teaser_options',
					'std'		=> '',
					'class'		=> 'select300',
					'type'		=> 'select',
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
			// Subheader Text Color
			//--------------------------------------------------------
			array(
					'name'		=> __('Subheader Text Color','ATP_ADMIN_SITE'),
					'desc'		=> 'Select the color for the content in the subheader',
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
					'name'		=> __('Custom Sidebar','ATP_ADMIN_SITE'),
					'desc'		=> 'Select the Sidebar you wish to assign for this page.',
					'id'		=> $prefix . 'custom_widget',
					'type'		=> 'customselect',
					'std'		=> '',
					'class'		=> 'select300',					
					'options'=> $sidebarwidget
			),
			// L A Y O U T   O P T I O N S 
			//--------------------------------------------------------
			array(
					'name'		=> __('Sidebar Option','ATP_ADMIN_SITE'),
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
		)
	);
?>