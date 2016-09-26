<?php
$dave_is_testing = ($_SERVER['REMOTE_ADDR'] == '71.119.100.176');

function custom_head()
{
    echo <<< ONREADY
    <script type='text/javascript'>
    $(function()
    {
        $($('a')[0]).hover(function()
        {
            var ti = $($('img')[0]),
                src = ti.attr('src');
            ti.attr('src',src.replace('ee2','ee1'));
        },                 function()
        {
            var ti = $($('img')[0]),
                src = ti.attr('src');
            ti.attr('src',src.replace('ee1','ee2'));
        });
        $(window).resize(function()
        {
            var tg=$('img:eq(0)');
            tg.width(Math.min($('img:eq(1)').position().left-4,150));
        });
        $('#btnD').click(function(e){
            var site = $('input[name=sitesearch]:checked').val(),
                iq   = $('input[name=q]'),
                q    = iq.val(),
                nq   = q + (site > '' ? ' ' + 'site:voluntaryist.com' : '');
            location.href='https://www.duckduckgo.com?q=' + nq;
            return false;
        });
    });
    </script>
ONREADY;
}

add_filter("wp_enqueue_scripts", "custom_head", 10, 2);

function djs_sc_addthis()
{
    return <<< ATEND
    <!-- AddThis Button BEGIN -->
    <div class="addthis_default_style"
        style="position:absolute;right:10px;top:10px;z-index:5;line-height:1;">
    <a class="at300b" title="Contribute on GitHub" href="https://github.com/voluntaryist/site">
      <img style="height:16px;" src="/imgs/GitHub-Mark-32px.png" alt="Contribute on GitHub"></a>
    <a class="addthis_button_preferred_1"></a>
    <a class="addthis_button_preferred_2"></a>
    <a class="addthis_button_preferred_3"></a>
    <a class="addthis_button_preferred_4"></a>
    <a class="addthis_button_compact"></a>
    <a class="addthis_counter addthis_bubble_style"></a>
    </div>
    <script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-50dcd8de709483c2"></script>
    <!-- AddThis Button END -->
ATEND;
}

function djs_sc_quote()
{
    include("../quotelist.php");
    srand((date('mYd')+1)*count($quotes));
    return $quotes[rand(0,count($quotes))];
}
add_shortcode('daily-quote','djs_sc_quote');
add_shortcode('addthis','djs_sc_addthis');

function custom_order_category( $query ) {
    // exit out if it's the admin or it isn't the main query
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }
    // order category archives by title in ascending order
    if ( is_category(3) ) {
        $query->set( 'order' , 'asc' );
        $query->set( 'orderby', 'title');
        return;
    }
}
add_action( 'pre_get_posts', 'custom_order_category', 1 );

if($dave_is_testing)
{
}