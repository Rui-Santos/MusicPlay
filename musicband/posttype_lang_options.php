<?php
	global $post;
	//Events
	$atp_event_date			= get_option('atp_event_date') ? get_option('atp_event_date') : 'Date';
	$atp_starttime			= get_option('atp_starttime') ? get_option('atp_starttime') : 'Starts';
	$atp_endtime			= get_option('atp_endtime') ? get_option('atp_endtime') : 'Ends';
	$atp_venue				= get_option('atp_venue') ? get_option('atp_venue') : 'Venue';
	$atp_location			= get_option('atp_location') ? get_option('atp_location') : 'Location';
	$atp_event_ticket_text	= get_option('atp_event_ticket_text') ? get_option('atp_event_ticket_text') : 'Ticket';
	$atp_event_status		= get_option('atp_event_status') ? get_option('atp_event_status') : 'Status';
	$atp_event_alldays		= get_option('atp_event_alldays') ? get_option('atp_event_alldays') : 'All Days';

	//Artist
	$atp_artist_nickname_txt	= get_option('atp_artist_nickname_txt') ? get_option('atp_artist_nickname_txt'): 'Artist Name';
	$atp_artist_borndate_txt	= get_option('atp_artist_borndate_txt') ? get_option('atp_artist_borndate_txt') : 'Born Date';
	$atp_artist_birthdate_txt	= get_option('atp_artist_birthdate_txt') ? get_option('atp_artist_birthdate_txt') : 'Birth Date';
	$atp_artist_birthplace_txt	= get_option('atp_artist_birthplace_txt') ? get_option('atp_artist_birthplace_txt') : 'Birth Place';
	$atp_artist_genres_txt		= get_option('atp_artist_genres_txt') ? get_option('atp_artist_genres_txt') : 'Genres';
	$atp_artist_yearactive_txt	= get_option('atp_artist_yearactive_txt') ? get_option('atp_artist_yearactive_txt') : 'Year activate';
	$atp_artist_siteurl_txt		= get_option('atp_artist_siteurl_txt') ? get_option('atp_artist_siteurl_txt') : 'Website';
	$atp_artist_biography_txt	= get_option('atp_artist_biography_txt') ? get_option('atp_artist_biography_txt') : 'Biography';
	$atp_follow_social_txt	    = get_option('atp_follow_social_txt') ? get_option('atp_follow_social_txt') : 'Follow';

	//Album
	$atp_album_artistname_txt	= get_option('atp_album_artistname_txt') ? get_option('atp_album_artistname_txt') : 'Artist Name';
	$atp_album_releasedate_txt	= get_option('atp_album_releasedate_txt') ? get_option('atp_album_releasedate_txt') : 'Release Date';
	$atp_album_label_txt		= get_option('atp_album_label_txt') ? get_option('atp_album_label_txt') : 'Label';
	$atp_album_catid_txt		= get_option('atp_album_catid_txt') ? get_option('atp_album_catid_txt') : 'Catalog ID';
	$atp_album_genre_txt		= get_option('atp_album_genre_txt') ? get_option('atp_album_genre_txt') : 'Genres';

?>