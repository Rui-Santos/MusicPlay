<?php
	
	add_filter('posttypelabel_options','atp_posttypelabel_options');
	function atp_posttypelabel_options( $iva_options ) {
	
	global $url, $shortname, $iva_options;
	
	//---------------------------------------------------------------------------------------------------
	$iva_options[] = array( 'name'	=> 'Event', 'desc' => '<h3>Events Localization</h3> Text translation for the Events Section.', 'type' => 'subsection');
	//---------------------------------------------------------------------------------------------------

	$iva_options[] = array( 'name'		=> 'Event Date',
						'desc'		=> 'Date text displays in Events single Page',
						'id'		=> $shortname.'_event_date',
						'std'		=> '',
						'type'		=> 'text',
						'inputsize'	=> '333');

	$iva_options[] = array( 'name'		=> 'Event Start Time',
						'desc'		=> 'Start Time displays in Events single Page',
						'id'		=> $shortname.'_starttime',
						'std'		=> '',
						'type'		=> 'text',
						'inputsize'	=> '333');

	$iva_options[] = array( 'name'		=> 'Event End Time',
						'desc'		=> 'End Time displays in Events single Page',
						'id'		=> $shortname.'_endtime',
						'std'		=> '',
						'type'		=> 'text',
						'inputsize'	=> '333');

	$iva_options[] = array( 'name'		=> 'Event Venue',
						'desc'		=> 'Venue text displays in Events single Page',
						'id'		=> $shortname.'_venue',
						'std'		=> '',
						'type'		=> 'text',
						'inputsize'	=> '333');

	$iva_options[] = array( 'name'		=> 'Event Location',
						'desc'		=> 'Location text displays in Events single Page',
						'id'		=> $shortname.'_location',
						'std'		=> '',
						'type'		=> 'text',
						'inputsize'	=> '333');

	$iva_options[] = array( 'name'		=> 'Event Status',
						'desc'		=> 'Location text displays as label in Events single Page',
						'id'		=> $shortname.'_event_status',
						'std'		=> '',
						'type'		=> 'text',
						'inputsize'	=> '333');

	//---------------------------------------------------------------------------------------------------
	$iva_options[] = array( 'name'	=> 'Artist', 'desc' => '<h3>Artist Options</h3> Text translation for the Artist Options text.', 'type' => 'subsection');
	//---------------------------------------------------------------------------------------------------


	$iva_options[] = array( 
		'name'		=> 'Artist Biography Text',
		'desc'		=> 'Artist Biography Text Name displays in artist single page',
		'id'		=> $shortname.'_artist_biography_txt',
		'std'		=> '',
		'type'		=> 'text',
		'inputsize'	=> '333'
	);

	$iva_options[] = array( 
		'name'		=> 'Artist Nick Name',
		'desc'		=> 'Artist nick/birth name displays in artist single page',
		'id'		=> $shortname.'_artist_nickname_txt',
		'std'		=> '',
		'type'		=> 'text',
		'inputsize'	=> '333'
	);

	$iva_options[] = array( 
		'name'		=> 'Artist Born Date',
		'desc'		=> 'Artist born date text displays in artist single page',
		'id'		=> $shortname.'_artist_borndate_txt',
		'std'		=> '',
		'type'		=> 'text',
		'inputsize'	=> '333'
	);

	$iva_options[] = array( 
		'name'		=> 'Artist Place of birth',
		'desc'		=> 'Artist place of birth displays in artist single page',
		'id'		=> $shortname.'_artist_birthplace_txt',
		'std'		=> '',
		'type'		=> 'text',
		'inputsize'	=> '333'
	);

	$iva_options[] = array( 
		'name'		=> 'Artist Geners',
		'desc'		=> 'Artist geners text displays in artist single page',
		'id'		=> $shortname.'_artist_genres_txt',
		'std'		=> '',
		'type'		=> 'text',
		'inputsize'	=> '333'
	);

	$iva_options[] = array( 
		'name'		=> 'Artist Year Active',
		'desc'		=> 'Artist year activate displays in artist single page',
		'id'		=> $shortname.'_artist_yearactive_txt',
		'std'		=> '',
		'type'		=> 'text',
		'inputsize'	=> '333'
	);

	$iva_options[] = array( 
		'name'		=> 'Artist Website Url',
		'desc'		=> 'Artist website url displays in artist single page',
		'id'		=> $shortname.'_artist_siteurl_txt',
		'std'		=> '',
		'type'		=> 'text',
		'inputsize'	=> '333'
	);

	//---------------------------------------------------------------------------------------------------
	$iva_options[] = array( 'name'	=> 'Album', 'desc' => '<h3>Album Options</h3> Text translation for the Album Options text.', 'type' => 'subsection');
	//---------------------------------------------------------------------------------------------------


	$iva_options[] = array( 
		'name'		=> 'Album Release Date',
		'desc'		=> 'Album release date text displays in album single Page',
		'id'		=> $shortname.'_album_releasedate_txt',
		'std'		=> '',
		'type'		=> 'text',
		'inputsize'	=> '333'
	);

	$iva_options[] = array( 
		'name'		=> 'Album Label',
		'desc'		=> 'Album label text displays as label in album single Page',
		'id'		=> $shortname.'_album_label_txt',
		'std'		=> '',
		'type'		=> 'text',
		'inputsize'	=> '333'
	);

	$iva_options[] = array( 
		'name'		=> 'Album Catalog ID',
		'desc'		=> 'Album catalog id text displays in album single Page',
		'id'		=> $shortname.'_album_catid_txt',
		'std'		=> '',
		'type'		=> 'text',
		'inputsize'	=> '333'
	);

	$iva_options[] = array( 
		'name'		=> 'Album Genre Music',
		'desc'		=> 'Album genre music text displays in album single Page',
		'id'		=> $shortname.'_album_genre_txt',
		'std'		=> '',
		'type'		=> 'text',
		'inputsize'	=> '333'
	);


	return $iva_options;
}
?>