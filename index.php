<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _rj
 */

get_header(); ?>

<main id="main" class="site-main" role="main">
  
	<div id="primary" class="content-area">
<!--          <header>
            <h2 class="title">latest publications</h2>
            
            <div class="main-display">
              <span class="mosaique"></span>
              <span class="carres on"></span>
            </div>
          </header>-->
          
          <div class="site-main-content">
            
            <?php if ( have_posts() ) : ?>

                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php

                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'content', get_post_format() );
                    ?>

			<?php endwhile; ?>
            
          </div> <!-- .site-main-content -->
          
			<?php the_posts_navigation(); 
                  ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>
	
	</div><!-- #primary -->

    <?php get_sidebar(); ?>
    
</main><!-- #main -->
<?php get_footer(); ?>
