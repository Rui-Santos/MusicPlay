<?php 
$radio_ip = get_option('atp_radiostream_id');
$radio_autoplay = get_option('atp_radio_autoplay');
$radio_title = get_option('atp_radio_title');
$radio_desc = get_option('atp_radio_desc');
?>
<script type="text/javascript">
jQuery(document).ready(function($){
	var stream = {
		mp3: "<?php echo $radio_ip; ?>"
	},

	ready = false;

	$("#jquery_jplayer_1").jPlayer({
		ready: function (event) {
			ready = true;
			$(this).jPlayer("setMedia", stream);
		},
		pause: function() {
			$(this).jPlayer("clearMedia");
		},
		error: function(event) {
			if(ready && event.jPlayer.error.type === $.jPlayer.error.URL_NOT_SET) {
				// Setup the media stream again and play it.
				$(this).jPlayer("setMedia", stream)<?php if($radio_autoplay =='on'){ ?>.jPlayer("play") <?php } ?>;
			}
		},
		swfPath: "<?php echo get_template_directory_uri(); ?>/js",
		supplied: "mp3",
		preload: "none",
		wmode: "window",
		keyEnabled: true

	});
});
</script>
<div id="jp_container_1" class="jp-audio jp-radio">

	<div class="jp-type-single">
		<div class="jp-gui jp-interface">
		<div class="jp-inner">
		<div class="jp-close-btn">+</div>
			<ul class="jp-controls">
				<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
				<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
				<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
				<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
				<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
				<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
			</ul>
			<div class="jp-progress">
				<strong><?php echo $radio_title ?></strong>
				<span style="display:block;"><?php echo $radio_desc; ?></span>
			</div>
			<div class="jp-time-holder">
				<div class="jp-current-time"></div>
				
			</div>
			<div class="jp-volume-bar">
				<div class="jp-volume-bar-value"></div>
			</div>
		</div>
		</div>

	</div>
</div>