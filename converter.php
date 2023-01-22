<html>
<head>
    <title>KONWERTER</title>
</head>

</html>


<?php

$lrc = "
[00:39.11]Shake it up is all that we know
[00:43.49]Using the bodies up as we go
[00:47.75]I'm waking up to fantasy
[00:51.78]The shades all around aren't the colors we used to see
[00:56.06]Broken ice still melts in the sun
[01:00.09]And times that are broken can often be one again
[01:04.60]We're soul alone
[01:06.19]And soul really matters to me
[01:10.02]Take a look around
[01:11.95]You're out of touch
[01:13.81]I'm out of time
[01:16.41]But I'm out of my head when you're not around
[01:20.44]You're out of touch
[01:22.20]I'm out of time (time)
[01:24.22]But I'm out of my head when you're not around
[01:28.53]Oh oh oh oh oh oh
[01:34.32]Reaching out for something to hold
[01:38.84]Looking for a love where the climate is cold
[01:42.87]Manic moves and drowsy dreams
[01:47.13]Or living in the middle between the two extremes
[01:51.66]Smoking guns hot to the touch
[01:55.43]Would cool down if we didn't use them so much, yeah
[01:59.71]We're soul alone
[02:01.77]And soul really matters to me
[02:05.29]Too much
[02:07.36]You're out of touch
[02:08.88]I'm out of time
[02:11.69]But I'm out of my head when you're not around
[02:15.70]You're out of touch
[02:17.46]I'm out of time
[02:19.98]But I'm out of my head when you're not around
[02:23.78]Oh oh oh oh oh oh
[02:31.86]Oh oh oh oh oh oh
[02:53.34]You're out of touch
[02:55.75]I'm out of time
[02:57.62]But I'm out of my head when you're not around
[03:01.68]You're out of touch
[03:03.47]I'm out of time
[03:05.72]But I'm out of my head when you're not around
[03:10.08]You're out of touch
[03:12.39]Time
[03:12.99]But I'm out of my head when you're not around
[03:18.75]You're out of touch
[03:20.76]I'm out of time
[03:25.65]Not around
[03:26.75]You're out of touch
[03:29.03]I'm out of time
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