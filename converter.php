<?php

$lrc = '
[00:38.43]When we were young the future was so bright
[00:41.45]The old neighborhood was so alive
[00:43.42]And every kid on the whole damn street
[00:45.88]Was gonna make it big and not be beat
[00:48.29]Now the neighborhood\'s cracked and torn
[00:50.62]The kids are grown up but their lives are worn
[00:53.12]How can one little street
[00:55.45]Swallow so many lives
[00:57.51]Chances thrown
[00:59.76]Nothing\'s free
[01:02.26]Longing for what used to be
[01:07.18]Still it\'s hard
[01:09.30]Hard to see
[01:12.04]Fragile lives, shattered dreams
[01:35.83]Jamie had a chance, well she really did
[01:38.73]Instead she dropped out and had a couple of kids
[01:41.23]Mark still lives at home cause he\'s got no job
[01:43.61]He just plays guitar and smokes a lot of pot
[01:46.17]Jay committed suicide
[01:48.77]Brandon OD\'d and died
[01:51.12]What the hell is going on
[01:53.19]The cruelest dream, reality
[01:55.42]Chances thrown
[01:57.57]Nothing\'s free
[01:59.95]Longing for what used to be
[02:04.68]Still it\'s hard
[02:07.21]Hard to see
[02:09.46]Fragile lives, shattered dreams
[02:33.44]Chances thrown
[02:35.95]Nothing\'s free
[02:38.59]Longing for what used to be
[02:43.24]Still it\'s hard
[02:45.65]Hard to see
[02:47.98]Fragile lives, shattered dreams
';



$myjson = '';
$linia = '';

$poczatek = 0;

// $myjson .= 'fragmenty:[';

$numerlini = 0;
while ($numerlini < 60) {

    $linia = substr($lrc, $poczatek, strpos($lrc, "\r\n", $poczatek + 1) - $poczatek);

    $myjson .= '{start:';

    $minuty = substr($linia,4,1);
    $czas = str_replace('[03:', '',str_replace('[02:', '',str_replace('[01:', '',str_replace('[00:', '', str_replace('[00:0', '', substr($linia, 0, 11))))));
    
    if (intval($minuty) > 0) {
        $czas = floatval(floatval($minuty) * 60 + floatval($czas));
    }

    

    $myjson .= $czas - 4;

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

    @$duration = floatval($newczas) - floatval($czas);

    $myjson .= floatval($duration);

    $myjson .= '},';

    

$numerlini = $numerlini + 1;

}












echo $myjson;

?>