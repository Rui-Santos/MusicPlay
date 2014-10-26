<?php
	/*
	 * Add new taxonomy, NOT hierarchical (like tags)
	 * taxonomy = gallery_type
	 * object type = gallery (Name of the object type for the taxonomy object)
	 */
	function create_gallerypost_type() {
	
		$labels = array(
			'name'				=> __('Gallery','ATP_ADMIN_SITE'),
			'singular_name'		=> __('ALL Gallery','ATP_ADMIN_SITE'),
			'add_new'			=> __('Add New Gallery', 'ATP_ADMIN_SITE'),
			'add_new_item'		=> __('Add New Gallery','ATP_ADMIN_SITE'),
			'edit_item'			=> __('Edit Gallery','ATP_ADMIN_SITE'),
			'new_item'			=> __('New Item','ATP_ADMIN_SITE'),
			'view_item'			=> __('View Gallery Item','ATP_ADMIN_SITE'),
			'search_items'		=> __('Search Gallery Item','ATP_ADMIN_SITE'),
			'not_found'			=> __('Nothing found','ATP_ADMIN_SITE'),
			'not_found_in_trash'=> __('Nothing found in Trash','ATP_ADMIN_SITE'),
			'parent_item_colon'	=> '',
			'all_items' 		=> __( 'All Galleries','ATP_ADMIN_SITE'),
		);

		$atp_gallery_slug = get_option('atp_gallery_slug') ? get_option('atp_gallery_slug') :'photos';

		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'exclude_from_search'	=> false,
			'show_ui'				=> true,
			'capability_type'		=> 'post',
			'hierarchical'			=> false,
			'rewrite'				=> array('slug' => $atp_gallery_slug, 'with_front' => true ),
			'query_var'				=> false,
			'menu_position'			=> null,
			'menu_icon'				=> THEME_URI . '/musicband/images/gallery-icon.png',   
			'supports'				=> array('title','thumbnail', 'page-attributes','editor','comments'),
			'taxonomies' 			=> array('gallery_type')
		); 
		register_post_type( 'gallery' , $args );
	}
	add_action('init', 'create_gallerypost_type');

	register_taxonomy( "gallery_type", 'gallery', array(
		'hierarchical'		=> true,
		'labels' => array(
			'name' 				=> __( 'Gallery Categories', 'taxonomy general name' ),
			'singular_name' 	=> __( 'Gallery Categories', 'taxonomy singular name' ),
			'search_items' 		=> __( 'Search Gallery','ATP_ADMIN_SITE'),
			'parent_item' 		=> __( 'Parent Gallery' ,'ATP_ADMIN_SITE'),
			'parent_item_colon' => __( 'Parent Gallery:' ,'ATP_ADMIN_SITE'),
			'edit_item' 		=> __( 'Edit Gallery','ATP_ADMIN_SITE'),
			'update_item' 		=> __( 'Update Gallery Category','ATP_ADMIN_SITE'),
			'add_new_item' 		=> __( 'Add Gallery Category','ATP_ADMIN_SITE'),
			'new_item_name' 	=> __( 'New Gallery ','ATP_ADMIN_SITE'),
			'gallery_name' 	    => __( 'Gallery Categories' ,'ATP_ADMIN_SITE'),
		),
		'show_ui'			=> true,
		'query_var'			=> true,
		'rewrite'			=> true,
		'sort' 				=> true,
		'args' 				=> array( 'orderby' => 'menu_order' ),
		'has_archive' => true,

	));
	global $columns;
	function gallery_columns( $columns ) {
		$columns = array(
			'cb'      		 => '<input type="checkbox" />',
			'title'      	 => __('Title','ATP_ADMIN_SITE'),
			'venue'          => __('Venue','ATP_ADMIN_SITE'),
			'gallery_type'   => __('Categories','ATP_ADMIN_SITE'),
			'gallery_id'	 => __('ID\'s','ATP_ADMIN_SITE'),
			'thumbnail'  	 => __('Thumbnails','ATP_ADMIN_SITE'),
		);
		return $columns;
	}
	function manage_gallery_columns( $name ) {
		global $wpdb, $wp_query,$post,$default_date;
		switch ( $name ) {
			case 'venue':
					echo get_post_meta( get_the_ID(),'gallery_venue',TRUE );
					break;
			case 'gallery_type':
				$terms = get_the_terms($post->ID, 'gallery_type');
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
			case 'gallery_id':
					echo get_the_ID();
					break;

			case 'thumbnail':
						echo the_post_thumbnail(array(100,100));
						break;
		}
	} 
	add_action('manage_gallery_posts_custom_column', 'manage_gallery_columns', 10, 2);
	add_filter('manage_edit-gallery_columns', 'gallery_columns');
?>