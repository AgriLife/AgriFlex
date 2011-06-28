<?php

// Shortcodes
// -----------------------------------------------------------------------------
// Custom shortcodes


/**
 * The Child Page shortcode. [children]
 *
 * This lists children of the current page.
 **
 */
function child_pages_shortcode() {
	global $post;
	return '<ul class="childpages">'.wp_list_pages('echo=0&depth=0&title_li=&child_of='.$post->ID).'</ul>';
}
add_shortcode('children', 'child_pages_shortcode');




/**
 * The Home Gallery shortcode.
 *
 * This implements the functionality of the jQuery Gallery Shortcode for the Home template
 *
 * @param array $attr Attributes attributed to the shortcode.
 * @return string HTML content to display gallery.
 */
 add_shortcode('gallery_home', 'gallery_home_shortcode');
 
function gallery_home_shortcode($attr) {
	global $post;

	static $instance = 0;
	$instance++;

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters('post_gallery', '', $attr);
	if ( $output != '' )
		return $output;

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( !$attr['orderby'] )
			unset( $attr['orderby'] );
	}

	extract(shortcode_atts(array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post->ID,
		'size'       => array(585,305)
	), $attr));

	// dropped:
	// itemtag
	// icontag
	// captiontag
	// columns

	$id = intval($id);
	$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

	if ( empty($attachments) )
		return '';

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment )
			$output .= wp_get_attachment_link($att_id, $size, true) . "\n";
		return $output;
	}

	//$itemtag = tag_escape($itemtag);
	//$captiontag = tag_escape($captiontag);
	//$columns = intval($columns);
	//$itemwidth = $columns > 0 ? floor(100/$columns) : 100;

	$selector = "gallery-{$instance}";

	$output = apply_filters('gallery_home_style', "<div id='$selector' class='pics galleryid-{$id}'>");

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {
		$link = isset($attr['link']) && 'file' == $attr['link'] 
				? wp_get_attachment_image($id, $size, false) 
				: wp_get_attachment_image($id, $size, false);
				
		$image = wp_get_attachment_image_src($id,$size);
		//$output .= "\n<!-- ".$image[0]." -->";

		$output .= "\n	<div class='home-slide'>\n		";
		//$output .= '<img src="'.$image[0].'" alt="'.wptexturize($attachment->post_title).'" title="'.wptexturize($attachment->post_excerpt).'" />';
		// accomodate links : anchor tags
		$output .= '<img src="'.$image[0].'" alt="slide show image" title="" />';

		  if ( trim($attachment->post_excerpt) ) {
			  $output .= "<p class='home-caption'><span>" . wptexturize($attachment->post_title) . "</span>". wptexturize($attachment->post_excerpt) ."</p>";
		  }
		$output .= "\n	</div><!-- .gallery-icon -->";
	}
	$output .= "\n</div><!-- .pics -->\n";
	return $output;
}


/**
 * The Social Media Directory shortcode. [sm-directory]
 */
function sm_dir_shortcode() {
	global $post;
	
    // $array = get_cforms_entries();   /* all data, no filters */
	//$array = get_cforms_entries('Social Media Efforts',false,date ("Y-m-d H:i:s", time()-(3600*24*20)),'What AgriLife office do you represent?',false,'asc'); //20 day buffer
	//$array = get_cforms_entries('Social Media Efforts');
	$array = get_cforms_entries('Social Media Efforts',false,date ("Y-m-d H:i:s", time()),'What AgriLife office do you represent?',false,'asc');

	$return = '<div class="table2">
	<div class="t2-row"><div class="t2-dept"><h4>Department</h4></div><div class="t2-effort"><h4>SM Efforts</h4></div></div>';

	foreach( $array as $e ){
		if (($e['data']['Facebook Page or Group Address']<>'')
			|| ($e['data']['Facebook Page or Group Address'] <>'http://')
			|| ($e['data']['Twitter Account']<>'')
			|| ($e['data']['Twitter Account']<>'@username')
			|| ($e['data']['Flickr Photostream Address'] <> '') 
			|| ($e['data']['Flickr Photostream Address'] <> 'http://') 
			|| ($e['data']['Flickr Username'] <> '')
			|| ($e['data']['YouTube Username']<>'')
			|| ($e['data']['YouTube Username']<>'@username')
			|| ($e['data']['YouTube Channel Address']<>'')
			|| ($e['data']['YouTube Channel Address'] <> 'http://')) {
	
			$name = $e['data']['What AgriLife office do you represent?'];
			if($e['data']['Website']<>'' && $e['data']['Website']<>'http://')
				$name = '<a href="'.$e['data']['Website'].'" target="_blank">'.$name.'</a>';
			$return .=  '<div class="t2-row"><div class="t2-dept">' . $name . '</div>';
			$return .=  '<div class="t2-effort">';
			
			//Facebook
			if($e['data']['Facebook Page or Group Address']<>'' && $e['data']['Facebook Page or Group Address'] <>'http://') {
				$return .=  '<a href="'.$e['data']['Facebook Page or Group Address'].'" target="_blank"><img src="http://agrilifeweb.tamu.edu/us/files/2010/01/facebook.gif" alt="'.$e['data']['Facebook Page or Group Address'].'" /></a>';
			}
			
			//Flickr
			if ($e['data']['Flickr Photostream Address'] <> '' && $e['data']['Flickr Photostream Address'] <> 'http://') {
			  $return .=  '<a href="'.$e['data']['Flickr Photostream Address'].'">'.
			  '<img src="http://agrilifeweb.tamu.edu/us/files/2010/01/flickr.gif" alt="'.$e['data']['Flickr Photostream Address'] . ' Flickr Photos" /></a>';
			}
			
			//YouTube
			//if($e['data']['YouTube Username']<>'' && $e['data']['YouTube Username']<>'@username')
			//  $return .=  $e['data']['YouTube Username'] . '<br />';
			if($e['data']['YouTube Channel Address']<>'' && $e['data']['YouTube Channel Address'] <> 'http://') {
			  $return .=  '<a href="'.$e['data']['YouTube Channel Address'].'">'.
		  		'<img src="http://agrilifeweb.tamu.edu/us/files/2010/01/youtube.gif" alt="'.$e['data']['YouTube Channel Address'] . 
		  		' Flickr Photos" /></a>';
		  	}
		  	
		  	//Twitter
			if ($e['data']['Twitter Account']<>'' && $e['data']['Twitter Account']<>'@username') {	
				  $return .=  '<a href="'.$e['data']['Twitter Account'].'" target="_blank">'.
				  '<img src="http://agrilifeweb.tamu.edu/us/files/2010/01/twitter.gif" alt="'.$e['data']['Twitter Account'] . 
		  		  ' Twitter Page" /></a>';
			}
			
			//Blog
			if ($e['data']['Blog Address']<>'' && $e['data']['Blog Address'] <> 'http://') {
			  $return .=  '<a href="'.$e['data']['Blog Address'].'" target="_blank">'.
			  '<img src="http://agrilifeweb.tamu.edu/us/files/2010/01/rss.png" alt="'.$e['data']['What AgriLife office do you represent?'] . 
	  		  ' Blog" /></a>';
			}

			$return .=  '</div></div>';
		}
	}	
	$return .=  '</div><!-- .table2 -->';
	
	/* 
	$return .=  '<table>';
	$return .=  '<tr><th>Department</th><th>SM Efforts</th></tr>';
	foreach( $array as $e ){
		$return .=  '<tr valign="top"><td>' . $e['data']['What AgriLife office do you represent?'] . '</td>'.
		'<td>';
		
		if($e['data']['Website']<>'' && $e['data']['Website']<>'http://')
		  $return .=  $e['data']['Website'].'<br />';
		if ($e['data']['Blog Address']<>'' && $e['data']['Blog Address'] <> 'http://')
		  $return .=  $e['data']['Blog Address'] . '<br />';
		$return .=  '</td><tr>';
	}
	$return .=  '</table>';
	*/

	return $return;
}
add_shortcode('sm-directory', 'sm_dir_shortcode');

?>
