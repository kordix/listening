<html>
<head>
    <title>KONWERTER</title>
</head>

</html>


<?php

$lrc = "
[00:17.80]Circumventing circuses,
[00:18.98]Lamenting in protest,
[00:20.47]To visible police,
[00:21.96]Presence sponsored fear,
[00:23.46]Battalions of riot police,
[00:24.76]With rubber bullet kisses,
[00:26.32]Baton courtesy,
[00:27.75]Service with a smile
[00:29.24][01:10.50]Beyond the Staples Center you can see America,
[00:32.23][01:13.56]With its tired, poor, avenging disgrace,
[00:35.15][01:16.42]Peaceful, loving youth against the brutality,
[00:39.20][01:20.73]Of plastic existence.
[00:41.12]Pushing little children,
[00:42.86]With their fully automatics,
[00:58.79]A rush of words,
[01:00.09]Pleading to disperse,
[01:01.98]Upon your naked walls, alive,
[01:04.96]A political call,
[01:06.27]The fall guy accord,
[01:07.82]We can\'t afford to be neutral on a moving train,
[01:45.44]Push them around,
[01:52.42]A deer dance, invitation to peace,
[01:56.06]War staring you in the face, dressed in black.
[02:05.00]With a helmet, fierce,
[02:08.07]Trained and appropriate for the malcontents,
[02:13.11]For the disproportioned malcontents,
[02:17.17]The little boy smiled, it\'ll all be well,
[02:20.10]The little boy smiled it\'ll all be well,
[02:43.34][02:46.27][02:49.26]Push the weak around
";



$myjson = '';
$linia = '';

$poczatek = 0;


$index = 0;
// $myjson .= 'fragmenty:[';

$numerlini = 0;

$korekta = 0;
while ($numerlini <  100){

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