<html>
<head>
    <title>KONWERTER</title>
</head>

</html>


<?php

$lrc = "
[00:14.36]We passed upon the stairs
[00:18.87]We spoke of was and when
[00:22.78]Although I wasn't there
[00:27.27]He said I was his friend
[00:31.16]Which came as a surprise
[00:35.39]I spoke into his eyes
[00:38.76]I thought you died alone
[00:42.76]A long long time ago
[00:47.14].
[00:49.26]Oh no, not me
[00:53.25]We never lost control
[00:57.38]You're face to face
[01:01.65]With the man who sold the world
[01:05.17](Guitar riff)
[01:18.29]I laughed and shook his hand
[01:23.18]And made my way back home
[01:26.80]I searched for foreign land
[01:31.59]For years and years I roamed
[01:35.59]I gazed a gazely stare
[01:39.71]We walked a million hills
[01:43.08]I must have died alone
[01:47.32]A long, long time ago
[01:50.96].
[01:53.57]Who knows? Not me
[01:57.59]I never lost control
[02:01.82]You're face to face
[02:05.82]With the man who sold the world
[02:09.53](Guitar riff)
[02:16.20]Who knows? Not me
[02:20.31]We never lost control
[02:24.45]You're face to face
[02:28.45]With the man who sold the world
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