jQuery(document).ready(function($) {
	// audiobuttons Meta
	jQuery("#add-buttons").click(function($) {	
		if(jQuery('.buttonsCount buttonsort tr').length>1){
			jQuery('.buttonsCount table tbody>tr:first').clone().insertAfter('.buttonsCount table tbody>tr:last');
		}else{
			jQuery('.buttonsCount table tbody>tr:first').clone().insertAfter('.buttonsCount table tbody>tr:last');	
		}
		jQuery('.buttonsCount table tbody>tr:last').find('.buttonname').val('');
		jQuery('.buttonsCount table tbody>tr:last').find('.buttonurl').val('');
		jQuery('.buttonsCount table tbody>tr:last').find('.buttoncolor').val('');
		
		return false;
	});
	
	jQuery("#buttonsWrap").on('click', '.button-primary', function(){
		addrow = jQuery(this).parent().parent();
		if(jQuery('.buttonsCount table tbody>tr').length>1){
			addrow.remove();
		}else{
			alert('Insert at-least One Field');
		}
		return false;
	});

	// audiobuttons Meta
	jQuery("#add-mp3url").click(function($) {	
		if(jQuery('.mp3urlCount buttonsort tr').length>1){
			jQuery('.mp3urlCount table tbody>tr:first').clone().insertAfter('.mp3urlCount table tbody>tr:last');
		}else{
			jQuery('.mp3urlCount table tbody>tr:first').clone().insertAfter('.mp3urlCount table tbody>tr:last');	
		}
		jQuery('.mp3urlCount table tbody>tr:last').find('.buttonmp3').val('');
		jQuery('.mp3urlCount table tbody>tr:last').find('.buttontitle').val('');
		jQuery('.mp3urlCount table tbody>tr:last').find('.buttondownload').val('');
		jQuery('.mp3urlCount table tbody>tr:last').find('.buttonbuylink').val('');
		jQuery('.mp3urlCount table tbody>tr:last').find('.buttonlyrics').val('');
		
		return false;
	});
	
	jQuery(".mp3externalwrap").on('click', '.button-primary', function(){
		addrow = jQuery(this).parent().parent();
		if(jQuery('.mp3urlCount table tbody>tr').length>1){
			addrow.remove();
		}else{
			alert('Insert at-least One Field');
		}
		return false;
	});
	// drag drop
	jQuery('table#buttonsort tbody').sortable({
		  //helper: fixHelper
	});

});