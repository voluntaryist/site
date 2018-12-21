<?php
include_once($_SERVER['DOCUMENT_ROOT']."/scripts/curl.php");
$BTC_JSON_URL = 'http://api.bitcoincharts.com/v1/weighted_prices.json';
$BTC_AVG_COM = 'https://api.bitcoinaverage.com/ticker/USD/';
$BTC_WINK = 'http://winkdex.com/api/v0/price';

function email($subject,$body,$linkText)
{
return <<< EMAIL
<script type="text/javascript">
<!--
    var string1 = "editor";
    var string2 = "@";
    var string3 = "voluntaryist.com";
    var string4 = string1 + string2 + string3;
    document.write("<a href='" + "mail" + "to:" + string1 + string2 + string3
        + "?subject=$subject&body=$body'>$linkText</a>");
//-->
</script>
EMAIL;
}

function testpa2() { return "(Not Yet Imp.)"; }

function priceAt2($price, $name='Payment', $return=false)
{
    global $rateObj,$BTC_JSON_URL,$BTC_AVG_COM,$BTC_WINK;

    $rateFile = 'rates.ser';
    if(!isset($rateObj))
    {
        if( ($fTime = @filemtime($rateFile)) && time() - $fTime > 300 )
        {
            @unlink($rateFile);
        }
        if(($fRate = @file_get_contents($rateFile)) === false)
        {
            $rateJS = curlGet("https://openexchangerates.org/api/latest.json?app_id=7eb73900ba7c488f8977316618c7c5b7");
            $rates = json_decode($rateJS);
            $rateObj = new stdClass();
            $rateObj->rateAu = 1/$rates->rates->XAU;
            $rateObj->rateAr = 1/$rates->rates->XAG;
            $rateObj->rateBTC = 1/$rates->rates->BTC;

            $fRate = serialize($rateObj);
            file_put_contents($rateFile,$fRate, LOCK_EX);
        }
        $rateObj = unserialize($fRate);
        if($rateObj->rateBTC == -1)
        {
            @unlink($rateFile);
        }
    }
$ret =  "<!-- btc3: $btc,  -->";
    $inAr = $rateObj->rateAr > 0 ? number_format($price/$rateObj->rateAr,3) : 'N/A';
    $inAuz = $rateObj->rateAu > 0 ? number_format($price/$rateObj->rateAu,5) : 'N/A';
    $inAu = $rateObj->rateAu > 0 ? number_format($price/$rateObj->rateAu*31.1034768,3) : 'N/A';
    $inBTC = $rateObj->rateBTC > 0 ? number_format($price/$rateObj->rateBTC,5) : 'N/A';
    $pp1 = "https://www.paypal.com/cgi-bin/webscr?cmd=_cart&business=UQCKYDNMPYF56&lc=US";
    $pp2 = "&currency_code=USD&button_subtype=products&add=1&bn=PP%2dShopCartBF%3abtn_cart_LG%2egif%3aNonHosted";
    $ret .= " <a href='$pp1&item_name=$name&amount=$price$pp2'
        title='Pay with Paypal'>$price.00 federal reserve notes</a>
        <select><option>Or Real Money...</option>
        <option>$inAr oz. of Silver</option>
        <option>$inAu grams of gold</option>
        <option>$inAuz troy oz. of gold</option>
        <option>$inBTC bitcoins</option></select>";

    if($return)
    {
        return $ret;
    }
    else
    {
        echo $ret;
    }
}
?>
