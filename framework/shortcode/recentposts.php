<?php

	// R E C E N T   P O S T S 
	//--------------------------------------------------------
	function sys_recent_posts ($atts, $content = null) {
		extract( shortcode_atts( array(
			'limit'			=>'2',
			'description'	=>'40',
			'cat_id'		=>'23',
			'thumb'			=>'true',
			'postdate'		=>'',
		), $atts ) );

		$out = '<div class="widget_postslist sc">';
		$out .= '<ul>';

		global $wpdb;
			
		$myposts = get_posts("numberposts=$limit&offset=0&cat=$cat_id");
	
		foreach( $myposts as $post ) {
			$post_date = $post->post_date;
			$post_date = mysql2date('F j, Y', $post_date, false);
			
			$out .= "<li>";
			
			if( $thumb == "true" ){
				$thumbid = get_post_thumbnail_id( $post->ID );
				$imgsrc	 = wp_get_attachment_image_src( $thumbid , array(9999,9999) );
				$out 	.= '<div class="thumb"><a href="'.get_permalink( $post->ID ).'" title="'.$post->post_title.'">';
				if ( $thumbid ){	
					$out .= atp_resize('',$imgsrc['0'],'50','50','imgborder','');
				}else{
					//$out .= '<img class="imgborder" src="'.THEME_URI.'/images/no-image.jpg'.'"  alt="' .$post->post_title. '" />';	
				}
				$out .= '</a></div>';
			}
			
			$out .= '<div class="pdesc"><a href="' .get_permalink($post->ID). '" rel="bookmark">' .$post->post_title. '</a>';
			
			if( $postdate == "true" ){
				$out .=	'<div class="w-postmeta"><span>'.$post_date.'</span></div>';
			} else{ 
				$out .= '<p>'.wp_html_excerpt( $post->post_content, $description, '...' ).'</p>';
			}
			$out .= '</div></li>';
		}
		$out .= '</ul></div>';
		
		return $out;
		wp_reset_query();
	}
	add_shortcode('recentposts','sys_recent_posts');
?>