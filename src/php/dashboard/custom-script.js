(function($) {

	// Hide "New Post" and "Manage Comments" on Multisite dropdown
	// Main Site
	$("#wp-admin-bar-blog-1-n").hide();
	$("#wp-admin-bar-blog-1-c").hide();

	// Second Site
	$("#wp-admin-bar-blog-2-n").hide();
	$("#wp-admin-bar-blog-2-c").hide();

	// New Plus dropdown
	$("#wp-admin-bar-new-post a").text("File");
	$("#wp-admin-bar-new-post a").attr("href", "https://drive.google.com/");
	$("#wp-admin-bar-new-post a").attr("target", "_blank");

	$("#wp-admin-bar-new-media a").text("Image");
	$("#wp-admin-bar-new-media a").attr("href", "https://photos.google.com/");
	$("#wp-admin-bar-new-media a").attr("target", "_blank");

	$("#wp-admin-bar-new-user a").text("Form");
	$("#wp-admin-bar-new-user a").attr("href", "https://docs.google.com/forms");
	$("#wp-admin-bar-new-user a").attr("target", "_blank");

	// // Add URL friendly hashes to ACF tabs
	// // Useful if paired with zoneboard
	// acf.add_action('ready', function(){
	// 	// check if there is a hash
	// 	if (location.hash.length>1){
	// 		// get everything after the #
	// 		var hash = location.hash.substring(1);
	// 		// loop through the tab buttons and try to find a match
	// 		$('.acf-tab-wrap .acf-tab-button').each(function(i, button){
	// 			if (hash==$(button).text().toLowerCase().replace(' ', '-')){
	// 				// if we found a match, click it then exit the each() loop
	// 				$(button).trigger('click');
	// 				return false;
	// 			}
	// 		});
	// 	}
	//
	// // Cont: after hashes are added,
	// // update the hash in URL when a table is clicked.
	// $('.acf-tab-wrap .acf-tab-button').on('click', function($el){
	// 	location.hash='#'+$(this).text().toLowerCase().replace(' ', '-');
	// });

  // // There only an option to disable the "No Campus" option on // readio-button-for-taxonomies, but what SDH needs is to
  // // change the text to "Head Office". JS to the rescue.
  // var $headOffice = $("#campuschecklist.categorychecklist #campus-0 label");
	//
	// if ( $headOffice.length ) {
  // 	$headOffice.html( $headOffice.html().replace("No Campus", "Head Office") );
	// }
})(jQuery);
