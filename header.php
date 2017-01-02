<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _rj
 */



?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.png">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', '_rj' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
      
      <a href="#navigation" class="nav-trigger" aria-controls="primary-menu" aria-expanded="false">
        Menu <span class="hamburger"></span>
      </a> <!-- .nav-trigger /Hamburger menu -->
       
      <div class="site-branding">
        <div class="site-title"><?php bloginfo( 'name' ); ?></div>

        <?php _rj_the_custom_logo() ?>

      </div><!-- .site-branding -->
      
      <nav id="site-navigation" class="main-navigation" role="navigation">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
      </nav><!-- #site-navigation -->
      
      
      <!-- Expandable search form -->

      <?php //include('inc/expandable-searchForm.php'); ?>

	</header><!-- #masthead -->

      
	  