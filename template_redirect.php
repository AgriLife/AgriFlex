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
3. Add an URL to the content of the page (e.g. http://www.google.com)
4. Publish!

OR

use custom field "redirect"

*/

global $post;
if (have_posts()) : the_post(); 

	if (get_post_meta($post->ID, 'redirect', true)) :
		$URL = get_post_meta($post->ID, 'redirect', true);
	
	else :
	
		$URL = get_the_excerpt(); 
		if (!preg_match('/^http:\/\//', $URL)) $URL = 'http://' . $URL; 
		
	endif;
		
	//if($URL) wp_redirect(clean_url($URL), 301);
	//get_header();
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Refresh" content="0; url=<?php echo $URL; ?>"> 
</head>

<body>
</body>
</html>
<?php endif; ?>