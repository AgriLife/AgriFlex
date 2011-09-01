<?php
/**
 * Change Default Role Permissions
 * For more info about the options available visit: http://codex.wordpress.org/Roles_and_Capabilities
 */


/**
 * Add new permissions/capabilities to a specific role
 *
 * @param string $role
 * @param string $cap
 */
function add_capability($role,$cap) {
	$role_obj = get_role($role); // get the the role object
	$role_obj->add_cap($cap); // add $cap capability to this role object
}
//add_capability('subscriber','read_private_pages'); //Example

/**
 * Remove existing permissions/capabilities to a specific role
 *
 * @param string $role
 * @param string $cap
 */
function remove_capability($role,$cap) {
	$role_obj = get_role($role); // get the the role object
	$role_obj->remove_cap($cap); // add $cap capability to this role object
}
//remove_capability('subscriber','read_private_pages'); //Example

add_capability('editor','edit_theme_options');  // Allow an editor to edit widgets 

//Remove unwanted wdigets from dashboard
function remove_dashboard_widgets(){
	global $wp_meta_boxes;
	
	//remove gravity forms dashboard widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['rg_forms_dashboard']);
	
	//remove Twitter Widget Pro/xavisys dashboard widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboardb_xavisys']);
	
	//remove Yoast breadcrumb dashboard widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['yoast_db_widget']);
	
	// remove core widgets
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
  
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets', 11);

?>