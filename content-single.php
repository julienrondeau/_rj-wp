<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package _rj
 */

?>

		
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

		<div class="entry-meta">
			<?php //_rj_posted_on(); ?>
		</div> <!-- .entry-meta -->
	</header> <!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', '_rj' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php the_date(); ?>
        <?php echo ' &#8226; '; ?>
        <?php the_category( '<span class="entry-footer-category">', '</span>'); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

