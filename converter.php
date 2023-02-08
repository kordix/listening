<html>
<head>
    <title>KONWERTER</title>
</head>

</html>


<?php

$lrc = '
[00:11.52]I wish I found some better sounds no one\'s ever heard
[00:14.36]I wish I had a better voice that sang some better words
[00:17.26]I wish I found some chords in an order that is new
[00:20.01]I wish I didn\'t have to rhyme every time I sang
[00:23.00]I was told when I get older all my fears would shrink
[00:25.50]But now I\'m insecure and I care what people think
[00:27.73]My name\'s \'Blurryface\' and I care what you think
[00:40.57]Wish we could turn back time, to the good old days
[00:46.35]When our momma sang us to sleep but now we\'re stressed out (oh)
[00:51.88]Wish we could turn back time (oh), to the good old days (oh)
[00:57.61]When our momma sang us to sleep but now we\'re stressed out
[01:06.68]We\'re stressed out
[01:13.70]Sometimes a certain smell will take me back to when I was young
[01:16.52]How come I\'m never able to identify where it\'s coming from
[01:19.26]I\'d make a candle out of it if I ever found it
[01:21.51]Try to sell it, never sell out of it, I\'d probably only sell one
[01:24.97]It\'d be to my brother, \'cause we have the same nose
[01:27.37]Same clothes homegrown a stone\'s throw from a creek we used to roam
[01:30.71]But it would remind us of when nothing really mattered
[01:32.98]Out of student loans and tree-house homes we all would take the latter
[02:11.36]We used to play pretend, give each other different names
[02:13.92]We would build a rocket ship and then we\'d fly it far away
[02:16.57]Used to dream of outer space but now they\'re laughing at our face
[02:19.48]Saying, "Wake up, you need to make money."
[02:21.93]Yeah
[02:28.03]Used to dream of outer space but now they\'re laughing at our face
[02:30.68]Saying, "Wake up, you need to make money."
[02:33.23]Yeah
[02:56.52]Used to play pretend, used to play pretend, bunny
[02:59.24]We used to play pretend, wake up, you need the money
[03:13.26]Used to dream of outer space but now they\'re laughing at our face
[03:15.96]Saying, "Wake up, you need to make money."
[03:18.45]Yeah
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