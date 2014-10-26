<?php
/*
	 * Add new taxonomy, NOT hierarchical (like tags)
	 * taxonomy = genres
	 * object type = albums (Name of the object type for the taxonomy object)
	 */

	add_action('init', 'create_albumspost_type');

	function create_albumspost_type() {

		$labels = array(
			'name'				=> __('Albums','ATP_ADMIN_SITE'),
			'singular_name'		=> __('Albums','ATP_ADMIN_SITE'),
			'add_new'			=> __('Add New Album', 'ATP_ADMIN_SITE'),
			'add_new_item'		=> __('Add New Album','ATP_ADMIN_SITE'),
			'edit_item'			=> __('Edit Album','ATP_ADMIN_SITE'),
			'new_item'			=> __('New Item','ATP_ADMIN_SITE'),
			'view_item'			=> __('View Album Item','ATP_ADMIN_SITE'),
			'search_items'		=> __('Search Album Item','ATP_ADMIN_SITE'),
			'not_found'			=> __('Nothing found','ATP_ADMIN_SITE'),
			'not_found_in_trash'=> __('Nothing found in Trash','ATP_ADMIN_SITE'),
			'parent_item_colon'	=> '',
			'all_items' 		=> __( 'All Albums','ATP_ADMIN_SITE'),
		);

		$atp_album_slug = get_option('atp_album_slug') ? get_option('atp_album_slug') :'album';

		$args = array(
			'labels'				=> $labels,
			'public'				=> true,
			'exclude_from_search'	=> false,
			'show_ui'				=> true,
			'capability_type'		=> 'post',
			'hierarchical'			=> false,
			'rewrite'				=> array('slug'=> $atp_album_slug, 'with_front' => true ),
			'query_var'				=> false,
			'menu_position'			=> null,
			'menu_icon'				=> THEME_URI . '/musicband/images/audio-icon.png',  
			'supports'				=> array('title','thumbnail', 'page-attributes','editor','comments'),
			'taxonomies' 			=> array('genres','label')
		); 
		register_post_type( 'albums' , $args );
	}


	register_taxonomy( 'genres', 'albums', array(
		'hierarchical'		=> true,
		'labels' => array(
			'name' 				=> __( 'Album Genres', 'taxonomy general name' ),
			'singular_name' 	=> __( 'Album Genres', 'taxonomy singular name' ),
			'search_items'		=> __( 'Search Albums Dates','ATP_ADMIN_SITE'),
			'parent_item'		=> __( 'Parent Albums ' ,'ATP_ADMIN_SITE'),
			'parent_item_colon'	=> __( 'Parent Albums :' ,'ATP_ADMIN_SITE'),
			'edit_item'			=> __( 'Edit Albums ','ATP_ADMIN_SITE'),
			'update_item'		=> __( 'Update Album Genres','ATP_ADMIN_SITE'),
			'add_new_item'		=> __( 'Add Album Genres','ATP_ADMIN_SITE'),
			'new_item_name'		=> __( 'New Album Dates ','ATP_ADMIN_SITE'),
			'albums_name'		=> __( 'Album Genres' ,'ATP_ADMIN_SITE'),
		),
		'show_ui'			=> true,
		'query_var'			=> true,
		'show_ui'			=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'genres' ),
		'sort' 				=> true,
		'args' 				=> array( 'orderby' => 'menu_order' ),
		'has_archive' => true,

	));
		register_taxonomy( "label", 'albums', array(
		'hierarchical'		=> true,
		'labels' => array(
			'name' 				=> __( 'Album Labels', 'taxonomy general name' ),
			'singular_name' 	=> __( 'Album Labels', 'taxonomy singular name' ),
			'search_items'		=> __( 'Search Labels Dates','ATP_ADMIN_SITE'),
			'parent_item'		=> __( 'Parent Labels ' ,'ATP_ADMIN_SITE'),
			'parent_item_colon'	=> __( 'Parent Labels :' ,'ATP_ADMIN_SITE'),
			'edit_item'			=> __( 'Edit Labels ','ATP_ADMIN_SITE'),
			'update_item'		=> __( 'Update Albums Label','ATP_ADMIN_SITE'),
			'add_new_item'		=> __( 'Add Album Labels','ATP_ADMIN_SITE'),
			'new_item_name'		=> __( 'New Labels Dates ','ATP_ADMIN_SITE'),
			'albums_name'		=> __( 'Album Labels' ,'ATP_ADMIN_SITE'),
		),
		'show_ui'			=> true,
		'query_var'			=> true,
		'rewrite'			=> array( 'slug' => 'label' ),
		'sort' 				=> true,
		'args' 				=> array( 'orderby' => 'menu_order' ),
		'has_archive' => true,

	));
	global $columns;
	function albums_columns( $columns ) {
		$columns = array(
			'cb'			=> '<input type="checkbox" />',
			'title'			=> __('Title','ATP_ADMIN_SITE'),
			'release_date'	=> __('Release Date','ATP_ADMIN_SITE'),
			'genres'	=> __('Genres','ATP_ADMIN_SITE'),
			'album_id'	=> __('ID\'s','ATP_ADMIN_SITE'),
			'thumbnail'		=> __('Thumbnails','ATP_ADMIN_SITE'),
			'date'			=> __('Date','ATP_ADMIN_SITE'),
		);
		return $columns;
	}
	function manage_albums_columns( $name ) {
		global $wpdb, $wp_query,$post,$default_date;
		switch ( $name ) {
			case 'release_date':
					$release_date = get_post_meta( get_the_ID(),'audio_release_date',TRUE );
					if(is_numeric($release_date)){
						$release_date	= date($default_date, $release_date);
					}
					echo $release_date;
				break;
			case 'album_id':
					echo get_the_ID();
					break;
			case 'genres':
				echo get_the_term_list( $post->ID, 'genres', '', ',', '' );
				break;
			case 'thumbnail':
					echo the_post_thumbnail('thumbnail');
				break;
		}
	} 
	add_action('manage_albums_posts_custom_column', 'manage_albums_columns', 10, 2);
	add_filter('manage_edit-albums_columns', 'albums_columns');	
	add_filter("request", "audio_release_date_column_orderby" );
	function audio_release_date_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'audio_release_date' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'audio_release_date',
            'orderby' => 'meta_value_num'
        ) );
    }
    return $vars;
	}
?>