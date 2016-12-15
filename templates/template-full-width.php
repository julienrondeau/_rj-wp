<?php
/**
 * Template Name: Full-width Page
 *
 * Description: Displays a full-width page, with no sidebar. This template is great for pages
 * containing large amounts of content.
 *
 * @package _rj
 */

get_header(); ?>

	
  <main id="main" class="site-main container" role="main">
    
    <div id="primary" class="content-area full-width">
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
    
  </main><!-- #main -->
	
<?php get_footer(); ?>
