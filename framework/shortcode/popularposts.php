<?php

	// P O P U L A R   P O S T S 
	//--------------------------------------------------------
	function sys_popular_posts ($atts, $content = null) {
		extract(shortcode_atts(array(
			'limit'			=> '2',
			'description'	=>'40',
			'thumb'			=>'true',
			'popular_select'=>'time',
		), $atts));

		$out = '<div class="widget_postslist sc">';
		$out .= '<ul>';

		global $wpdb;
		
		$popular_limits = $limit;
		$show_pass_post = false;
		$duration = '';
		
		$request = "SELECT ID, post_title,post_date,post_content, COUNT($wpdb->comments.comment_post_ID) AS 'comment_count' FROM $wpdb->posts, $wpdb->comments";
		$request .= " WHERE comment_approved = '1' AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'";
		
		if( !$show_pass_post ) $request .= " AND post_password =''";
		
		if( $duration!= "" ) {
			$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
		}
		$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $popular_limits";
		
		$popular_posts = $wpdb->get_results( $request );
	
		foreach( $popular_posts as $post ) {
			if( $post ) {
			
				$post_date = $post->post_date;
				$post_date = mysql2date('F j, Y', $post_date, false);
				
				$out .= "<li>";
				if( $thumb == "true" ){
				
					$thumbid = get_post_thumbnail_id($post->ID);
					$imgesc = wp_get_attachment_image_src( $thumbid , array(9999,9999) );
					
					$out .= '<div class="thumb"><a href="'.get_permalink($post->ID).'" title="'.$post->post_title.'">';
					
					if( $thumbid ){
						$out .= atp_resize('',$imgesc['0'],'50','50','imgborder','');
					}else{
						//$out .= '<img class="imgborder" src="'. THEME_URI.'/images/no-image.jpg" title="'.$post->post_title.'"  alt=""  />';
					}
					$out .= '</a></div>';
				}
				$out .= '<div class="pdesc"><a href="' .get_permalink( $post->ID ). '" rel="bookmark">' .$post->post_title. '</a>';
				if( $popular_select == 'time'){
					$out .=	'<div class="w-postmeta"><span>'.$post_date.'</span></div>';
				}else{
					$out .= '<p>'.wp_html_excerpt( $post->post_content, $description, '...' ).'</p>';
				}
				$out .= '</div></li>';
			}
		}
		$out .= '</ul></div>';
		
		return $out;
		wp_reset_query();
	}
	add_shortcode('popularposts','sys_popular_posts');
?>