<?php

$lrc = '
[00:00.61]From the top to the bottom
[00:02.35]Bottom to top I stop
[00:03.10]At the core I\'ve forgotten
[00:04.35]In the middle of my thoughts
[00:05.37]Taken far from my safety
[00:06.61]The picture\'s there
[00:07.61]The memory won\'t escape me
[00:08.84]But why should I care?
[00:10.09]From the top to the bottom
[00:10.88]Bottom to top I stop
[00:11.84]At the core I\'ve forgotten
[00:13.11]In the middle of my thoughts
[00:14.11]Taken far from my safety
[00:15.34]The picture\'s there
[00:16.37]The memory won\'t escape me
[00:17.39]But why should I care?
[00:18.86]There\'s a place so dark you can\'t see the end
[00:20.85](Skies cock back) and shock that which can\'t defend
[00:23.10]The rain then sends dripping acidic questions
[00:25.36]Forcefully, the power of suggestion
[00:27.09]Then with the eyes shut looking through the rust and rot, and dust
[00:29.59]A small spot of light floods the floor
[00:31.88]And pours over the rusted world of pretend
[00:34.12]And the eyes ease open and it\'s dark again
[00:36.36]From the top to the bottom
[00:37.61]Bottom to top I stop
[00:38.60]At the core I\'ve forgotten
[00:39.86]In the middle of my thoughts
[00:40.85]Taken far from my safety
[00:42.09]The picture\'s there
[00:43.09]The memory won\'t escape me
[00:44.36]But why should I care?
[00:45.62]In the memory you\'ll find me
[00:50.61]Eyes burning up
[00:54.61]The darkness holding me tightly
[00:59.13]Until the sun rises up
[01:07.36]Moving all around
[01:08.36]Screaming of the ups and downs
[01:09.61]Pollution manifested in perpetual sound
[01:11.87]The wheels go \'round and the sunset creeps
[01:14.10]Behind street lamps, chain-link, and concrete
[01:16.35]A little piece of paper with a picture drawn
[01:18.59]Floats on down the street \'til the wind is gone
[01:20.60]And the memory now is like the picture was then
[01:22.84]When the paper\'s crumpled up it can\'t be perfect again
[01:25.12]From the top to the bottom
[01:26.11]Bottom to top I stop
[01:27.36]At the core I\'ve forgotten
[01:28.61]In the middle of my thoughts
[01:29.61]Taken far from my safety
[01:30.60]The picture\'s there
[01:31.61]The memory won\'t escape me
[01:33.12]But why should I care?
[01:34.35]From the top to the bottom
[01:35.36]Bottom to top I stop
[01:36.09]At the core I\'ve forgotten
[01:37.13]In the middle of my thoughts
[01:38.37]Taken far from my safety
[01:39.76]The picture\'s there
[01:40.76]The memory won\'t escape me
[01:42.03]But why should I care?
[01:43.28]In the memory you\'ll find me
[01:48.28]Eyes burning up
[01:52.27]The darkness holding me tightly
[01:56.76]Until the sun rises up
[02:05.29]Now you got me caught in the act
[02:07.03]You bring the thought back
[02:07.77]Telling you that I see it right through you
[02:09.78]Now you got me caught in the act
[02:11.27]You bring the thought back
[02:12.26]Telling you that I see it right through you
[02:14.02]Now you got me caught in the act
[02:15.78]You bring the thought back
[02:16.51]Telling you that I see it right through you
';



$myjson = '';
$linia = '';

$poczatek = 0;

// $myjson .= 'fragmenty:[';

$numerlini = 0;
while ($numerlini <  90){

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