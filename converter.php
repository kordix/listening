<html>
<head>
    <title>KONWERTER</title>
</head>

</html>


<?php

$lrc = "
[00:14.79]Her name is Noelle
[00:17.55]I have a dream about her
[00:20.05]She rings my bell
[00:22.29]I got gym class in half an hour
[00:25.30]Oh, how she rocks
[00:27.33]In Keds and tube socks
[00:30.09]But she doesn't know who I am
[00:35.06]And she doesn't give a damn about me
[00:40.05]'Cause I'm just a teenage dirtbag, baby
[00:45.28]Yeah, I'm just a teenage dirtbag, baby
[00:50.51]Listen to Iron Maiden, baby, with me
[00:56.89]Oo-o-o-oo-o-oh
[01:11.64]Her boyfriend's a dick
[01:14.51]And he brings a gun to school
[01:16.92]And he'd simply kick
[01:19.43]My ass if he knew the truth
[01:22.06]He lives on my block
[01:24.34]And he drives an IROC
[01:26.81]But he doesn't know who I am
[01:32.10]And he doesn't give a damn about me
[01:37.07]'Cause I'm just a teenage dirtbag, baby
[01:42.33]Yeah, I'm just a teenage dirtbag, baby
[01:47.57]Listen to Iron Maiden, baby, with me
[01:54.10]Oo-o-o-oo-o-oh
[02:00.53]Oh yeah, dirtbag
[02:05.90]No, she doesn't know what she's missing
[02:10.59]Oh yeah, dirtbag
[02:16.30]No, she doesn't know what she's missing
[02:23.99]Man, I feel like mold
[02:26.76]It's prom night and I am lonely
[02:29.52]Lo and behold
[02:31.86]She's walking over to me
[02:34.62]This must be fake
[02:36.64]My lip starts to shake
[02:39.62]How does she know who I am?
[02:44.44]And why does she give a damn about me?
[02:49.11]I've got two tickets to Iron Maiden, baby
[02:54.86]Come with me Friday, don't say maybe
[02:59.86]I'm just a teenage dirtbag baby like you
[03:06.37]Oo-o-oo-oh
[03:12.88]Oh yeah, dirtbag
[03:18.39]No, she doesn't know what she's missing
[03:22.87]Oh yeah, dirtbag
[03:28.15]No, she doesn't know what she's missing
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