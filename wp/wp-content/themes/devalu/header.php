<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Impronta
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<!-- WP_Head -->
<?php wp_head(); ?>
<!-- End WP_Head -->

</head>

<body <?php body_class(); ?>>

    <div id="container" class="container">


        <div class="row">

<!--fixed image start -->
		<?php
$head = '<a href="'.esc_url( home_url( '/' ) ).'" rel="home">'.bloginfo( 'name' ).'<img src="http://voluntaryist.com/wp/wp-content/uploads/2016/07/free2.jpg"><img src="http://voluntaryist.com/wp/wp-content/uploads/2016/07/logo1.jpg" style="float:right"></a>';

					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><?php echo $head;?></h1>
					<?php else : ?>
						<p class="site-title"><?php echo $head;?></p>
					<?php endif;					
				?>
<!--fixed image end -->
