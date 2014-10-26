	jQuery(document).ready(function(){
		jQuery('.group').hide();
		jQuery('.group:first').fadeIn();
		jQuery('#atp-nav li:first ').addClass('current');
		jQuery('#atp-nav li a').click(function(evt){
			jQuery('#atp-nav li').removeClass('current');
			jQuery(this).parent().addClass('current');
				var clicked_class = jQuery(this).attr('class');	
				if(clicked_class == "parent")
				{
					clicked_group = jQuery( this ).parent().find( '.sub-menu li a:first' ).attr( 'href' );
					jQuery('.group').hide();
					jQuery(clicked_group).fadeIn();
				}else{
					var clicked_group = jQuery(this).attr('href');
					jQuery('.group').hide();
					jQuery(clicked_group).fadeIn();
				//evt.preventDefault();
				}
			evt.preventDefault();
		});
					
		if(querystring_reset != ''){
			var reset_popup = jQuery('#atp-popup-reset');
				reset_popup.fadeIn();
				window.setTimeout(function(){
				reset_popup.fadeOut();                        
			}, 2000);
			//alert(response);
		}
						
		//Update Message popup
		jQuery.fn.center = function () {
			this.animate({"top":( jQuery(window).height() - this.height() - 200 ) / 2+jQuery(window).scrollTop() + "px"},100);
			this.css("left", 250 );
			return this;
		}

		jQuery('#atp-popup-save').center();
		jQuery('#atp-popup-reset').center();
		
		jQuery(window).scroll(function() { 
			jQuery('#atp-popup-save').center();
			jQuery('#atp-popup-reset').center();
		});
			
		//AJAX Upload
		jQuery('#atpform .image_upload_button').each(function(){
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');	
			new AjaxUpload(clickedID, {
				action: admin_ajax_url,
				name: clickedID, // File upload name
				data: { // Additional data to send
					action: 'atp_ajax_post_action',
					type: 'upload',
					data: clickedID },
				autoSubmit: true, // Submit file after selection
				responseType: false,
				onChange: function(file, extension){},
				onSubmit: function(file, extension){
					clickedObject.text('Uploading'); // change button text, when user selects file	
					this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
					interval = window.setInterval(function(){
						var text = clickedObject.text();
						if (text.length < 13){	clickedObject.text(text + '.'); }
						else { clickedObject.text('Uploading'); } 
					}, 200);
				},
				onComplete: function(file, response) {
					window.clearInterval(interval);
					clickedObject.text('Upload Image');	
					this.enable(); // enable upload button
					
					// If there was an error
					if(response.search('Upload Error') > -1){
						var buildReturn = '<span class="upload-error">' + response + '</span>';
						jQuery(".upload-error").remove();
						clickedObject.parent().after(buildReturn);
					
					}else{
						var buildReturn = '<img class="hide atp-option-image" id="image_'+clickedID+'" src="'+response+'" alt="" />';
						jQuery(".upload-error").remove();
						jQuery("#image_" + clickedID).remove();	
						clickedObject.parent().after(buildReturn);
						jQuery('img#image_'+clickedID).fadeIn();
						clickedObject.next('span').fadeIn();
						clickedObject.parent().prev('input').val(response);
					}
				}
			});
		});
				
		//AJAX Remove (clear option value)
		jQuery('.image_reset_button').click(function(){
			var clickedObject = jQuery(this);
			var clickedID = jQuery(this).attr('id');
			var theID = jQuery(this).attr('title');	

			var ajax_url = admin_ajax_url;
		
			var data = {
				action: 'atp_ajax_post_action',
				type: 'image_reset',
				data: theID
			};
				
			jQuery.post(ajax_url, data, function(response) {
				var image_to_remove = jQuery('#image_' + theID);
				var button_to_hide = jQuery('#reset_' + theID);
				image_to_remove.fadeOut(500,function(){ jQuery(this).remove(); });
				button_to_hide.fadeOut();
				clickedObject.parent().prev('input').val('');
			});
			return false; 
		}); 
				
		//Save everything else
		jQuery('#atpform').submit(function(){
			function newValues() {
				var serializedValues = jQuery("#atpform").serialize();
				return serializedValues;
			}
			
			jQuery(":checkbox, :radio").click(newValues);
			jQuery("select").change(newValues);
			jQuery('.ajax-loading-img').fadeIn();
			var serializedReturn = newValues();
			 
			var ajax_url = admin_ajax_url;
			
			if(querystring_page == 'optionsframework') {
				var data = {
					type: 'options',
					action: 'atp_ajax_post_action',
					data: serializedReturn
				};
			} else if(querystring_page == 'advance') {
				var data = {
					type: 'advance_options',
					action: 'atp_ajax_post_action',
					data: serializedReturn
				};
			}
			
				
			jQuery.post(ajax_url, data, function(response) {
				var success = jQuery('#atp-popup-save');
				var loading = jQuery('.ajax-loading-img');
				loading.fadeOut();  
				success.fadeIn();
				window.setTimeout(function(){
				   success.fadeOut(); 
				}, 2000);
			});
			return false; 
		});  
		sidemenu();	
	});
	function sidemenu() {
		jQuery("#atp-nav li ul").hide(); // Hide all sub menus
		jQuery("#atp-nav li a.current").parent().find("ul").slideToggle("slow"); 		
		jQuery("#atp-nav li a.parent").click( function () {
			jQuery(this).parent().siblings().find("ul").slideUp("normal"); 
			jQuery(this).next().slideToggle("normal"); 
			return false;
		});
	}