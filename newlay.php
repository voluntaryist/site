<?php
$filename = $_GET['file'];
include("funcs.php");
// $filename = 'index.html';
$docroot = $_SERVER['DOCUMENT_ROOT'];
$handle = fopen($filename, "rb");
$contents = fread($handle, filesize($filename));
fclose($handle);

// If there is a refresh, just return the page as is.
// --------------------------------------------------
if(strpos($contents,'<meta HTTP-EQUIV="Refresh"') > 0 || strpos($contents,'<!-- nolay -->') > 0)
{
    die($contents);
}

// If we're in a subdirectory, chdir to it.
// ----------------------------------------
if(preg_match("#voluntaryist/([^/]+)/#",$filename,$dir))
{
    chdir($dir[1]);
}
// Alter the file
// --------------

// Identify the three dynamic pieces of the header
// -----------------------------------------------
if( preg_match("#title>(.*?)</title>#s",$contents,$bquote) )
{
    $title = $bquote[1];
}
// Get list of titles.
// -------------------
include("titles.php");

// Try replacing it if it's still "voluntaryist.com"
// -------------------------------------------------
if($title == 'voluntaryist.com')
{
    $title = isset($titles[$_SERVER['REQUEST_URI']])
        ? $titles[$_SERVER['REQUEST_URI']]
        : $ht;
    $contents = preg_replace("#title>.*?</title#s",
        "title>voluntaryist.com - ".$title."</title",$contents);
}

session_start();
$phpC = '?'.'>';

$newHead = "<script type='text/javascript'>
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-35663849-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

          function paypal(price, name)
          {
            uname = encodeURIComponent(name);
            location.href='https://www.paypal.com/cgi-bin/webscr?cmd=_cart&business=5DCD3RCYP8Q5J&lc=US&item_name='
                + uname + '&amount=' + price + '%2e00&currency_code=USD&button_subtype=products&add=1&bn=PP%2dShopCartBF%3abtn_cart_LG%2egif%3aNonHosted';
          }
        </script>
    <>/head>";

$newHtml = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.1//EN\" \"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd\">
    <>html><>head><>script src='//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js' ><>/script>
        <>meta http-equiv=\"content-type\" content=\"text/html;charset=ISO-8859-1\">";

$contents = preg_replace(array("#</head>#s","#<html>#"),
    array($newHead,$newHtml),$contents,1);
$contents = preg_replace(array( "#</head>#s","#<html>#","#<head>#","#<!-- Main Content -->..?<td valign=top>..?<center>#s",
        '#</center>..?</td>..?</tr>..?<!-- end second row -->..?</table>..?</div>..?</body>#s',
        '#<meta http-equiv="content-type" content="text/html;charset=UTF-8">#','/<>/'),
    array('','','',"<!-- Main Content -->\n<td valign=top>",
        "</td>\n</tr>\n<!-- end second row -->\n</table>\n</div>\n</body>",'','<'),$contents);

$contents = preg_replace(array( "#“#","#”#","#‘#","#’#","#–#","#—#","# #","#é#","#ú#","#ó#" ),
    array('&ldquo;','&rdquo;','&lsquo;','&rsquo;','&ndash;','&ndash;',' ','&#233;','&#250;','&#243;'),$contents);

$contents = str_replace(array('name=sitesearch value="http://www.voluntaryist.com"'),
    array('name=sitesearch value="voluntaryist.com"'), $contents);

$disq = <<< DISQ
    <div id="disqus_thread" style="width: 500px"></div>
    <script type="text/javascript">
        /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
        var disqus_shortname = 'voluntaryist'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <a href="http://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
DISQ;

$contents = str_replace('<!-- ##DISQ## -->', $disq, $contents);

if('74.100.77.169' == $_SERVER['REMOTE_ADDR'] && $_GET['src'] == 1)
{
    die($contents);
}
// Add some nice hyperlinks
// ------------------------
$links = array(
    'electoral politics' => '/nonvoting/index.html',
    'education' => '/articles/040.html',
    'Jeff Knaebel' => '/forthcoming/farewelltomurder.html',
    'voluntaryism' => '/fundamentals/introduction.html',
    'coins' => '/aboutcoins.html',
    'by reading' => '/howibecame/myjourney.html',
    'police state' => '/forthcoming/policestate.html',
    'a rebel' => '/howibecame/rebel.html',
    'homeschooling' => '/forthcoming/educatedchicken.html',
    'Christmas' => '/howibecame/perfectchristmas.html',
    'Hayek' => '/howibecame/whatsmystory.html',
    'law enforcement' => '/howibecame/eyre.html',
    'the children' => '/articles/059d.html',
    'the Party' => '/howibecame/alexknight.html',
    'Lloyd Licher' => '/howibecame/licher.html',
    'liars' => '/howibecame/mcmanigal.html',
    'anonymous' => '/howibecame/windingroad.html',
    'political science' => '/howibecame/myroute.html',
    'N[oO]' => '/howibecame/whataboutno.html',
    'Laissez Faire' => '/howibecame/andrearich.html',
    'Larken Rose' => '/howibecame/deprogramming.html',
    'consistency' => '/howibecame/seeking.html',
    'conservative' => '/howibecame/conscience.html',
    'searching' => '/howibecame/searchfortruth.html',
    'borders' => '/howibecame/mysteriousways.html',
    'theft' => '/taxation/contest.html',
    "right by nature" => 'http://voluntarycompact.com/the-argument-from-natural-order.html'
    );
if(substr($filename,-19) != 'mysteriousways.html')
{$debug = substr($filename,-19);
    foreach($links as $k => $l)
    {
        if(!(strpos($_SERVER['REQUEST_URI'],$l) === false) )
        {
            $debug .= "strpos(_SERVER['REQUEST_URI'],$l)";
            unset($links[$k]);
        }
    }
    $srch = preg_replace("/^.*$/","#([^<>;]{20}[^a-z])($0)([, .][^<>;]{20})#",array_keys($links));
    $repl = preg_replace("/^.*$/",'\$1'."<a href='$0'>".'\\$2</a>\\$3',$links);
    $contents = preg_replace($srch, $repl, $contents, 5);
}
eval($phpC.$contents);
$debug = $titles[$_SERVER['REQUEST_URI']];
echo '<!-- '.$debug.' -->';
echo '<!--
"I am notplato on bitcoin-otc"
without the quotes, using 1MaRr8uhTqshmaCHpRBZQkeytQynwJwztg has this signature:
H8z667dnZZli2ppHmw942wGwLmAS7xbJ4Mjl3vVyCkA8Hlg3NR/EzHfSPFnzXDGOlzj1xqtXLMGXa1H5iGI3X5I=
Please use the "Our Webmaster..." link at the bottom of the left menu
if you would like to establish that this was not slipped into the website without permission.
-->';
?>
