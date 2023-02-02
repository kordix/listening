<html>
<head>
    <title>KONWERTER</title>
</head>

</html>


<?php

$lrc = "
[00:08.10]I summoned you, please come to me
[00:11.87]Don't bury thoughts that you really want
[00:15.63]I fill you up, drink from my cup
[00:19.62]Within me lies what you really want
[00:23.87]Come, lay me down
[00:27.36]'Cause you know this
[00:29.37]'Cause you know this now
[00:31.63]In the middle of the night, in the middle of the night
[00:35.36]Just call my name, I'm yours to tame
[00:39.13]In the middle of the night, in the middle of the night
[00:43.12]I'm wide awake, I crave your taste
[00:46.87]All night long till morning comes
[00:50.13]I'm getting what is mine, you gon' get yours, oh
[00:54.12]In the middle of the night, in the middle of the night, oh
[01:10.12]These burning flames, these crashing waves
[01:13.86]Wash over me like a hurricane
[01:17.87]I captivate, you're hypnotized
[01:21.37]Feel powerful but it's me again
";



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