<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

/* SE È PRESENTE UN PARAMETRO GET VOGLIO I DATI DELL'EVENTO PASSATO*/
if ((isset($_GET['numero'])) && (isset($_GET['evento']))) {
    
    /* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO E NE ESTRAGGO IL VALORE, QUINDI LO INIETTO NELLA QUERY*/
    $numero = $_GET['numero'];
    $evento = $_GET['evento'];
    $controllo = "select numero from r1 where numero='$numero' and nomeevento='$evento'";
    $result_controllo = mysql_query($controllo, $conn) or die('Error, check query failed ' . mysql_error());
    if (mysql_num_rows($result_controllo) == 0) {
        echo true;
    } 
    else {
        echo false;
    }
}

mysql_close();
?>