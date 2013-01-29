<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
?>
    </div><!-- .wrap -->
  </div><!-- #content-wrap -->
</div><!-- #wrapper -->
<footer id="footer" role="contentinfo">

  <?php agriflex_before_footer(); ?>
  <div class="wrap">

    <?php agriflex_footer(); ?> 

  </div><!-- .wrap -->		
  <?php agriflex_after_footer(); ?>

</footer><!-- #footer -->

<!-- Always have wp_footer() just before the closing </body>
tag of your theme, or you will break many plugins, which
generally use this hook to reference JavaScript files. -->
<?php wp_footer(); ?>

</body>
</html>
