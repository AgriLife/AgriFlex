<?php

function agriflex_return_map() {

  GLOBAL $googlemap;

  if ( $googlemap ) echo $googlemap;

}

function agriflex_show_header() {

  GLOBAL $options;

  GLOBAL $isextensioncounty,
    $isextensioncountytce,
    $isextensionmg,
    $isextensionmn;

  $home_url = get_home_url( '/' );
  $blog_name = esc_attr( get_bloginfo( 'name', 'display' ) );
  
  if ( $isextensioncounty || $isextensioncountytce ) {
    $display = '<span>Extension Education</span> <em>in ' . 
               $options['county-name-human'] .
               ' County</em>';

  } elseif ( $isextensionmg ) {
    $src = get_bloginfo( 'stylesheet_directory' ) . '/img/txmg-logo80.gif';
    $img = '<img src="' . $src . '" alt="' . $blog_name . '" />';

    $display = $img . $blog_name;
    
  } elseif ( $isextensionmn ) {
    $src = get_bloginfo( 'stylesheet_directory' ) . '/img/txmn-logo.png';
    $img = '<img src="' . $src . '" alt="' . $blog_name . '" />';

    $display = $img . $blog_name;

  } else {
  
    if ( $options['header_type'] == 1 && $options['titleImg'] <> '' ) {
      $src = $options['titleImg'];
      $img = '<img src="' . $src . '" alt="' . $blog_name . '" />';

      $display = $img . $blog_name;

    } elseif ( $options['header_type'] == 2 ) {
      $src = $options['titleImg'];
      $img = '<img src="' . $src . '" alt="' . $blog_name . '" />';

      $display = $img . '<span class="full-img-text">' . $blog_name . '</span>';

    } else {
      $display = $blog_name;
    }
  
  }

  $link = '<a href="' . $home_url . '" 
    title="' . $blog_name . '" >' . 
    $display . '</a>';

  $html = '<div id="header">';
  $html .= '<header id="branding" role="banner">';
  $html .= '<hgroup>';
  $html .= '<h1 id="site-title">';
  $html .= $link;
  $html .= '</h1>';
  $html .= '<h2 id="site-description">';
  $html .= get_bloginfo( 'description' );
  $html .= '</h2>';
  $html .= '</hgroup>';
  $html .= get_search_form( false );    // false returns form as string
  $html .= '</header><!-- end #branding -->';
  $html .= '</div><!-- end #header -->';

  return $html;

}
