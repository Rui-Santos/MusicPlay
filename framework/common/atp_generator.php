<?php
if(!class_exists('atpgenerator')){
	class atpgenerator {

		// P R I M A R Y   M E N U 
		//--------------------------------------------------------
		function atp_primary_menu() {
			if (has_nav_menu( 'primary-menu' ) ) {
				wp_nav_menu(array(
					'container'		=> false, 
					'theme_location'=> 'primary-menu',
					'menu_class'	=> 'sf-menu',
					'menu_id'		=> 'atp_menu', 
					'echo'			=> true, 
					'before'		=> '', 
					'after'			=> '',
					'link_before'	=> '', 
					'link_after'	=> '', 
					'depth'			=> 0,
					'walker'		=> new description_walker()
					));
			}else{
			}
		}
		function atp_secondary_menu() {
			if (has_nav_menu( 'secondary-menu' ) ) {
				wp_nav_menu(array(
					'container'			=> false, 
					'theme_location'	=> 'secondary-menu',
					'menu_class'		=> 'sf-menu', 
					'echo'				=> true, 
					'before'			=> '', 
					'after'				=> '',
					'link_before'		=> '', 
					'link_after'		=> '', 
					'depth'				=> 0,
					'walker'			=> new description_walker()
				));
			}else{
			}
		}

		// L O G O   G E N E R A T O R
		//--------------------------------------------------------
		function logo(){
			$atp_logo = get_option('atp_logo'); 
			if($atp_logo == 'logo'){ ?>
				<a href="<?php echo home_url('/'); ?>" title="<?php bloginfo('name'); ?>">
					<img src="<?php echo get_option('atp_header_logo'); ?>" alt="<?php bloginfo('name'); ?>" />
				</a>
			<?php 
			}else { ?>
				<h1 id="site-title"><span><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?>	</a></span></h1>
				<h2 id="site-description"><?php echo bloginfo( 'description' ); ?></h2>
			<?php 
			} 
		}
		
		// 	TESER FRONT PAGE
		//--------------------------------------------------------
		function teaser_option()
		{
			$out = '';
			if(get_option('atp_teaser_frontpage') != "on" && get_option('atp_teaser_frontpage_text') != "") {
				$out = '<div class="frontpage_teaser"><div class="inner">';
				$out .= do_shortcode( stripslashes( get_option( 'atp_teaser_frontpage_text' ) ) );
				$out .= '</div></div>';
			}
			echo $out;
		}
		// S I D E B A R   P O S I T I O N S 
		//--------------------------------------------------------
		function sidebaroption($postid) {
			// Get sidebar class and adds sub class to pagemid block layout

			$sidebaroption = get_post_meta($postid, "sidebar_options", TRUE) ? get_post_meta($postid, "sidebar_options", TRUE):'rightsidebar';
			switch($sidebaroption){
				case  'rightsidebar':
						$sidebaroption="rightsidebar";
						break;
				case  'leftsidebar':
						$sidebaroption="leftsidebar";
						break;
				case  'fullwidth':
						$sidebaroption="fullwidth";
						break;
				default:
						$sidebaroption="rightsidebar";
						if(is_singular( 'artists' )){
							$sidebaroption="fullwidth";
						}
			}

			if(is_archive()) {
				$sidebaroption = 'rightsidebar';
			}

			if( is_search() ) {
				$sidebaroption = 'fullwidth';
			}

			if ( is_404() || is_tax() || is_singular( 'artists_type' )  || is_singular( 'genres' ) ||  is_singular( 'gallery_type' ) || is_singular( 'gallery' ) || is_singular( 'video_type' )  ) {
				$sidebaroption = 'fullwidth';
			}

			return $sidebaroption;
		}

		/***
		 * P O S T   L I N K   T Y P E 
		 *--------------------------------------------------------
		 * atp_getPostLinkURL - generates URL based on link type
		 * @param - string link_type - Type of link 
		 * @return - string URL
		 * 
		 */
		function atp_getPostLinkURL($link_type) {
			global $post;
			
			//use switch to generate URL based on link type
			switch($link_type) {
				case 'linkpage':
						return get_page_link(get_post_meta($post->ID, 'linkpage', true));
						break;
				case 'linktocategory':
						return get_category_link(get_post_meta($post->ID, 'linktocategory', true));
						break;
				case 'linktopost':
						return get_permalink(get_post_meta($post->ID, 'linktopost', true));
						break;
				case 'linkmanually':
						return esc_url(get_post_meta($post->ID, 'linkmanually', true));
						break;
				case 'nolink':
						return 'nolink';
						break;
			}
		}

		/**
		 * P O S T   A T T A C H M E N T S 
		 *--------------------------------------------------------
		 * getPostAttachments - displays post attachements 
		 * @param - int post_id - Post ID
		 * @param - string size - thumbnail, medium, large or full
		 * @param - string attributes - thumbnail, medium, large or full
		 * @param - int width - width to which image has be revised to
		 * @param - int height - height to which image has be revised to
		 * @return - string Post Attachments
		 */
 
		function getPostAttachments($postid=0, $size='thumbnail', $attributes='',$width,$height,$postlinkurl) {
			global $post, $width;
				//get the postid
				if ($postid<1) $postid = get_the_ID();
				
				//variables
				$rel = $out = '';
						
				//get the attachments (images)
				$images = get_children(array(
					'post_parent'    => $postid,
					'post_type'      => 'attachment',
					'order'          => 'DESC',
					'numberposts'    => 0,
					'post_mime_type' => 'image'));
					
				//if images exists	, define/determine the relation for lightbox
				if(count($images) >1) {
					$rel = '"group'.$postid.'"';
				}else{
					$rel='""'; 
				}
				$rel = ' rel='.$rel;
				//if images exists, loop through and prepare the output
				if($images) {
				$out .='<div class="flexslider">';
				$out .='<ul class="slides">';
					//loop through
					foreach($images as $image) {
						$full_attachment = wp_get_attachment_image_src($image->ID, 'full');
							if( !empty( $image->ID ) )
						$alt=get_the_title( $image->ID );
						$out .='<li>';
						$out .= atp_resize('',$full_attachment['0'],$width,$height,'',$alt);
						$out .='</li>';
					}//loop ends
					$out .='</ul>';
					$out .='</div><div class="clear"></div>';
				} else { //if images does not exists
					$alt='';
					$post_thumbnail_id = get_post_thumbnail_id($postid);
					$full_attachment = wp_get_attachment_image_src($post_thumbnail_id,'full');
							if( !empty($post_thumbnail_id) )
					$alt=get_the_title($post_thumbnail_id);
						$out.='<figure><a href="'.$postlinkurl.'">';
						$out.=atp_resize('',$full_attachment['0'],$width,$height,'imageborder',$alt);
						$out.='</a></figure>';
				}// if images exists
			return $out; 
		}

		// P O R T F O L I O I M A G E T Y P E
		function atp_portfoliotype($postid,$post_type,$width,$height){
			$out='<div class="postimg">';
			if( $post_type == 'gallery' ) {
				$out.=atp_generator('getPostAttachments',$postid,'','',$width,'','','slider');
			}elseif( $post_type == 'posttype_image' ){ 
				if( has_post_thumbnail($postid)){
					$out.="<figure>";
					$out.= atp_resize($postid,'',$width,'','imageborder aligncenter','');
					$out.="</figure>";
				}
			}elseif( $post_type == 'vimeo' ) {
				$vimeo_id = get_post_meta($postid, 'vimeo', true);
				if( !empty($vimeo_id) ) {
					$out.="<div class='video-frame' id='iframevideo'>";
					$out .= "<iframe src='http://player.vimeo.com/video/$vimeo_id?&ampportrait=0' frameborder='0'></iframe>";
					$out.="</div>";
				}
			}elseif( $post_type == 'youtube' )	{
				$youtube_id = get_post_meta($postid, 'youtube', true);
				if( !empty($youtube_id) ) {
					$out.="<div class='video-frame' id='iframevideo'>";
					$out .='<iframe src="http://www.youtube.com/embed/'.$youtube_id.'?wmode=transparent"  frameborder="0"></iframe>';
					$out.="</div>";
				}
			}
			$out.='</div>';
			return $out;
		}

		// CUSTOM TWITTER TWEETS
		//--------------------------------------------------------
		function atp_customtwitter()
		{
			if ( function_exists( 'twitter_parse_cache_feed' ) ) {
				twitter_parse_cache_feed(array(
					'username'				=> get_option('atp_teaser_twitter'),
					'limit'					=> '1',
					'encode_utf8'			=> '',
					'twitter_cons_key'		=> get_option('atp_consumerkey'),
					'twitter_cons_secret'	=> get_option('atp_consumersecret'),
					'twitter_oauth_token'	=> get_option('atp_accesstoken'),
					'twitter_oauth_secret'	=> get_option('atp_accesstokensecret')
				));
			}
		}
		// S U B H E A D E R 
		//--------------------------------------------------------
		function subheader($postid){

			$subdesc = $title = '';

			$username			= get_option( 'atp_teaser_twitter' );
			$page				= get_post( $postid );
			$sh_bg_properties 	= get_post_meta( $postid,'subheader_img', true );
			$subbreadcrumb      = get_post_meta( $postid, 'breadcrumb', true );
			$subheadertextcolor = get_post_meta($postid,'sh_txtcolor',true); 
			$subheaderpadding   = get_post_meta($postid,'sh_padding',true); 
			$sh_textcolor 		= $subheadertextcolor ? 'color:'.$subheadertextcolor.';':'';
			$sh_padding 		= $subheaderpadding 		? 'padding:'.$subheaderpadding.';':'';
			$subheader_properties = '';
			$sub_option ='';
			if ( !is_tax() ) {
				$sub_option			= get_post_meta( $postid, 'subheader_teaser_options', true );
			}

			if (is_page() || (is_single()) || is_page_template() || (!is_singular('portfoliotype')) || (is_front_page() && $postid != NULL) || (is_home() && $postid != NULL)){

				if( is_array($sh_bg_properties) && !empty($sh_bg_properties['0']['image']) ) {
					$subheader_properties = 'background:url('.$sh_bg_properties['0']['image'].') '.$sh_bg_properties['0']['position'].' '.$sh_bg_properties['0']['repeat'].' '.$sh_bg_properties['0']['attachement'].' '.$sh_bg_properties['0']['color'].';';
				}
				elseif( is_array($sh_bg_properties) && !empty($sh_bg_properties['0']['color']) ) {
					$subheader_properties = 'background-color:'.$sh_bg_properties['0']['color'].';';
				}elseif( !is_array($sh_bg_properties)  && $sh_bg_properties !='' ){	
					$subheader_properties  = 'background:url('.$sh_bg_properties.');';
				}
			
			$cssextras = ( $subheader_properties != '' || $sh_textcolor != '' || $sh_padding != ''  ) ? 'style="'.$subheader_properties.$sh_textcolor.$sh_padding.'"':'';

				switch($sub_option) {
					case 'custom':
							$title = $page->post_title;
							$subdesc = stripslashes(do_shortcode(get_post_meta($postid, "page_desc", true)));
							break;
					case 'twitter':
							$title = $page->post_title;
							ob_start();
							$subdesc = atp_generator('atp_customtwitter');
							$subdesc .= ob_get_clean();	
							wp_reset_query();
							break;
					case 'default':
							if(get_option('atp_teaser') == 'twitter') : 
								$title = $page->post_title;
								ob_start();
								$subdesc= atp_generator('atp_customtwitter');
								$subdesc .= ob_get_clean();	
							elseif(get_option('atp_teaser') == 'default') :
								$title = $page->post_title;
							elseif(get_option('atp_teaser') == 'disable') :
							else :
								$title = $page->post_title;
							endif;
							break;
					default:
							if(get_option('atp_teaser') == 'twitter') : 
								$title = $page->post_title;
								ob_start();
								$subdesc= atp_generator('atp_customtwitter');
								$subdesc .= ob_get_clean();	
							elseif(get_option('atp_teaser') == 'default') :
								$title = $page->post_title;
							elseif(get_option('atp_teaser') == 'disable') :
							else :
								$title = $page->post_title;
							endif;
							break;
				}
			}

			// iF IS  is_single   
			//--------------------------------------------------------
			if (is_single()) {
				$title = $page->post_title;
			}
			if (is_singular('video')) {
				$title = $page->post_title;
			}
			if(is_singular( 'portfoliotype' ) ||  is_singular( 'slider' ) || is_singular( 'albums' ) || is_singular( 'events' ) || is_singular( 'testimonialtype' ) ){
				$title = $page->post_title;
			}

			// iF IS  PAGE   B L O G 
			//--------------------------------------------------------
			if (is_home()) {
				$title = __('Blog','musicplay');
			}

			// IF IS  A R C H I V E
			//--------------------------------------------------------
			if(is_archive()) {
			
				$title = NULL;

				if(is_tax('genres') ){

					global $wp_query; 
					$taxonomy_archive_query_obj = $wp_query->get_queried_object();
					$ctitle = $taxonomy_archive_query_obj->name; // Taxonomy term name
					$title = sprintf( __( 'Albums Genre for: %s', 'musicplay' ), '<span>' . $ctitle . '</span>' );

				}
				if(is_tax('label') ){

					global $wp_query; 
					$taxonomy_archive_query_obj = $wp_query->get_queried_object();
					$ctitle = $taxonomy_archive_query_obj->name; // Taxonomy term name
					$title = sprintf( __( 'Albums Label for: %s', 'musicplay' ), '<span>' . $ctitle . '</span>' );

				}
				if(is_tax('events_cat') ){

					global $wp_query; 
					$taxonomy_archive_query_obj = $wp_query->get_queried_object();
					$ctitle = $taxonomy_archive_query_obj->name; // Taxonomy term name
					$title = sprintf( __( 'Events Archive for: %s', 'musicplay' ), '<span>' . $ctitle . '</span>' );

				}
				if(is_tax('artist_cat') ){

					global $wp_query; 
					$taxonomy_archive_query_obj = $wp_query->get_queried_object();
					$ctitle = $taxonomy_archive_query_obj->name; // Taxonomy term name
					$title = sprintf( __( 'Artist Archive for: %s', 'musicplay' ), '<span>' . $ctitle . '</span>' );

				}
				if(is_tax('video_type') ){

					global $wp_query; 
					$taxonomy_archive_query_obj = $wp_query->get_queried_object();
					$ctitle = $taxonomy_archive_query_obj->name; // Taxonomy term name
					$title = sprintf( __( 'Video Archive for: %s', 'musicplay' ), '<span>' . $ctitle . '</span>' );

				}
				if(is_tax('gallery_type') ){

					global $wp_query; 
					$taxonomy_archive_query_obj = $wp_query->get_queried_object();
					$ctitle = $taxonomy_archive_query_obj->name; // Taxonomy term name
					$title = sprintf( __( 'Gallery Archive for: %s', 'musicplay' ), '<span>' . $ctitle . '</span>' );

				}

				if ( is_category() || is_tag() ) {
					global $wp_query; 
					$taxonomy_archive_query_obj = $wp_query->get_queried_object();
					$title = $taxonomy_archive_query_obj->name; // Taxonomy term name
				}

				if ( is_day() ) :
							$subdesc=sprintf( __( 'Daily Archives: %s', 'musicplay' ), '<span>' . get_the_date() . '</span>' ); 
					elseif ( is_month() ) : 
							$subdesc= sprintf( __( 'Monthly Archives: %s', 'musicplay' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'musicplay' ) ) . '</span>' ); 
					elseif ( is_year() ) : 
							$subdesc=sprintf( __( 'Yearly Archives: %s', 'musicplay' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'musicplay' ) ) . '</span>' ); 
					else :
				endif;
			}
			// iF IS TAG PAGE  
			//--------------------------------------------------------
			if (is_tag()) {
				$title = NULL;
				$subdesc = sprintf( __( 'Tag Archives: %s', 'musicplay' ), '<span>' . single_tag_title( '', false ) . '</span>' );
			}
			// iF IS Category PAGE  
			//--------------------------------------------------------
			if (is_category()) {
				$title = NULL;
				$subdesc = sprintf( __( 'Category Archives: %s', 'musicplay' ), '<span>' . single_cat_title( '', false ) . '</span>' );
			}
			// IF IS  S E A R C H
			//--------------------------------------------------------

			if( is_search() ) {
				$subdesc = __('Search Results : '.stripslashes( strip_tags( get_search_query() ) ) ,'musicplay') ;
			}

			if(is_author()) {
				$title = NULL;
				$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
				$subdesc = sprintf(__('Archives Author: %s', 'musicplay'),$curauth->nickname);
				}
			// C U S T O M   S U B H E A D E R   P R O P E R T I E S 
			//--------------------------------------------------------
		
			$out = '';
			if( get_option('atp_teaser') != 'disable' ) {
				if( $sub_option != "disable" ){
					$out .= '<div id="subheader" '.$cssextras.'>';
					$out .= '<div class="inner">';
					$out .= '<div class="subdesc">';
					if( $title != '' ) {
						$out .= '<h1 class="page-title">'.$title.'</h1>';
					}
					$out .= '<div class="customtext">'.$subdesc.'</div>';
					$out .= '</div>';
					ob_start();
					$out .= atp_generator('breadcrumb',$postid);
					$out .= ob_get_clean();
					$out .= '</div>';
					$out .= '</div>';
				}else{
					if ($subbreadcrumb != 'on') {
						$out .= '<div id="subheader" '.$cssextras.' class="sub_disabled">';
						$out .= '<div class="inner">';
						ob_start();
						$out .= atp_generator('breadcrumb',$postid);
						$out .= ob_get_clean();
						$out .='</div>';
						$out .='</div>';
					}
				}
			}else{
				if ($subbreadcrumb != 'on') {
					$out .= '<div id="subheader" '.$cssextras.'>';
					$out .= '<div class="inner">';
					ob_start();
					$out .= atp_generator('breadcrumb',$postid);
					$out .= ob_get_clean();
					$out .='</div>';
					$out .='</div>';
				}
			}
			
			return $out;
		}

		// P O S T   F O R M A T   M E D I A   T Y P E
		//--------------------------------------------------------
		// Embed (Media) Player  to play audio/video or call slideshow or just embed image
		
		function embed_media( $postid, $type, $width = 1020) {
			switch($type) {
				case 'video' :
						$height = get_post_meta($postid, 'video_height', true);
						$m4v = get_post_meta($postid, 'video_m4v', true);
						$ogv = get_post_meta($postid, 'video_ogv', true);
						$poster = get_post_meta($postid, 'video_poster', true);
						include(THEME_DIR.'/jPlayer_mediatype.php');
						break;
				case 'audio' :
						$mp3 = get_post_meta($postid, 'audiopost_mp3', TRUE);
						$ogg = get_post_meta($postid, 'audio_ogg', TRUE);
						$poster = get_post_meta($postid, 'audio_poster', TRUE);
						$height = get_post_meta($postid, 'poster_height', TRUE);
						if($mp3 or $ogg or $poster or $height) {
							include(THEME_DIR.'/jPlayer_mediatype.php');
						}
						break;
			}
		}

		// P O S T   M E T A   D A T A 
		//--------------------------------------------------------
		function postmetaStyle() {
			global $format;
			ob_start();
			$out = '<div class="post-metadata">'; 
			echo '<span>';
			the_time(get_option('date_format'));
			echo '</span>/<span>By ';
            the_author_posts_link(); 
			echo '</span>/<span>In ';
			the_category(', ') ; 
			echo '</span>/<span> ';
			comments_popup_link( __( '0 Comment', 'musicplay' ), __( '1 Comment', 'musicplay' ), __( '% Comments', 'musicplay' ) );
			echo '</span>';
			$out .= ob_get_clean();
			$out .= '</div>';
			return $out;;
		}

		// B R E A D C R U M B S 
		//--------------------------------------------------------
		
		function breadcrumb($postid){
			$breadcrumb = get_post_meta($postid,'breadcrumb','true');
			if ( function_exists( 'bcn_display' ) ){ 
				if( $breadcrumb != 'on') {
					if(get_option('atp_breadcrumbs') != 'on' ) {
						echo '<div class="breadcrumbs">';
						bcn_display();
						echo '</div>';
					}
				}
			}
		}

		
		// A B O U T   A U T H O R 
		//--------------------------------------------------------
		function aboutauthor(){?>
			<div id="entry-author-info">
			<h4 class="fancyheading textleft"><span><?php _e('Written by ','musicplay'); ?><?php the_author_posts_link(); ?></span></h4>
				<div class="author_entry">
					<div class="author-avatar">
						<?php echo get_avatar(get_the_author_meta('email'), $size = '70', $default=''); ?>
					</div>
					<div class="author-description">
						<p><?php the_author_meta('description') ; ?></p>
					</div>
				</div>
			</div>
		<?php 
		} 

		// R E L A T E D   P O S T S 
		//--------------------------------------------------------
		function relatedposts($postid) {

		//Variables
		global $wpdb,$post;
		$tags = wp_get_post_tags($postid);
		if ($tags) {
			$tag_ids = array();
			foreach($tags as $individual_tag) {
				$tag_ids[] = $individual_tag->term_id;
			}

			$args = array(
				'tag__in'				=> $tag_ids,
				'post__not_in'			=> array($post->ID),
				'showposts'				=> 4, // Number of related posts that will be shown.
				'ignore_sticky_posts'	=>1
			);
			
			$related_post_found = "true";
			$my_query = new wp_query($args);

			if( $my_query->have_posts() ) {
				echo '<div class="related-posts"><div class="fancyheading textleft"><h4><span>'. __("You might also like", "musicplay").'</span></h4></div><ul>';
				while ( $my_query->have_posts() ) {
					$my_query->the_post();
					echo '<li>';
					echo '<a href="'.get_permalink($post->ID).'">'. get_the_title(). '</a> - <span>'.get_the_date().'</span>'; 
					echo '</li>';
				}
				echo '</ul>';
				echo '</div>';
				}
			}
			wp_reset_query();
		?>	
		<div class="clear"></div>
		<?php }
	}
	// end class
 }	
	/**
	 * Description Walker Class for Custom Menu
	 */
	class description_walker extends Walker_Nav_Menu {
	 function start_el(&$output, $object, $depth = 0, $args = array(), $current_object_id = 0){
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty( $object->classes ) ? array() : (array) $object->classes;
		$class=array();
		//$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		$class_names=apply_filters( 'nav_menu_css_class', array_filter( $classes ));
		foreach($class_names as $key=>$values){
				if($key!='0')
				{
				$class[].=$values;
				}
		}
		$custommneu_class = join( ' ',$class);
		$class_menu = ' class="'. esc_attr( $custommneu_class ) . '"';
		$output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $value . $class_menu.'>';
		$attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
		$attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
		$attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
		$attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';
		$prepend = '';
		$append = ''; 
		$description = '';
		$description  = ! empty( $object->attr_title ) ? '<span class="msubtitle">'.esc_attr( $object->attr_title ).'</span>' : '';

		if($depth != 0){
			 $description = $append = $prepend = "";
		}
		$object_output = $args->before;
		$object_output .= '<a'. $attributes .'>';
		if($classes['0']!=''){
		$object_output .='<i class=' .$classes['0'].'></i>';
		}
		$object_output .= $args->link_before .$prepend.apply_filters( 'the_title', $object->title, $object->ID ).$append;
		$object_output .= $description.$args->link_after;
		$object_output .= '</a>';
		$object_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
		}
	}

	// W R I T E   G E N E R A T O R
	//--------------------------------------------------------
	function atp_generator($function){
	//http:www//php.net/manual/en/function.call-user-func-array.php
	//http://php.net/manual/en/function.func-get-args.php	
		global $_atpgenerator;
		$_atpgenerator = new atpgenerator;
		$args = array_slice( func_get_args(), 1 );
		return call_user_func_array(array( &$_atpgenerator, $function ), $args );
	}
	// C U S T O M   E X C E R P T   L E N G T H
	//--------------------------------------------------------
	function excerpt($num) {
		$link = get_permalink();
		$ending = '...';
		$limit = $num+1;
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).$ending;
		echo $excerpt;
	}
	// C U S T O M   C O M M E N T   T E M P L A T E 
	//--------------------------------------------------------

	function atp_custom_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e( 'Pingback:', 'musicplay' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'musicplay' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment_wrap">
			<header class="comment-meta comment-author vcard">
				<?php
					echo get_avatar( $comment, 60 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'musicplay' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'musicplay' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->
			<section class="comment-content comment single_comment">
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'musicplay' ); ?></p>
				<?php endif; ?>
				
					<?php comment_text(); ?>
					<?php edit_comment_link( __( 'Edit', 'musicplay' ), '<p class="edit-link">', '</p>' ); ?>
				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'musicplay' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
			</section><!-- .comment-content -->
		</div><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
	} 
?>