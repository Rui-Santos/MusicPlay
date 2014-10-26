<?php
	/*
	 * Add new taxonomy, NOT hierarchical (like tags)
	 * taxonomy = djmix_type
	 * object type = djmix (Name of the object type for the taxonomy object)
	 */

	add_action('init', 'create_djmixpost_type');

	function create_djmixpost_type() {
		$labels = array(
			'name'				=> __('DJMix','ATP_ADMIN_SITE'),
			'singular_name'		=> __('ALL DJMix','ATP_ADMIN_SITE'),
			'add_new'			=> __('Add New DJMix', 'ATP_ADMIN_SITE'),
			'add_new_item'		=> __('Add New DJMix','ATP_ADMIN_SITE'),
			'edit_item'			=> __('Edit Djmix','ATP_ADMIN_SITE'),
			'new_item'			=> __('New Item','ATP_ADMIN_SITE'),
			'view_item'			=> __('View  Item','ATP_ADMIN_SITE'),
			'search_items'		=> __('Search  Item','ATP_ADMIN_SITE'),
			'not_found'			=> __('Nothing found','ATP_ADMIN_SITE'),
			'not_found_in_trash'=> __('Nothing found in Trash','ATP_ADMIN_SITE'),
			'parent_item_colon'	=> ''
		);

		$atp_djmix_slug = get_option('atp_djmix_slug') ? get_option('atp_djmix_slug') :'djmix';

		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'exclude_from_search'	=> false,
			'show_ui'				=> true,
			'capability_type'		=> 'post',
			'hierarchical'			=> false,
			'rewrite'           	=> array( 'slug' => $atp_djmix_slug ),
			'query_var'				=> false,
			'menu_position'			=> null,
			'menu_icon'				=> THEME_URI . '/musicband/images/djmix-icon.png',  
			'supports'				=> array('title','thumbnail', 'page-attributes'),
			'taxonomies' 			=> array('djmix_cat')
		); 
		register_post_type( 'djmix' , $args );
	}
	register_taxonomy( 'djmix_cat', 'djmix', array(
		'hierarchical'		=> true,
		'labels' => array(
			'name' 				=> __( 'Djmix Categories', 'taxonomy general name' ),
			'singular_name' 	=> __( 'Djmix Categories', 'taxonomy singular name' ),
			'search_items'		=> __( 'Search Djmix','ATP_ADMIN_SITE'),
			'parent_item'		=> __( 'Parent Djmix ' ,'ATP_ADMIN_SITE'),
			'parent_item_colon'	=> __( 'Parent Djmix :' ,'ATP_ADMIN_SITE'),
			'edit_item'			=> __( 'Edit Djmix ','ATP_ADMIN_SITE'),
			'update_item'		=> __( 'Update Djmix','ATP_ADMIN_SITE'),
			'add_new_item'		=> __( 'Add Djmix','ATP_ADMIN_SITE'),
			'new_item_name'		=> __( 'New Djmix','ATP_ADMIN_SITE'),
			'djmix_name'		=> __( 'Djmix Categories' ,'ATP_ADMIN_SITE'),
		),
		'show_ui'			=> true,
		'query_var'			=> true,
		'show_ui'			=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'djmix_cat' ),
		'sort' 				=> true,
		'args' 				=> array( 'orderby' => 'menu_order' ),
		'has_archive' => true,

	));
	
	global $columns;
	function djmix_columns( $columns ) {
		$columns = array(
			'cb'			=> '<input type="checkbox" />',
			'title'			=> __('Title','ATP_ADMIN_SITE'),
			'thumbnail'		=> __('Thumbnails','ATP_ADMIN_SITE'),
			'djmix_id'		=> __('ID\'s','ATP_ADMIN_SITE'),
			'djmix_cat'		=> __('Categories','ATP_ADMIN_SITE'),
			'date'			=> __('Date','ATP_ADMIN_SITE'),
		);
		return $columns;
	}
	function manage_djmix_columns( $name ) {
		global $wpdb, $wp_query,$post;
		switch ( $name ) {
			case 'thumbnail':
					echo the_post_thumbnail('thumbnail');
				break;
			case 'djmix_cat':
				$terms = get_the_terms($post->ID, 'djmix_cat');
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
			
			case 'djmix_id':
					echo get_the_ID();
				break;
		}
	} 
	add_action('manage_djmix_posts_custom_column', 'manage_djmix_columns', 10, 2);
	add_filter('manage_edit-djmix_columns', 'djmix_columns');
?>