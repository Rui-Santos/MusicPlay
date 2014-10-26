<?php get_header(); ?>
	<div id="primary" class="pagemid">
	<div class="inner">

		<div class="content-area">

			<?php
			if ( get_query_var('paged') ) {
				$paged = get_query_var('paged');
			}
			elseif ( get_query_var('page') ) {
				$paged = get_query_var('page');
			} else {
				$paged = 1;  
			}

			$pagination = get_option('atp_event_pagination');
			if ( $pagination == 'on' ){
				$event_limit		= get_option( 'atp_event_limits' );
			}else{
				$event_limit		= '-1' ;
			}

			$args = array(
				'post_type' 	=> 'events',
				'posts_per_page'=> $event_limit, 
				'orderby'   	=> 'event_date',
       			'meta_key'  	=> 'event_date',
				'paged' 		=> $paged,
				'order'    	 	=> 'ASC'
			);
			$wp_query = new WP_Query( $args );
				
			if ( $wp_query->have_posts()) : while (  $wp_query->have_posts()) :  $wp_query->the_post(); 
				
				$eventdate =get_post_meta($post->ID, 'event_date', true);
				if($eventdate!=''){
					$event_date			= date('M-d-Y', $eventdate);
					$date_event			= explode( '-', $event_date );
				}
				$event_timeslider 	= get_post_meta( $post->ID, 'event_timeslider', true );
				$event_starttime 	= isset($event_timeslider['starttime']) ? $event_timeslider['starttime'] : '';
				$event_endtime 		= isset($event_timeslider['endtime']) ? $event_timeslider['endtime'] : '';
				$event_location		= get_post_meta( $post->ID, 'event_location', true );
				$event_venue		= get_post_meta( $post->ID, 'event_venue', true );
				$event_status		= get_post_meta( $post->ID, 'event_status', true );
				$date_event			= explode( '-', $event_date );
				?>

				<div class="events-list">

					<?php if( $eventdate < time() ) { echo '<div class="pastevent"></div>'; } ?>

					<?php if( has_post_thumbnail()){ ?>
					<div class="event_thumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>">
						<?php echo atp_resize( $post->ID, '', '200', '140', '', '' );?>
					</a></div><!-- .event_thumb -->
					<?php } ?>

					<div class="event_entry">
						<div class="event_details">
							
							<div class="event-meta">
								<?php if ( isset( $event_date ) && $event_date != '' ) { ?>	
								<span class="month"><?php echo $date_event['0']; ?></span>
								<span class="day"><?php echo $date_event['1']; ?></span>
								<span class="year"><?php echo $date_event['2']; ?></span>
								<?php } ?>
							</div><!-- .event-meta -->
							
							<div class="event-content">

								<h2 class="entry-title"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a></h2>
								
								<div class="event_info">
									<?php if ( $event_venue ) { echo '<p>'.atp_localize($atp_venue,'<span>','</span>'). $event_venue .'</p>'; } ?>
									<?php if ( $event_location ) { echo '<p>'.atp_localize($atp_location,'<span>','</span>'); echo $event_location .'</p>'; } ?>
									<?php if ( isset( $event_status ) && $event_status != '' ) { ?>
									<?php echo '<p>'.atp_localize($atp_event_status,'<span>','</span>'); echo $event_status .'</p>'; ?>
									<?php } ?>
								</div><!-- .event_info-->
								
							</div><!-- .event-content-->
							
						</div><!-- .event_details-->
					</div><!-- .event_entry -->
					
				</div><!-- .events-list -->
				
				<div class="demo-space"></div>
				
				<?php endwhile; ?>
				
				<?php if ( $pagination == 'on' ) { echo atp_pagination(); } ?>
				
				<?php wp_reset_query(); ?>

				<?php else : ?>

				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'musicplay' ); ?></p>

				<?php get_search_form(); ?>

				<?php endif;?>
				
				<?php edit_post_link( __( 'Edit', 'musicplay' ), '<span class="edit-link">', '</span>' ); ?>

			</div><!-- .content-area -->
	
			<?php // if ( atp_generator( 'sidebaroption', $post->ID) != "fullwidth" ){ get_sidebar(); } ?>

	</div><!-- inner -->
	</div><!-- #primary.pagemid -->

<?php get_footer(); ?>