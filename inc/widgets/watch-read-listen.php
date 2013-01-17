<?php
/**
 * Widget: Watch, Read, Listen
 *
 * Three widgets in one with thoughtful defaults in case of absentee user.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */

class WatchReadListenWidget extends WP_Widget {

  /**
   * Sets up the widget settings
   */
	function __construct() {

    $widget_ops = array(
      'classname' => 'widget Watch Read Listen',
      'description' => 'Pick a YouTube Video and a Podcast RSS feed.'
    );

    parent::__construct(
      'watch-read-listen', // Base ID
      'Watch Read Listen', // Name
      array( 'description' => $widget_ops['description'], ) // Args
    );

	}

  /**
   * Outputs the widget on the frontend
   *
   * @param array $args
   * @param array $instance The saved widget information
   */
	function widget( $args, $instance ) {

    // Set YouTube Default
    $youtube_video_default = 'http://www.youtube.com/watch?v=q_UsLHl_YDQ';

    // Set Podcast Default
    $podcast_link_default  = 'http://agrilife.org/drought/feed/';

    // prints the widget
    if ( isset( $instance['error'] ) && $instance['error'] )
      return;
    extract( $args, EXTR_SKIP );


    // YouTube Processing
    $user_video = empty( $instance['youtube_video'] ) ? $youtube_video_default :
      apply_filters( 'widget_youtube_video', $instance['youtube_video'] );

    // If a URL was passed
    if ( 'http://' == substr( $user_video, 0, 7 ) ) {

      if ( 'http://youtu.be' == substr( $user_video, 0, 15 ) ) {

        // New short URL
        // ex: http://youtu.be/iWCmfpFOC3A
        $user_video = explode( "youtu.be/", $user_video );
        $user_video = $user_video[1];
        $embedpath = 'v/' . $user_video;
        $fallbacklink = 'http://www.youtube.com/watch?v=' . $user_video;
        $fallbackcontent = '<img src="http://img.youtube.com/vi/' .
          $user_video . '/0.jpg?v=100" alt="' .
          __( 'YouTube Preview Image', 'vipers-video-quicktags' ) . '" />';

      } elseif ( FALSE !== stristr( $user_video, 'view_play_list' ) ) {

        // Playlist URL
        // only works with the form:
        // http://youtube.com/view_play_list?p=929CBCA261930FCE
        preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/view_play_list\?p=([\w-]+)(.*?)#i', $user_video, $matches );
        if ( empty( $matches ) || empty( $matches[2] ) ) 
          echo 'Unable to parse URL, check for correct format';
        $embedpath = 'p/' . $matches[2];
        $fallbacklink = $fallbackcontent =
          'http://www.youtube.com/view_play_list?p=' . $matches[2];

      } elseif ( FALSE !== stristr( $user_video, '/user/' ) ) {

        // Playlist URL
        // only works with the form:
        // http://www.youtube.com/user/flottos#grid/user/0CE5AEDE96A3E414

        $matches = explode( "/user/", $user_video );

        $embedpath = 'p/' . $matches[2];
        $fallbacklink = $fallbackcontent =
          'http://www.youtube.com/view_play_list?p=' . $matches[2];	

      } else {

        // Normal Video URL
        preg_match( '#http://(www.youtube|youtube|[A-Za-z]{2}.youtube)\.com/(watch\?v=|w/\?v=|\?v=)([\w-]+)(.*?)#i', $user_video, $matches );
        if ( empty( $matches ) || empty( $matches[3] ) ) 
        echo "Unable to parse URL, check for correct format: http://www.youtube.com/watch?v=iRbX2uPgGsw";

        $embedpath = 'v/' . $matches[3];
        $fallbacklink = 'http://www.youtube.com/watch?v=' . $matches[3];
        $fallbackcontent = '<img src="http://img.youtube.com/vi/' .
          $matches[3] . '/0.jpg?v=100" alt="' .
          __( 'YouTube Preview Image', 'vipers-video-quicktags' ) . '" />';
      }

    } else { // If a URL wasn't passed, assume a video ID was passed instead

      $embedpath = 'v/' . $user_video;
      $fallbacklink = 'http://www.youtube.com/watch?v=' . $user_video;
      $fallbackcontent = '<img src="http://img.youtube.com/vi/' . $user_video .
        '/0.jpg?v=100" alt="' .
        __( 'YouTube Preview Image', 'vipers-video-quicktags' ) . '" />';

    }

    $youtube_video = 'http://www.youtube.com/' . $embedpath;


    // Podcast Processing
    $podcast_link = empty( $instance['podcast_link'] ) ?
      $podcast_link_default :
      apply_filters( 'widget_podcast_link', $instance['podcast_link'] );

    $rss = fetch_feed( $podcast_link );

    if ( ! is_wp_error( $rss ) ) {

      $podcast_desc = esc_attr( strip_tags(
        @html_entity_decode( $rss->get_description(),
        ENT_QUOTES, get_option( 'blog_charset' ) ) ) );

      $podcast_title = esc_attr( strip_tags(
        @html_entity_decode( $rss->get_title(),
        ENT_QUOTES, get_option( 'blog_charset' ) ) ) );

      $podcast_link_audio = esc_attr( strip_tags(
        @html_entity_decode( $rss->get_link(),
        ENT_QUOTES, get_option( 'blog_charset' ) ) ) );

      if ( empty( $title ) )
        $title = esc_html( strip_tags( $rss->get_title() ) );

      $link = esc_url( strip_tags( $rss->get_permalink() ) );

      while ( stristr( $link, 'http' ) != $link )
        $link = substr( $link, 1 );

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
          <object type="application/x-shockwave-flash" width="372" height="236" data="<?php echo $youtube_video;?>">
            <param name="movie" value="<?php echo $youtube_video;?>">
            <param name="allowFullScreen" value="true">
            <param name="allowscriptaccess" value="always">
            <param name="wmode" value="opaque" />
          </object>	
        </div><!-- end #watch-tab -->
        <div id="tabs-2">		
          <ul class="books">
            <li>
              <a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=1496">
                <dl>
                  <dt class="book-title">Keep Your Lawn Alive</dt>	
                  <dd class="book-cover">
                    <img class="book" src="<?php bloginfo( 'template_directory' ) ?>/images/alive-book.jpg?v=100" alt="keep your lawn alive book"/>
                  </dd>
                  <dd class="price">
                    <em>$</em>2<span>00</span>
                  </dd>	
                </dl>
              </a>
              <p class="buy btn">
                <a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=1496">Buy</a>
              </p>					
            </li>
            <li>	
              <a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=1979">
                <dl>
                  <dt class="book-title">Rainwater Harvest</dt>	
                  <dd class="book-cover">
                    <img class="book" src="<?php bloginfo( 'template_directory' ) ?>/images/rainwater-harvest-cover.png?v=100" alt="rainwater harvest book"/>
                  </dd>
                  <dd class="price">
                    <em>$</em>4<span>50</span>
                  </dd>						
                </dl>
              </a>
              <p class="buy btn"><a href="https://agrilifebookstore.org/publications_details.cfm?whichpublication=1979">Buy</a></p>					
            </li>
          </ul>
        </div><!-- end #read-tab -->
        <div id="tabs-3">
          <h4>
            <a href="<?php echo $podcast_site_link;?>">
              <?php echo $podcast_title;?>
            </a>
          </h4>
          <?php $this->podcast_output( $rss, $instance ); ?>

        </div><!-- end #listen-tab -->
      </div><!-- end #tabs -->					
    </div><!-- end #watchreadlisten -->
    <?php 
    echo $after_widget;

	}

  /**
   * Saves the form
   *
   * @param  array $new_instance New information from the widget form
   * @param  array $old_instance The old saved widget information
   * @return array $instance The sanitized new information
   */
	function update( $new_instance, $old_instance ) {

    //save the widget
		$instance = $old_instance;
		$instance['youtube_video'] = strip_tags( $new_instance['youtube_video'] );
		$instance['podcast_link'] = strip_tags( $new_instance['podcast_link'] );

		return $instance;

	}

  /**
   * Outputs the form on the Widget page
   *
   * @param array $instance The array of saved values
   */
	function form($instance) {

    $instance = wp_parse_args(
      (array) $instance, array( 'youtube_video' => '', 'podcast_link' => '' )
    );

		$youtube_video = strip_tags( $instance['youtube_video'] );
		$podcast_link = strip_tags( $instance['podcast_link'] );

    ?>
    <p>
      <label for="<?php echo $this->get_field_id( 'youtube_video' ); ?>">YouTube Video or Playlist Link: <br />
        <code>http://www.youtube.com/watch?v=iRbX2uPgGsw</code>
        <input class="widefat" id="<?php echo $this->get_field_id( 'youtube_video' ); ?>" name="<?php echo $this->get_field_name( 'youtube_video' ); ?>" type="text" value="<?php echo esc_attr( $youtube_video ); ?>" />
      </label>
    </p>
    <p>
      <label for="<?php echo $this->get_field_id( 'podcast_link' ); ?>">Podcast Link: <br />
        <code>http://tmnpodcast.libsyn.com/rss</code>
        <input class="widefat" id="<?php echo $this->get_field_id( 'podcast_link' ); ?>" name="<?php echo $this->get_field_name( 'podcast_link' ); ?>" type="text" value="<?php echo esc_attr( $podcast_link ); ?>" />
      </label>
    </p>
    <?php
	}

  /**
   * Display the RSS podcast entries in a list
   *
   * @since AgriFlex1.0 
   *
   * @param string|array|object $rss RSS url.
   * @param array $args Widget arguments.
   */
  function podcast_output( $rss, $args = array() ) {

    if ( is_string( $rss ) ) {
      $rss = fetch_feed( $rss );
    } elseif ( is_array( $rss ) && isset( $rss['url'] ) ) {
      $args = $rss;
      $rss = fetch_feed( $rss['url'] );
    } elseif ( !is_object( $rss ) ) {
      return;
    }

    if ( is_wp_error( $rss ) ) {
      if ( is_admin() || current_user_can( 'manage_options' ) )
        echo '<p>' .
        sprintf( __( '<strong>RSS Error</strong>: %s'), $rss->get_error_message() ) .
        '</p>';
      return;
    }

    $default_args = array(
      'show_author' => 0,
      'show_date' => 0,
      'show_summary' => 0
    );

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
    foreach ( $rss->get_items( 0, $items ) as $item ) {
      $link = $item->get_link();
      while ( stristr( $link, 'http' ) != $link )
        $link = substr( $link, 1 );
      $link = esc_url( strip_tags( $link ) );
      $title = esc_attr( strip_tags( $item->get_title() ) );
      if ( empty( $title ) )
        $title = __( 'Untitled' );

      $desc = str_replace( array("\n", "\r"), ' ',
        esc_attr( strip_tags( 
          @html_entity_decode( $item->get_description(),
          ENT_QUOTES, get_option( 'blog_charset' ) ) ) ) );

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
      
      if ( $enclosure = $item->get_enclosure() )
      {
        echo "<li><embed type=\"application/x-shockwave-flash\" flashvars=\"audioUrl=" . $enclosure->get_link() . 
          "\" src=\"http://www.google.com/reader/ui/3523697345-audio-player.swf\" width=\"400\" height=\"27\" quality=\"best\"></li>";
      }
      
    }
    echo '</ul>';
    $rss->__destruct();
    unset($rss);
  }

}

register_widget( 'WatchReadListenWidget' );
