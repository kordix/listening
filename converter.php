<html>
<head>
    <title>KONWERTER</title>
</head>

</html>


<?php

$lrc = '
[00:28.81]I woke up in a
[00:31.02]dream today
[00:32.02]To the cold of the
[00:32.80]static and put my
[00:33.78]cold feet on the floor
[00:34.78]Forgot all about yesterday
[00:35.77]Remembering I\'m pretending
[00:37.03]to be where I\'m not anymore
[00:38.28]A little taste of hypocrisy
[00:39.54]And I\'m left in
[00:41.04]the wake of the mistake,
[00:42.54]slow to react
[00:44.04]And even though you\'re
[00:45.53]so close to me
[00:46.52]You\'re still so distant
[00:47.28]and I can\'t bring you back
[00:48.52]It\'s true the way I feel
[00:51.52]Was promised by your face
[00:55.52]The sound of your voice
[00:59.30]Painted on my memories
[01:01.79]Even if you\'re
[01:05.26]not with me
[01:07.54](I\'m with you)
[01:09.05]You Now I see
[01:10.53]keeping everything inside
[01:12.51](with you)
[01:14.28]You Now I see
[01:15.28]even when I close my eyes
[01:18.04]I hit you and
[01:19.52]you hit me back
[01:20.55]We fall to the floor,
[01:21.52]the rest of the day
[01:22.55]stands still
[01:23.52]Fine line between
[01:24.55]this and that
[01:25.27]When things go wrong
[01:26.31]I pretend that the
[01:27.03]past isn\'t real
[01:28.03]Now I\'m trapped in
[01:29.00]this memory
[01:30.28]And I\'m left in
[01:31.01]the wake of the mistake,
[01:31.78] slow to react
[01:33.04]So even though
[01:34.04]you\'re close to me
[01:35.03]You\'re still so distant
[01:36.03]and I can\'t bring you back
[01:37.06]It\'s true the way I feel
[01:39.02]Was promised by your face
[01:43.53]The sound of your voice
[01:48.01]Painted on my memories
[01:51.79]Even if you\'re
[01:53.77]not with me
[01:56.02](I\'m with you)
[01:58.61]You Now I see
[01:59.55]keeping everything inside
[02:01.02](with you)
[02:03.30]You Now I see even
[02:04.53]when I close my eyes
[02:06.27](with you)
[02:07.77]You Now I see
[02:09.50]keeping everything inside
[02:11.28](with you)
[02:12.76]You Now I see even
[02:14.53]when I close my eyes
[02:16.56]No, no matter how
[02:32.26]far we\'ve come
[02:34.02]I can\'t wait to see
[02:36.53]tomorrow
[02:38.79]No matter how
[02:40.02]far we\'ve come
[02:43.06]I, I can\'t wait to
[02:46.30]see tomorrow
[02:47.79](with you)
[02:49.53]You Now I see
[02:51.04]keeping everything inside
[02:53.26](with you)
[02:54.52]You Now I see even
[02:56.02]when I close my eyes
[02:57.78](with you)
[02:59.51]You Now I see
[03:02.02]keeping everything inside
[03:03.28](with you)
[03:04.29]You Now I see even
[03:06.03]when I close my eyes
';



$myjson = '';
$linia = '';

$poczatek = 0;


$index = 0;
// $myjson .= 'fragmenty:[';

$numerlini = 0;
while ($numerlini <  68){

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