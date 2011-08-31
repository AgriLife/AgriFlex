<?php
/*
Template Name: Redirect
*/
?>

<?php 
/* 

USAGE INSTRUCTIONS:

1. Create a new page in WordPress
2. Add a title to the page
3. Add an URL to the content of the page (e.g. http://www.google.com OR google.com OR www.google.com)
4. Publish!

OR

use custom field "redirect"

*/
?>

<?php 
global $post;
if (have_posts()) : the_post(); 

	if (get_post_meta($post->ID, 'redirect', true)) :
		$URL = get_post_meta($post->ID, 'redirect', true);
	
	else :
	
		$URL = get_the_excerpt(); 
		if (!preg_match('/^http:\/\//', $URL)) $URL = 'http://' . $URL; 
		
	endif;
		
	if($URL) wp_redirect(clean_url($URL), 301);
	get_header();?>

<?php endif; ?>