<?php
function curlGet($url)
{
    $ch = curl_init();

    $cookies = "/tmp/cookies.txt";
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookies);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookies);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER,
        array( 'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 (.NET CLR 3.5.30729)',
               'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
               'Accept-Language: en-us,en;q=0.5',
               'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
               'Keep-Alive: 300',
               'Connection: keep-alive'
               ) );
    curl_setopt($ch, CURLOPT_URL, $url);
    $ret = curl_exec($ch);
    global $cErr;
    $cErr = curl_error($ch);
    curl_close($ch);
    return $ret;
}
?>