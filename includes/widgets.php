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
				$fallbackcontent = '<img src="http://img.youtube.com/vi/' . $user_video . '/0.jpg?v=100" alt="' . __('YouTube Preview Image', 'vipers-video-quicktags') . '" />';
			
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
				$fallbackcontent = '<img src="http://img.youtube.com/vi/' . $matches[3] . '/0.jpg?v=100" alt="' . __('YouTube Preview Image', 'vipers-video-quicktags') . '" />';
			}
		}
		// If a URL wasn't passed, assume a video ID was passed instead
		else {
			$embedpath = 'v/' . $user_video;
			$fallbacklink = 'http://www.youtube.com/watch?v=' . $user_video;
			$fallbackcontent = '<img src="http://img.youtube.com/vi/' . $user_video . '/0.jpg?v=100" alt="' . __('YouTube Preview Image', 'vipers-video-quicktags') . '" />';
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
						<dd class="book-cover"><img class="book" src="<?php bloginfo('template_directory') ?>/images/alive-book.jpg?v=100" alt="keep your lawn alive book"/></dd>
						<dd class="price"><em>$</em>2<span>00</span></dd>	
					</dl>
					</a>
					<p class="buy btn"><a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=1496">Buy</a></p>					
				</li>
				<li>	
					<a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=1979">
					<dl>
						<dt class="book-title">Rainwater Harvest</dt>	
						<dd class="book-cover"><img class="book" src="<?php bloginfo('template_directory') ?>/images/rainwater-harvest-cover.png?v=100" alt="rainwater harvest book"/></dd>
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
        $url = $value;
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
    global $options;

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
    if ( empty( $instance['s']['rss'] ) ) {
      $rss = $options['feedBurner'];
    }
    else {
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
      <label for="<?php echo $this->get_field_id( 'googleplus' ); ?>"><?php _e( 'Google+ User Number:' ); ?></label>
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
      <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e( 'Youtube URL (include "http://"):' ); ?></label>
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
