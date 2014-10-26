<?php

/** 
 * The Header for our theme.
 * Includes the header.php template file. 
 */

get_header(); ?>

	
	<div id="primary" class="pagemid">
	<div class="inner">

		<div class="content-area">
			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div <?php post_class( 'event-single' );?> id="post-<?php the_ID(); ?>">

				<?php
				global $default_date;
				$event_date = "";
				if(get_post_meta($post->ID, "event_date", true)!=''){
					$event_date				= date_i18n($default_date, get_post_meta($post->ID, "event_date", true));
				}
				$event_venue 			= get_post_meta( $post->ID, 'event_venue', true );
				$event_location 		= get_post_meta( $post->ID, 'event_location', true );
				$event_status 			= get_post_meta( $post->ID, 'event_status', true );
				$event_button_disable 	= get_post_meta( $post->ID, 'event_button_disable', true );
				$event_maplocation		= get_post_meta( $post->ID, 'event_maplocation', true );
				$event_video_content    = get_post_meta( $post->ID, 'event_video_content', true );
				$event_timeslider 		= get_post_meta( $post->ID, 'event_timeslider', true );
				$event_starttime 		= isset($event_timeslider['starttime']) ? $event_timeslider['starttime'] :'';
				$event_endtime 			= isset($event_timeslider['endtime']) ? $event_timeslider['endtime'] :'';
				$event_alldays 			= isset($event_timeslider['alldays']) ?  $event_timeslider['alldays'] : '';
				$event_maplocation		= get_post_meta( $post->ID, 'event_maplocation', true );
				$event_longitutes		= isset($event_maplocation['longitutes']) ? $event_maplocation['longitutes'] : '';
				$event_latitudes		= isset($event_maplocation['latitudes']) ? $event_maplocation['latitudes'] : '';
				$event_zoom				= isset($event_maplocation['zoom']) ? $event_maplocation['zoom'] : '10'; 
				$event_controller		= isset($event_maplocation['controller']) ? $event_maplocation['controller'] : ''; 
				$control				= ($event_controller == 'on') ? 'true' : 'false';
				$eventmeta	= get_post_meta( get_the_id(), 'custom_meta', true );

				?>
				
				<?php if( atp_generator( 'sidebaroption',$post->ID ) != "fullwidth" ){ $width = '670'; }else{ $width = '960'; } ?>

				<?php if( has_post_thumbnail()){ ?>
				<div class="event_thumb">
					<?php echo atp_resize( $post->ID, '', $width, '', '', '' );?>
				</div><!-- .event_thumb -->
				<?php } ?>

				<h2 class="entry-title title-large"><?php the_title(); ?></h2>

				<div class="event_details_wrap">
					<div class="col_half">
						<div class="event_info">
							<?php
							if ( $event_date != '' ) { 
								echo '<p>'. atp_localize($atp_event_date, '<span>','</span>') . $event_date .'</p>';
							} 
							
							if ( get_option( 'atp_timeformat' ) == 12 ) {
	
								if ( $event_starttime != '' ) { echo '<p>'. atp_localize( $atp_starttime, '<span>', '</span>') . date_i18n( 'g:i a', strtotime( $event_starttime ) ) .'</p>';}
								if ( $event_endtime != '' ) { echo '<p>'. atp_localize( $atp_endtime, '<span>','</span>') . date_i18n( 'g:i a', strtotime( $event_endtime ) ) .'</p>';	} 
							}else {
								if ( $event_starttime != '' ) { echo '<p>'. atp_localize( $atp_starttime, '<span>', '</span>') . $event_starttime .'</p>'; }
								if ( $event_endtime != '' ) { echo'<p>'. atp_localize( $atp_endtime, '<span>', '</span>' ) . $event_endtime . '</p>';	}
							}
	
							if ( $event_alldays == 'on' ) {
								echo '<p>'. atp_localize( $atp_event_alldays,'<span>','</span>') . 'All days' .'</p>';
							} 
	
							if ( $event_venue != '' ){ 
								echo '<p>'. atp_localize($atp_venue,'<span>','</span>') . $event_venue .'</p>';
							}
	
							if ( $event_location != '' ){ 
								echo '<p>'. atp_localize($atp_location,'<span>','</span>') . $event_location .'</p>';
							}
	
							if ( $event_status != '' ){
								echo '<p>'. atp_localize($atp_event_status,'<span>','</span>') . $event_status .'</p>';
							}

							if( $eventmeta != '' ) {
								foreach($eventmeta as $meta) {
									echo '<p>'.$meta.'</p>';
								}
							}
							?>
		
						</div><!-- .event_info -->
					</div><!-- .col_half -->
					<div class="col_half end">
						<?php 
						$event_buttons = get_post_meta( $post->ID, 'event_buttons', true );
						if ( $event_button_disable != 'on' ) {	
						if ( $event_buttons != '' ){
								foreach ( $event_buttons as $buttons ){ ?>
								<a href="<?php echo $buttons['buttonurl'] ?>" target="_blank"><button <?php if($buttons['buttoncolor']!=''){?> style="background-color:<?php echo $buttons['buttoncolor'] ?>"<?php } ?>type="button" class="btn medium orange flat"><span><?php echo  $buttons['buttonname'];?></span></button></a>
								<?php 
								}
							}
						}
						?>
					</div>	
				</div><!-- .event_details_wrap -->

				<div class="clear"></div>	

				<div class="event_entry">
					
				<?php the_content(); ?>

				</div><!-- .event_entry -->
				<div class="demospace" style="height:20px;"></div>

				<?php get_template_part('musicband/share','link'); ?>

				<div class="demospace" style="height:20px;"></div>

				<?php 
				if ( $event_video_content != '' ) {
					echo $event_video_content;
					echo '<div class="demospace" style="height:20px;"></div>';

					}
				?>

				<div class="demospace" style="height:20px;"></div>
			
				<?php
				// Google Map for Event Location
				if ( ($event_location != '') OR (($event_longitutes !='') AND ($event_latitudes !='')) ) {
					echo iva_googlemap( array(
						'address'		=> $event_location,
						'controls'		=> '[]',
						'longitude'		=> $event_longitutes,
						'latitude'		=> $event_latitudes,
						'html'			=> '',
						'popup'			=> 'false',
						'zoom'			=> $event_zoom,
						'align'			=> false,
						'controller'	=> $control, 
					));
				}
				?>
				
				<div class="demospace" style="height:20px;"></div>
			
			</div><!-- #post-<?php the_ID();?> -->
			
			<?php edit_post_link(__('Edit', 'musicplay'), '<span class="edit-link">', '</span>'); ?>

			<div class="clear"></div>
			<?php endwhile; ?>
			<?php else: ?>
			<?php '<p>'.__('Sorry, no projects matched your criteria.', 'musicplay').'</p>';?>
			<?php endif; ?>

			<?php 
			$comments = get_option('atp_events_comments');
			if ( $comments == 'enable' ) {
				comments_template( '', true ); 
			}?>

			</div><!-- .content-area -->
	
			<?php if ( atp_generator( 'sidebaroption', $post->ID) != "fullwidth" ){ get_sidebar(); } ?>

	</div><!-- inner -->
	</div><!-- #primary.pagemid -->

<?php get_footer(); ?>