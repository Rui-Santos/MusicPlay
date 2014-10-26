<?php
	//E V E N T S   M E T A B O X 
	//--------------------------------------------------------
	$prefix = '';
	$sidebarwidget = get_option('atp_customsidebar');
	global $layout_option;
	$this->meta_box[] = array(
		'id'		=> 'events-meta-box',
		'title'		=> THEMENAME. ' Events Options',
		'page'		=> array('events'),
		'context'	=> 'normal',
		'priority'	=> 'high',
		'fields'	=> array(
			array(
				'name'	=> __('Events Date','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the text you wish to display in the Events Time element',
				'id'	=> 'event_date',
				'title'	=> 'Event &amp; Date',
				'std'	=> '',
				'type'	=> 'dateformat',
			),

			array(
				'name'	=> __('Event Time','ATP_ADMIN_SITE'),
				'desc'	=> 'Select the starttime, endtime and check all days you wish to display in the front end',
				'id'	=> 'event_timeslider',
				'title'	=> 'Start  &amp; Time',
				'std'	=> '',
				'type'	=> 'timeslider',
			),

			array(
				'name'	=> __('Event Venue','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the Venue or the place of the event which it will be organized.',
				'id'	=> 'event_venue',
				'title'	=> 'Event  &amp; Venue',
				'std'	=> '',
				'type'	=> 'textarea',
			),
			array(
				'name'	=> __('Event Location','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the address where the event is organized and the same address will be used to display the Google Map for the Event Location.',
				'id'	=> 'event_location',
				'title'	=> 'Event  &amp; Location',
				'std'	=> '',
				'type'	=> 'textarea',
			),
			array(
				'name'	=> __('Map Location','ATP_ADMIN_SITE'),
				'desc'	=> 'Type map longitude, lagitudes coordinates & seclect zoom, Tick the controller checkbox option if you want to display the controller option for zoom',
				'id'	=> 'event_maplocation',
				'title'	=> 'event &amp; maplocation',
				'std'	=> '',
				'type'	=> 'map_location',
			),

			array(
				'name'	=> __('Status','ATP_ADMIN_SITE'),
				'desc'	=> 'Type the status  you wish to display in the status element, For example: tickets available',
				'id'	=> 'event_status',
				'title'	=> 'End  &amp; Time',
				'std'	=> '',
				'type'	=> 'text',
			),

			// C U S T O M N E W M E T A 
			//--------------------------------------------------------
			array(
				'name'	=> __('Add New Meta','ATP_ADMIN_SITE'),
				'desc'	=> 'ex:&lt;span&gt;Some text&lt;/span&gt;&nbsp;Some Text&nbsp;',
				'id'	=> $prefix . 'custom_meta',
				'std'	=> '',
				'type'	=> 'newmeta'
			),

			array(
				'name'	=> __('Add buttons','ATP_ADMIN_SITE'),
				'desc'	=> 'Type button name and url,you wish to display on front page ',
				'id'	=> 'event_buttons',
				'title'	=> 'Buttons ',
				'std'	=> '',
				'type'	=> 'add_buttons',
			),

			array(
				'name'	=> __('Disable','ATP_ADMIN_SITE'),
				'desc'	=> 'Check this if you wish to disable above buttons',
				'id'	=> 'event_button_disable',
				'title'	=> 'End  &amp; Time',
				'std'	=> '',
				'type'	=> 'checkbox',
			),

			array( 
				'name'		=> 'Video Embed Code',
				'desc'		=> 'Enter the video embed code which will display on your event page.',
				'id'		=> 'event_video_content',
				'std'		=> '',
				'type'		=> 'textarea',
				'inputsize' => '' 
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
					'desc'		=> 'Upload the background image for this page. This will be applied only if the layout is boxed mode. Select Layout option from Options Panel > Styling - Layout Option',
					'id'		=> 'page_bg_image',
					'std'		=> '',
					'title'		=> 'Background Image',
					'type'		=> 'upload',
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