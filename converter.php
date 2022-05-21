<?php

$lrc = '
[00:04.35]When the days are cold
[00:05.48]And the cards all fold
[00:07.85]And the saints we see
[00:10.23]Are all made of gold
[00:13.48]When your dreams all fail
[00:16.23]And the ones we hail
[00:18.49]Are the worst of all
[00:20.98]And the blood\'s run stale
[00:25.06]I wanna hide the truth
[00:27.59]I wanna shelter you
[00:30.31]But with the beast inside
[00:32.80]There\'s nowhere we can hide
[00:35.80]No matter what we breed
[00:38.29]We still are made of greed
[00:41.05]This is my kingdom come
[00:43.58]This is my kingdom come
[00:46.55]When you feel my heat
[00:49.06]Look into my eyes
[00:51.80]It\'s where my demons hide
[00:54.33]It\'s where my demons hide
[00:57.31]Don\'t get too close
[01:00.05]It\'s dark inside
[01:02.56]It\'s where my demons hide
[01:05.07]It\'s where my demons hide
[01:06.93]At the curtain\'s call
[01:09.19]It\'s the last of all
[01:11.94]When the lights fade out
[01:14.43]All the sinners crawl
[01:17.18]So they dug your grave
[01:19.93]And the masquerade
[01:22.44]Will come calling out
[01:25.18]At the mess you made
[01:29.27]Don\'t wanna let you down
[01:31.52]But I am hell bound
[01:34.51]Though this is all for you
[01:37.04]Don\'t wanna hide the truth
[01:39.77]No matter what we breed
[01:42.27]We still are made of greed
[01:45.03]This is my kingdom come
[01:47.77]This is my kingdom come
[01:50.52]When you feel my heat
[01:53.02]Look into my eyes
[01:55.78]It\'s where my demons hide
[01:58.28]It\'s where my demons hide
[02:01.29]Don\'t get too close
[02:03.79]It\'s dark inside
[02:06.28]It\'s where my demons hide
[02:09.02]It\'s where my demons hide
[02:12.02]They say it\'s what you make
[02:14.52]I say it\'s up to fate
[02:17.27]It\'s woven in my soul
[02:19.77]I need to let you go
[02:22.54]Your eyes, they shine so bright
[02:25.02]I wanna save that light
[02:27.77]I can\'t escape this now
[02:30.53]Unless you show me how
[02:33.52]When you feel my heat
[02:35.77]Look into my eyes
[02:38.27]It\'s where my demons hide
[02:41.02]It\'s where my demons hide
[02:44.03]Don\'t get too close
[02:46.78]It\'s dark inside
[02:49.04]It\'s where my demons hide
[02:51.78]It\'s where my demons hide
';



$myjson = '';
$linia = '';

$poczatek = 0;

// $myjson .= 'fragmenty:[';

$numerlini = 0;
while ($numerlini <  60){

    $linia = substr($lrc, $poczatek, strpos($lrc, "\r\n", $poczatek + 1) - $poczatek);

    $myjson .= '{start:';

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

}












echo $myjson;

?>