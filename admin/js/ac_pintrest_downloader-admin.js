$( document ).ready( function () {


	var ajaxurl = ac_pintrest_downloader.ajaxurl;
	// ================================== Featch Data Function ===============================================
	// featch with force
	$( document ).on( "click", "#which-force", function () {
		var selected = $( "#printrest_url" ).val();

		var postdata = "action=ac_pintrest_downloader_ajax_request&url=" + selected;
		$.ajax( {
			type: "POST",
			url: ajaxurl,
			data: postdata,
			success: function ( response ) {
				// $( "#searchData" ).html( response );
				console.log( response );
			}
		} );
	} );

	// ========================================================================================================


} );