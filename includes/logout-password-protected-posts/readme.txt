=== Logout Password Protected Posts ===
Contributors: johnbillion
Tags: password, logout
Requires at least: 2.7
Tested up to: 3.2
Stable tag: trunk

Provides a template tag for a link for visitors to log out of password protected posts. Add <code>do_action('posts_logout_link')</code> to your theme where you want the link to appear.

== Description ==

There is no built-in way for your visitors to "log out" of password protected posts once they've entered the password. Even logged in users cannot log out of password protected posts by logging out of their account. This plugin solves that problem by providing a link for your visitors which will log them out of password protected posts when clicked.

== Installation ==

1. Unzip the ZIP file and drop the folder straight into your wp-content/plugins directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Add <code><?php do_action('posts_logout_link'); ?></code> somewhere in your theme.

Those people who are logged in to password protected posts will now see a link to log out.

== Frequently Asked Questions ==

= I've added the template tag to my theme but can't see the link. What's up? =

Ensure that you have entered a password for a password protected post. The link will not show up if you're not logged into a password protected post.

= Can I change the default text in the link? =

Sure. Add a second parameter to the template tag with the text you'd like instead. For example: <code><?php do_action('posts_logout_link','Log out!'); ?></code>

For those who want even more control, you can also add a third paramter which will be used as the class name on the link element.

== Changelog ==

= 0.1 =
* Initial release.
