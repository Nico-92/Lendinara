<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Connessione impossibile");
mysql_select_db(DB_NAME, $conn) or die("Database non presente");

/* SE È PRESENTE UN PARAMETRO GET VOGLIO I DATI DELL'EVENTO PASSATO*/
if (isset($_GET['evento'])) {
    
    //RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO E NE ESTRAGGO IL VALORE, QUINDI LO INIETTO NELLA QUERY
    $evento = $_GET['evento'];
    $evento = json_decode($evento);
    $evento = $evento->{'nome'};
    $query = "SELECT *,date_format(dataevento,'%d/%m/%Y') FROM eventi WHERE nomeevento = '$evento'";
    $result = mysql_query($query, $conn) or die('Error, select query1 failed');
    $array = mysql_fetch_array($result);
    $ris = '{ "nome": "' . $array['nomeevento'] . '", "data": "' . $array['dataevento'] . '", "luogo": "' . $array['luogoevento'] . '", "costo": "' . $array['costoevento'] . '", "altro": "' . $array['altro'] . '"}';
}

/* ALTRIMENTI VOGLIO IL NOME DI TUTTI GLI EVENTI */
else {
    $query = "SELECT * FROM eventi";
    $result = mysql_query($query, $conn) or die('Error, select query1 failed');
    $i = 0;
    $ris = '[';
    while ($array = mysql_fetch_array($result)) {
        if ($i == mysql_num_rows($result) - 1) $ris = $ris . '{ "nome": "' . $array['nomeevento'] . '"}';
        else $ris = $ris . '{ "nome": "' . $array['nomeevento'] . '"},';
        $i++;
    }
    $ris = $ris . ']';
}

echo $ris;
mysql_close();
?>