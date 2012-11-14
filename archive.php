<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage agriflex
 * @since agriflex 1.0
 */
?>

<?php get_header(); ?>

<div id="wrap">
	<div id="content" role="main">
	
  <?php agriflex_archive_title(); ?>
	
  <!-- Run the loop for the archives page to output the posts.
  If you want to overload this in a child theme then include a file
  called loop-archives.php and that will be used instead. -->
	<?php get_template_part( 'content', 'archive' ); ?>

	</div><!-- #content -->
</div><!-- #wrap -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
