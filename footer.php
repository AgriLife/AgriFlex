<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */
?>
    </div><!-- .wrap -->
  </div><!-- #content-wrap -->
</div><!-- #wrapper -->
<footer id="footer" role="contentinfo">
  <div class="wrap">

    <?php agriflex_show_footer(); ?> 

  </div><!-- .wrap -->		
</footer><!-- #footer -->

<!-- Always have wp_footer() just before the closing </body>
tag of your theme, or you will break many plugins, which
generally use this hook to reference JavaScript files. -->
<?php wp_footer(); ?>

</body>
</html>
