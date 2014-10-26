<?php
	//Events type
	//--------------------------------------------------------
	function events_register() {
		$labels = array(
			'name'				=> __('Events','ATP_ADMIN_SITE'),
			'singular_name'		=> __('Events','ATP_ADMIN_SITE'),
			'add_new'			=> __('Add New Event', 'ATP_ADMIN_SITE'),
			'add_new_item'		=> __('Add New Event','ATP_ADMIN_SITE'),
			'edit_item'			=> __('Edit Event','ATP_ADMIN_SITE'),
			'new_item'			=> __('New Event','ATP_ADMIN_SITE'),
			'view_item'			=> __('View Event','ATP_ADMIN_SITE'),
			'search_items'		=> __('Search Events','ATP_ADMIN_SITE'),
			'not_found'			=> __('Nothing found','ATP_ADMIN_SITE'),
			'not_found_in_trash'=> __('Nothing found in Trash','ATP_ADMIN_SITE'),
			'parent_item_colon'	=> '',
			'all_items' =>  __( 'All Events' ,'ATP_ADMIN_SITE')
		);
		$atp_events_slug = get_option('atp_events_slug') ?  get_option('atp_events_slug') : 'event';
		$args = array(
			'labels'			=> $labels,
			'public'			=> true,
			'exclude_from_search'=> false,
			'show_ui'			=> true,
			'capability_type'	=> 'post',
			'hierarchical'		=> false,
			'rewrite'				=> array('slug'=> $atp_events_slug, 'with_front' => true ),
			'query_var'			=> false,	
			'menu_icon'			=> THEME_URI . '/musicband/images/events-icon.png',
			'supports'			=> array('page-attributes','editor','title','thumbnail','comments'),
			'taxonomies'		=> array('event_cat')
		); 
		register_post_type( 'events' , $args );

	}
	
	register_taxonomy( 'events_cat', 'events', array(
		'hierarchical'		=> true,
		'labels' 			=> array(
								'name' 				=> __( 'Event Categories', 'taxonomy general name' ),
								'singular_name' 	=> __( 'Events', 'taxonomy singular name' ),
								'search_items' 		=> __( 'Search Events','ATP_ADMIN_SITE'),
								'all_items' 		=> __( 'All Events','ATP_ADMIN_SITE'),
								'parent_item' 		=> __( 'Parent Location','ATP_ADMIN_SITE'),
								'parent_item_colon' => __( 'Parent Events:','ATP_ADMIN_SITE'),
								'edit_item' 		=> __( 'Edit Events','ATP_ADMIN_SITE'),
								'update_item' 		=> __( 'Update Events','ATP_ADMIN_SITE'),
								'add_new_item' 		=> __( 'Add Event Category','ATP_ADMIN_SITE'),
								'new_item_name' 	=> __( 'New Event','ATP_ADMIN_SITE'),
								'menu_name' 		=> __( 'Event Categories','ATP_ADMIN_SITE'),
						),
		'show_ui'			=> true,
		'query_var'			=> true,
		'rewrite'			=> true,
	));
		
	add_action('init', 'events_register');
	
	function events_columns($columns) {



			$columns = array(
				'cb'      		 	=> '<input type="checkbox" />',
				'title'      	 => __('Title','ATP_ADMIN_SITE'),
				'eventdate'  	 => __('Event Date','ATP_ADMIN_SITE'),
				'events_cat'    => __('Categories','ATP_ADMIN_SITE'),
				'location'       => __('Location','ATP_ADMIN_SITE'),
				'venue'          => __('Venue','ATP_ADMIN_SITE'),
				'date'       	 => __('Date','ATP_ADMIN_SITE'),
		 	
		  );
	
	
		return $columns;
	}
	
	function manage_events_columns($name) {
		global $post, $wp_query,$default_date;
		switch ($name) {
			case 'events_cat':
				$terms = get_the_terms($post->ID, 'events_cat');
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
			case 'eventdate':
					if(get_post_meta(get_the_ID(), 'event_date', true) !=''){
						echo  date($default_date, get_post_meta(get_the_ID(), 'event_date', true));
					}
					//echo get_post_meta( get_the_ID(),'event_date',TRUE );
					break;	
			case 'location':
					echo get_post_meta( get_the_ID(),'event_location',TRUE );
					break;
			case 'venue':
					echo get_post_meta( get_the_ID(),'event_venue',TRUE );
					break;	
		}
	}
	add_action( 'manage_posts_custom_column', 'manage_events_columns', 10, 2 );
	add_filter( 'manage_edit-events_columns', 'events_columns' );
	add_filter("request", "event_date_column_orderby" );
	function event_date_column_orderby( $vars ) {
    if ( isset( $vars['orderby'] ) && 'event_date' == $vars['orderby'] ) {
        $vars = array_merge( $vars, array(
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num'
        ) );
    }
    return $vars;
}
?>