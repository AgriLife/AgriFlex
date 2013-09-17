<?php
/**
 * Custom actions to allow child theme and plugin developers
 * to easily add functionality to the theme.
 *
 * @package AgriFlex
 */

/**
 * Add asynchronous google analytics code. Insert the custom account code
 * if available.
 *
 * @since AgriFlex 1.0
 */
function agriflex_analytics_code() {

  $options = of_get_option();
  $a = agriflex_agency();

  if( !is_admin() ) : ?>
    <script type="text/javascript">//<![CDATA[
    // Google Analytics asynchronous
    var _gaq = _gaq || [];
    <?php if( $a['ext-type'] == 'county' ||
              $a['ext-type'] == 'tce' ) : ?>
      _gaq.push(['_setAccount','UA-7414081-1']);      //county-co
      _gaq.push(['_trackPageview'],['_trackPageLoadTime']);
    <?php endif; ?>

    <?php if( ! empty($options['g-analytics'] ) ) {
      echo "_gaq.push(['_setAccount','" . $options['g-analytics'] . "']); //local \n";
      echo "_gaq.push(['_trackPageview'],['_trackPageLoadTime']);\n";
    }
    ?>
    (function() {
      var ga = document.createElement('script');
      ga.type = 'text/javascript';
      ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(ga, s);
    })();
    //]] >
    </script>
  <?php
  endif;

} // agriflex_analytics_code    
add_action('wp_head','agriflex_analytics_code',0);

function agriflex_analytics_admin_code() {

    $options = of_get_option();
    $a = agriflex_agency();
    $code = $options['g-analytics-admin'];

  if ( ! empty( $code ) && $code != $options['g-analytics'] ):
    if( !is_admin() ) : ?>
      <script type="text/javascript">//<![CDATA[
      // Google Analytics asynchronous
      var _gaq = _gaq || [];
      <?php if( $a['ext-type'] == 'county' ||
                $a['ext-type'] == 'tce' ) : ?>
        _gaq.push(['_setAccount','UA-7414081-1']);      //county-co
        _gaq.push(['_trackPageview'],['_trackPageLoadTime']);
      <?php endif; ?>

      <?php 
        echo "_gaq.push(['_setAccount','" . $options['g-analytics-admin'] . "']); //local \n";
        echo "_gaq.push(['_trackPageview'],['_trackPageLoadTime']);\n";
      ?>

      (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
      })();
      //]] >
      </script>
    <?php
    endif;
  endif;

} // agriflex_analytics_admin_code
add_action('wp_head','agriflex_analytics_admin_code',0);

/**
 * Adds the Typekit goodies to the document head
 *
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */
function typekit_js() {

  $a = agriflex_agency();

  switch ( $a['ext-type'] ) {
    case 'mg' :
      $key = 'vaf4fhz';
      break;
    case 'mn' :
      $key = 'nqb0igu';
      break;
    default :
      $key = 'thu0wyf';
  }

  if( !is_admin() ) : ?>
    <script type="text/javascript" src="http://use.typekit.com/<?php echo $key ?>.js"></script>
    <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
    <style type="text/css">
      .wf-loading #site-title,
      .wf-loading .entry-title {
      /* Hide the blog title and post titles while web fonts are loading */
      visibility: hidden;
      }
    </style>                        
  <?php
  endif;

} // typekit_js
add_action('wp_head','typekit_js');

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your
 * own function tied to the widgets_init action hook.
 *
 * @since AgriFlex 1.0
 * @global $wp_widget_factory
 */
function agriflex_remove_recent_comments_style() {

  global $wp_widget_factory;

  remove_action( 'wp_head',
    array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
    'recent_comments_style' ) );

} // agriflex_remove_recent_comments_style
add_action( 'widgets_init', 'agriflex_remove_recent_comments_style' );

/**
 * Resets the map_image transient after options are updated
 * 
 * @since AgriFlex 2.2
 */
function agriflex_reset_map() {

  delete_transient( 'map_image' );

}
add_action( 'optionsframework_after_validate', 'agriflex_reset_map' );
