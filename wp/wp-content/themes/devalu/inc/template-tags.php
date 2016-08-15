<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Impronta
 */

if ( ! function_exists( 'impronta_metadata' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function impronta_metadata() {

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		echo '<p class="metadata">';

		$byline = sprintf(
			esc_html_x( 'By %s', 'post author',  'impronta' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span> '
		);

		echo $byline;

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ',  'impronta' ) );
		if ( $categories_list && impronta_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html_x( 'on %1$s ', 'on categories', 'impronta' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ',  'impronta' ) );
		if ( $tags_list ) {
			printf( esc_html__( 'tagged %1$s',  'impronta' ), $tags_list ); // WPCS: XSS OK.
		}
		

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			if ( get_comments_number( get_the_id() ) == 0 ) :
				echo esc_html__( '- ', 'impronta' );
			else:
				echo esc_html__( 'with ', 'impronta' );
			endif;
			comments_popup_link( esc_html__( 'Leave a comment',  'impronta' ), esc_html__( '1 Comment',  'impronta' ), esc_html__( '% Comments',  'impronta' ) );
		}

		if ( is_sticky() ) {
			echo ' - ' . '<i class="feature-star fa fa-star" data-toggle="tooltip" data-placement="right" title="' . esc_attr__( 'Featured Post', 'impronta' ) . '"></i>';
		}

		echo '</p>';
	}


}
endif;





if ( ! function_exists( 'impronta_date' ) ) :
/**
 * Prints HTML with date information for the current post.
 */
function impronta_date() {

	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s <span>%3$s</span></time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s <span>%3$s</span></time>';
		$time_string = sprintf( $time_string,
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date( 'j' ) ),
			esc_html( get_the_modified_date( 'M' ) )
		);
	}else{
		$time_string = sprintf( $time_string, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date( 'j' ) ), esc_html( get_the_date( 'M' ) ) );
	}

	echo $time_string;

}
endif;






/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function impronta_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'impronta_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'impronta_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so impronta_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so impronta_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in impronta_categorized_blog.
 */
function impronta_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'impronta_categories' );
}
add_action( 'edit_category', 'impronta_category_transient_flusher' );
add_action( 'save_post',     'impronta_category_transient_flusher' );
