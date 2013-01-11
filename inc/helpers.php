<?php
/**
 * Helper functions for the AgriFlex theme
 *
 * @package AgriFlex
 * @since AgriFlex 2.0
 */

/**
 * Retrieves the post's category or format to help determine template use
 * This is required for backwards compatibility with sites that used
 * AgriFlex 1.0
 *
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @since AgriFlex 2.0
 * @returns string $format The post's category or format
 */
function agriflex_get_format() {

  global $wp_query, $post;

  $post_format[] = get_post_format( $post->ID );
  $post_cats = get_the_category( $post->ID );

  // Combine the post format with the categories
  foreach ( $post_cats as $c ) {
    $post_format[] = $c->name;
  }

  switch ( $post_format ) {

    // Applies to both the old category and post format
    case in_array( 'gallery', $post_format ) :
      $format = 'gallery';
      break;

    // Old category 'asides'
    case in_array( 'asides', $post_format ) :
      $format = 'aside';
      break;

    // The post format 'aside'
    case in_array( 'aside', $post_format ) :
      $format = 'aside';
      break;

    case in_array( 'video', $post_format ) :
      $format = 'video';
      break;

    case in_array( 'audio', $post_format ) :
      $format = 'audio';
      break;

    default :
      $format = 'index';

  }

  unset( $post_format );

  return $format;

} // agriflex_get_format
