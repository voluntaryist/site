<?php
/**
 * The template for displaying category pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Impronta
 */
$isArticles = strcasecmp($wp_query->query['category_name'],'articles') == 0;
get_header(); ?>

    <main id="main" class="site-main col-md-9 col-md-push-3" role="main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <?php
                    the_archive_title( '<h2 class="page-title">', '</h2>' );
                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                ?>
                        <div style="width:575px">
                            <FORM id=search method=GET action="http://www.google.com/search">
                                <input type=hidden name=ie value=UTF-8>
                                <input type=hidden name=oe value=UTF-8>
                                <A HREF="http://www.google.com/" style='float:left;height:120px'>
                                    <IMG SRC="//www.google.com/logos/Logo_40wht.gif"
                                    border="0" ALT="Google"></A>
                                <INPUT TYPE=text name=q size=39 maxlength=255 value=""><br/>
                                <INPUT type=submit name=btnG VALUE="Google Search">
                                <INPUT type=submit id=btnD VALUE="DuckDuckGo Search"
                                    title='Use DuckduckGo instead of Google'>
                                <font size=-1>
                                <input type=hidden name=domains value="www.Voluntaryist.com"><br><input type=radio id=ssw name=sitesearch value=""> WWW <input type=radio name=sitesearch value="http://www.voluntaryist.com" checked> Voluntaryist.com <br>

                                </font>
                            </FORM>
                        </div>
            </header><!-- .page-header -->
<center>
    <form id='inum'>
        <font size=-1>
            <input type='submit' value='Go To Issue' id='nbtn'/>
            <input type='text' inx='Iss #' value='Iss #' id='num' size='1'/><br />
        </font>
    </form>
</center>

            <div id="posts-container">

                <?php /* Start the Loop */
                $lastIssue = '';
                $output = array();
                while ( have_posts() ) : the_post();
                    // If we are doing articles (28), make sure the Issue was already displayed.
                    // -------------------------------------------------------------------------
                    global $wp_query;
                    if($isArticles)
                    {
                        $categories = get_the_category();
                        foreach($categories as $category)
                        {
                            // Use only the Issue category.
                            // ----------------------------
                            if( substr($category->name,0,6) == 'Issue ' )
                            {
                                if($category->name != $lastIssue)
                                {
                                    // Output a link to the issue ("Issue [number]")
                                    // ---------------------------------------------
                                    $lastIssue = $category->name;
                                    $iid = substr($lastIssue, 6);
                                    // Must be revised once we hit 1000 issues.
                                    // ----------------------------------------
                                    $pdfID = substr(10000+$iid, -3);
                                    $output[$iid] = "<a href='backissues/$pdfID.pdf' name='i$pdfID'><strong>$lastIssue</strong></a><br />";
                                }
                            }
                        }
                    } // Handled Articles Category.
                    $output[$iid] .= sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ).get_the_title().'</a><br/>';
                endwhile;
                ksort($output);
                foreach($output as $l)
                {
                    echo $l;
                }
                ?>


            </div><!-- /post-container -->

            <?php get_template_part( 'template-parts/pagination', 'archive' ); ?>

        <?php else : ?>

            <?php get_template_part( 'template-parts/content', 'none' ); ?>

        <?php endif; ?>

    </main><!-- #main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
