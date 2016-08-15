<?php

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @see wp_add_inline_style()
 */
function impronta_custom_css() {
	$text_color = get_theme_mod( 'impronta_text_color', '#999999' );
	$link_color = get_theme_mod( 'impronta_link_color', '#6ebafc' );
	$headings_color = get_theme_mod( 'impronta_headings_color', '#383838' );

	$colors = array(
		'text_color'     => esc_attr( $text_color ),
		'link_color'     => esc_attr( $link_color ),
		'headings_color'     => esc_attr( $headings_color ),
	);

	$custom_css = impronta_get_custom_css( $colors );

	wp_add_inline_style( 'impronta-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'impronta_custom_css' );



/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors colors.
 * @return string CSS.
 */
function impronta_get_custom_css( $colors ) {

	//Default colors
	$colors = wp_parse_args( $colors, array(
		'text_color'            => '',
		'link_color'            => '',
		'headings_color'        => '',
	) );

	$css = <<<CSS

	/* Text Color */
	body{
		color: {$colors['text_color']};
	}
	/* Link Color */
	a{
		color: {$colors['link_color']};
	}
	/* Headings Color */
	h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6{
		color: {$colors['headings_color']};
	}


CSS;

	return $css;
}