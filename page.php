<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _rj
 */

get_header(); ?>

	
<main id="main" class="site-main" role="main">
  
  <div id="primary" class="content-area">
    <header class="entry-header">

      <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

    </header><!-- .entry-header -->

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', 'page' ); ?>

        <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        ?>

    <?php endwhile; // End of the loop. ?>
  </div><!-- #primary --> 

  <?php get_sidebar(); ?>

</main><!-- #main -->
	
<?php get_footer(); ?>
