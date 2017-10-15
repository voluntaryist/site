<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Impronta
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-image">
            <a href="<?php echo esc_url( get_permalink() ); ?>" class="ql_thumbnail_hover" rel="bookmark">
                <?php the_post_thumbnail( 'impronta_post' ); ?>
                <?php impronta_date(); ?>
            </a>
        </div><!-- /post-image -->
        <?php endif; ?>

        <div class="post-content">

        	<?php impronta_metadata(); ?>

			<header class="entry-header">
        		<?php the_title( sprintf( '<h2 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        	</header><!-- .entry-header -->

        	<hr>

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
