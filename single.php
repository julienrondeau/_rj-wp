<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _rj
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
  
  <div id="primary" class="content-area">

    <?php while ( have_posts() ) : the_post(); ?>

        <?php get_template_part( 'content', 'single' ); ?>

        <?php custom_nav(); ?>      
        <?php the_post_navigation(); ?>


        <?php
        // If comments are open or we have at least one comment, load up the comment template.
//				if ( comments_open() || get_comments_number() ) :
//					comments_template();
//				endif;
        ?>

    <?php endwhile; // End of the loop. ?>
  </div><!-- #primary -->
  
  <?php get_sidebar(); ?> 
  
</main><!-- #main -->

<?php get_footer(); ?>
