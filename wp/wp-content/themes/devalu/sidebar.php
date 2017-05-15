<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Impronta
 */

?>
<aside id="sidebar" class="col-md-3 col-md-pull-9 widget-area" role="complementary">

	<header id="header" class="site-header" role="banner">

		<div class="logo_container">
            <?php
            $logo = wp_get_attachment_image_src( absint( get_theme_mod( 'impronta_logo' ) ), 'full' );
            $logo = $logo[0];
            ?>
            <?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="ql_logo"><?php if ( !empty( $logo ) ) : echo '<img src="' . esc_url( $logo ) . '" />'; else: bloginfo( 'name' ); endif; ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="ql_logo"><?php if ( !empty( $logo ) ) : echo '<img src="' . esc_url( $logo ) . '" />'; else: bloginfo( 'name' ); endif; ?></a></p>
			<?php endif; ?>

            <p class="site-description"><?php echo html_entity_decode(get_bloginfo('description')); ?></p>

            <?php get_template_part( '/template-parts/social-menu', 'header' ); ?>

            <hr class="hr-small">

        </div><!-- /logo_container -->
        
    </header>


    <nav id="jqueryslidemenu" class="jqueryslidemenu navbar " role="navigation">
        <?php
        wp_nav_menu( array(                     
            'theme_location'  => 'primary',
            'menu_id' => 'primary-menu',
            'depth'             => 3,
            'menu_class'        => 'nav',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker()
        ));
        ?>
    </nav>

    



	<?php dynamic_sidebar( 'sidebar-1' ); ?>



	<p class="sub-footer"><?php esc_html_e( 'Powered by Devsyntax',  'Devsyntax' ); ?><a href="<?php echo esc_url( __( 'https://www.devsyntax.com/',  'Devsyntax' ) ); ?>">.</p>
</aside><!-- #sidebar -->
