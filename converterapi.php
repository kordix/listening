<html>
<head>
    <title>KONWERTER</title>
</head>

</html>

<pre id="tekst">

<?php

$dane = json_decode(file_get_contents('php://input'));

// echo $dane;

// echo htmlspecialchars($_POST['siemano']);

$lrc = $_POST['siemano'];
$myjson = '';
$linia = '';

$poczatek = 0;


$index = 0;
// $myjson .= 'fragmenty:[';

$numerlini = 0;

$korekta = 0;
$ilelini = substr_count( $lrc, "\r\n");
while ($numerlini <  substr_count( $lrc, "\r\n" )-1){

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

    if($numerlini == ($ilelini-2)){
        $duration = 5;
    }

    $myjson .= floatval($duration);

    $myjson .= '},';

    

$numerlini = $numerlini + 1;

$index = $index + 1;

}


//echo '<pre>'.$myjson.'</pre>';

echo $myjson;



?>

</pre>

<script>
    let mojtekst = document.querySelector('#tekst').innerHTML;

    mojtekst = mojtekst.replace(/(\r\n|\n|\r)/gm, "");
    mojtekst = mojtekst.replace(/(\r\n|\n|\r)/gm, "\r\n");
    mojtekst = mojtekst.replace(/\}\,\{/gm, "},\r\n{");
    mojtekst = mojtekst.slice(0,mojtekst.length - 1);
    


    document.querySelector('#tekst').innerHTML = mojtekst;

  


</script>