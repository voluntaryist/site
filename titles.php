<?php
$titles = array(
'/howibecame/seeking.html' => "Seeking Consistency: How I Arrived at Voluntaryism",
);
// print_r($_SERVER);
if(preg_match("#<h1>([^<]+)</h1>#i",$contents,$ht))
{
    $ht = $ht[1];
}
else
{
    preg_match("#<h2>([^<]+)</h2>#i",$contents,$ht);
    $ht = $ht[1];
}
?>