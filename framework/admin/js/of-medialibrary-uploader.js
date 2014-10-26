/*-----------------------------------------------------------------------------------*/
/* WooFramework Media Library-driven AJAX File Uploader Module
/* JavaScript Functions (2010-11-05)
/*
/* The code below is designed to work as a part of the WooFramework Media Library-driven
/* AJAX File Uploader Module. It is included only on screens where this module is used.
/*
/* Used with (very) slight modifications for Options Framework.
/*-----------------------------------------------------------------------------------*/

(function ($) {

  optionsframeworkMLU = {
  
/*-----------------------------------------------------------------------------------*/
/* Remove file when the "remove" button is clicked.
/*-----------------------------------------------------------------------------------*/
  
    removeFile: function () {
     
       $('.custom_clear_image_button').live('click', function(event) { 
        $(this).hide();
        $(this).parents().parents().children('.upload').attr('value', '');
        $(this).parents('.screenshot').slideUp();
        return false;
      });
      
      // Hide the delete button on the first row 
      $('a.delete-inline', "#option-1").hide();
      
    }, // End removeFile
    
/*-----------------------------------------------------------------------------------*/
/* Replace the default file upload field with a customised version.
/*-----------------------------------------------------------------------------------*/

    recreateFileField: function () {
    
      $('input.file').each(function(){
        var uploadbutton = '<input class="upload_file_button" type="button" value="Upload" />';
        $(this).wrap('<div class="file_wrap" />');
        $(this).addClass('file').css('opacity', 0); //set to invisible
        $(this).parent().append($('<div class="fake_file" />').append($('<input type="text" class="upload" />').attr('id',$(this).attr('id')+'_file')).val( $(this).val() ).append(uploadbutton));
 
        $(this).bind('change', function() {
          $('#'+$(this).attr('id')+'_file').val($(this).val());
        });
        $(this).bind('mouseout', function() {
          $('#'+$(this).attr('id')+'_file').val($(this).val());
        });
      });
      
    }, // End recreateFileField

/*-----------------------------------------------------------------------------------*/
/* Use a custom function when working with the Media Uploads popup.
/* Requires jQuery, Media Upload and Thickbox JavaScripts.
/*-----------------------------------------------------------------------------------*/

	mediaUpload: function () {
	
	jQuery.noConflict();
	
	$( 'input.upload_button' ).removeAttr('style');
	
	var formfield,
		formID,
		btnContent = true,
		tbframe_interval;
		// On Click
		$('input.upload_button').live("click", function () {
      
      
      var custom_uploader;
		
			formfield =  $(this).prev('input').attr('id');;
				if (custom_uploader) {
					custom_uploader.open();
					return;
				}
			//Extend the wp.media object
			custom_uploader = wp.media.frames.file_frame = wp.media({
				title: 'Use This',
				button: {
				text: 'Use This'
				},
					multiple: false
			});
			custom_uploader.on('select', function() {
				var attachment = custom_uploader.state().get('selection').first().toJSON();
				if(typeof(attachment.sizes)  != "undefined") {
					if(typeof(attachment.sizes.thumbnail)  === "undefined") {
						var image = /(^.*\.jpg|jpeg|png|gif*)/gi;
						if (attachment.url.match(image)) {
							var  btnContent = '<img src="'+attachment.url+'" alt="" /><a href="#" class="custom_clear_image_button button button-primary" href="javascript:(void);">x</a>';
						}
					 
					} else {
						var image = /(^.*\.jpg|jpeg|png|gif*)/gi;
						if (attachment.sizes.thumbnail.url.match(image)) {
							var  btnContent = '<img src="'+attachment.sizes.thumbnail.url+'" alt="" /><a href="#" class="custom_clear_image_button button button-primary" href="javascript:(void);">x</a>';
						}
					}
					  //alert('#atp_imagepreview-'+clickedID);
					jQuery( '#' + formfield).val(attachment.url);
					jQuery( '#' + formfield).siblings('.screenshot').slideDown().html(btnContent); 
				}else{
					jQuery( '#' + formfield).val(attachment.url);
					var  btnContent = '<a href="#" class="custom_clear_image_button button button-primary" href="javascript:(void);">x</a>';
					jQuery( '#' + formfield).val(attachment.url);
					jQuery( '#' + formfield).siblings('.screenshot').slideDown().html(btnContent); 
				}
			});
		 
			//Open the uploader dialog
			custom_uploader.open();
			return false;
		
	});
      
    } // End mediaUpload
   
  }; // End optionsframeworkMLU Object // Don't remove this, or the sky will fall on your head.

/*-----------------------------------------------------------------------------------*/
/* Execute the above methods in the optionsframeworkMLU object.
/*-----------------------------------------------------------------------------------*/
  
	$(document).ready(function () {

		optionsframeworkMLU.removeFile();
		optionsframeworkMLU.recreateFileField();
		optionsframeworkMLU.mediaUpload();
	
	});
  
})(jQuery);