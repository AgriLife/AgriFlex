<?php
/**
 * Widget: Watch, Read, Listen
 * Three widgets in one with thoughtful defaults in case of absentee user.
 */

class WatchReadListenWidget extends WP_Widget {
	function WatchReadListenWidget() {
	//Constructor
		$widget_ops = array('classname' => 'widget Watch Read Listen', 'description' => 'Pick a YouTube Video and a Podcast RSS feed. *coming soon* AgriLife Bookstore Items' );
		$this->WP_Widget('WatchReadListenWidget', 'AgriLife: Watch, Read, Listen', $widget_ops);
	}

	function widget($args, $instance) {
	// Set YouTube Default
	$youtube_video_default = 'http://www.youtube.com/watch?v=q_UsLHl_YDQ';
	// Set Podcast Default
	$podcast_link_default  = 'http://tmnpodcast.libsyn.com/rss';
	// prints the widget
		if ( isset($instance['error']) && $instance['error'] )
			return;
		extract($args, EXTR_SKIP);
		
		
		// YouTube Processing
 		$user_video = empty($instance['youtube_video']) ? $youtube_video_default : apply_filters('widget_youtube_video', $instance['youtube_video']);
 		// If a URL was passed
		if ( 'http://' == substr( $user_video, 0, 7 ) ) {
			// Playlist URL
			if ( FALSE !== stristr( $user_video, 'view_play_list' ) ) {
				preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/view_play_list\?p=([\w-]+)(.*?)#i', $user_video, $matches );
				if ( empty($matches) || empty($matches[2]) ) return $this->error( sprintf('Unable to parse URL, check for correct %s format', __('YouTube') ) );
				$embedpath = 'p/' . $matches[2];
				$fallbacklink = $fallbackcontent = 'http://www.youtube.com/view_play_list?p=' . $matches[2];
			}
			// Normal video URL
			else {
				preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(watch\?v=|w/\?v=|\?v=)([\w-]+)(.*?)#i', $user_video, $matches );
				if ( empty($matches) || empty($matches[3]) ) return $this->error( sprintf('Unable to parse URL, check for correct %s format', __('YouTube') ) );

				$embedpath = 'v/' . $matches[3];
				$fallbacklink = 'http://www.youtube.com/watch?v=' . $matches[3];
				$fallbackcontent = '<img src="http://img.youtube.com/vi/' . $matches[3] . '/0.jpg" alt="' . __('YouTube Preview Image', 'vipers-video-quicktags') . '" />';
			}
		}
		// If a URL wasn't passed, assume a video ID was passed instead
		else {
			$embedpath = 'v/' . $user_video;
			$fallbacklink = 'http://www.youtube.com/watch?v=' . $user_video;
			$fallbackcontent = '<img src="http://img.youtube.com/vi/' . $user_video . '/0.jpg" alt="' . __('YouTube Preview Image', 'vipers-video-quicktags') . '" />';
		}
		
		$youtube_video = 'http://www.youtube.com/' . $embedpath;

 		
 		// Podcast Processing
 		$podcast_link = empty($instance['podcast_link']) ? $podcast_link_default : apply_filters('widget_podcast_link', $instance['podcast_link']);
		$rss = fetch_feed($podcast_link);
		if ( ! is_wp_error($rss) ) {
			$podcast_desc = esc_attr(strip_tags(@html_entity_decode($rss->get_description(), ENT_QUOTES, get_option('blog_charset'))));
			$podcast_title= esc_attr(strip_tags(@html_entity_decode($rss->get_title(), ENT_QUOTES, get_option('blog_charset'))));
			$podcast_link_audio= esc_attr(strip_tags(@html_entity_decode($rss->get_link(), ENT_QUOTES, get_option('blog_charset'))));
			if ( empty($title) )
				$title = esc_html(strip_tags($rss->get_title()));
			$link = esc_url(strip_tags($rss->get_permalink()));
			while ( stristr($link, 'http') != $link )
				$link = substr($link, 1);
			$podcast_site_link = $link;
		}
		
		echo $before_widget;
		 ?>
		 
<div class="watchreadlisten-bg widget">
	<div id="tabs">	
	<ul>
		<li><a href="#tabs-1">Watch</a></li>
		<li><a href="#tabs-2">Read</a></li>
		<li><a href="#tabs-3">Listen</a></li>
	</ul>
		<div id="tabs-1">
		<?php // Watch Tab ?>
		<object type="application/x-shockwave-flash" width="348" height="221" data="<?php echo $youtube_video;?>">
			<param name="movie" value="<?php echo $youtube_video;?>">
			<param name="allowFullScreen" value="true">
			<param name="allowscriptaccess" value="always">
</object>	
		<?php // END Watch Tab ?>		
		</div>
		<div id="tabs-2">		
			<?php // Read Tab ?>
			<ul class="books">
				<li>
					<a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=2423">
					<dl>
						<dt class="book-title">Brush &amp; Weeds</dt>	
						<dd class="book-cover"><img class="book" src="http://brazos.agrilife.org/wp-content/themes/county/images/brush-weeds-cover.png" /></dd>
						<dd class="price"><em>$</em>19<span>99</span></dd>	
					</dl>
					</a>
					<p class="buy btn"><a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=2423">Buy</a></p>					
				</li>
				<li>	
					<a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=1979">
					<dl>
						<dt class="book-title">Rainwater Harvest</dt>	
						<dd class="book-cover"><img class="book" src="http://brazos.agrilife.org/wp-content/themes/county/images/rainwater-harvest-cover.png" /></dd>
						<dd class="price"><em></em>Free<span></span></dd>						
					</dl>
					</a>
					<p class="buy btn"><a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=1979">Read</a></p>					
				</li>
			</ul>
			<?php // END Read Tab ?>
			</div>		
		<div id="tabs-3">
			<?php // Listen Tab ?>
			<h4><a href="<?php echo $podcast_site_link;?>"><?php echo $podcast_title;?></a></h4>
			<?php wp_widget_rss_podcast_output( $rss, $instance ); ?>
		
			<!--<p><?php echo $podcast_desc;?></p>-->
			<?php // END Listen Tab ?>
		</div>
	
		
	</div>							
	</div>
				<?php 
	echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		$instance['youtube_video'] = strip_tags($new_instance['youtube_video']);
		$instance['podcast_link'] = strip_tags($new_instance['podcast_link']);
		return $instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array('youtube_video' => '', 'podcast_link' => '' ) );
		$youtube_video = strip_tags($instance['youtube_video']);
		$podcast_link = strip_tags($instance['podcast_link']);

?>
<p>
  <label for="<?php echo $this->get_field_id('youtube_video'); ?>">YouTube Video Link: <br /><code>http://www.youtube.com/watch?v=iRbX2uPgGsw</code>
  <input class="widefat" id="<?php echo $this->get_field_id('youtube_video'); ?>" name="<?php echo $this->get_field_name('youtube_video'); ?>" type="text" value="<?php echo attribute_escape($youtube_video); ?>" />
  </label>
</p>
<p>
  <label for="<?php echo $this->get_field_id('podcast_link'); ?>">Podcast Link: <br /><code>http://tmnpodcast.libsyn.com/rss</code>
  <input class="widefat" id="<?php echo $this->get_field_id('podcast_link'); ?>" name="<?php echo $this->get_field_name('podcast_link'); ?>" type="text" value="<?php echo attribute_escape($podcast_link); ?>" />
  </label>
</p>
<?php
	}

}

register_widget('WatchReadListenWidget');




/**
 * Display the RSS podcast entries in a list
 *
 * @since 2.5.0
 *
 * @param string|array|object $rss RSS url.
 * @param array $args Widget arguments.
 */
function wp_widget_rss_podcast_output( $rss, $args = array() ) {
	if ( is_string( $rss ) ) {
		$rss = fetch_feed($rss);
	} elseif ( is_array($rss) && isset($rss['url']) ) {
		$args = $rss;
		$rss = fetch_feed($rss['url']);
	} elseif ( !is_object($rss) ) {
		return;
	}

	if ( is_wp_error($rss) ) {
		if ( is_admin() || current_user_can('manage_options') )
			echo '<p>' . sprintf( __('<strong>RSS Error</strong>: %s'), $rss->get_error_message() ) . '</p>';
		return;
	}

	$default_args = array( 'show_author' => 0, 'show_date' => 0, 'show_summary' => 0 );
	$args = wp_parse_args( $args, $default_args );
	extract( $args, EXTR_SKIP );

	$items = 1;  // Just show the latest podcast
	$show_summary  = (int) $show_summary;
	$show_author   = (int) $show_author;
	$show_date     = (int) $show_date;

	if ( !$rss->get_item_quantity() ) {
		echo '<ul><li>' . __( 'An error has occurred; the feed is probably down. Try again later.' ) . '</li></ul>';
		$rss->__destruct();
		unset($rss);
		return;
	}

	echo '<ul>';
	foreach ( $rss->get_items(0, $items) as $item ) {
		$link = $item->get_link();
		while ( stristr($link, 'http') != $link )
			$link = substr($link, 1);
		$link = esc_url(strip_tags($link));
		$title = esc_attr(strip_tags($item->get_title()));
		if ( empty($title) )
			$title = __('Untitled');

		$desc = str_replace( array("\n", "\r"), ' ', esc_attr( strip_tags( @html_entity_decode( $item->get_description(), ENT_QUOTES, get_option('blog_charset') ) ) ) );
		$desc = wp_html_excerpt( $desc, 360 );

		// Append ellipsis. Change existing [...] to [&hellip;].
		if ( '[...]' == substr( $desc, -5 ) )
			$desc = substr( $desc, 0, -5 ) . '[&hellip;]';
		elseif ( '[&hellip;]' != substr( $desc, -10 ) )
			$desc .= ' [&hellip;]';

		$desc = esc_html( $desc );

		if ( $show_summary ) {
			$summary = "<div class='rssSummary'>$desc</div>";
		} else {
			$summary = '';
		}
	  
		if ($enclosure = $item->get_enclosure())
		{
			echo "<li><embed type=\"application/x-shockwave-flash\" flashvars=\"audioUrl=".$enclosure->get_link()."\" src=\"http://www.google.com/reader/ui/3523697345-audio-player.swf\" width=\"400\" height=\"27\" quality=\"best\"></li>";
		}
		
	}
	echo '</ul>';
	$rss->__destruct();
	unset($rss);
}






















/**
 * Widget: AgriLife Today Fees
 * Three widgets in one with thoughtful defaults in case of absentee user.
 */

class Agrilife_Today_Widget_RSS extends WP_Widget {
	function Agrilife_Today_Widget_RSS() {
	//Constructor
		$widget_ops = array('classname' => 'widget agrilifetoday', 'description' => 'Show the latest AgriLife Today updates.' );
		$this->WP_Widget('Agrilife_Today_Widget_RSS', 'AgriLife: Agrilife Today News Feed', $widget_ops);
	}

	function widget($args, $instance) {
	
	// prints the widget
		if ( isset($instance['error']) && $instance['error'] )
			return;
		extract($args, EXTR_SKIP);
		

 		// RSS Processing
 		$podcast_link = 'http://agrilife.org/today/feed/';
		$rss = fetch_feed($podcast_link);
		if ( ! is_wp_error($rss) ) {
			$podcast_desc = esc_attr(strip_tags(@html_entity_decode($rss->get_description(), ENT_QUOTES, get_option('blog_charset'))));
			$podcast_title= esc_attr(strip_tags(@html_entity_decode($rss->get_title(), ENT_QUOTES, get_option('blog_charset'))));
			//$podcast_link_audio= esc_attr(strip_tags(@html_entity_decode($rss->get_link(), ENT_QUOTES, get_option('blog_charset'))));
			if ( empty($title) )
				$title = esc_html(strip_tags($rss->get_title()));
			$link = esc_url(strip_tags($rss->get_permalink()));
			while ( stristr($link, 'http') != $link )
				$link = substr($link, 1);
			$podcast_site_link = $link;
		}
		
		echo $before_widget;
		 ?>
		 
<div class="watchreadlisten-bg widget">
			<h3 class="widget-title"><a href="<?php echo $podcast_site_link;?>"><?php echo $podcast_title;?></a></h3>
			<?php agrilife_widget_agrilifetoday_rss_output( $rss, $instance ); ?>		
</div>
				<?php 
	echo $after_widget;
	}

	function update($new_instance, $old_instance) {
	//save the widget
		$instance = $old_instance;
		//$instance['youtube_video'] = strip_tags($new_instance['youtube_video']);
		$instance['items'] = strip_tags($new_instance['items']);
		return $instance;

	}

	function form($instance) {
	//widgetform in backend
		$instance = wp_parse_args( (array) $instance, array('items' => '5') );
		$items  = $instance['items'];
		
		
		
		//if ( $inputs['items'] ) : ?>
		<p><label for="<?php echo $this->get_field_name('items'); ?>"><?php _e('How many items would you like to display?'); ?></label>
		<select id="<?php echo $this->get_field_name('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>">
	<?php
			for ( $i = 1; $i <= 10; ++$i )
				echo "<option value='$i' " . ( $items == $i ? "selected='selected'" : '' ) . ">$i</option>";
	?>
	</select></p>
<?php //endif;

	}

}

register_widget('Agrilife_Today_Widget_RSS');




/**
 * Display the RSS feed from AgriLife Today and include image
 *
 * @since 2.5.0
 *
 * @param string|array|object $rss RSS url.
 * @param array $args Widget arguments.
 */
function agrilife_widget_agrilifetoday_rss_output( $rss, $args = array() ) {
	if ( is_string( $rss ) ) {
		$rss = fetch_feed($rss);
	} elseif ( is_array($rss) && isset($rss['url']) ) {
		$args = $rss;
		$rss = fetch_feed($rss['url']);
	} elseif ( !is_object($rss) ) {
		return;
	}

	if ( is_wp_error($rss) ) {
		if ( is_admin() || current_user_can('manage_options') )
			echo '<p>' . sprintf( __('<strong>RSS Error</strong>: %s'), $rss->get_error_message() ) . '</p>';
		return;
	}

	$default_args = array( 'show_author' => 0, 'show_date' => 0, 'show_summary' => 0 );
	$args = wp_parse_args( $args, $default_args );
	extract( $args, EXTR_SKIP );

	$items = (int) $items;
	if ( $items < 1 || 20 < $items )
		$items = 10;

	if ( !$rss->get_item_quantity() ) {
		echo '<ul><li>' . __( 'An error has occurred; the feed is probably down. Try again later.' ) . '</li></ul>';
		$rss->__destruct();
		unset($rss);
		return;
	}

	echo '<ul>';
	foreach ( $rss->get_items(0, $items) as $item ) {
		$link = $item->get_link();
		while ( stristr($link, 'http') != $link )
			$link = substr($link, 1);
		$link = esc_url(strip_tags($link));
		$title = esc_attr(strip_tags($item->get_title()));
		if ( empty($title) )
			$title = __('Untitled');

		$desc = str_replace( array("\n", "\r"), ' ', esc_attr( strip_tags( @html_entity_decode( $item->get_description(), ENT_QUOTES, get_option('blog_charset') ) ) ) );
		$desc = wp_html_excerpt( $desc, 360 );
		
		// default
		$image = '<img class="rssthumb" height="48" width="48" src="'.get_bloginfo('stylesheet_directory') . '/images/agrilifetodaythumb.jpg'.'" alt="'.$title.'" />';

		$date = $item->get_date( 'U' );
		if ( $date ) {
			$date = ' <span class="rss-date">' . date_i18n( 'M d', $date ) . '</span>';
		}

		foreach ($item->get_enclosures() as $enclosure) {
		// SimplePie Bug:
		// get_enclosures only returns one enclosure
		// http://tech.groups.yahoo.com/group/simplepie-support/message/2994	
			if ($enclosure = $item->get_enclosure()) {		
				if(	$enclosure->get_extension() == 'jpg' || $enclosure->get_extension() == 'png' || $enclosure->get_extension() == 'gif') {
				  	$image = '<img class="rssthumb" height="48" width="48" src="'.$enclosure->get_link().'" alt="'.$title.'" />';
				 } else {
				 	$image = '<img class="rssthumb" height="48" width="48" src="'.get_bloginfo('stylesheet_directory') . '/images/agrilifetodaythumb.jpg'.'" alt="'.$title.'" />';
				 }
			}
		}
			
	    echo "<li>{$date}".'<a href="'.$link.'" >'.$title."</a>{$image}</li>";

	}
	echo '</ul>';
	$rss->__destruct();
	unset($rss);
}




