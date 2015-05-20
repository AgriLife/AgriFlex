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
 * @since  AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @returns string $format The post's category or format
 */
function agriflex_get_format() {

	global $wp_query, $post;

	$post_format[] = get_post_format( $post->ID );
	$post_cats     = get_the_category( $post->ID );

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
 *
 * @param string $email Email to obfuscate
 *
 * @return string $link Obfuscated email
 */
function obfuscate( $email ) {

	$link = '';

	// Convert each letter in $email to ASCII
	foreach ( str_split( $email ) as $letter ) {
		$link .= '&#' . ord( $letter ) . ';';
	}

	return $link;
} // obfuscate

/**
 * Determines the site's agency and returns a useful array of information
 *
 * @since  AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 * @return array $return Array containing the site agency, single status,
 * and extension type (if applicable).
 */
function agriflex_agency() {

    $agencies = array();
	$agencies = of_get_option( 'agency-top' );
	$ext_type = of_get_option( 'ext-type' );
	$val      = array_count_values( $agencies );

	$active = array();

	// Add the active agency slugs to the $active array
	if(is_array(of_get_option( 'agency-top' ))){
		foreach ( $agencies as $k => $v ) {
			if ( $v == 1 ) {
				array_push( $active, $k );
			}
		}
	}

	// If there's only one active agency, return true
	if ( ! empty( $val[1] ) && $val[1] == 1 ) {
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
 * Retrieves the user option to show excerpts or full content on
 * a non-archive page.
 *
 * @since 2.3
 * @return string The returned content
 */
function agriflex_front_page_content() {

	global $post;

	$content = of_get_option( 'front-page-content' );

	if ( $content == 'excerpt' ) {
		return the_excerpt();
	} elseif ( $content == 'full-content' ) {
		return the_content();
	} else {
		return the_excerpt();
	}

}

/**
 * Displays a Soliloquy slider if selected
 *
 * @since 2.3.6
 * @return void
 */
function agriflex_home_slider() {

	if ( function_exists( 'soliloquy_slider' ) ) {
		$slider = get_field( 'college-home-slider' );
		$slider = soliloquy_slider( $slider->ID );
	} else {
		$my_query = new WP_Query(
			array(
				'meta_key'   => 'feature-homepage',
				'meta_value' => '1',
				'showposts'  => '5',
				'post_type'  => array( 'post', 'page' )
			) );
		$count    = 0;

		if ( $my_query->have_posts() ) :

			$slider = '<div class="flex-container">';
			$slider .= '<div class="flexslider">';
			$slider .= '<ul class="slides">';

			while ( $my_query->have_posts() ) : $my_query->the_post();
				global $post;
				$count ++;
				$feature_title = get_post_meta( $post->ID, 'feature-title', true );
				$slider .= '<li class="feature-item-<?php echo $count; ?> flex-slider-item">';
				$slider .= '<a href="' . get_permalink() . '">';
				$slider .= get_the_post_thumbnail( $post->ID, 'featured-2' );
				$slider .= '</a>';

				$slider .= '<p class="flex-caption">';
				$slider .= '<a href="' . get_permalink( $post->ID ) . '">';
				if ( $feature_title !== '' ) :
					$slider .= $feature_title;
				else :
					$slider .= get_the_title();
				endif;
				$slider .= '</a>';
				$slider .= '</p><!-- end .flex-caption -->';
				$slider .= '</li><!-- end .feature-item -->';
			endwhile;
			wp_reset_query();

			$slider .= '</ul>';
			$slider .= '</div>';
			$slider .= '<!-- .flexslider -->';
			$slider .= '</div><!-- .flex-container -->';

		endif;
	}
	printf( '
<div class="home-slider">%s</div>',
		$slider
	);

}
