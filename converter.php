<html>
<head>
    <title>KONWERTER</title>
</head>

</html>


<?php

$lrc = '
[00:50.20]Conversion, software version 7.0
[00:56.00]Looking at life through the eyes of a tire hub
[01:01.50]Eating seeds as a pastime activity
[01:08.70]The toxicity of our city, of our city
[01:14.10]New, what do you own the world?
[01:16.20]How do you own disorder, disorder
[01:19.70]Now, somewhere between the sacred silence, sacred silence and sleep
[01:26.00]Somewhere between the sacred silence and sleep
[01:31.60]Disorder, disorder, disorder
[01:51.90]More wood for their fires, loud neighbours
[01:57.50]Flashlight reveries caught in the headlights of a truck
[02:03.40]Eating seeds as a pastime activity
[02:10.70]The toxicity of our city, of our city
[02:16.10]New, what do you own the world?
[02:18.30]How do you own disorder, disorder
[02:21.90]Now, somewhere between the sacred silence, sacred silence and sleep
[02:28.00]Somewhere between the sacred silence and sleep
[02:33.90]Disorder, disorder, disorder
[03:03.30]New, what do you own the world?
[03:05.50]How do you own disorder
[03:09.30]Now, somewhere between the sacred silence, sacred silence and sleep
[03:15.30]Somewhere between the sacred silence and sleep
[03:21.10]Disorder, disorder, disorder
[03:33.10]When I became the sun
[03:34.50]I shone life into the man\'s hearts
[03:35.90]When I became the sun
[03:37.30]I shone life into the man\'s hearts
';



$myjson = '';
$linia = '';

$poczatek = 0;


$index = 0;
// $myjson .= 'fragmenty:[';

$numerlini = 0;

$korekta = 0;
while ($numerlini <  100){

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












echo $myjson;

?>