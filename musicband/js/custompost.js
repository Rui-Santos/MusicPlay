/** Album upload Audio type js **/
jQuery("#audio_posttype_option").change(function () {
		jQuery(".audiopost").hide();
			chooseslider = jQuery("#audio_posttype_option option:selected").val();
			if(chooseslider !=""){
				jQuery("."+chooseslider).show();
			}
		}).change();


jQuery('#atp_event_pagination').change(function(){
		 var event_pagination = jQuery('[name="atp_event_pagination"]');
			if (event_pagination.is(':checked')) {
               jQuery('.event_limits').show();
            } else {
                jQuery('.event_limits').hide();
            }	
		}).change();
jQuery('#atp_audio_pagination').change(function(){
		 var pagination = jQuery('[name="atp_audio_pagination"]');
			if (pagination.is(':checked')) {
               jQuery('.audio_limits').show();
            } else {
                jQuery('.audio_limits').hide();
            }	
		}).change();	
jQuery('#atp_artist_pagination').change(function(){
		 var artist_pagination = jQuery('[name="atp_artist_pagination"]');
			if (artist_pagination.is(':checked')) {
               jQuery('.artist_limits').show();
            } else {
                jQuery('.artist_limits').hide();
            }	
		}).change();
jQuery('#atp_video_pagination').change(function(){
		 var artist_pagination = jQuery('[name="atp_video_pagination"]');
			if (artist_pagination.is(':checked')) {
               jQuery('.video_limits').show();
            } else {
                jQuery('.video_limits').hide();
            }	
		}).change();		
jQuery('#atp_gallery_pagination').change(function(){
		 var artist_pagination = jQuery('[name="atp_gallery_pagination"]');
			if (artist_pagination.is(':checked')) {
               jQuery('.gallery_limits').show();
            } else {
                jQuery('.gallery_limits').hide();
            }	
		}).change();				
jQuery('#atp_gallery_pagination').change(function(){
		 var artist_pagination = jQuery('[name="atp_gallery_pagination"]');
			if (artist_pagination.is(':checked')) {
               jQuery('.gallery_limits').show();
            } else {
                jQuery('.gallery_limits').hide();
            }	
		}).change();				
jQuery('#atp_djmix_pagination').change(function(){
		 var artist_pagination = jQuery('[name="atp_djmix_pagination"]');
			if (artist_pagination.is(':checked')) {
               jQuery('.djmix_limits').show();
            } else {
                jQuery('.djmix_limits').hide();
            }	
		}).change();				

/*-- custom Player selection--*/
	jQuery("#atp_audio_player").change(function () {
		jQuery(".audio_player").hide();
		selected_player = jQuery("#atp_audio_player option:selected").val();
		if(selected_player != "") {
			jQuery("."+selected_player).show();
		}
	}).change();