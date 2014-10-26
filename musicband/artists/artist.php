<?php
	/*
	 * Add new taxonomy, NOT hierarchical (like tags)
	 * taxonomy = artists_type
	 * object type = artists (Name of the object type for the taxonomy object)
	 */
	function create_artistpost_type() {
	
		$labels = array(
			'name'				=> __('Artist','ATP_ADMIN_SITE'),
			'singular_name'		=> __('ALL Artist','ATP_ADMIN_SITE'),
			'add_new'			=> __('Add New Artist', 'ATP_ADMIN_SITE'),
			'add_new_item'		=> __('Add New Artist','ATP_ADMIN_SITE'),
			'edit'				=> __('Edit Artist','ATP_ADMIN_SITE'),
			'edit_item'			=> __('Edit Artist','ATP_ADMIN_SITE'),
			'new_item'			=> __('New Artist','ATP_ADMIN_SITE'),
			'view'				=> __('View Artist','ATP_ADMIN_SITE'),
			'view_item'			=> __('View Artist','ATP_ADMIN_SITE'),
			'search_items'		=> __('Search Artists','ATP_ADMIN_SITE'),
			'not_found'			=> __('Nothing found','ATP_ADMIN_SITE'),
			'not_found_in_trash'=> __('Nothing found in Trash','ATP_ADMIN_SITE'),
			'parent_item_colon'	=> '',
			'all_items' 		=> __( 'All Artists','ATP_ADMIN_SITE'),
		);

		$atp_artist_slug = get_option('atp_artist_slug') ? get_option('atp_artist_slug') : 'artist';

		$args = array(
			'labels'				=> $labels,
			'description' 			=> 'Placeholder for all the Artists',
			'public'				=> true,
	        'publicly_queryable' 	=> true,
			'exclude_from_search'	=> false,
			'show_ui'				=> true,
			'capability_type'		=> 'post',
			'hierarchical'			=> false,
			'rewrite'				=> array('slug'=>$atp_artist_slug,'with_front'=>'true'),
			'query_var'				=> true,
			'menu_position'			=> null,
			'menu_icon'				=> THEME_URI . '/musicband/images/artist-icon.png',  
			'supports'				=> array('title','thumbnail', 'page-attributes','editor','comments'),
			'taxonomies' 			=> array('artist_cat')		
		); 
		register_post_type( 'artists' , $args );
	}
	add_action('init', 'create_artistpost_type');
	register_taxonomy( 'artist_cat', 'artists', array(
		'hierarchical'		=> true,
		'labels' => array(
			'name' 				=> __( 'Artists Category', 'taxonomy general name' ),
			'singular_name' 	=> __( 'Artists', 'taxonomy singular name' ),
			'search_items'		=> __( 'Search Artists','ATP_ADMIN_SITE'),
			'parent_item'		=> __( 'Parent Artists ' ,'ATP_ADMIN_SITE'),
			'parent_item_colon'	=> __( 'Parent Artists :' ,'ATP_ADMIN_SITE'),
			'edit_item'			=> __( 'Edit Artists ','ATP_ADMIN_SITE'),
			'update_item'		=> __( 'Update Artists','ATP_ADMIN_SITE'),
			'add_new_item'		=> __( 'Add Artists','ATP_ADMIN_SITE'),
			'new_item_name'		=> __( 'New Artists','ATP_ADMIN_SITE'),
			'albums_name'		=> __( 'Artist categories' ,'ATP_ADMIN_SITE'),
		),
		'show_ui'			=> true,
		'query_var'			=> true,
		'show_ui'			=> true,
		'query_var'			=> true,
		'rewrite'			=> true,
		'sort' 				=> true,
		'args' 				=> array( 'orderby' => 'menu_order' ),
		'has_archive' => true,

	));
	global $columns;
	function artists_columns( $columns ) {
		$columns = array(
			'cb'      		 => '<input type="checkbox" />',
			'title'      	 => __('Title','ATP_ADMIN_SITE'),
			'artist_cat'		 => __('Categories','ATP_ADMIN_SITE'),
			'genres'		 => __('Genres','ATP_ADMIN_SITE'),
			'thumbnail'  	 => __('Thumbnails','ATP_ADMIN_SITE'),
			'artist_id'		 => __('ID\'s','ATP_ADMIN_SITE'),
			'date'       	 => __('Date','ATP_ADMIN_SITE'),
		);
		
		return $columns;
	}
	function manage_artists_columns( $name ) {
		global $wpdb, $wp_query,$post;
		switch ( $name ) {
			case 'genres':
						echo get_post_meta( get_the_ID(),'artist_genres',TRUE );
						break;
			case 'artist_id':
						echo get_the_ID();
						break;
			case 'artist_cat':
				$terms = get_the_terms($post->ID, 'artist_cat');
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
						echo the_post_thumbnail(array(100,100));
						break;			
		}
	} 
	add_action('manage_artists_posts_custom_column', 'manage_artists_columns', 10, 2);
	add_filter('manage_edit-artists_columns', 'artists_columns');	
?>