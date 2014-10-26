/** Handle Post Formats Custom Meta boxes **/
	function postformat_meta() {
  
		//show metat box based on selection of post format
		var postformat_type_grp = jQuery('#post-formats-select input');
			
		jQuery('#post-formats-select input').change(function () { 
			//hide all the post format meta boxes
			if(jQuery(this).is(':checked') === true) { //alert(jQuery(this).val());
				jQuery('div[class*="postformatmetabox-"]').hide();   
				jQuery('.postformatmetabox-'+jQuery(this).val()).show();
			}
		}).change();
	}

	styleSelect = {
		init: function () {
			jQuery('.select_wrapper').each(function () {
				jQuery(this).prepend('<span>' + jQuery(this).find('.select option:selected').text() + '</span>');
			});
			jQuery('.select').on('change', function () {
				jQuery(this).prev('span').replaceWith('<span>' + jQuery(this).find('option:selected').text() + '</span>');
			});
			jQuery('.select').bind(jQuery.browser.msie ? 'click' : 'change', function(event) {
				jQuery(this).prev('span').replaceWith('<span>' + jQuery(this).find('option:selected').text() + '</span>');
			}); 
		}
	};

	jQuery(document).ready(function($) {
		jQuery('.atp-radio-option').click(function(){
			jQuery(this).parent().parent().find('.atp-radio-option').removeClass('atp-radio-option-selected');
			jQuery(this).addClass('atp-radio-option-selected');
		});
		jQuery('.atp-radio-option').show();
		jQuery('.atp-radio-img-label').hide();
		jQuery('.atp-radio-img-radio').hide();
		postformat_meta();
		styleSelect.init();
		/*-- custom teaser option selection--*/
		jQuery("#atp_teaser").change(function () {
			jQuery(".atpteaseroption").hide();
			selected_teaser = jQuery("#atp_teaser option:selected").val();
			jQuery("."+selected_teaser).show();
		}).change();
	
		/*-- custom Testimonial uploadimage/gravatar selection--*/
		jQuery("#testimonial_image_option").change(function () {
			jQuery(".testimonialoption").hide();
			testimonialoption = jQuery("#testimonial_image_option option:selected").val();
			jQuery("."+testimonialoption).show();
		}).change();	
		
		/*-- custom Logo option selection--*/
		jQuery("#atp_logo").change(function () {
			jQuery(".title").hide();
			jQuery(".logo").hide();
			selected_teaser = jQuery("#atp_logo option:selected").val();
			jQuery("."+selected_teaser).show();
		}).change();	
		
		/*-- custom teaser option selection--*/
		jQuery("#subheader_teaser_options").change(function () {
			jQuery(".sub_teaser_option").hide();
			subheader_teaser_select = jQuery("#subheader_teaser_options option:selected").val();
			jQuery("."+subheader_teaser_select).show();
		}).change();
			
		/*-- Slider selection--*/
		jQuery("#page_slider").change(function () {
		jQuery(".page_slider").hide();
			chooseslider = jQuery("#page_slider option:selected").val();
			if(chooseslider !=""){
				jQuery("."+chooseslider).show();
			}
		}).change();
	
		/*-- custom slider selection--*/
		jQuery("#atp_slider").change(function () {
			jQuery(".atpsliders").hide();
			jQuery(".subtoggle").hide();
			selected_slider = jQuery("#atp_slider option:selected").val();
			if(selected_slider != "") {
				jQuery("."+selected_slider).show();
			}
		}).change();

		jQuery('#media-items').bind('DOMNodeInserted',function(){
			jQuery('input[value="Insert into Post"]').each(function(){
				jQuery(this).attr('value','Use This Image');
			});
		});
	
		/*-- Upload Image Remove-*/
		 jQuery('.cimage_remove').live('click', function(event) { 
		   var defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
		   jQuery(this).parent().siblings('.custom_upload_image').val('');
		   jQuery(this).parent('.screenshot').slideUp();
		   return false;
		});
		
		var custom_uploader,clickedID ,formfield = '';
		jQuery('.custom_upload_image_button').click(function() {
			clickedID = jQuery(this).attr('name');
			formfield = jQuery(this).prev( 'input').attr( 'name' );
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
				var image = /(^.*\.jpg|jpeg|png|gif*)/gi;
				if(typeof(attachment.sizes.thumbnail)  === "undefined") {
					if (attachment.url.match(image)) {
					  var  btnContent = '<img src="'+attachment.url+'" alt="" />';
					  btnContent += '<a href="javascript:(void);" class="cimage_remove button button-primary">x</a>';
					}
				}else if (attachment.sizes.thumbnail.url.match(image)) {
					var  btnContent = '<img src="'+attachment.sizes.thumbnail.url+'" alt="" />';
					btnContent += '<a href="javascript:(void);" class="cimage_remove button button-primary">x</a>'
				}
				
				jQuery( '#' + formfield).val(attachment.url);
				jQuery( '#' + formfield).siblings( '#atp_imagepreview-'+clickedID).slideDown().html(btnContent); 
			});		 
			//Open the uploader dialog
			custom_uploader.open();
			return false;
			
		});
		
			/*-- portfolio post type selection--*/
		jQuery("#port_posttype_option").change(function () {
			jQuery(".ptoption").hide();
			selected_ptoption = jQuery("#port_posttype_option option:selected").val();
			jQuery("."+selected_ptoption).show();
		}).change();
		
		jQuery("#postlinktype_options").change(function () {
			jQuery(".linkoption").hide();
			selected_ptoption = jQuery("#postlinktype_options option:selected").val();
			jQuery("."+selected_ptoption).show();
		}).change();
		
		jQuery("#video_type_option").change(function () {
			jQuery(".videotype").hide();
			selected_ptoption = jQuery("#video_type_option option:selected").val();
			jQuery("."+selected_ptoption).show();
		}).change();
		
	
		
		jQuery('.repeatable-add').click(function() {
			field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true);
			fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');
			jQuery('input', field).val('').attr('name', function(index, name) {
				return name.replace(/(\d+)/, function(fullMatch, n) {
					return Number(n) + 1;
				});
			})
			field.insertAfter(fieldLocation, jQuery(this).closest('td'))
			return false;
		});

		jQuery(window).load(function() {
    		jQuery('.page_load').fadeOut(600);
		});
	
		jQuery('.repeatable-remove').click(function(){
			jQuery(this).parent().remove();
			return false;
		});

	});
	jQuery(document).ready(function($) {
		window.restore_send_to_editor = window.send_to_editor;
		var shortcodecustom_uploader,shortcodeformfield,attachment;
		jQuery('.upload_sc').click(function($) {
		 shortcodeformfield = jQuery(this).siblings('.custom_upload_image');

		//If the uploader object has already been created, reopen the dialog
		if (shortcodecustom_uploader) {
			shortcodecustom_uploader.open();
			return;
		}

		//Extend the wp.media object
		shortcodecustom_uploader = wp.media.frames.file_frame = wp.media({
			title: 'Use This',
			button: {
				text: 'Use This'
			},
			multiple: false
		});

		//When a file is selected, grab the URL and set it as the text field's value
		shortcodecustom_uploader.on('select', function() {
			attachment = shortcodecustom_uploader.state().get('selection').first().toJSON();
			
			shortcodeformfield.val(attachment.url);
		});

		//Open the uploader dialog
		shortcodecustom_uploader.open();
	
		});
		// Color Picker
		jQuery('.wpcolorSelector').each(function(){
			var Othis = this; //cache a copy of the this variable for use inside nested function
			var initialColor = jQuery(Othis).prev('input').attr('value');
			var initialColorid = jQuery(Othis).prev('input').attr('id');
			jQuery(Othis).children('div').css('backgroundColor', initialColor);
			jQuery('#' + initialColorid).wpColorPicker({
					color: initialColor,
					onShow: function (colpkr) {
						jQuery(colpkr).fadeIn(500);
						return false;
					},
					onHide: function (colpkr) {
						jQuery(colpkr).fadeOut(500);
						return false;
					},
					onChange: function (hsb, hex, rgb) {
						jQuery(Othis).children('div').css('backgroundColor', '#' + hex);
						jQuery(Othis).prev('input').attr('value','#' + hex);
					}
				});
		}); 
		//end color picker	
		jQuery("#add-progressbar").click(function($) {	
	
					if(jQuery('.CircleCount').length>1){
						jQuery('.CircleCount:last-child').clone().appendTo('#circleWrap');
					}else{
						jQuery('.CircleCount').clone().appendTo('#circleWrap');				
					}
					jQuery('.CircleCount:last-child').find('.title').val('');
					jQuery('.CircleCount:last-child').find('.percent').val('');
					jQuery('.CircleCount:last-child').find('.color').val('');
					jQuery('.CircleCount:last-child .colorSelector').each(function(){
						var Othis = this; //cache a copy of the this variable for use inside nested function
						var initialColor = jQuery(Othis).prev('input').attr('value');
						var initialColorid = jQuery(Othis).prev('input').attr('id');
						jQuery(Othis).children('div').css('backgroundColor', initialColor);
						jQuery(".CircleCount:last-child .color").wpcolorSelector({
							color: "#000000",
							onShow: function (colpkr) {
							jQuery(colpkr).fadeIn(500);
							return false;
							},
							onHide: function (colpkr) {
							jQuery(colpkr).fadeOut(500);
							return false;
							},
							onChange: function (hsb, hex, rgb) {
							jQuery(Othis).children('div').css('backgroundColor', '#' + hex);
							jQuery(Othis).prev('input').attr('value','#' + hex);
							}
						});
					}); //end color picker
			return false;
		});
		jQuery("#circleWrap").on('click', '.close', function(){
			addrow = jQuery(this).parent('.CircleCount');
			if(jQuery('.CircleCount').length>1){
				addrow.remove();
			}else{
				alert('Insert at-least One Field');
			}
			return false;
		});

		function GoogleFontSelect( slctr, mainID ){
			var _selected = $(slctr).val(); 						//get current value - selected and saved
			var _linkclass = 'style_link_'+ mainID;
			var _previewer = mainID +'_ggf_previewer';
			
			if( _selected ){ //if var exists and isset
			
				$('.'+ _previewer ).fadeIn();
				
				//Check if selected is not equal with "Select a font" and execute the script.
				if ( _selected !== ' ' && _selected !== 'Select a font' ) {
					
					//remove other elements crested in <head>
					$( '.'+ _linkclass ).remove();
					var arr = [ "Arial", "Verdana", "Tahoma", "Sans-serif", "Lucida Grande" , "Georgia,serif", "Trebuchet MS, Tahoma, sans-serif", "Times New Roman, Geneva, sans-serif", "Palatino,Palatino Linotyp,serif","Helvetica Neue, Helvetica, sans-serif" ];
					if ($.inArray(_selected, arr) !== -1){
					
					}else{
						//replace spaces with "+" sign
						var the_font = _selected.replace(/\s+/g, '+');
						//add reference to google font family
							$('head').append('<link href="http://fonts.googleapis.com/css?family='+ the_font +'" rel="stylesheet" type="text/css" class="'+ _linkclass +'">');
					}
					//}
					//show in the preview box the font
					$('.'+ _previewer ).css('font-family', _selected +', sans-serif' );
					
				}else{
					
					//if selected is not a font remove style "font-family" at preview box
					$('.'+ _previewer ).css('font-family', '' );
					$('.'+ _previewer ).fadeOut();
					
				}
			
			}
	
		}
	
		//init for each element
		jQuery( '.google_font_select' ).each(function(){ 
			var mainID = jQuery(this).attr('id');
			GoogleFontSelect( this, mainID );
		});
		
		//init when value is changed
		jQuery( '.google_font_select' ).change(function(){ 
			var mainID = jQuery(this).attr('id');
			GoogleFontSelect( this, mainID );
		});
		//Chosen jquery for dropdown select
		jQuery(function($){
			var config = {
			  '.chosen-select'           : {},
			  '.chosen-select-deselect'  : {allow_single_deselect:true},
			  '.chosen-select-no-single' : {disable_search_threshold:10},
			  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
			  '.chosen-select-width'     : {width:"95%"}
			}
			for (var selector in config) {
			  jQuery(selector).chosen(config[selector]);
			}
		});
	});
