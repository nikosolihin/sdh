(function($) {

	// // Multisite dropdown
	// // Indonesian
	// $("#wp-admin-bar-blog-1-n").hide();
	// $("#wp-admin-bar-blog-1-c").hide();
	//
	// // English
	// $("#wp-admin-bar-blog-2-n").hide();
	// $("#wp-admin-bar-blog-2-c").hide();
	//
	// // Chinese
	// $("#wp-admin-bar-blog-3-n").hide();
	// $("#wp-admin-bar-blog-3-c").hide();
	//
	// // New Plus dropdown
	// $("#wp-admin-bar-new-post a").text("File");
	// $("#wp-admin-bar-new-post a").attr("href", "https://drive.google.com/");
	// $("#wp-admin-bar-new-post a").attr("target", "_blank");
	//
	// $("#wp-admin-bar-new-media a").text("Image");
	// $("#wp-admin-bar-new-media a").attr("href", "https://www.flickr.com/photos/upload/");
	// $("#wp-admin-bar-new-media a").attr("target", "_blank");
	//
	// $("#wp-admin-bar-new-user a").text("Form");
	// $("#wp-admin-bar-new-user a").attr("href", "https://docs.google.com/forms");
	// $("#wp-admin-bar-new-user a").attr("target", "_blank");
	//
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
	// 	// when a table is clicked, update the hash in the URL
	// 	$('.acf-tab-wrap .acf-tab-button').on('click', function($el){
	// 		location.hash='#'+$(this).text().toLowerCase().replace(' ', '-');
	// 	});
	// });
})(jQuery);
