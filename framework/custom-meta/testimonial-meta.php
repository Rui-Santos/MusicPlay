<?php
	//T E S T I M O N I A L M E T A B O X.
	//----------------------------------------
	$prefix = '';
	$this->meta_box[] = array(
		'id'		=> 'Testimonial-meta-box',
		'title'		=> THEMENAME. ' Testimonial Options',
		'page'		=> array('testimonialtype'),
		'context'	=> 'normal',
		'priority'	=> 'core',
		'fields'	=> array(
			array(
				'name'	=> __('Image','ATP_ADMIN_SITE'),
				'desc'	=> 'Select the Image type/mode you wish to use either Gravatar or Custom Image.',
				'id'	=> $prefix . 'testimonial_image_option',
				'std'	=> 'gravatar',
				'class'	=> 'select300',
				'type'	=> 'select',
				'options'=> array(
								"gravatar"	=> "Gravatar",
								"customimage"	=>'Upload Picture')
			),
		
			// U P L O A D I M A G E 
			array(
				'name'	=> __(' Photo','ATP_ADMIN_SITE'),
				'desc'	=> 'Featured Image',
				'class'	=> 'testimonialoption customimage',
				'std'	=> '',
				'type'	=> 'labeltext',
			),
			// E M A I L 
			array(
				'name'	=> __('Email','ATP_ADMIN_SITE'),
				'desc'	=> 'Enter the email id which represents the photo and email ID of testimonial.',
				'id'	=> 'testimonial_email',
				'std'	=> '',
				'title'	=> 'Name',
				'type'	=> 'text',
			),
			// W E B S I T E N A M E
			//--------------------------------------------------------
			array(
				'name'	=> __('Website Name','ATP_ADMIN_SITE'),
				'desc'	=> 'Enter Website Name.',
				'id'	=> 'websitename',
				'std'	=> '',
				'title'	=> 'Website Name',
				'type'	=> 'text',
			),
			// W E B S I T E U R L
			//--------------------------------------------------------
			array(
				'name'	=> __('Website URL','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the Link URL you wish to display. excluding http',
				'id'	=> 'website_url',
				'std'	=> '',
				'title'	=> 'Website URL',
				'type'	=> 'text',
			),

			array(
				'name'	=> __('Open link in a new window/tab','ATP_ADMIN_SITE'),
				'desc'	=> 'Check this if you wish to Open link in a new window/tab.',
				'id'	=> $prefix.'target_link',
				'std' 	=> 'off',
				'type'	=> 'checkbox',
			),


		)
	);
?>