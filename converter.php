<html>
<head>
    <title>KONWERTER</title>
</head>

</html>


<?php

$lrc = '
[00:13.67]I stand here waiting for you to bang the gong
[00:20.18]To crash the critic saying, "Is it right or is it wrong?"
[00:26.93]If only fame had an I.V., baby could I bear
[00:34.17]Being away from you, I found the vein, put it in here
[00:39.92]I live for the applause, applause, applause
[00:43.43]I live for the applause-plause
[00:45.18]Live for the applause-plause
[00:46.92]Live for the way that you cheer and scream for me
[00:50.43]The applause, applause, applause
[00:54.68]Give me that thing that I love (I\'ll turn the lights out)
[00:57.93]Put your hands up, make \'em touch, touch (make it real loud)
[01:08.19](A-P-P-L-A-U-S-E) Make it real loud
[01:12.17](A-P-P-L-A-U-S-E) Put your hands up, make \'em touch, touch
[01:14.67](A-P-P-L-A-U-S-E) Make it real loud
[01:18.67](A-P-P-L-A-U-S-E) Put your hands up, make \'em touch, touch
[01:21.93]I\'ve overheard your theory "nostalgia\'s for geeks"
[01:28.67]I guess sir, if you say so, some of us just like to read
[01:35.93]One second I\'m a Koons, then suddenly the Koons is me
[01:42.67]Pop culture was in art, now art\'s in pop culture in me
[01:55.42]Live for the way that you cheer and scream for me
[03:25.42]A-R-T-P-O-P
';



$myjson = '';
$linia = '';

$poczatek = 0;


$index = 0;
// $myjson .= 'fragmenty:[';

$numerlini = 0;

$korekta = 0.01;

$ilelini = substr_count($lrc,"\r\n") - 2;
while ($numerlini <  $ilelini){

    $linia = substr($lrc, $poczatek, strpos($lrc, "\r\n", $poczatek + 1) - $poczatek);

    $myjson .= '{index:'.$index;


    $myjson .= ',start:';

    $minuty = substr($linia,4,1);
    $czas = str_replace('[03:', '',str_replace('[02:', '',str_replace('[01:', '',str_replace('[00:', '', str_replace('[00:0', '', substr($linia, 0, 11)))))) + $korekta;
    
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

    @$duration = floatval($newczas) - floatval($czas) + 0.5 + $korekta;

    $myjson .= floatval($duration);

    $myjson .= '},';

    

$numerlini = $numerlini + 1;
$index = $index + 1;

}




$myjson = substr($myjson,0,-1);
echo str_replace('},{',"},<br>{",$myjson );

?>