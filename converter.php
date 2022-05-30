<html>
<head>
    <title>KONWERTER</title>
</head>

</html>


<?php

$lrc = '
[00:25.90]All these punk motherfuckers don\'t know
[00:28.66]They running their mouth like I won\'t kick in their door
[00:32.05]All these punk motherfuckers hitting my phone
[00:35.30]You think we boys, I never seen you at one of my shows
[00:38.80]All these punk motherfuckers don\'t know
[00:42.04]They running their mouth like I won\'t kick in their door
[00:45.55]All these punk motherfuckers hitting my phone
[00:48.81]You think we boys, I never seen you at one of my shows
[00:52.30]See, I been fucking up my life no joke
[00:55.29]Tatted my face, quit my job, went broke
[00:58.54]But I been loving every day a little more
[01:02.05]When you hear that wooden block, you know it\'s only ghoste
[01:05.69]Made in the image of what they call Satan
[01:07.33]The blade is serrated and decapitating
[01:08.83]The brain of sedated and awaiting heads
[01:10.84]Never to let them think freely again
[01:12.34]Put em in an underwater grave
[01:13.59]Better pay your attention to what I am about to say
[01:15.33]Fuck what your friends say
[01:17.83]Fuck what the man say
[01:19.34]I been licking venom off my gums
[01:21.84]Getting faded off the blood of my girl
[01:25.33]I cut her on the face, she told me "more"
[01:28.24]She got blood on my grandma floor
[01:31.83]Bitch, I\'m draped in Ghost Supply head to toe
[01:35.08]Y\'all were sleeping, I don\'t want your damn clothes
[01:38.48]My chick gon\' to seduce your damn girl
[01:41.62]We tag-teaming like we wrestling for the belt
[01:44.26](Lay down your soul)
[01:46.91]All these punk motherfuckers don\'t know
[01:49.90]They running their mouth like I won\'t kick in their door
[01:53.15]All these punk motherfuckers hitting my phone
[01:56.65]You think we boys, I never seen you at one of my shows
[01:59.80]All these punk motherfuckers don\'t know
[02:03.06]They running their mouth like I won\'t kick in their door
[02:06.56]All these punk motherfuckers hitting my phone
[02:09.81]You think we boys, I never seen you at one of my shows
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