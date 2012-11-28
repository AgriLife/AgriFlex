<?php

/**
 * AgriLife Social Media Icons
 *
 * Allows users to input usernames/urls from various social media outlets
 * and displays icons in a sidebar widget
 *
 * @package AgriFlex
 * @since 1.0+
 * @author J. Aaron Eaton <aaron@channeleaton.com>
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

    $html = $before_widget;
    if( ! empty( $title ) )
        $html .= $before_title . $title . $after_title;

    $html .= '<ul class="clearfix">';
    foreach( $instance['s'] as $key => $value ) {
      if( ! empty( $value ) ) {
        $html .= '<li class="social-media-item">';
        $html .= '<a class="' . $key . '" href="' . $this->socialUrl( $key, $value ) . '">' . $key . '</a>';
        $html .= '</li>';
      }
    }
    $html .= '</ul>';

    $html .= $after_widget;

    echo $html;

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
