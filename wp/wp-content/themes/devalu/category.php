<?php
/**
 * The template for displaying category pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Impronta
 */

get_header(); ?>

    <main id="main" class="site-main col-md-9 col-md-push-3" role="main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <?php
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
            </header><!-- .page-header -->

            <div id="posts-container">

                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post();
                    the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a><br/>' );
                endwhile; ?>

            </div><!-- /post-container -->

            <?php get_template_part( 'template-parts/pagination', 'archive' ); ?>

        <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>

    </main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
