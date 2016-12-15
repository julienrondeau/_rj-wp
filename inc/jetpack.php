<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package _rj
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function _rj_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => '_rj_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function _rj_jetpack_setup
add_action( 'after_setup_theme', '_rj_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function _rj_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'content', get_post_format() );
	}
} // end function _rj_infinite_scroll_render
