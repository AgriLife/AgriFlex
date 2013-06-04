<?php
/**
 * Helper functions for the AgriFlex theme
 *
 * @package AgriFlex
 */

/**
 * Retrieves the post's category or format to help determine template use
 * This is required for backwards compatibility with sites that used
 * AgriFlex 1.0
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
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

/** 
 * Obfuscates email addresses
 *
 * @since AgriFlex 1.0
 * @param string $email Email to obfuscate
 * @return string $link Obfuscated email
 */
function obfuscate( $email ){

     $link = '';

     // Convert each letter in $email to ASCII
     foreach( str_split( $email ) as $letter ) {
       $link .= '&#' . ord( $letter ) . ';';
     }

     return $link;
} // obfuscate

/**
 * Determines the site's agency and returns a useful array of information
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @return array $return Array containing the site agency, single status,
 * and extension type (if applicable).
 */
function agriflex_agency() {

  $agencies = of_get_option( 'agency-top' );
  $ext_type = of_get_option( 'ext-type' );
  $val = array_count_values( $agencies );

  $active = array();

  // Add the active agency slugs to the $active array
  foreach ( $agencies as $k => $v ) {
    if ( $v == 1 )
      array_push( $active, $k );
  }
  
  // If there's only one active agency, return true
  if ( $val[1] == 1 ) {
    $only = TRUE;
  } else {
    $only = FALSE;
  }

  // Build the return payload
  $return = array(
    'agencies' => $active,
    'single'   => $only,
    'ext-type' => $ext_type
  );

  return $return;

} // agriflex_agency

/**
 * Retrieves the static map image, encodes, then caches it. Returns the
 * transient if available.
 * 
 * @since AgriFlex 2.2
 * @param  string $mapaddress The map image url
 * @return string             The encoded image data
 */
function agriflex_get_map( $mapaddress ) {

  $options = of_get_option();
  $map_image_trans = get_transient( 'map_image' );

  if ( empty( $map_image_trans ) ) {
    $map_image = ( $options['map-image'] == '' ? 'http://maps.google.com/maps/api/staticmap?size=175x101&markers=size:mid%7Ccolor:blue%7Clabel:Office%7C' . urlencode( $mapaddress ) . '&sensor=false' : $options['map-image'] );
    $map_file = file_get_contents( $map_image );
    $map_encoded = 'data:image/png;base64, ' . base64_encode( $map_file );

    set_transient( 'map_image', $map_encoded, WEEK_IN_SECONDS );

    return $map_encoded;
  } else {
    return $map_image_trans;
  }


}

/**
 * Retrieves the user option to show excerpts or full content on
 * a non-archive page.
 * 
 * @since 2.3
 * @return string The returned content
 */
function agriflex_front_page_content() {

  $content = of_get_option( 'front-page-content' );

  if ( $content == 'excerpt' ) {
    return the_excerpt();
  } elseif ( $content == 'full-content' ) {
    return the_content();
  }

}
