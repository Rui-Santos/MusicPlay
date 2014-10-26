<?php
	// S L I D E R   M E T A B O X 
	//--------------------------------------------------------
	$prefix = '';

	$this->meta_box[] = array(
		'id'		=> 'slider-meta-box',
		'title'		=> THEMENAME. ' Slider Options',
		'page'		=> array('slider'),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(

			array(
				'name'		=> 'Link for Slide Item',
				'id'		=> $prefix . 'postlinktype_options',
				'desc'		=> __('The url that the slide post is linked to','ATP_ADMIN_SITE'),
				'type'		=> 'select',
				'class'		=> 'select300',
				'std'		=>'nolink',
				'options' 	=>array(
							'linkpage'		=> 'Link to Page',
							'linktocategory'=> 'Link to Category', 
							'linktopost'	=> 'Link to Post',
							'linkmanually'	=> 'Link Manually',
							'nolink'		=> 'No Link'
					)	
			),
			
			array(
					'name'		=> __('Slider Page Link','ATP_ADMIN_SITE'),
					'desc'		=> 'Slider Page Link.',
					'id'		=> $prefix.'linkpage',
					'class' 	=> 'linkoption linkpage select300',
					'options' 	=>	$this->atp_variable('pages'),
					'std'		=> '',
					'type'		=> 'select'
			),
			array(
					'name'	=> __('Link Category for Slider','ATP_ADMIN_SITE'),
					'desc'	=> 'Slider Description..',
					'id'	=> $prefix.'linktocategory',
					'class' => 'linkoption linktocategory select300',
					'std'	=> '',
					'options' 	=>	$this->atp_variable('categories'),
					'type'	=> 'select'
			),
			array(
					'name'	=> __('Slider Post Link','ATP_ADMIN_SITE'),
					'desc'	=> 'Slider Description..',
					'id'	=> $prefix.'linktopost',
					'class' => 'linkoption linktopost select300',
					'std'	=> '',
					'options' 	=>	$this->atp_variable('postlink'),
					'type'	=> 'select'
			),
			array(
					'name'	=> __('Slider Link','ATP_ADMIN_SITE'),
					'desc'	=> 'Slider Description..',
					'id'	=> $prefix.'linkmanually',
					'class' => 'linkoption linkmanually select300',
					'std'	=> '',
					'type'	=> 'text'
			),

			array(
				'name'	=> __('Open link in a new window/tab','ATP_ADMIN_SITE'),
				'desc'	=> 'Check this if you wish to Open link in a new window/tab.',
				'id'	=> $prefix.'target_link',
				'class' => 'linkoption linkmanually',
				'std' 	=> 'off',
				'type'	=> 'checkbox',
			),
			
			
			array(
					'name'	=> __('Slider Description','ATP_ADMIN_SITE'),
					'desc'	=> 'Slider Description..',
					'id'	=> $prefix.'slider_desc',
					'class' => '',
					'std'	=> '',
					'type'	=> 'textarea'
			),
			array(
				'name'	=> __('Slider Description Disable','ATP_ADMIN_SITE'),
				'desc'	=> 'Check this if you wish to disable the Slider Description for this Slider.',
				'id'	=> $prefix.'desc_enable',
				'std' 	=> 'off',
				'type'	=> 'checkbox',
			),
		),
	);
?>