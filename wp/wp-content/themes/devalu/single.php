<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Impronta
 */

get_header(); ?>

	<main id="main" class="site-main col-md-9 col-md-push-3" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/content', 'single' ); ?>			

			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

			<?php the_post_navigation(); ?>

		<?php endwhile; // End of the loop. ?>

	</main><!-- #main -->


	<?php get_sidebar(); ?>


<?php get_footer(); ?>
