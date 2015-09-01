<?php
    $recents = !isset($recents) ? 8 : $recents;
    $files = array_merge(glob('*/index.ht*'), glob('*.html'));
    $byTime = array();
    foreach($files as $f)
    {
        if(!preg_match("/^feed|tire/",$f))
        {
            $data = file_get_contents($f);
            preg_match_all("~<a[^>]+?href=['\"]([^#:'\"]+)[#'\"][^>]*>.*?</a>~is",$data,$matches);
            foreach($matches[1] as $i => $m)
            {
                $lf = substr($m,0,1) == '/'
                    ? substr($m,1)
                    : preg_replace("#/index.ht.*$#",'',$f)."/$m";
                $wp = substr($m,0,1) == '/'
                    ? $matches[0][$i]
                    : str_replace($m, '/'.preg_replace("#/index.ht.*$#",'',$f)."/$m",$matches[0][$i]);
                if(($ti = @filemtime($lf)) && !preg_match("/_old.ht|plea.ht|index.ht|rendernot/",$m)
                    && !preg_match("#>(click )?here<#i",$wp))
                {
                    $hash = substr(md5(basename($lf)),2,4);
                    $byTime[$ti.'_'.$hash] = array($wp, $lf);
                }
            }
        }
    }
    krsort($byTime);
// echo "<!-- ".print_r($byTime,true)." -->";
    $listed = 0;
    foreach($byTime as $f)
    {
        $file = fopen($f[1], 'r');
        $isMinor = fread($file, 14);
        fclose($file);
        if($isMinor != '<!-- minor -->')
        {
            $f = preg_replace("/Good Government: Hope or Illusion.|Does Government protection Protect./","$0 by Robert LeFevre", $f[0]);
            echo "<li>$f</li>\n";
            if(++$listed == $recents)
            {
                break;
            }
        }
    }
?>