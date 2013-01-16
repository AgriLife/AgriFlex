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
add_action('wp_head','agriflex_analytics_code',0);
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

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your
 * own function tied to the widgets_init action hook.
 *
 * @since AgriFlex 1.0
 * @global $wp_widget_factory
 */
add_action( 'widgets_init', 'agriflex_remove_recent_comments_style' );
function agriflex_remove_recent_comments_style() {

  global $wp_widget_factory;

  remove_action( 'wp_head',
    array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
    'recent_comments_style' ) );

}
