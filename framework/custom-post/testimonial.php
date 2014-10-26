<?php
	//Testimonial type
	//--------------------------------------------------------
	function testimonial_register() {
		$labels = array(
			'name'				=> __('Testimonials','ATP_ADMIN_SITE'),
			'singular_name'		=> __('Testimonials','ATP_ADMIN_SITE'),
			'add_new'			=> __('Add Testimonial', 'ATP_ADMIN_SITE'),
			'add_new_item'		=> __('Add Testimonial','ATP_ADMIN_SITE'),
			'edit_item'			=> __('Edit Testimonial','ATP_ADMIN_SITE'),
			'new_item'			=> __('New Item','ATP_ADMIN_SITE'),
			'view_item'			=> __('View Testimonial Item','ATP_ADMIN_SITE'),
			'search_items'		=> __('Search Testimonial Item','ATP_ADMIN_SITE'),
			'not_found'			=> __('Nothing found','ATP_ADMIN_SITE'),
			'not_found_in_trash'=> __('Nothing found in Trash','ATP_ADMIN_SITE'),
			'parent_item_colon'	=> '',
			'all_items' 		=>  __( 'All Testimonials' ,'ATP_ADMIN_SITE')
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
			'menu_icon'			=> THEME_URI . '/framework/admin/images/testimonial-icon.png',  		
			'supports'			=> array('page-attributes','editor','title','thumbnail')
		); 
		register_post_type( 'testimonialtype' , $args );
	}
	
	register_taxonomy("testimonial_cat", 'testimonialtype', array(
		'hierarchical'		=> true,
			'labels' 		=> array(
								'name' 				=> __( 'Testimonial Categories', 'taxonomy general name' ),
								'singular_name' 	=> __( 'Testimonials', 'taxonomy singular name' ),
								'search_items' 		=>  __( 'Search Testimonials','ATP_ADMIN_SITE'),
								'all_items' 		=> __( 'All Testimonials','ATP_ADMIN_SITE'),
								'parent_item' 		=> __( 'Parent Testimonials','ATP_ADMIN_SITE'),
								'parent_item_colon' => __( 'Parent Testimonials:','ATP_ADMIN_SITE'),
								'edit_item' 		=> __( 'Edit Testimonials','ATP_ADMIN_SITE'),
								'update_item' 		=> __( 'Update Testimonials','ATP_ADMIN_SITE'),
								'add_new_item' 		=> __( 'Add Testimonial Category','ATP_ADMIN_SITE'),
								'new_item_name' 	=> __( 'New Testimonials ','ATP_ADMIN_SITE'),
								'menu_name' 		=> __( 'Testimonial Categories','ATP_ADMIN_SITE'),
								),
		'show_ui'			=> true,
		'query_var'			=> true,
		'rewrite'			=> false,
	));
		
	add_action('init', 'testimonial_register');
	
	function testimonial_columns($columns) {


		$columns = array(
		    'cb'      		 	=> '<input type="checkbox" />',
		 	'title'       		=> __('Title','ATP_ADMIN_SITE'),
			'author'       		=> __('Author','ATP_ADMIN_SITE'),
		 	'testimonialcat'    => __('Categories','ATP_ADMIN_SITE'),
			'testimonial_email' => __('Email','ATP_ADMIN_SITE'),
		    'date'       		=> __('Date','ATP_ADMIN_SITE'),
		 	
		  );
		return $columns;
	}
	
	function manage_testimonial_columns($name) {
		global $post, $wp_query;
		switch ( $name ) {
			case 'testimonialcat':
							$terms = get_the_terms($post->ID, 'testimonial_cat');
							//If the terms array contains items... (dupe of core)
							if ( !empty( $terms ) ) {
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
		
			case 'testimonial_email':
							echo get_post_meta( get_the_ID(),'testimonial_email',TRUE );
							break;
		}
	}
	add_action( 'manage_posts_custom_column', 'manage_testimonial_columns', 10, 2 );
	add_filter( 'manage_edit-testimonialtype_columns', 'testimonial_columns' );
?>