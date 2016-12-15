<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package _rj
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
  <section id="primary" class="content-area">

      <?php if ( have_posts() ) : ?>

          <header class="page-header">
              <h2 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', '_rj' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
          </header><!-- .page-header -->

          <?php /* Start the Loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>

              <?php
              /**
               * Run the loop for the search to output the results.
               * If you want to overload this in a child theme then include a file
               * called content-search.php and that will be used instead.
               */
              get_template_part( 'template-parts/content', 'search' );
              ?>

          <?php endwhile; ?>

          <?php the_posts_navigation(); ?>

      <?php else : ?>

          <?php get_template_part( 'template-parts/content', 'none' ); ?>

      <?php endif; ?>

    <?php //get_sidebar(); ?>
  </section><!-- #primary -->
</main><!-- #main -->

<?php get_footer(); ?>
