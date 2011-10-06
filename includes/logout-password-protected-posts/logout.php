<?php
/*
Plugin Name:  Logout Password Protected Posts
Description:  Provides a template tag for a link for visitors to log out of password protected posts. Add <code>do_action('posts_logout_link')</code> to your theme where you want the link to appear.
Plugin URI:   http://lud.icro.us/wordpress-plugin-logout-password-protected-posts/
Version:      0.1
Author:       John Blackbourn
Author URI:   http://johnblackbourn.com/
License:      GNU General Public License

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

*/

function posts_logout() {
	if ( isset( $_REQUEST['action'] ) and ( 'posts_logout' == $_REQUEST['action'] ) ) {
		check_admin_referer( 'posts_logout' );
		setcookie( 'wp-postpass_' . COOKIEHASH, ' ', time() - 31536000, COOKIEPATH );
		wp_redirect( wp_get_referer() );
		die();
	}
}

function posts_logout_url() {
	return wp_nonce_url( add_query_arg( array( 'action' => 'posts_logout' ), get_bloginfo('home') . '/' ), 'posts_logout' );
}

function posts_logout_link( $text = '', $class = '' ) {
	if ( !isset( $_COOKIE['wp-postpass_' . COOKIEHASH] ) )
		return;
	if ( !$text )
		$text = 'Log out of password protected posts';
	if ( $class )
		$class = ' class="' . $class . '"';
	echo '<a href="' . posts_logout_url() . '"' . $class . '>' . $text . '</a>';
}

add_action( 'posts_logout_link', 'posts_logout_link', 10, 2 );
add_action( 'init', 'posts_logout' );

?>