jQuery.fn.exists = function () {
    return jQuery(this).length > 0;
}
jQuery(document).ready(function($) {
 
    if($(".plupload-upload-uic").exists()) {
        var pconfig=false;
        $(".plupload-upload-uic").each(function() {
            var $this=$(this);
            var id1=$this.attr("id");
            var imgId=id1.replace("plupload-upload-ui", "");
            plu_show_thumbs(imgId);
			var filters = jQuery(".format_filter").val();
			base_plupload_config = $.extend( {
				filters   : [{ title : "Allowed Files", extensions :filters }]
			}, base_plupload_config );
            pconfig = JSON.parse(JSON.stringify(base_plupload_config));
            pconfig["browse_button"] = imgId + pconfig["browse_button"];
            pconfig["container"] = imgId + pconfig["container"];
            pconfig["drop_element"] = imgId + pconfig["drop_element"];
            pconfig["file_data_name"] = imgId + pconfig["file_data_name"];
	   
            pconfig["multipart_params"]["imgid"] = imgId;
            pconfig["multipart_params"]["_ajax_nonce"] = $this.find(".ajaxnonceplu").attr("id").replace("ajaxnonceplu", "");
 
            if($this.hasClass("plupload-upload-uic-multiple")) {
                pconfig["multi_selection"]=true;
            }else{
				 pconfig["multi_selection"]=false;
			}

            if($this.find(".plupload-resize").exists()) {
                var w = parseInt($this.find(".plupload-width").attr("id").replace("plupload-width", ""));
                var h = parseInt($this.find(".plupload-height").attr("id").replace("plupload-height", ""));
                pconfig["resize"] = {
                    width : w,
                    height : h,
                    quality : 90
                };
            }
 
            var uploader = new plupload.Uploader(pconfig);
            uploader.bind('Init', function(up){
 
            });
 
            uploader.init();
 
            // a file was added in the queue
            uploader.bind('FilesAdded', function(up, files){
                $.each(files, function(i, file) {
                    $this.find('.filelist').append(
                        '<div class="file" id="' + file.id + '"><b>' +
 
                        file.name + '</b> (<span>' + plupload.formatSize(0) + '</span>/' + plupload.formatSize(file.size) + ') ' +
                        '<div class="fileprogress"></div></div>');
                });
 
                up.refresh();
                up.start();
            });
 
            uploader.bind('UploadProgress', function(up, file) {
 
                $('#' + file.id + " .fileprogress").width(file.percent + "%");
                $('#' + file.id + " span").html(plupload.formatSize(parseInt(file.size * file.percent / 100)));
            });
 
            // a file was uploaded
            uploader.bind('FileUploaded', function(up, file, response) {
                $('#' + file.id).fadeOut();
		        response1=response['response'];
				response2=JSON.parse(response1);
				//alert(obj.a);
                // add url to the hidden field
                if($this.hasClass("plupload-upload-uic-multiple")) {
                    // multiple
                    var v1=$.trim($("#" + imgId).val());
					var v2= $( "#" + imgId).attr( "data-title");
					var  v3= $( "#" + imgId).attr( "data-url");
					var  v4= $( "#" + imgId).attr( "data-img");

                    if(v1 && v2 && v3 && v4) {
                        v1 = v1 + "," + response2['audioid'];
						v2 = v2 + "," + response2['name'];
						v3 = v3 + "," + response2['link'];
						v4 = v4 + "," + response2['img'];
                    } else {
						v1 = response2['audioid'];
						v2 = response2['name'];
						v3 = response2['link'];
						v4 = response2['img'];
                    }
					
					//alert(v1['url']);
					$("#" + imgId).val(v1);
					$( "#" + imgId).attr( "data-title",v2 );
					$( "#" + imgId).attr( "data-url",v3 );
					$( "#" + imgId).attr( "data-img",v4 );
                } else {
                    // single
					$("#" + imgId).val(response2['audioid']);
					$( "#" + imgId).attr( "data-title",response2['name']);
					$( "#" + imgId).attr( "data-url",response2['link']);
					$( "#" + imgId).attr( "data-img",response2['img']);
                }
                // show thumbs 
                plu_show_thumbs(imgId,v2,v3,v4);
            });
        });
    }
});
 
function plu_show_thumbs(imgId,title,url,image) {
	var $=jQuery;
	var thumbsC=$("#" + imgId + "plupload-thumbs");
	thumbsC.html("");
	// get urls
	var imagesS=$("#"+imgId).val();
	var title= $( "#" + imgId).attr("data-title");
	var url= $( "#" + imgId).attr( "data-url");
	var image= $( "#" + imgId).attr( "data-img");

	var images=imagesS.split(",");
	//alert(images);
	var title=title.split(",");
	var url=url.split(",");
	var image=image.split(",");
	for(var i=0; i<images.length; i++) {
		if(image[i]) {
			if (image[i].match(/(?:gif|jpg|png|bmp|tif)$/)) {
				var thumb = $('<li class="gallery-item sort" data-url="'+url[i]+'" data-img="' + image[i] + '"  data-title="'+title[i]+'" data-value="' + images[i] + '" id="audio-' + imgId +  i + '"><img  width="150" height="150" src="' + image[i] + '" /><div class="iva-gallery-item"><div class="iva-gallery-act"><a class="iva-audio-del delete" href="'+url[i]+'" target="_blank"  onclick="return showNotice.warn();">Delete</a> / <a class="iva-audio-edt edit" href="'+url[i]+'" target="_blank">Edit</a></div></div></li>');
		} else {
				var thumb = $('<li class="audio-item sort"  data-url="'+url[i]+'" data-img="' + image[i] + '"  data-title="'+title[i]+'" data-value="' + images[i] + '" id="audio-' + imgId +  i + '"><img  src="' + atp_panel['SiteUrl'] + '/images/audio_box.png" /><div class="iva-audio-item"><div class="iva-audio-title">'+title[i]+'</div><div class="iva-audio-act"><a class="iva-audio-del delete" href="'+url[i]+'" target="_blank"  onclick="return showNotice.warn();">Delete</a> / <a class="iva-audio-edt edit" href="'+url[i]+'" target="_blank">Edit</a></div></div></li>');
	
				
			}
			thumbsC.append(thumb);

		}
	}
      if(images.length > 1) {
        thumbsC.sortable({
            update: function(event, ui) {
                var kimages=[];
				var ktitle=[];
				 var kurl=[];
				  var kimg=[];
                thumbsC.find(".sort").each(function() {
					//alert($(this).attr("id"));
                    kimages[kimages.length]=$(this).attr("data-value");
					ktitle[ktitle.length]=$(this).attr("data-title");
					kurl[kurl.length]=$(this).attr("data-url");
					kimg[kimg.length]=$(this).attr("data-img");
                    $("#"+imgId).val(kimages.join());
					$("#"+imgId).attr('data-title',ktitle.join());
					$("#"+imgId).attr('data-url',kurl.join());
					$("#"+imgId).attr('data-img',kimg.join());
                    plu_show_thumbs(imgId);
                });
            }
        });
        thumbsC.disableSelection();
    }
}