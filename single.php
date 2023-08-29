<?php
/**
 * The Template for displaying all single posts.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */

// Include header
get_header();

// Initialize main content area
echo '<div id="wrap">';
echo '<div id="content" role="main">';

// Execute functions hooked to 'agriflex_before_loop'
do_action('agriflex_before_loop');

// Check if there are posts
if ( have_posts() ) {
    // Loop through the posts
    while ( have_posts() ) {
        the_post();
        
        // Load single post content template
        get_template_part('content', 'single');
        
        // Output navigation below the content
        do_action('agriflex_content_nav', 'nav-below');
        
        // Load the comments template
        if ( comments_open() || get_comments_number() ) {
            comments_template('', true);
        }
    }
}

// Execute functions hooked to 'agriflex_after_loop'
do_action('agriflex_after_loop');

// Close main content area
echo '</div><!-- #content -->';
echo '</div><!-- #wrap -->';

// Include sidebar and footer
get_sidebar();
get_footer();
