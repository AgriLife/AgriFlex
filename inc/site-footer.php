<?php

function agriflex_show_footer() {

  GLOBAL $isresearch,
    $isextension,
    $iscollege,
    $istvmdl;

  GLOBAL $isextensiononly,
    $isresearchonly,
    $iscollegeonly,
    $istvmdlonly,
    $isfazd;

  GLOBAL $isextension4h,
    $isextensioncounty,
    $isextensioncountytce,
    $isextensionmg,
    $isextensionmn;

  GLOBAL $options;

  GLOBAL $useCustomFooter;
  
  $path = get_template_directory() . '/inc/footer/';

// Column 1-3
if ( $iscollegeonly ) : 
	include( $path . 'college.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
elseif ( $isresearchonly ) : 
	include( $path . 'research.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' );  
elseif ( $istvmdlonly ) : 
	include( $path . 'tvmdl.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
elseif ( $isfazd ) : 
	include( $path . 'fazd.inc.php' );
	// Column 4
	//include($path . 'contact.inc.php' );  
	// Column 5
	//include($path . 'bookstore.inc.php' ); 	
elseif ( $options['useCustomFooter'] ) :
  include( $path . 'fazd.inc.php' );
elseif ( $isextensiononly && $isextension4h ) : 
	include( $path . '4h.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
elseif ( $isextensiononly && $isextensionmg ) : 
	include( $path . 'txmg.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
elseif ( $isextensiononly && $isextensionmn ) : 
	include( $path . 'txmn.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
elseif( $isextensiononly ) : 
	include( $path . 'extension.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
else : 
	// Multi-agency 
	include( $path . 'multi.inc.php' );
	// Column 4
	include( $path . 'contact.inc.php' );  
	// Column 5
	include( $path . 'bookstore.inc.php' ); 
endif;

}
