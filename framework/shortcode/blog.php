<?php
	// B L O G 
	//--------------------------------------------------------
	function sys_blog ($atts, $content = null) {
		extract(shortcode_atts(array(
			'cat'		=> '2',
			'limit'		=> '5',
			'pagination'=> 'true',
			'postmeta'  =>'true'
		), $atts));

		global $atp_readmoretxt, $post;
		$out = '';

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			
		$query = array(
				'category_name'	=>	$cat, 
				'showposts'	=> $limit, 
				'paged'		=> $paged
				);
		query_posts($query);
		if ( have_posts() ) : 
			while (have_posts()) : the_post();
			$format = get_post_format($post->ID);
			if( false === $format ) { $format = 'standard'; } 
				$out .= '<div class="'.join( ' ', get_post_class( 'post', get_the_ID() ) ).'" id="post-'.get_the_ID().'">';
				$out .= '<div class="post_content">';	
				ob_start();
				$out .= get_template_part( 'includes/' . $format );
				$out .= ob_get_contents();
				ob_end_clean();
				 if( $format != 'link' && $format != 'quote' && $format != 'aside') {
					$out .= '<h2 class="entry-title"><a href="'.get_permalink().'" rel="bookmark" title="'.sprintf( __( "Permanent Link to %s", 'THEME_FRONT_SITE' ), esc_attr( get_the_title() ) ).'">'.get_the_title().'</a></h2>';
				}
				if( $postmeta == "true") {
					$out .= '<div class="post-info">';
					$out .= atp_generator('postmetaStyle');					
					$out .= '</div>';
				} 		
				if ( $format != 'quote'){
					$out .= '<div class="post-entry">';
					$out .= '<p>'.get_the_excerpt().'</p>';
					
					if ( $format != 'quote' && $format != 'link'  ){
						$out .= '<a href="'.get_permalink().'" class="more-link">'.atp_localize($atp_readmoretxt,'<span>','</span>').'</a>';
					}
					
					$out .= '</div>';
				}

				$out .= '</div>';
				$out .= '</div>';
			endwhile;
			if(!function_exists('atp_pagination')){
				if( $pagination == "true") {
					if(function_exists('atp_pagination')) {
						$out .= atp_pagination(); 
					}
				}
			}
		wp_reset_query();
		endif;
	return $out;	
	} 
	//EOF sys_blog

	add_shortcode('blog','sys_blog');
	
?>