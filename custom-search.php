<?php 
/***
 * Custom Search for Albums/Tracks and Artists
 *
 */
$search_option = get_option('atp_custom_search') ?  get_option('atp_custom_search') : 'enable';
if( $search_option == 'enable'){ ?>
 
	<div class="iva-music-bar">
		<div class="inner">
			<div class="one_half nomargin"> 
				<div class="searchmenu-wrap">
				
				<?php 
				$iva_genres_count = wp_count_terms( 'genres', array( 'orderby'=> 'name','hide_empty' => 1) );
				if ( !empty( $iva_genres_count ) ) { ?>
					<div class="searchmenu-align">
						<ul class="search-nav clearfix">
							<li><a href="#"><?php _e( 'Genres','musicplay');?></a>
								<div class="searchmenu-container">
									<?php
									$out = '';
									$terms = get_terms( array( 'genres'),array( 'orderby'=> 'name','hide_empty' => 1));
									$j = ( $iva_genres_count / 2 );
									$i = 1;
									if ( !empty( $terms ) && !is_wp_error( $terms ) ){
										foreach ( $terms as $term ) {
											if( ( $i == '1' )){
												$out .='<div class="searchmenu-col"><ul>';
											}
											$out .='<li><a class="'.$term->slug.' iva-search-genres" href="'. get_term_link( $term ).'" >' . $term->name . '</a></li>'; 
											if( ( $i == $j )){
												$out .='</ul></div>';
												$i=0;
											}
											$i++;
										}
									}
									echo $out;
									?>
								</div><!-- .container-2-->
							</li>
						</ul><!-- search-nav clearfix animated-->
					</div><!-- searchmenu-align-->
					
				<?php } ?>

				
				<?php 
				$iva_label_count = wp_count_terms( 'label', array( 'orderby'=> 'name','hide_empty' => 1) );
				if ( !empty( $iva_label_count ) ) { ?>

					<div class="searchmenu-align">
						<ul class="search-nav clearfix">
							<li><a href="#"><?php _e( 'Labels','musicplay');?></a>
						
								<div class="searchmenu-container">
									<?php
									$out = '';
									$terms = get_terms( array( 'label'),array( 'orderby'=> 'name','hide_empty' => 1));
									$j = ( $iva_label_count / 2 );
									$i = 1;
									if ( !empty( $terms ) && !is_wp_error( $terms ) ){
										foreach ( $terms as $term ) {
											if( ( $i == '1' )){
												$out .='<div class="searchmenu-col"><ul>';
											}
											$out .='<li><a class="'.$term->slug.' iva-search-labels" href="'. get_term_link( $term ).'" >' . $term->name . '</a></li>'; 
											if( ( $i == $j )){
												$out .='</ul></div>';
												$i=0;
											}
											$i++;
										}
									}
									echo $out;
									?>
								</div><!-- .container-2-->
							</li>
						</ul><!-- search-nav clearfix animated-->
					</div><!-- searchmenu-align-->
				<?php } ?>	
				</div><!-- searchmenu-wrap-->
			</div><!-- .one_half-->
		
			<div class="one_half last nomargin"> 
			
				<div class="iva-custom-search">
					<div class="iva-music-search-box">
						<script>
						jQuery(document).ready(function () {

							jQuery(".iva_search").on("input", function() {
							   jQuery("#search_val").val( jQuery(this).val());
							});

							jQuery(".iva_search_btn").click(function(){
								var search_keyword = jQuery(".iva_search").val();
								if( search_keyword =="" ){
									jQuery(".pop-modal").css('display', 'block');
									jQuery("#hide-box").click(function () {
										jQuery(".pop-modal").css('display', 'none');
									});
									jQuery("#hide-x").click(function () {
										jQuery(".pop-modal").css('display', 'none');
									});
									return false; 
								}else{
									return true; 
								}
							});
						});
						</script>
						<form method="get" action="<?php echo home_url(); ?>">
						
							<div class="pop-modal">
								<div class="pop-overlay" id="hide-box">&nbsp;</div>
								<div class="pop-box round-corners">
									<div class="xbutton round-corners" id="hide-x">&#215;</div>
									<p>Enter Keyword To Search</p>
								</div>
							</div>
								
							<input type='hidden' id="search_val" name='s' value=''>
							<input type='hidden' name='iva_search_keyword' value='Musicplay_Custom_Search'>
							
							<input type="text" class="iva_search" name="iva_search_input" placeholder="Search Album, Artist, Track" value="" size="25">
							<input type="submit" class="iva_search_btn btn greensea" value="<?php _e( 'Search', 'musicplay' ); ?>">
						
						</form>
					</div><!-- .recipesearch-box-->
				</div><!-- .iva-custom-search -->
				
			</div><!-- .one_half last-->
			
		</div><!-- .inner -->
	</div><!-- .iva-music-bar -->
	
<?php } ?>