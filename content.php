<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _rj
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		
		<?php 
			the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); 
	
		    if ( 'post' === get_post_type() ) : ?>
		
				<div class="entry-meta">
                  <?php the_date(); ?> - 
                  <?php comments_number( 'No Comments', 'one Comment', '% Comments' ); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
            the_excerpt();
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_rj' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php //_rj_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
