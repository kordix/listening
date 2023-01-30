<html>
<head>
    <title>KONWERTER</title>
</head>

</html>


<?php

$lrc = "
[00:03.50]That's the motto
[00:05.75]Throw it back with no chaser, with no trouble
[00:09.74]Poppin' that Moët, baby, let's make some bubbles
[00:12.74]Puffin' on that Gelato, wanna be seeing double
[00:18.00]Gotta do what you gotta
[00:20.00]Believe it, we ain't got no plans to leave here
[00:26.00]Tell all of your friends to be here
[00:30.00]We ain't gonna sleep all weekend
[00:34.25]Oh, you know, you know, you know that's the motto (mhm)
[00:38.00]Drop a few bills then pop a few champagne bottles (mhm)
[00:41.25]Throwin' that money like you just won the lotto (mhm)
[00:45.00]We been up all damn summer
[00:48.49]Makin' that bread and butter
[00:50.74]Tell me, did I just stutter?
[00:52.49]That's the motto (mhm)
[00:55.00]Drop a few bills then pop a few champagne bottles (mhm)
[00:57.25]Throwin' that money like you just won the lotto (mhm)
[01:02.99]We been up all damn summer
[01:05.00]Makin' that bread and butter
[01:07.00]Tell me, did I just stutter?
[01:17.00]Hopped in the Range, can't feel my face, the window's down
[01:21.24]Back to my place, my birthday cake is coming out
[01:25.25]The way it's hittin' like I can go all night
[01:31.25]Don't want no bloodshot eyes
[01:33.50]So hold my drink, let's fly
[01:34.25]Believe it, we ain't got no plans to leave here
[01:39.00]Tell all of your friends to be here
[01:42.75]We ain't gonna sleep all weekend
";



$myjson = '';
$linia = '';

$poczatek = 0;


$index = 0;
// $myjson .= 'fragmenty:[';

$numerlini = 0;

$korekta = 0;

$ilelini = substr_count($lrc,"\r\n") - 2;
while ($numerlini <  $ilelini){

    $linia = substr($lrc, $poczatek, strpos($lrc, "\r\n", $poczatek + 1) - $poczatek);

    $myjson .= '{index:'.$index;


    $myjson .= ',start:';

    $minuty = substr($linia,4,1);
    $czas = str_replace('[03:', '',str_replace('[02:', '',str_replace('[01:', '',str_replace('[00:', '', str_replace('[00:0', '', substr($linia, 0, 11))))));
    
    if (intval($minuty) > 0) {
        $czas = floatval(floatval($minuty) * 60 + floatval($czas));
    }

    $myjson .= $czas;
    $myjson .= ',tekst:';
    $myjson .=  '\''.str_replace('\'','\\\'', substr($linia, 12, strlen($linia))).'\'';
    $myjson .= ',duration:';

    $poczatek += strlen($linia);

    $linia = substr($lrc, $poczatek, strpos($lrc, "\r\n", $poczatek + 1) - $poczatek);

    $minuty = substr($linia,4,1);
    $newczas = str_replace('[03:', '',str_replace('[02:', '',str_replace('[01:', '',str_replace('[00:', '', str_replace('[00:0', '', substr($linia, 0, 11))))));

    
    
    if (intval($minuty) > 0) {
        $newczas = floatval(floatval($minuty) * 60 + floatval($newczas));
    }

    @$duration = floatval($newczas) - floatval($czas) + 0.5;

    $myjson .= floatval($duration);

    $myjson .= '},';

    

$numerlini = $numerlini + 1;
$index = $index + 1;

}




$myjson = substr($myjson,0,-1);
echo str_replace('},{',"},<br>{",$myjson );

?>