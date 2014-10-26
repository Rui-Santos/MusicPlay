<?php if ( $type == 'video' ) { 

if( atp_generator( 'sidebaroption', $postid ) != "fullwidth" ) {
			$width = '670';
		} else {
			$width = '960';
		}


?>
<script type="text/javascript">
jQuery(document).ready(function(){
	if(jQuery().jPlayer) {
		jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
			ready: function () {
				jQuery(this).jPlayer("setMedia", {
					<?php if($m4v != '') : ?>
					m4v: "<?php echo $m4v; ?>",
					<?php endif; ?>
					<?php if($ogv != '') : ?>
					ogv: "<?php echo $ogv; ?>",
					<?php endif; ?>
					<?php if ($poster != '') : 
					$image = aq_resize( $poster, $width, '300', true );
					?>
					poster: "<?php echo $image; ?>"
					<?php endif; ?>
				});
			},
			size: {
				width: "100%",
				height: "100%"
			},
			play: function() { // To avoid both jPlayers playing together.
				jQuery(this).jPlayer("pauseOthers");
			},
			repeat: function(event) { // Override the default jPlayer repeat event handler
				if(event.jPlayer.options.loop) {
					jQuery(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
					jQuery(this).bind(jQuery.jPlayer.event.ended + ".jPlayer.jPlayerRepeat", function() {
						jQuery(this).jPlayer("play");
					});
				} else {
					jQuery(this).unbind(".jPlayerRepeat").unbind(".jPlayerNext");
					jQuery(this).bind(jQuery.jPlayer.event.ended + ".jPlayer.jPlayerNext", function() {
						jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer("play", 0);
					});
				}
			},
			swfPath: "<?php echo get_template_directory_uri(); ?>/js",
			cssSelectorAncestor: "#jp_container_<?php echo $postid; ?>",
			supplied: "<?php if($m4v != '') : ?>m4v, <?php endif; ?><?php if($ogv != '') : ?>ogv, <?php endif; ?> all"
		});
	}
});
</script>
<div id="skin-wrapper" data-skin-name="premium-pixels">
<div id="jp_container_<?php echo $postid; ?>" class="jp-video jp-video-270p">
	<div class="jp-type-single">
		<div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer"></div>
		<div class="jp-gui">
			<div class="jp-video-play">
				<a href="javascript:;" class="jp-video-play-icon" tabindex="1">play</a>
			</div>
			<div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
				<div class="jp-current-time"></div>
				<div class="jp-duration"></div>
				<div class="jp-controls-holder">
					<ul class="jp-controls">
						<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
						<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
						<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
					</ul>
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>
					<ul class="jp-toggles">
						<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat">repeat</a></li>
						<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off">repeat off</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php }elseif($type == 'audio') {

if( atp_generator( 'sidebaroption', $postid ) != "fullwidth" ) {
			$width = '670';
		} else {
			$width = '960';
		}

 ?>
<!-- Post Type Audio -->
<script type="text/javascript">
jQuery(document).ready(function(){
	if(jQuery().jPlayer) {
		jQuery("#jquery_jplayer_<?php echo $postid; ?>").jPlayer({
			ready: function () {
				jQuery(this).jPlayer("setMedia", {
					<?php 
					
					if($poster != '') : 
						$image = aq_resize( $poster, $width, '300', true );
					?>
					poster: "<?php echo $image; ?>",
					<?php endif; ?>
					<?php if($mp3 != '') : ?>
					mp3: "<?php echo $mp3; ?>",
					<?php endif; ?>
					<?php if($ogg != '') : ?>
					oga: "<?php echo $ogg; ?>",
					<?php endif; ?>
					end: ""
				});
			},
			<?php if( !empty($poster) ) { ?>
			size: {
				width: "100%",
				height: "<?php echo (int)$height . 'px'; ?>"
			},
			<?php } ?>
			swfPath: "<?php echo get_template_directory_uri(); ?>/js",
			cssSelectorAncestor: "#jp_interface_<?php echo $postid; ?>",
			supplied: "<?php if($ogg != '') : ?>oga,<?php endif; ?><?php if($mp3 != '') : ?>mp3, <?php endif; ?> all"
		});
	}
});
</script>
<div id="skin-wrapper" data-skin-name="premium-pixels">
<div id="jquery_jplayer_<?php echo $postid; ?>" class="jp-jplayer jp-jplayer-audio"></div>
	<div class="jp-audio-container">
		<div class="jp-audio">
			<div class="jp-type-single">
				<div id="jp_interface_<?php echo $postid; ?>" class="jp-interface">
					<ul class="jp-controls">
						<li><a href="#" class="jp-play" tabindex="1">play</a></li>
						<li><a href="#" class="jp-pause" tabindex="1">pause</a></li>
						<li><a href="#" class="jp-mute" tabindex="1">mute</a></li>
						<li><a href="#" class="jp-unmute" tabindex="1">unmute</a></li>
					</ul>
					<div class="jp-progress">
						<div class="jp-seek-bar">
							<div class="jp-play-bar"></div>
						</div>
					</div>
					<div class="jp-volume-bar">
						<div class="jp-volume-bar-value"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>