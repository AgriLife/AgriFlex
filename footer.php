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
  GLOBAL $isresearch, $isextension, $iscollege, $istvmdl;
  GLOBAL $isextensiononly, $isresearchonly, $iscollegeonly, $istvmdlonly;
  GLOBAL $isextension4h, $isextensioncounty, $isextensioncountytce, $isextensionmg, $isextensionmn;
  GLOBAL $options;
?>
</div><!--.wrap-->
</div><!--#content-wrap-->
</div><!-- #wrapper -->
	<footer id="footer" role="contentinfo">
		<div class="wrap">
<?php 

// Column 1-3
if($iscollegeonly) : 
	include("includes/footer/college.inc.php"); 
elseif($isresearchonly) : 
	include("includes/footer/research.inc.php"); 
elseif($istvmdlonly) : 
	include("includes/footer/tvmdl.inc.php");
elseif($isfazd) : 
	include("includes/footer/fazd.inc.php");	
elseif($isextensiononly && $isextension4h) : 
	include("includes/footer/4h.inc.php");
elseif($isextensiononly && $isextensionmg) : 
	include("includes/footer/txmg.inc.php");
elseif($isextensiononly && $isextensionmn) : 
	include("includes/footer/txmn.inc.php");
elseif($isextensiononly) : 
	include("includes/footer/extension.inc.php");
else : 
	// Multi-agency 
	include("includes/footer/multi.inc.php");
endif;

// Column 4
include("includes/footer/contact.inc.php");  

// Column 5
include("includes/footer/bookstore.inc.php"); 

?>	
		</div><!-- .wrap -->		
	</footer><!-- #footer -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
