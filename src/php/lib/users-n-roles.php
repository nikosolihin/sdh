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

function add_campus_manager_role_caps() {
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
}
add_action('admin_init', 'add_campus_manager_role_caps', 999);
