<?php

	/**
	 * Register Sidebars
	 */
	if(function_exists('register_sidebar')){

		// Default Sidebar 
		register_sidebar( array(
			'name'			=> __( 'Main Sidebar', 'ATP_ADMIN_SITE' ),
			'id'			=> 'defaultsidebar',
			'before_title'	=>'<h3 class="widget-title">',
			'after_title'	=>'</h3>',
			'before_widget'	=>'<aside id="%1$s" class="widget %2$s">',
			'after_widget'	=>'</aside><div class="clear"></div>',
		));

		
	}
	/**
	 * Custom Sidebars
	 */
	if(function_exists('register_sidebar')){

		/**
		 * Footer Column Widgets
		 *-----------------------------
		 */
		 // footer column1
		register_sidebar(array(
			'name'			=> 'Footer Column1',
			'id'			=> 'footercolumn1',
			'description'	=> __('Select only one widget which will appear on your Footer column1', 'ATP_ADMIN_SITE'),
			'before_widget'	=> '<aside id="%1$s" class="widget clearfix %2$s">',
			'after_widget'	=> '</aside>',
			'before_title'	=> '<h3 class="widget-title">',
			'after_title'	=> '</h3>',
		));
		// footer column2
		register_sidebar(array(
				'name'			=> 'Footer Column2',
				'id'			=> 'footercolumn2',
				'description'	=> __('Select only one widget which will appear on your Footer column2', 'ATP_ADMIN_SITE'),
				'before_widget'	=> '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'	=> '</aside>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>',
		));
		// footer column3
		register_sidebar(array(
				'name'			=> 'Footer Column3',
				'id'			=> 'footercolumn3',
				'description'	=> __('Select only one widget which will appear on your Footer column3', 'ATP_ADMIN_SITE'),
				'before_widget'	=> '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'	=> '</aside>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>',
		));
		// footer column4
		register_sidebar(array(
				'name'			=> 'Footer Column4',
				'id'			=> 'footercolumn4',
				'description'	=> __('Select only one widget which will appear on your Footer column4', 'ATP_ADMIN_SITE'),
				'before_widget'	=> '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'	=> '</aside>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>',
		));
		// footer column5
		register_sidebar(array(
				'name'			=> 'Footer Column5',
				'id'			=> 'footercolumn5',
				'description'	=> __('Select only one widget which will appear on your Footer column5', 'ATP_ADMIN_SITE'),
				'before_widget'	=> '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'	=> '</aside>',
				'before_title'	=> '<h3 class="widget-title">',
				'after_title'	=> '</h3>',
		));
		// footer column6
		register_sidebar(array(
				'name'			=> 'Footer Column6',
				'id'			=> 'footercolumn6',
				'description'	=> __('Select only one widget which will appear on your Footer column6', 'ATP_ADMIN_SITE'),
				'before_widget'	=> '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'	=> '</aside>',
				'before_title'	=> '<h3 class="widget-title"><span>',
				'after_title'	=> '</span></h3>',
		));
	}

	/**
	 * Custom Sidebar Widget
	 *
	 */
	if ( function_exists('register_sidebar') ) {
		$atp_template_custom_widget = get_option('atp_customsidebar');
		if(is_array($atp_template_custom_widget)) { 
			foreach ($atp_template_custom_widget as $page_name){
				if($page_name != "")
				register_sidebar(array(
					'name'			=> $page_name,
					'id'			=> 'sidebar-'.strtolower(preg_replace('/\s+/', '-', $page_name)),
					'before_widget'	=>'<aside id="%1$s" class="widget %2$s">',
					'after_widget'	=>'</aside>',
					'before_title'	=>'<h3 class="widget-title">',
					'after_title'	=>'</h3>',

				));
			}
		}
	}

	// Footer Widget Limits
	$footerwidgetcounts=get_option("atp_footerwidgetcount");
	if($footerwidgetcounts){
		if($footerwidgetcounts == '6') { $fclass="one_sixth";}
		if($footerwidgetcounts == '5') { $fclass="one_fifth";}
		if($footerwidgetcounts == '4') { $fclass="one_fourth";}
		if($footerwidgetcounts == '2') { $fclass="half_width";}
		if($footerwidgetcounts == '3') { $fclass="one_third";}
	}
	
?>