<?php
	/*
	 * Add new taxonomy, NOT hierarchical (like tags)
	 * taxonomy = slider
	 * object type = slide (Name of the object type for the taxonomy object)
	 */
	function my_custom_slider() {
		$labels = array(
			'name'					=> __('Slider', 'ATP_ADMIN_SITE'),  
			'singular_name'			=> __('Slider', 'ATP_ADMIN_SITE'),  
			'add_new'				=> __('Add New Slide','ATP_ADMIN_SITE'),  
			'add_new_item'			=> __('Add New Slide','ATP_ADMIN_SITE'),  
			'edit_item'				=> __('Edit Slide','ATP_ADMIN_SITE'),  
			'new_item'				=> __('New Slide','ATP_ADMIN_SITE'),  
			'view_item'				=> __('View Slide','ATP_ADMIN_SITE'),  
			'search_items'			=> __('Search Slide','ATP_ADMIN_SITE'),  
			'not_found'				=> __('No Slider found','ATP_ADMIN_SITE'),  
			'not_found_in_trash'	=> __('No Slider found in Trash','ATP_ADMIN_SITE'),  
			'parent_item_colon'		=> '' ,
			'all_items' 			=>  __( 'All Sliders' ,'ATP_ADMIN_SITE')
		);  
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'exclude_from_search'=> false,
			'show_ui'			=> true,
			'capability_type'	=> 'post',
			'hierarchical'		=> false,
			'rewrite'			=> array( 'with_front' => false ),
			'query_var'			=> false,
			'menu_position'		=> null,
			'menu_icon'			=> THEME_URI . '/framework/admin/images/slider-icon.png',  
			'supports'			=> array('title', 'thumbnail', 'page-attributes')
		);  
	
		register_post_type('slider',$args);  
	}
	add_action('init', 'my_custom_slider');
		register_taxonomy("slider_cat", 'slider', array(
		'hierarchical'		=> true,
			'labels' => array(
							'name' 				=> __( 'Slider Categories', 'taxonomy general name' ),
							'singular_name' 	=> __( 'Sliders', 'taxonomy singular name' ),
							'search_items' 		=>  __( 'Search Slider','ATP_ADMIN_SITE'),
							'all_items' 		=> __( 'All Slider','ATP_ADMIN_SITE'),
							'parent_item' 		=> __( 'Parent Slider','ATP_ADMIN_SITE'),
							'parent_item_colon' => __( 'Parent Slider:','ATP_ADMIN_SITE'),
							'edit_item' 		=> __( 'Edit Slider','ATP_ADMIN_SITE'),
							'update_item' 		=> __( 'Update Sliders','ATP_ADMIN_SITE'),
							'add_new_item' 		=> __( 'Add Slider Category','ATP_ADMIN_SITE'),
							'new_item_name' 	=> __( 'New Slider ','ATP_ADMIN_SITE'),
							'menu_name' 		=> __( 'Slider Categories','ATP_ADMIN_SITE'),
						),
		'show_ui'			=> true,
		'query_var'			=> true,
		'rewrite'			=> false,
	));
	function slider_columns($columns) {
			$columns = array(
		    'cb'       		=> '<input type="checkbox" />',
		 	'title'       	=> __('Title','ATP_ADMIN_SITE'),
			'author'       	=> __('Author','ATP_ADMIN_SITE'),
			'thumbnail'    => __('Thumbnails','ATP_ADMIN_SITE'),
		 	'slider_cat'    => __('Categories','ATP_ADMIN_SITE'),
		    'date'       	=> __('Date','ATP_ADMIN_SITE'),
		 	
		  );
		return $columns;
	}
		
	function manage_slider_columns($name) {
		global $wpdb, $wp_query,$post;
		switch ($name) {
			case 'slider_cat':
						$terms = get_the_terms($post->ID, 'slider_cat');
						//If the terms array contains items... (dupe of core)
						if ( !empty($terms) ) {
							//Loop through terms
							foreach ( $terms as $term ){
								//Add tax name & link to an array
								$post_terms[] = esc_html(sanitize_term_field('name', $term->name, $term->term_id, '', 'edit'));
							}
							//Spit out the array as CSV
							echo implode( ', ', $post_terms );
						} else {
							//Text to show if no terms attached for post & tax
							echo '<em>No terms</em>';
						}
						break;
					case 'thumbnail':
						echo the_post_thumbnail(array(150,150));
							break;
		
		}
	}
	add_action( 'manage_slider_posts_custom_column', 'manage_slider_columns', 10, 2 );
	add_filter( 'manage_edit-slider_columns', 'slider_columns' );
?>