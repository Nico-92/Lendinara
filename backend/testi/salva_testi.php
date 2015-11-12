<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Connessione impossibile");
mysql_select_db(DB_NAME, $conn) or die("Database non presente");

/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
if ((isset($_GET['testo'])) && (isset($_GET['posizione'])) && (isset($_GET['azione'])) && (isset($_GET['id']))) {
    $azione = $_GET['azione'];
    $testo = $_GET['testo'];
    $posizione = $_GET['posizione'];
    $id = $_GET['id'];
    switch ($azione) {
        case 'salva':
            $posizione = mysql_real_escape_string($posizione);
            
            //Sostituisco gli a capo con <br />
            $testo = preg_replace("/\r\n|\r|\n/", '<br/>', $testo);
            
            //Sostituisco i tab con 4 spazi
            $testo = trim(preg_replace('/\s+/', '   ', $testo));
            $testo = mysql_real_escape_string($testo);
            
            //$dati = json_decode($dati);
            //$testo = $dati->{'testo'};
            //$posizione = $dati->{'posizione'};
            
            //INSERISCI IL TESTO
            $insert_query = "INSERT INTO testi (testo,posizione) VALUES ('$testo', '$posizione')";
            $result = mysql_query($insert_query, $conn) or die('Error, insert query failed ' . mysql_error());
            break;

        case 'modifica':
            $posizione = mysql_real_escape_string($posizione);
            
            //Sostituisco gli a capo con <br />
            $testo = preg_replace("/\r\n|\r|\n/", '<br/>', $testo);
            
            //Sostituisco i tab con 4 spazi
            $testo = trim(preg_replace('/\s+/', '   ', $testo));
            $testo = mysql_real_escape_string($testo);
            
            //INSERISCI IL TESTO
            $insert_query = "UPDATE testi SET testo = '$testo',posizione = '$posizione' WHERE id = '$id'";
            $result = mysql_query($insert_query, $conn) or die('Error, insert query failed ' . mysql_error());
            break;

        case 'elimina':
            $query = "DELETE FROM testi WHERE id = '$id'";
            $result = mysql_query($query, $conn) or die('Error, insert query failed ' . mysql_error());
            break;
    }
    
    if ($result) {
        echo "true";
    } 
    else {
        echo $result;
    }
} 
else {
    echo "Dati mancanti";
}
mysql_close();
?>