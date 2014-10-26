<?php
/**
 * Plugin Name: Events Widget
 * Description: A widget used for displaying Events.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
	// Register Widget 
	function events_widgets() {
		register_widget( 'events_widget' );
	}

	// Define the Widget as an extension of WP_Widget
	class events_widget extends WP_Widget {

		function events_widget() {
			
			/* Widget settings. */
			$widget_ops = array( 
				'classname'		=> 'Events-wg',
				'description'	=> __('Events widget for sidebar.', 'ATP_ADMIN_SITE')
			);
	
			/* Widget control settings. */
			$control_ops = array(
				'width'		=> 300,
				'height'	=> 350,
				'id_base'	=> 'events_widget'
			);

			/* Create the widget. */
			$this->WP_Widget( 'events_widget',THEMENAME.' - Events', $widget_ops, $control_ops );
		}

		// outputs the content of the widget
		function widget( $args, $instance ) {
			extract( $args );

			$title = $instance['title'];
			$eventorder = $instance['events_order'] ? $instance['events_order'] :'upcomeing';
			$event_limit=$instance['event_limit'] ? $instance['event_limit'] :'3';
			echo $before_widget;
			if ($title) {
				$eventtitle=$before_title.$title.$after_title;
			}
			global $post;
			$out = $sorting = '';	
			if( $eventorder == 'past'){
			$query = array(
				'post_type' 	=> 'events',
				'meta_key' 		=> 'event_date',
				'orderby' 		=> 'event_date',
				'posts_per_page'=> $event_limit, 
				'meta_query' 	=> array(
				'relation' 		=> 'AND',
			    array(
				'key' 		=> 'event_date',
				'value' 	=> time() - (time() % 86400),
				'compare' 	=> '<'),)
				);
			$posts=query_posts($query);
			$out .=$eventtitle;
			if(have_posts()) : while(have_posts()) : the_post();
			$out .= $this->atp_dateorder($post->ID,$sorting);
			endwhile;
			$out .='<div class="clear"></div>';
			else : 
			$out .= __( 'No Events are currently listed', 'musicplay' );
			endif; 
			echo $out;
			wp_reset_query(); 
		}
		if( $eventorder == 'upcomeing'){
			$query = array(
				'post_type' 	=> 'events',
				'meta_key' 		=> 'event_date',
				'orderby' 		=> 'event_date',
				'order'			=> 'ASC',	
				'tax_query' => array(
				'relation' => 'OR',
			),
				'posts_per_page'=> $event_limit, 
				'meta_query' 	=> array(
				'relation' 		=> 'AND',
			    array(
				'key' 		=> 'event_date',
				'value' 	=> time() - (time() % 86400),
				'compare' 	=> '>='),)
				);
			$posts=query_posts($query);
			$out .=$eventtitle;
			if(have_posts()) : while(have_posts()) : the_post();
			$out .= $this->atp_dateorder($post->ID,$eventorder);
			endwhile;
			$out .='<div class="clear"></div>';
			else : 
			$out .= __( 'No Events are currently listed', 'musicplay' );
			endif; 
			echo $out;
			wp_reset_query();
	
		}

			echo $after_widget;
		}
		function  atp_dateorder($postid,$eventorder)
		{
			$eventdate =get_post_meta($postid, 'event_date', true);
			$event_starttime 	= isset($event_timeslider['starttime']) ? $event_timeslider['starttime'] : '';
					$event_endtime 		= isset($event_timeslider['endtime']) ? $event_timeslider['endtime'] : '';
					$event_location		= get_post_meta( $postid, 'event_location', true );
					$event_venue		= get_post_meta( $postid, 'event_venue', true );
					$atp_venue          = get_option('atp_venue') ? get_option('atp_venue') : 'Venue';
					$atp_location		= get_option('atp_location') ? get_option('atp_location') : 'Location';
					$atp_event_status	= get_option('atp_event_status') ? get_option('atp_event_status') : 'Status';
					$event_status		= get_post_meta( $postid, 'event_status', true );
					$event_timeslider 		= get_post_meta( $postid, 'event_timeslider', true );
					$event_starttime 			= isset($event_timeslider['starttime']) ? $event_timeslider['starttime'] :'';
					$time_in_24_hour_format  = date("H:i", strtotime($event_starttime));
					$event_time =preg_replace('/:/',',', $time_in_24_hour_format);
					if( $eventdate != '' ){
						$event_date	= date_i18n('M-d-Y', $eventdate);
						$date_event	= explode( '-', $event_date );
					}
					$out = '<div class="event_wwrap">';
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

					// if ( $event_location ) { $out .= '<p>'.atp_localize($atp_location,'<span>','</span>'); 
					// $out .= $event_location .'</p>'; 
					// }

					if ( isset( $event_status ) && $event_status != '' ) {
						$out .='<span class="etick-status">'. $event_status .'</span>';
					}

					// $event_buttons = get_post_meta( $postid, 'event_buttons', true );
					// if ( $event_buttons != '' ) {
						// foreach ( $event_buttons as $buttons ) {
							// $btncolor = ($buttons['buttoncolor'] != '') ? ' style="background-color:'.$buttons['buttoncolor'].'"':'';
							// $out .= '<a href="'. $buttons['buttonurl'] .'" target="_blank"><button ' .$btncolor. ' type="button" class="btn small orange flat"><span>'. $buttons['buttonname'].'</span></button></a>';
						// }
					// }

					$out .= '</div>';
					$out .='</div>';
					if ( $eventorder == 'upcomeing' ){
						if ( $eventdate  != '' ){
							$countdown_date  = date_i18n('m/d/Y', $eventdate);
							$countdown_event = explode( '/', $countdown_date );
						}
					
						$month  = $countdown_event['0'];
						$day    = $countdown_event['1'];
						$year   = $countdown_event['2'];
						$minute = '00';
						$second = '00';
						$hour = '00';
		
						$out .='<script type="text/javascript">
							jQuery(function($) {
								var endDate = "'.$month.' '.$day.' '.$year.' '.$hour.':'.$minute.':'.'00";
								enddate = new Date('.$year.' , '.$month.'-1 , '.$day.','.$event_time.',0,0);
								$("#iva-countdown-wg-'.$postid.'").countdown({
									until: enddate, 
									format: "DHMS",
									padZeroes: true,
									labels:["Yrs","Mns","Wks","Days","Hrs","Min","Sec"],
									labels1:["Yr","Mon","Wks","Day","Hr","Min","Sec"]
								});
							});
						</script>';
						$out .='<div class="clear"></div>';
						$out .='<div id="iva-countdown-wg-'.$postid.'"></div>';
					}


					$out .= '</div>';
					
					return $out;
			}
	
		//processes widget options to be saved
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			/* Strip tags for title and name to remove HTML (important for text inputs). */
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['events_order'] = strip_tags( $new_instance['events_order'] );
			$instance['event_limit'] = strip_tags( $new_instance['event_limit'] );
			
			return $instance;
		}
		
		// outputs the options form on admin
		function form( $instance ) {
			$instance = wp_parse_args( (array) $instance, array( 'title' => '','events_order' =>'','event_limit' => '4' ));
			$title = strip_tags($instance['title']);
			$events_order = strip_tags($instance['events_order']);
			$event_limit = strip_tags($instance['event_limit']);				
			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'Title' ); ?>"><?php _e('Title:', 'ATP_ADMIN_SITE'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $title; ?>" style="width:100%;" />
				<label for="<?php echo $this->get_field_id( 'event_limit' ); ?>"><?php _e('Limits:', 'ATP_ADMIN_SITE'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( 'event_limit' ); ?>" name="<?php echo $this->get_field_name( 'event_limit' ); ?>" value="<?php echo $event_limit; ?>" style="width:100%;" />
				<label for="<?php echo $this->get_field_id( 'events_order' ); ?>"><?php _e('Events Order:', 'ATP_ADMIN_SITE'); ?></label>
				<select id="<?php echo $this->get_field_id( 'events_order' ); ?>" name="<?php echo $this->get_field_name( 'events_order' );?>" >
					<option value="upcomeing" <?php if($events_order=="upcoming") { echo 'selected="selected"'; } ?>>Upcoming Events</option>
					<option value="past" <?php if($events_order=="past") { echo 'selected="selected"'; } ?>>Past Events</option>
				</select>
				
			</p>
		<?php 
		} 
	} 
	/* Add our function to the widgets_init hook. */
	add_action( 'widgets_init', 'events_widgets' );
?>
