<?php
$useWP = ($_COOKIE['UseWP'] == 'set');
if( $_GET['WP']=='1' )
{
    $h = isset($_GET['h']) ? $_GET['h'] : 1;
    setCookie('UseWP','set',time()+($h*3600));
    $useWP = true;
}
elseif( $_GET['WP']=='0' )
{
    setCookie('UseWP','unset');
    $useWP = false;
}

if( $useWP )
{
    /**
     * Front to the WordPress application. This file doesn't do anything, but loads
     * wp-blog-header.php which does and tells WordPress to load the theme.
     *
     * @package WordPress
     */

    /**
     * Tells WordPress to load the WordPress theme and output it.
     *
     * @var bool
     */
    define('WP_USE_THEMES', true);

    /** Loads the WordPress Environment and Template */
    require( dirname( __FILE__ ) . '/wp/wp-blog-header.php' );
}
else
{
    include('index.html');
}