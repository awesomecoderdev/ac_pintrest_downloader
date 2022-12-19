$( document ).ready( function () {


	var ajaxurl = ac_pintrest_downloader.ajaxurl;
	
	// ================================== Featch Data Function ===============================================
	// featch with force
	$( document ).on( "submit", "#pinterest_form", function () {
	    
		var selected = $( "#pinterest_url" ).val();
		var loader = '<div class="pinterest_loader" style="display: block;"></div>';
		$( "#pinterest_result" ).html( loader );

		var postdata = "action=ac_pintrest_downloader_ajax_request&url=" + selected;
		$.ajax( {
			type: "POST",
			url: ajaxurl,
			data: postdata,
			success: function ( data ) {
				var response = $.parseJSON( data );
				console.log(response);
				if ( response.success ) {
					var output = '<div class="pinterest_content">';

					if ( response.type == "video" ) {
						output += '<video width="100%" height="350px" controls>';
						output += '<source src="' + response.url + '" class="pinterest_video" type="video/mp4">';
						output += '</video>';
					} else {
						output += '<img src="' + response.url + '" class="pinterest_gif">';
					}

					output += '</div>';
					output += '<div class="pinterest_download">';
					output += '<a href="' + response.url + '" target="_blank" class="pinterest_download_btn" download>Download</a>';
					output += '</div>';

					$( "#pinterest_result" ).html( output );
				} else {
					var output = '<div class="pinterest_content">';
					output += '<p class="pinterest_error">Nothing Found. Try another video</p>';
					output += '</div>';
					$( "#pinterest_result" ).html( output );
				}

			}
		} );
	} );

	// ========================================================================================================


} );