<?php
function atp_musicevents ($atts, $content = null,$code) {
	extract(shortcode_atts(array(
		'cat'			=> '',
		'limit'			=> '-1',
		'style'			=> '',
		'postid'		=> '',
		'sorting'		=> 'past_events',
		'pagination'	=> ''
	), $atts));
	//Event Image Sizes
	$width='200'; 
	$height = '140';
	//$out = '';

	if ( get_query_var('paged') ) { 
		$paged = get_query_var('paged'); 
	} elseif ( get_query_var('page') ) { 
		$paged = get_query_var('page');
	}else {
		$paged = 1;
	}

	global $post;	
	$out='';
	if( $sorting == 'past_events'){
		$query = array(
			'post_type' 	=> 'events',
			'meta_key' 		=> 'event_date',
			'orderby' 		=> 'event_date',
			'tax_query' => array(
				'relation' => 'OR',
			),
			'posts_per_page'=> $limit, 
			'paged' 		=> $paged,
			'meta_query' 	=> array(
            'relation' 		=> 'AND',
            array(
                'key' 		=> 'event_date',
                'value' 	=> time(),
                'compare' 	=> '<'),)
		);
		if( $cat !=''){
			$tax_cat =	array(
				'taxonomy' 		=> 'events_cat',
				'field' 		=> 'slug',
				'terms' 		=> $cat
			);
			array_push( $query['tax_query'],$tax_cat );
		}
		query_posts($query);
	
	if (have_posts()) : while (have_posts()) : the_post();
		$eventdate 			= get_post_meta($post->ID, 'event_date', true);
		
		if($eventdate  !=''){
			$event_date			= date_i18n('M-d-Y', $eventdate);
			$date_event			= explode( '-', $event_date );
		}
		$permalink	= get_permalink( get_the_id() );
		$out .=show($post->ID,$width,$height,$style,$sorting);
		endwhile;
		if($pagination == 'true') { atp_pagination(); }
		$out .='<div class="clear"></div>';
	
		else :
		 $out .= __('No Events are currently listed','THEME_FRONT_SITE');     
		endif; 
		wp_reset_query();
	}
	if( $sorting == 'upcoming_events' ){
		$query = array(
			'post_type' 	=> 'events',
			'meta_key' 		=> 'event_date',
			'orderby' 		=> 'event_date',
			'order'    		=> 'ASC',
			'tax_query' => array(
						 'relation' => 'OR',
					),
			'posts_per_page'=> $limit, 
			'paged' 		=> $paged,
			'meta_query' 	=> array(
            'relation' 		=> 'AND',
            array(
                'key' 		=> 'event_date',
               	'value' 	=> time() - (time() % 86400),
                'compare' 	=> '>='),)
		);
	if( $cat !='' ){
		$tax_cat =	array(
			'taxonomy' 		=> 'events_cat',
			'field' 		=> 'slug',
			'terms' 		=> $cat,	
		);
		array_push( $query['tax_query'],$tax_cat );
	}
	query_posts( $query ); //get the results
	if( have_posts()) : while(have_posts()) : the_post();
		$eventdate 			= get_post_meta($post->ID, 'event_date', true);
		$event_status		= get_post_meta($post->ID, 'event_status', true);
		$atp_venue			= get_option('atp_venue') ? get_option('atp_venue') : 'Venue';
		$atp_location		= get_option('atp_location') ? get_option('atp_location') : 'Location';
		$atp_event_status	= get_option('atp_event_status') ? get_option('atp_event_status') : 'Status';
		$img_alt_title 		= get_the_title();
		if( $eventdate  !='' ){
			$event_date			= date_i18n('M-d-Y', $eventdate);
			$date_event			= explode( '-', $event_date );
		}
		$out .=show($post->ID,$width,$height,$style,$sorting);	
		endwhile;
		if($pagination == 'true') { atp_pagination(); }
		$out .='<div class="clear"></div>';
			else :
		 $out .= __('No Events are currently listed','THEME_FRONT_SITE');   
		endif; 
		wp_reset_query();
		
	}
	if( $sorting == 'postids' ) {
		
		if($postid!=''){
		$postid_array = array();
		$postid_array = explode(',',$postid);
			$query = array(
				'post_type'	=> 'events', 
				'post__in'	=> $postid_array,
				'showposts'	=> $limit
			);
		}else{
			$query = array(
				'post_type'	=> 'events', 
				'showposts'	=> $limit
			);
		}
		query_posts($query);
		
		if(have_posts()) : while(have_posts()) : the_post();
			$eventdate 			= get_post_meta($post->ID, 'event_date', true);
				if($eventdate  !=''){
					$event_date			= date_i18n('M-d-Y', $eventdate);
					$date_event			= explode( '-', $event_date );
				}
				$out .=show($post->ID,$width,$height,'style2');
				
		endwhile;
		if(!function_exists('atp_pagination')){
			if($pagination == 'true') { atp_pagination(); }
		}
		$out .='<div class="clear"></div>';
		
		else :
		 $out .= __('No Events are currently listed','THEME_FRONT_SITE');    
		endif; 
		wp_reset_query();
	}
	return $out;

}

function show($postid,$width,$height,$style,$sorting)
{

		$out ='';
		$event_venue		= get_post_meta( $postid, 'event_venue', true );
		$event_location  	= get_post_meta( $postid, 'event_location', true ); 
		$event_status		= get_post_meta($postid, 'event_status', true);
		$atp_venue			= get_option('atp_venue') ? get_option('atp_venue') : 'Venue';
		$atp_location		= get_option('atp_location') ? get_option('atp_location') : 'Location';
		$atp_event_status	= get_option('atp_event_status') ? get_option('atp_event_status') : 'Status';
		$img_alt_title 		= get_the_title();
		$eventdate 			= get_post_meta($postid, 'event_date', true);
		$permalink			= get_permalink( $postid );
		$event_timeslider 	= get_post_meta( $postid, 'event_timeslider', true );
		$event_starttime 	= isset($event_timeslider['starttime']) ? $event_timeslider['starttime'] :'';
		$time_in_24_hour_format  = date("H:i", strtotime($event_starttime));
		$event_time 			 =preg_replace('/:/',',', $time_in_24_hour_format);
		
		if($eventdate  !=''){
			$event_date			= date_i18n('M-d-Y', $eventdate);
			$date_event			= explode( '-', $event_date );
		}
			
		/*----------------------------------------------*/
		if( $style == 'style2' ){
			
			
			$out .= '<div class="event_wwrap">';
			$out .='<div class="event-meta">';
			if ( isset( $event_date ) && $event_date != '' ) {
				$out .= '<span class="month">'.$date_event['0'].'</span>';
				$out .= '<span class="day">'.$date_event['1'].'</span>';
				$out .= '<span class="year">'.$date_event['2'].'</span>';
			} 
			$out .='</div>';
			$out .='<div class="event-content">';
			$out .='<h4 class="entry-title"><a href="'.get_permalink().'" rel="bookmark" >'.get_the_title().'</a></h4>';
			$out .='<div class="event_info">';
			
			if ( $event_venue ) { $out .= '<p><strong>'. $event_venue .'</strong></p>'; }

			if ( isset( $event_status ) && $event_status != '' ) {
				$out .='<span class="etick-status">'. $event_status .'</span>';
			}
			$out .= '</div>';
			$out .= '</div>';
			$out .= '<div class="clear"></div>';
			if ( $sorting == 'upcoming_events' ){
				if ( $eventdate  != '' ){
					$countdown_date  = date_i18n('m/d/Y', $eventdate);
					$countdown_event = explode( '/', $countdown_date );
				}
			
				$month  = $countdown_event['0'];
				$day    = $countdown_event['1'];
				$year   = $countdown_event['2'];
				$hour  = '00';
				$minute = '00';
				$second = '00';

				$out .='<script type="text/javascript">
					jQuery(function($) {
						var endDate = "'.$month.' '.$day.' '.$year.' '.$hour.':'.$minute.':'.' '.$second.'";
						enddate = new Date('.$year.' , '.$month.'-1 , '.$day.','.$event_time.',0,0);
						$("#iva-countdown-'.$postid.'").countdown({
							until: enddate, 
							format: "dHMS",
							padZeroes: true,
							labels:["Years","Months","Weeks","Days","Hours","Minutes","Seconds"],
							labels1:["Year","Month","Week","Day","Hour","Minute","Second"]
						});
					});
				</script>';
				$out .='<div id="iva-countdown-'.$postid.'"></div>';
			}


			$out .= '</div>';

		}else{
			
			$out .='<div class="events-list">';
			
			if( has_post_thumbnail($postid)){ 
				$out .= '<div class="event_thumb">';
				$out .='<div class="event_thumb"><a href="'.get_permalink().'" >'.atp_resize( $postid, '', $width, $height, '', $img_alt_title ).'</a></div>';
				$out .= '</div>';	
			}				
			$out .='<div class="event_entry"><div class="event_details">';
			$out .= '<div class="event-meta">';
			if ( isset( $event_date ) && $event_date != '' ){
			$out .='<span class="month">'.$date_event['0'].'</span><span class="day">'.$date_event['1'].'</span><span class="year">'.$date_event['2'].'</span>';
			}
			$out .='</div>';
			$out .= '<div class="event-content"><h2 class="entry-title"><a href="' .$permalink. '">'.get_the_title().'</a></h2>';
			$out .=	'<div class="event_info">';
			if ( $event_venue ) { 
				$out .=	'<p><span>'.$atp_venue.'</span>'.$event_venue .'</p>'; 
			} 
			if ( $event_location ) { 
				$out .=	'<p><span>'.$atp_location.'</span>'.$event_location .'</p>'; 
			} 
			if ( $event_status != '' ) { 
				$out .=	'<p><span>'.$atp_event_status.'</span>'.$event_status .'</p>'; 
			} 
			$out .='</div>';
			$out .='</div>';
			$out .='</div>';
			$out .='</div>';
			if ( $sorting == 'upcoming_events' ){
				if ( $eventdate  != '' ){
					$countdown_date  = date_i18n('m/d/Y', $eventdate);
					$countdown_event = explode( '/', $countdown_date );
				}
			
				$month  = $countdown_event['0'];
				$day    = $countdown_event['1'];
				$year   = $countdown_event['2'];
				$hour  = '00';
				$minute = '00';
				$second = '00';

				$out .='<script type="text/javascript">
					jQuery(function($) {
						var endDate = "'.$month.' '.$day.' '.$year.' '.$hour.':'.$minute.':'.'00";
						enddate = new Date('.$year.' , '.$month.'-1 , '.$day.','.$event_time.',0,0);
						$("#iva-countdown-'.$postid.'").countdown({
							until: enddate, 
							format: "DHMS",
							padZeroes: true,
							labels:["Years","Months","Weeks","Days","Hours","Minutes","Seconds"],
							labels1:["Year","Month","Week","Day","Hour","Minute","Second"]
						});
					});
				</script>';
				$out .='<div id="iva-countdown-'.$postid.'"></div>';
			}
			$out .='</div><div class="demo-space"></div>';
			
		}
	return $out;

}
add_shortcode('musicevents','atp_musicevents'); //add shortcode
?>