<?php
	/*
	 * Add new taxonomy, NOT hierarchical (like tags)
	 * taxonomy = video_type
	 * object type = video (Name of the object type for the taxonomy object)
	 */
	function create_videopost_type() {
		$labels = array(
			'name'				=> __('Video','ATP_ADMIN_SITE'),
			'singular_name'		=> __('ALL Video','ATP_ADMIN_SITE'),
			'add_new'			=> __('Add New Video', 'ATP_ADMIN_SITE'),
			'add_new_item'		=> __('Add New Video','ATP_ADMIN_SITE'),
			'edit_item'			=> __('Edit Video','ATP_ADMIN_SITE'),
			'new_item'			=> __('New Item','ATP_ADMIN_SITE'),
			'view_item'			=> __('View Video Item','ATP_ADMIN_SITE'),
			'search_items'		=> __('Search Video Item','ATP_ADMIN_SITE'),
			'not_found'			=> __('Nothing found','ATP_ADMIN_SITE'),
			'not_found_in_trash'=> __('Nothing found in Trash','ATP_ADMIN_SITE'),
			'parent_item_colon'	=> '',
			'all_items' 		=> __( 'All Videos','ATP_ADMIN_SITE'),
		);
		$atp_video_slug = get_option('atp_video_slug') ? get_option('atp_video_slug') :'videos';
		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'exclude_from_search'	=> false,
			'show_ui'				=> true,
			'capability_type'		=> 'post',
			'hierarchical'			=> false,
			'rewrite'				=> array( 'slug'=> $atp_video_slug,'with_front' => false ),
			'query_var'				=> false,
			'menu_position'			=> null,
			'menu_icon'				=> THEME_URI . '/musicband/images/video-icon.png',   
			'supports'				=> array('title','thumbnail', 'page-attributes','editor','comments'),
			'taxonomies' 			=> array('video_type')
		); 
		register_post_type( 'video' , $args );
	}
	add_action('init', 'create_videopost_type');
	register_taxonomy( "video_type", 'video', array(
		'hierarchical'		=> true,
		'labels' => array(
			'name' 				=> __( 'Video  Category', 'taxonomy general name' ),
			'singular_name' 	=> __( 'Video  Category', 'taxonomy singular name' ),
			'search_items' 		=> __( 'Search Video Dates','ATP_ADMIN_SITE'),
			'parent_item' 		=> __( 'Parent Video Dates' ,'ATP_ADMIN_SITE'),
			'parent_item_colon' => __( 'Parent Video Dates:' ,'ATP_ADMIN_SITE'),
			'edit_item' 		=> __( 'Edit Video Dates','ATP_ADMIN_SITE'),
			'update_item' 		=> __( 'Update Video Dates Category','ATP_ADMIN_SITE'),
			'add_new_item' 		=> __( 'Add Video Category','ATP_ADMIN_SITE'),
			'new_item_name' 	=> __( 'New Video Dates ','ATP_ADMIN_SITE'),
			'gallery_name' 	    => __( 'Video Category' ,'ATP_ADMIN_SITE'),
		),
		'show_ui'			=> true,
		'query_var'			=> true,
		'rewrite'			=> true,
		'sort' 				=> true,
		'args' 				=> array( 'orderby' => 'menu_order' ),
		'has_archive' => true,

	));
	
	
	global $columns;
	function video_columns( $columns ) {
		$columns = array(
			'cb'			 => '<input type="checkbox" />',
			'title'      	 => __('Title','ATP_ADMIN_SITE'),
			'venue'        	 => __('Venue','ATP_ADMIN_SITE'),
			'video_type'   => __('Categories','ATP_ADMIN_SITE'),
			'thumbnail'  	 => __('Thumbnails','ATP_ADMIN_SITE'),
			'video_id'	=> __('ID\'s','ATP_ADMIN_SITE')
		);
		return $columns;
	}
	function manage_video_columns( $name ) {
		global $wpdb, $wp_query,$post,$default_date;
		switch ( $name ) {
			case 'venue':
					echo get_post_meta( get_the_ID(),'video_venue',TRUE );
					break;
			case 'video_id':
					echo get_the_ID();
					break;
			case 'video_type':
				$terms = get_the_terms($post->ID, 'video_type');
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
	add_action('manage_video_posts_custom_column', 'manage_video_columns', 10, 2);
	add_filter('manage_edit-video_columns', 'video_columns');	
?>