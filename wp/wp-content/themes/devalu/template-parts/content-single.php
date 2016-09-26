<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Impronta
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-image">
                <?php the_post_thumbnail( 'impronta_post' ); ?>
                <?php impronta_date(); ?>
        </div><!-- /post-image -->
        <?php endif; ?>

        <div class="post-content">

            <header class="entry-header">
                <?php the_title( sprintf( '<h1 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
            </header><!-- .entry-header -->

                <div class="entry-content">
                <?php the_content(); ?>

                <?php
                    wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:',  'impronta' ),
                        'after'  => '</div>',
                    ) );
                ?>
            </div><!-- .entry-content -->

            <div class="clearfix"></div>


        </div><!-- /post-content -->
</article><!-- #post-## -->
