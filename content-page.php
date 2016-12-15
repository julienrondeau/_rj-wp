<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _rj
 */


?>



<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">

      <?php the_content(); ?>
        `
      <?php
          wp_link_pages( array(
              'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_rj' ),
              'after'  => '</div>',
          ) );
      ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', '_rj' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->


