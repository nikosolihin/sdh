<?php
//=============================================
// Create the campus manager role
//=============================================
function add_campus_manager_role() {
	add_role('campus_manager', 'Campus Manager', array(
		'read' 					=> true,
		'edit_posts' 		=> false,
		'delete_posts' 	=> false,
		'publish_posts' => false,
		'upload_files' 	=> false,
	));
}
add_action('admin_init', 'add_campus_manager_role', 999);

//=============================================
// Assigns users capabilities for
// the campus post type
//=============================================
function add_campus_caps() {
	// Add the roles you'd like to administer the Campus custom post types
	$roles = array('campus_manager', 'administrator');

	// Loop through each role and assign capabilities
	foreach($roles as $the_role) {
		$role = get_role($the_role);
		$role->add_cap( 'read' );
		$role->add_cap( 'read_campus');
		$role->add_cap( 'read_private_campuses' );
		$role->add_cap( 'edit_campus' );
		$role->add_cap( 'edit_campuses' );
		$role->add_cap( 'edit_published_campuses' );
		$role->add_cap( 'publish_campuses' );
		$role->add_cap( 'delete_private_campuses' );
		$role->add_cap( 'delete_published_campuses' );
	}

	// Admin can see other users campus posts, but not
	// campus manager
	$admin = get_role('administrator');
	$admin->add_cap( 'edit_others_campuses' );
	$admin->add_cap( 'delete_others_campuses' );
}
add_action('admin_init', 'add_campus_caps', 999);
