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
	$podcast_link_default  = 'http://agrilife.org/drought/feed/';
	// prints the widget
		if ( isset($instance['error']) && $instance['error'] )
			return;
		extract($args, EXTR_SKIP);
		
		
		// YouTube Processing
 		$user_video = empty($instance['youtube_video']) ? $youtube_video_default : apply_filters('widget_youtube_video', $instance['youtube_video']);
 		// If a URL was passed
		if ( 'http://' == substr( $user_video, 0, 7 ) ) {
			if ( 'http://youtu.be' == substr( $user_video, 0, 15 )) {
				// New short URL
				// ex: http://youtu.be/iWCmfpFOC3A
				
				$user_video = explode("youtu.be/", $user_video);
				$user_video = $user_video[1];
				$embedpath = 'v/' . $user_video;
				$fallbacklink = 'http://www.youtube.com/watch?v=' . $user_video;
				$fallbackcontent = '<img src="http://img.youtube.com/vi/' . $user_video . '/0.jpg" alt="' . __('YouTube Preview Image', 'vipers-video-quicktags') . '" />';
			
			} else if ( FALSE !== stristr( $user_video, 'view_play_list' ) ) {
			
				// Playlist URL
				// only works with the form: http://youtube.com/view_play_list?p=929CBCA261930FCE
				preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/view_play_list\?p=([\w-]+)(.*?)#i', $user_video, $matches );
				if ( empty($matches) || empty($matches[2]) ) 
					echo 'Unable to parse URL, check for correct format';
				$embedpath = 'p/' . $matches[2];
				$fallbacklink = $fallbackcontent = 'http://www.youtube.com/view_play_list?p=' . $matches[2];
				
			} else if ( FALSE !== stristr( $user_video, '/user/' ) ) {
			
				// Playlist URL
				// only works with the form: http://www.youtube.com/user/flottos#grid/user/0CE5AEDE96A3E414
				
				$matches = explode("/user/", $user_video);
				
				$embedpath = 'p/' . $matches[2];
				$fallbacklink = $fallbackcontent = 'http://www.youtube.com/view_play_list?p=' . $matches[2];	
			
			} else {
			
				// Normal Video URL
				preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(watch\?v=|w/\?v=|\?v=)([\w-]+)(.*?)#i', $user_video, $matches );
				if ( empty($matches) || empty($matches[3]) ) 
					echo "Unable to parse URL, check for correct format: http://www.youtube.com/watch?v=iRbX2uPgGsw";

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
		<object type="application/x-shockwave-flash" width="372" height="236" data="<?php echo $youtube_video;?>">
			<param name="movie" value="<?php echo $youtube_video;?>">
			<param name="allowFullScreen" value="true">
			<param name="allowscriptaccess" value="always">
			<param name="wmode" value="opaque" />
</object>	
		<?php // END Watch Tab ?>		
		</div>
		<div id="tabs-2">		
			<?php // Read Tab ?>
			<ul class="books">
				<li>
					<a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=1496">
					<dl>
						<dt class="book-title">Keep Your Lawn Alive</dt>	
						<dd class="book-cover"><img class="book" src="<?php bloginfo('template_directory') ?>/images/alive-book.jpg" alt="keep your lawn alive book"/></dd>
						<dd class="price"><em>$</em>2<span>00</span></dd>	
					</dl>
					</a>
					<p class="buy btn"><a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=1496">Buy</a></p>					
				</li>
				<li>	
					<a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=1979">
					<dl>
						<dt class="book-title">Rainwater Harvest</dt>	
						<dd class="book-cover"><img class="book" src="<?php bloginfo('template_directory') ?>/images/rainwater-harvest-cover.png" alt="rainwater harvest book"/></dd>
						<dd class="price"><em>$</em>4<span>50</span></dd>						
					</dl>
					</a>
					<p class="buy btn"><a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=1979">Buy</a></p>					
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
  <label for="<?php echo $this->get_field_id('youtube_video'); ?>">YouTube Video or Playlist Link: <br /><code>http://www.youtube.com/watch?v=iRbX2uPgGsw</code>
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
 * Widget: AgriLife Today Feeds
 * Three widgets in one with thoughtful defaults in case of absentee user.
 */

class Agrilife_Today_Widget_RSS extends WP_Widget {
	private $feeds = array(
						array('All AgriLife Today','http://today.agrilife.org/feed/'),
						array('College','http://today.agrilife.org/agency/college-of-agriculture-and-life-sciences/feed/'),
						array('Extension','http://today.agrilife.org/agency/texas-agrilife-extension-service/feed/'),
						array('Research','http://today.agrilife.org/agency/texas-agrilife-research/feed/'),
						array('TVMDL','http://today.agrilife.org/agency/texas-veterinary-medical-diagnostics-laboratory/feed/'),
						array('Category: Business &amp; Finance','http://today.agrilife.org/category/business/feed/'),
						array('Category: Environment','http://today.agrilife.org/category/environment/feed/'),
						array('Category: Farm &amp; Ranch','http://today.agrilife.org/category/farm-ranch/feed/'),
						array('Category: Lawn &amp; Garden','http://today.agrilife.org/category/lawn-garden/feed/'),
						array('Category: Life &amp; Health','http://today.agrilife.org/category/life-health/feed/'),
						array('Category: Science &amp; Tech','http://today.agrilife.org/category/science-and-technology/feed/'),
						array('Sub-Cat: 4-H','http://today.agrilife.org/tag/4h-youth/feed/'),
						array('Sub-Cat: AgriLife Personnel','http://today.agrilife.org/tag/personnel/feed/'),
						array('Sub-Cat: Gardening','http://today.agrilife.org/tag/gardening-landscaping/feed/'),
						array('Sub-Cat: Energy','http://today.agrilife.org/tag/biofuel-energy/feed/'),

					);

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
 		$myfeeds 			= $this->feeds;
 		$feed_link_index	= (int) $instance['feed_link_index'];
 		$agrilife_feed_link = $myfeeds[$feed_link_index][1]; //'http://agrilife.org/today/feed/';
		$rss = fetch_feed($agrilife_feed_link);
		//$title = $instance['title'];
		
		$desc = '';
		
		if ( ! is_wp_error($rss) ) {
			//$agrilife_feed_title= esc_attr(strip_tags(@html_entity_decode($rss->get_title(), ENT_QUOTES, get_option('blog_charset'))));
			$title = apply_filters('widget_title', empty($instance['title']) ? __('AgriLife Today') : $instance['title'], $instance, $this->id_base);
			
			if ( empty($title) )
				$title = esc_html(strip_tags($rss->get_title()));
			$link = esc_url(strip_tags($rss->get_permalink()));
			while ( stristr($link, 'http') != $link )
				$link = substr($link, 1);
			$podcast_site_link = $link;
		}
		
		// show the widget
		echo $before_widget; ?>
		<div class="watchreadlisten-bg widget">
			<?php if ( $title ) echo $before_title . $title . $after_title; ?>
			<?php agrilife_widget_agrilifetoday_rss_output( $rss, $instance ); ?>		
		</div>
		<?php echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		//save the widget
		$instance = $old_instance;
		$instance['feed_link_index'] = strip_tags($new_instance['feed_link_index']);
		$instance['show_summary'] = strip_tags($new_instance['show_summary']);
		$instance['items'] = strip_tags($new_instance['items']);
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form($instance) {
		//widgetform in backend
		$instance 			= wp_parse_args( (array) $instance, array('items' => '5', 'feed_link_index' => '0', 'show_summary' => true) );
		
		$items  			= $instance['items'];
		$feed_link_index	= (int) $instance['feed_link_index'];
		$myfeed 			= $this->feeds;
		$show_summary   	= (int) $instance['show_summary'];
		
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('items'); ?>"><?php _e('How many items would you like to display?'); ?></label>
		<select id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>">
		<?php
				for ( $i = 1; $i <= 10; ++$i )
					echo "<option value='$i' " . ( $items == $i ? "selected='selected'" : '' ) . ">$i</option>";
		?>
		</select></p>
		<p><label for="<?php echo $this->get_field_id('feed_link_index'); ?>"><?php _e('What category do you want to display?'); ?></label>
		<select id="<?php echo $this->get_field_id('feed_link_index'); ?>" name="<?php echo $this->get_field_name('feed_link_index'); ?>">
		<?php			
			for ($i=0; $i<count($myfeed); $i++) {
				echo "<option value=\"".$i."\" " . ( $feed_link_index == $i ? "selected='selected'" : '' ) . ">".$myfeed[$i][0]."</option>";
			}
		?>
		</select></p>
	
		<p>
			<input id="<?php echo $this->get_field_id('show_summary'); ?>" name="<?php echo $this->get_field_name('show_summary'); ?>" type="checkbox" value="1" <?php checked( $show_summary ); ?> />
			<label for="<?php echo $this->get_field_id('show_summary'); ?>"><?php _e('Display article excerpts?'); ?></label>
		</p>
		<?php
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

	$default_args = array( 'items' => 5, 'feed_link_index' => 0, 'show_summary' => 0  );
	$args = wp_parse_args( $args, $default_args );
	extract( $args, EXTR_SKIP );

	$items = (int) $items;
	if ( $items < 1 || 20 < $items )
		$items = 10;
	$show_summary  = (int) $show_summary;

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
		//$desc = wp_html_excerpt( $desc, 360 );
		
		// Append ellipsis. Change existing [...] to [&hellip;].
		if ( '...' == substr( $desc, -3 ) )
			$desc = substr( $desc, 0, -5 ) . '&hellip;';
		elseif ( 'Read More...' == substr( $desc, -12 ) )
			$desc = substr( $desc, 0, -13 ).'&hellip;';

		$desc = trim(esc_html( $desc ));
		
		if ( $show_summary ) {
			$summary = "<p class='rss-excerpt'>$desc</p>";
		} else {
			$summary = '';
		}
		
		// default
		$image = '<img class="rssthumb" src="'.get_bloginfo('stylesheet_directory') . '/images/agrilifetodaythumb.jpg'.'" alt="'.$title.'" />';

		$date = $item->get_date( 'U' );
		if ( $date ) {
			$date = ' <span class="rss-date">' . date_i18n( 'M d', $date ) . '</span>';
		}

		// SimplePie Bug:
		// get_enclosures only returns one enclosure
		// http://tech.groups.yahoo.com/group/simplepie-support/message/2994	
		if ($enclosure = $item->get_enclosure()) {		
			if(	$enclosure->get_extension() == 'jpg' || $enclosure->get_extension() == 'png' || $enclosure->get_extension() == 'gif') {
			  	$image = '<img class="rssthumb" src="'.$enclosure->get_link().'" alt="'.$title.'" />';
			 } else {
			 	$image = '<img class="rssthumb" src="'.get_bloginfo('stylesheet_directory') . '/images/agrilifetodaythumb.jpg'.'" alt="'.$title.'" />';
			 }
		}
		
		// Link the image	
		$image = '<a class="rss-img-link" href="'.$link.'" >'.$image.'</a>';
		
	    echo "<li>".'<span class="rss-title"><a class="rss-title-link" href="'.$link.'" >'.$title."</a></span><div class='rss-content'>{$date}{$image}{$summary}</div></li>";

	}
	echo '</ul>';
	$rss->__destruct();
	unset($rss);
}


/**
 * Adds Category Widget widget.
 */
class Category_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'category_widget', // Base ID
			'Category Widget', // Name
			array( 'description' => __( 'A Category Widget', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$category = apply_filters( 'widget_category', $instance['category'] );

		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $category . $after_title; ?>
			
		<?php cat_loop($category) ?>	
		
		<?php echo $after_widget;
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['category'] = strip_tags( $new_instance['category'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'category' ] ) ) {
			$category = $instance[ 'category' ];			
		} else {
			$category = __( 'Enter Category', 'text_domain' );
		} 	?> 
		<p>
		<label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" type="text" value="<?php echo esc_attr( $category ); ?>" />		
		</p>
		<?php 
	}

}

/**
 * Adds Social Media Widget
 *
 * Allows users to input usernames from various social media outlets
 */

class AgriLife_Social_Media_Icons extends WP_Widget {

  /**
   * Register widget with WordPress
   */
  public function __construct() {
    parent::__construct(
      'social_media', // Base ID
      'Social Media', // Name
      array('description' => __('Add social media icons', 'text_domain'), ) // Args
    );
  }

  /**
   * Front-end display of widget.
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    extract( $args );
    $title = apply_filters( 'widget_title', $instance['title'] );

    echo $before_widget;
    if( ! empty( $title ) )
        echo $before_title . $title . $after_title;

    echo '<ul class="clearfix">';
    foreach( $instance['s'] as $key => $value ) {
      if( ! empty( $value ) ) {
        echo '<li class="social-media-item">';
        echo '<a class="' . $key . '" href="' . $this->socialUrl( $key, $value ) . '">' . $key . '</a>';
        echo '</li>';
      }
    }
    echo '</ul>';

    echo $after_widget;

  }

  private function socialUrl( $key, $value ) {
    switch($key) {
      case 'facebook' :
        $url = 'https://facebook.com/' . $value;
        return $url;
        break;
      case 'googleplus' :
        $url = 'https://plus.google.com/' . $value;
        return $url;
        break;
      case 'twitter' :
        $url = 'https://twitter.com/' . $value;
        return $url;
        break;
      case 'flickr' :
        $url = 'http://flickr.com/photos/' . $value;
        return $url;
        break;
      case 'youtube' :
        $url = 'http://youtube.com/user/' . $value;
        return $url;
        break;
      case 'rss' :
        return $value;
        break;
    }
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance   Values just sent to be saved.
   * @param array $old_instance   Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = strip_tags( $new_instance['title'] );
    $instance['s']['facebook'] = strip_tags( $new_instance['facebook'] );
    $instance['s']['googleplus'] = strip_tags( $new_instance['googleplus'] );
    $instance['s']['twitter'] = strip_tags( $new_instance['twitter'] );
    $instance['s']['flickr'] = strip_tags( $new_instance['flickr'] );
    $instance['s']['youtube'] = strip_tags( $new_instance['youtube'] );
    $instance['s']['rss'] = strip_tags( $new_instance['rss'] );

    return $instance;
  }

  /**
   * Back-end widget form
   *
   * @see WP_Widget::form()
   *
   * @param array $instance   Previously saved values from database
   */
  public function form( $instance ) {
    if ( isset( $instance['title'] ) ) {
      $title = $instance['title'];
    }
    else {
      $title = __( 'Social Media', 'text_domain' );
    }
    if ( isset( $instance['s']['facebook'] ) ) {
      $facebook = $instance['s']['facebook'];
    }
    if ( isset( $instance['s']['googleplus'] ) ) {
      $googleplus = $instance['s']['googleplus'];
    }
    if ( isset( $instance['s']['twitter'] ) ) {
      $twitter = $instance['s']['twitter'];
    }
    if ( isset( $instance['s']['flickr'] ) ) {
      $flickr = $instance['s']['flickr'];
    }
    if ( isset( $instance['s']['youtube'] ) ) {
      $youtube = $instance['s']['youtube'];
    }
    if ( isset( $instance['s']['rss'] ) ) {
      $rss = $instance['s']['rss'];
    }
    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
    </p>
    <hr />
    <p>
      <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook Username:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" type="text" value="<?php echo esc_attr( $facebook ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e( 'Google+ Username:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'googleplus' ); ?>" name="<?php echo $this->get_field_name( 'googleplus' ); ?>" type="text" value="<?php echo esc_attr( $googleplus ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter Username:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" type="text" value="<?php echo esc_attr( $twitter ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'flickr' ); ?>"><?php _e( 'Flickr Username:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'flickr' ); ?>" name="<?php echo $this->get_field_name( 'flickr' ); ?>" type="text" value="<?php echo esc_attr( $flickr ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Youtube Username:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" type="text" value="<?php echo esc_attr( $youtube ); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e( 'RSS Feed URL:' ); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" type="text" value="<?php echo esc_attr( $rss ); ?>" />
    </p>
    <?php
  }
} // class SocialMediaIcons

register_widget('AgriLife_Social_Media_Icons');
?>
