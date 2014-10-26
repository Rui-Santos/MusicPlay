<?php
/**
 * Plugin Name: Album Posts Widget
 * Description: A widget used for displaying album posts.
 * Version: 1.0
 * Author: Fem Khan
 * Author URI: http://www.aivahthemes.com
 *
 */
class WP_Widget_Audio_Album extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'album-widget', 'description' => __('Audio Widget','ATP_ADMIN_SITE'));
		$control_ops = array('width' => 200, 'height' => 350);
		/* Create the widget. */
		$this->WP_Widget( 'audio_widgets', THEMENAME.' - Album', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract($args);
		$title 		= $instance['title'];
		$post_id 	= $instance['post_id'];
		echo $before_widget;
		if( $title ) {
			echo $before_title.$title.$after_title; 
		}
		$desid=rand(30, 99);
		$the_query = new WP_Query();
		$the_query->query('post_type=albums&posts_per_page=1&p=' . $post_id);
		if ( $the_query->have_posts() ) : 
		while ( $the_query->have_posts() ) : $the_query->the_post(); 
		global $post, $default_date;
		
			$audio_artist=array();
			$audio_artist_name =get_post_meta($post->ID,'audio_artist_name',true);
			if ( is_array( $audio_artist_name ) && count( $audio_artist_name ) > 0 ) {
			foreach( $audio_artist_name as $audio_artist_id){
			
			  $permalink = get_permalink(  $audio_artist_id);
			  $playlisttitle = get_the_title(  $audio_artist_id);
			  $audio_artist[]= '<a href="'.$permalink.'">'.$playlisttitle.'</a>';
			 }
			$audio_artist_name = implode( ', ', $audio_artist );
			}
			
			$audio_button_disable 		= get_post_meta( $post->ID, 'audio_button_disable', true );
			$audio_buttons   = get_post_meta( $post->ID, 'audio_buttons', true );
			$audio_catalog_id	= get_post_meta( $post->ID, 'audio_catalog_id', true );
			$imagesrc 	= wp_get_attachment_image_src( get_post_thumbnail_id($post_id), 'full', false, '' );
			$image 	  	= aq_resize($imagesrc[0], '80', '80', true );
			$audiolist	= get_post_meta($the_query->post->ID,'audio_upload',true) ? get_post_meta($the_query->post->ID,'audio_upload',true) :'';
			$audio_label	=  get_the_term_list( $the_query->post->ID, 'label', '', ',', '' );
			$audio_posttype_option		= get_post_meta( $post->ID, 'audio_posttype_option', true ) ?  get_post_meta( $post->ID, 'audio_posttype_option', true ) :'player';
			$permalink = get_permalink(  $the_query->post->ID);
			$playlisttitle = get_the_title(  $the_query->post->ID );
			$audio_release_date = get_post_meta($the_query->post->ID,'audio_release_date',true) ? get_post_meta($the_query->post->ID,'audio_release_date',true) :'';
			if($audio_release_date !='') { 
			     if(is_numeric($audio_release_date)){
			      $audio_release_date= date_i18n($default_date,$audio_release_date);
			     } 
	    	}

			$playlisttitles ='<div class="single-player-meta" id="single-player-meta'.$desid.'">
						<a href="'.$permalink.'">'.$playlisttitle.'</a>
						<div>'.$audio_label.' | '.$audio_release_date.'</div></div>';

		?>
			<div class="album_widgetmeta">
				<?php echo '<figure>'.atp_resize( $post->ID, '', 90, 90, 'album-thumb', '' ).'</figure>';?>
				<div class="album-widget-info">
					<strong><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf( __( "Permanent Link to %s", 'musicplay' ), esc_attr( get_the_title() ) ); ?>"><?php the_title(); ?></a></strong>
					<div class="album-widgetmeta">
						<span><?php echo $audio_release_date; ?></span>
						<span><?php echo $audio_artist_name; ?></span>
						<span><?php echo get_the_term_list( $post->ID, 'genres', '', ',' , '' ); ?></span>
					</div>
				</div>
			</div>
			<ul class="fap-my-playlist album-playlist" data-playlist="unique-playlist-id">
			<?php
			if($audio_posttype_option =='player'){			
			$audio_list=array();
			$audio_list=explode(',',$audiolist);			
			$count=count($audio_list);
				if($count > 1) {
					$i=1;
					foreach($audio_list as $attachment_id) { 
						$attachment 		= get_post( $attachment_id );
						$attachment_title	= $attachment->post_title;
						?>
						<li><a class="fap-single-track no-ajaxy" data-meta="#single-player-meta<?php echo $desid; ?>" href="<?php  echo $attachment->guid;?>" title="<?php echo $attachment_title; ?>"  rel="<?php echo $image; ?>"><i class="fa fa-play-circle fa-2x play_icon"></i><?php echo $attachment_title; ?></a></li><?php 
					}
				} 

			}elseif($audio_posttype_option =='externalmp3'){		
					$audiolist=get_post_meta($post->ID,'audio_mp3',true) ? get_post_meta($post->ID,'audio_mp3',true) :'';
					$count=count($audiolist);
				if($count > 0) {
					$i=1;
					foreach($audiolist as $mp3_list) { 
						$mp3_title=$mp3_list['mp3title'];
								
						?>
						<li><a class="fap-single-track no-ajaxy" data-meta="#single-player-meta<?php echo $desid; ?>" href="<?php  echo esc_attr($mp3_list['mp3url']);?>" title="<?php echo $mp3_title; ?>"  rel="<?php echo $image; ?>"><i class="fa fa-play-circle fa-2x play_icon"></i><?php echo $mp3_title; ?></a></li><?php 
					}
				} 
			
			
			}else{
			$audio_soundcloud_title = get_post_meta($post->ID,'audio_soundcloud_title',true);
			$audio_soundcloud_url = get_post_meta($post->ID,'audio_soundcloud_url',true);
			?>
			<li><a class="fap-single-track no-ajaxy" data-meta="#single-player-meta<?php echo $desid; ?>" href="<?php  echo $audio_soundcloud_url; ?>" title="<?php echo $audio_soundcloud_title; ?>"  rel="<?php echo $image; ?>"><i class="fa fa-play-circle fa-2x play_icon"></i><?php echo $audio_soundcloud_title; ?></a></li>
			<?php
			} ?>
			</ul>
		<?php echo $playlisttitles; ?>
		<?php if ( $audio_button_disable != 'on' ) {
				if ( $audio_buttons != '' ){
					foreach ($audio_buttons as $buttons){ ?>
						<a href="<?php echo $buttons['buttonurl'] ?>" target="_blank"><button <?php if($buttons['buttoncolor']!=''){?> style="background-color:<?php echo $buttons['buttoncolor'] ?>"<?php } ?>type="button" class="btn medium orange flat"><span><?php echo  $buttons['buttonname'];?></span></button></a>
			<?php } ?>
		  <?php } ?>
		<?php } ?>
		<?php endwhile;
		// Restore original Post Data
		wp_reset_postdata();
		else:  ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.','ATP_ADMIN_SITE' ); ?></p>
		<?php endif; 
		echo $after_widget;
	}
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] 		= strip_tags($new_instance['title']);
		$instance['post_id'] 	=  $new_instance['post_id'];
		return $instance;
	}

	function form( $instance ) {
		$title   = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$post_id = isset( $instance['post_id'] ) ? $instance['post_id'] : '';
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','ATP_ADMIN_SITE'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id( 'post_id' ); ?>"><?php _e( 'Post ID:','ATP_ADMIN_SITE'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'post_id' ); ?>" name="<?php echo $this->get_field_name( 'post_id' ); ?>" type="text" value="<?php echo $post_id; ?>" /></p>
				
		<?php
	}
}
function WP_Widget_Audio_Album() {
	register_widget('WP_Widget_Audio_Album');
}
add_action('widgets_init', 'WP_Widget_Audio_Album');
?>