<?php

$lrc = '
[00:09.86]Forfeit the game
[00:11.37]Before somebody else
[00:12.61]Takes you outta the frame
[00:13.60]And puts your name to shame
[00:15.11]Cover up your face
[00:16.11]You can\'t run the race
[00:17.37]The pace is too fast
[00:18.60]You just won\'t last
[00:29.63]You love the way I look at you
[00:33.61]While taking pleasure in the awful things you put me through
[00:37.61]You take away if I give in
[00:43.88]My life
[00:45.88]My pride is broken
[00:50.10]You like to think you\'re never wrong
[00:52.12](You live what you\'ve learned)
[00:54.36]You have to act like you\'re someone
[00:57.86](You live what you\'ve learned)
[00:59.86]You want someone to hurt like you
[01:02.63](You live what you\'ve learned)
[01:04.88]You want to share what you\'ve been through
[01:08.60](You live what you\'ve learned)
[01:15.85]You love the things I say I\'ll do
[01:18.11]The way I hurt myself again just to get back at you
[01:24.10]You take away when I give in
[01:26.87]My life
[01:31.13]My pride is broken
[01:33.86]You like to think you\'re never wrong
[01:38.11](You live what you\'ve learned)
[01:39.63]You have to act like you\'re someone
[01:42.60](You live what you\'ve learned)
[01:46.36]You want someone to hurt like you
[01:48.37](You live what you\'ve learned)
[01:50.36]You want to share what you\'ve been through
[01:53.61](You live what you\'ve learned)
[01:56.11]Forfeit the game
[01:56.87]Before somebody else
[01:57.86]Takes you outta the frame
[01:59.11]And puts your name to shame
[02:00.89]Cover up your face
[02:01.86]You can\'t run the race
[02:03.13]The pace is too fast
[02:04.36]You just won\'t last
[02:06.61]Forfeit the game
[02:07.36]Before somebody else
[02:08.36]Takes you outta the frame
[02:09.61]And puts your name to shame
[02:11.61]Cover up your face
[02:12.38]You can\'t run the race
[02:13.92]The pace is too fast
[02:14.63]You just won\'t last
[02:16.86]You like to think you\'re never wrong
[02:19.36](You live what you\'ve learned)
[02:20.89]You have to act like you\'re someone
[02:24.11](You live what you\'ve learned)
[02:25.61]You want someone to hurt like you
[02:28.37](You live what you\'ve learned)
[02:30.86]You want to share what you\'ve been through
[02:35.61](You live what you\'ve learned
[02:36.61]You like to think you\'re never wrong
[02:38.61](Forfeit the game)
[02:39.60]You live what you\'ve learned
[02:41.61]You have to act like you\'re someone
[02:43.37](Forfeit the game)
[02:44.61]You live what you\'ve learned
[02:46.38]You want someone to hurt like you
[02:48.36](Forfeit the game)
[02:49.62]You live what you\'ve learned
[02:51.61]You want to share what you\'ve been through
[02:54.61]You live what you\'ve learned
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