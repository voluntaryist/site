<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Impronta
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 */
function impronta_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'type'      => 'scroll',
		'container' => 'posts-container',
		'render'    => 'impronta_infinite_scroll_render',
		'footer'    => false,
	) );

} // end function impronta_jetpack_setup
add_action( 'after_setup_theme', 'impronta_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function impronta_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/content', get_post_format() );
	}
} // end function impronta_infinite_scroll_render
