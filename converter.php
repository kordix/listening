<html>
<head>
    <title>KONWERTER</title>
</head>

</html>


<?php

$lrc = "
[00:21.88]They built you a cage of diamonds and gold
[00:30.56]Most beautiful place for you to grow old
[00:39.25]They brought you the moon and showed you the light
[00:47.94]And all that you wanted was freedom to fight
[00:56.01]
[00:57.57]It's heavy
[01:01.57]But you are not the only one
[01:05.64]Who's tired of giving
[01:09.94]Afraid of the oblivion
[01:15.57]Could it be that your curse is a bliss
[01:19.75]But the crown on your head never felt this heavy
[01:25.57]
[01:28.64]Harness your ache
[01:32.07]Take a leap of faith
[01:36.57]To claim back your soul
[01:40.95]Before it's too late
[01:45.69]Show them no fear
[01:49.19]Sing them goodbye
[01:54.56]Leave all that you have
[01:58.57]And you're free to fly
[02:03.50]It's heavy
[02:06.94]But you are not the only one
[02:11.81]Who's tired of giving
[02:16.12]Afraid of the oblivion
[02:21.01]Could it be that your curse is a bliss
[02:25.20]But the weight of the world never felt this heavy
[02:31.88]
[02:33.56]Take the evident
[02:36.56]Leap of faith
[02:40.88]Don't you be afraid
[02:46.51]
[02:47.95]It's heavy
[02:51.19]But you are not the only one
[02:55.75]Who's tired of giving
[02:59.81]Afraid of the oblivion
[03:05.06]Could it be that your curse is a bliss
[03:09.57]But the cross that you bare never felt this heavy
[03:16.62]
[03:17.56]Oh you are not the only one
[03:22.56]Tired of living
[03:26.00]Afraid of the oblivion
[03:31.50]'Cos the crown on your head
[03:33.87]The smile that you wear
[03:36.11]The cross that you bare
[03:38.55]Never felt this heavy
[03:43.18]
[03:44.50]You are not the only one
[03:47.62]
[03:54.50]The crown on your head never felt this heavy
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