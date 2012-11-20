<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
  <div id="content" role="main">

    <div id="post-0" class="post error404 not-found">
      <h1 class="entry-title"><?php _e( 'Not Found', 'agriflex' ); ?></h1>
      <div class="entry-content">
        <p><?php _e( 'Nothing to see here. Would you like to search for something else?', 'agriflex' ); ?></p>
        <?php get_search_form(); ?>
      </div><!-- .entry-content -->
    </div><!-- #post-0 -->

  </div><!-- #content -->
</div><!-- #container -->
<script type="text/javascript">
// focus on search field after it has loaded
document.getElementById('s') && document.getElementById('s').focus();
</script>

<?php get_footer(); ?>  
