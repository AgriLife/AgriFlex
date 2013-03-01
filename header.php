<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="wrap">
 *
 * @package AgriFlex
 * @since AgriFlex 1.0
 */
 
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html id="ie6" class="no-js ie6 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="no-js ie7 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="no-js ie8 oldie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?> class="no-js" id="doc">
<!--<![endif]-->
<head>

  <meta charset="<?php bloginfo( 'charset' ); ?>" />

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Print the <title> tag based on what is being viewed.
    We filter the output of wp_title() a bit - see
    agriflex_filter_wp_title() in functions.php.
    -->
  <title>
    <?php wp_title( '|', true, 'right' ); ?>
  </title>

  <link rel="profile" href="http://gmpg.org/xfn/11" />

  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=100" />

  <!--[if lt IE 9]>
  <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/iefix.css?2" />
  <![endif]-->

  <link rel="shortcut icon" href="http://agrilifecdn.tamu.edu/wp-content/themes/agrilife-2.0/favicon.ico" type="image/ico" />

  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

  <!-- Action hook to include some head stuff -->
  <?php agriflex_head(); ?>

  <!--Always have wp_head() just before the closing </head>
  tag of your theme, or you will break many plugins, which
  generally use this hook to add elements to <head> such
  as styles, scripts, and meta tags. -->
  <?php wp_head(); ?>

</head>

<body <?php body_class('not-active'); ?> id="page-body">

<!-- Action hook for inserting top navigation and other elements -->
<?php agriflex_before_header(); ?>

<div id="wrapper" class="hfeed">

  <!-- Action hook creating the site header -->
  <?php agriflex_header(); ?>

  <!-- Action hook for placing content below the site header -->
  <?php agriflex_after_header(); ?>

  <div id="content-wrap" role="document">		
          <div class="wrap">	
