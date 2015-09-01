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

function priceAt2($price, $name='Payment')
{
    global $rateObj,$BTC_JSON_URL,$BTC_AVG_COM,$BTC_WINK;

    $rateFile = 'rates.ser';
    if(!isset($rateObj))
    {
        if( ($fTime = @filemtime($rateFile)) && time() - $fTime > 1200 )
        {
            @unlink($rateFile);
        }
        if(($fRate = @file_get_contents($rateFile)) === false)
        {
            $rateJS = curlGet("http://ws.goldmoney.com/metal/prices/currentSpotPrices?currency=usd&units=ounces");
            $metals = json_decode($rateJS);
            $rateObj = new stdClass();
            foreach($metals->spotPrices as $rate)
            {
                $prc = $rate->spotPrice;
                switch($rate->metal)
                {
                    case 'au': $rateObj->rateAu = $prc; break;
                    case 'ag': $rateObj->rateAr = $prc; break;
                }
            }
            $btc = curlGet($BTC_JSON_URL);
            if($btc > '' && ($rates = json_decode($btc)))
            {
                $rates = get_object_vars($rates->USD);
                $rateObj->rateBTC = $rates['24h'];
            }
            else // Try BTC_AVG
            {
                $btc = curlGet($BTC_AVG_COM);
                if($rates = json_decode($btc))
                {
                    $rates = get_object_vars($rates);
                    $rateObj->rateBTC = $rates['24h_avg'];
                }
                else // Try BTC_WINK
                {
                    $btc = curlGet($BTC_WINK);
                    if($rates = json_decode($btc))
                    {
                        $rates = get_object_vars($rates);
                        $rateObj->rateBTC = $rates['price']/100;
                    }
                    else
                    {
                        $rateObj->rateBTC = -1;
                    }
                }
            }
            $fRate = serialize($rateObj);
            file_put_contents($rateFile,$fRate, LOCK_EX);
        }
        $rateObj = unserialize($fRate);
        if($rateObj->rateBTC == -1)
        {
            @unlink($rateFile);
        }
    }
echo "<!-- btc3: $btc,  -->";
    $inAr = $rateObj->rateAr > 0 ? number_format($price/$rateObj->rateAr,3) : 'N/A';
    $inAuz = $rateObj->rateAu > 0 ? number_format($price/$rateObj->rateAu,5) : 'N/A';
    $inAu = $rateObj->rateAu > 0 ? number_format($price/$rateObj->rateAu*31.1034768,3) : 'N/A';
    $inBTC = $rateObj->rateBTC > 0 ? number_format($price/$rateObj->rateBTC,5) : 'N/A';
    $pp1 = "https://www.paypal.com/cgi-bin/webscr?cmd=_cart&business=JGMXUNFVK7U94&lc=US";
    $pp2 = "&currency_code=USD&button_subtype=products&add=1&bn=PP%2dShopCartBF%3abtn_cart_LG%2egif%3aNonHosted";
    echo " <a href='$pp1&item_name=$name&amount=$price$pp2'
        title='Pay with Paypal'>\$$price.00</a>
        (<select>
        <option>Or Real Money...</option>
        <option>$inAr oz. Silver</option>
        <option>$inAu grams gold</option>
        <option>$inAuz troy oz. gold</option>
        <option>$inBTC bitcoins</option></select>)";
}
?>
