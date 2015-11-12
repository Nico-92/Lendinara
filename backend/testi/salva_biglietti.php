<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Connessione impossibile");
mysql_select_db(DB_NAME, $conn) or die("Database non presente");

/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
if ((isset($_GET['bigliettodx'])) && (isset($_GET['bigliettosx']))) {
    $bigliettodx = mysql_escape_string($_GET['bigliettodx']);
    $bigliettosx = mysql_escape_string($_GET['bigliettosx']);
    
    //INSERISCI IL TESTO
    $insert_query = "UPDATE varie SET altro1 = '$bigliettosx', altro2 = '$bigliettodx'";
    $result = mysql_query($insert_query, $conn) or die('Error, update query failed ' . mysql_error());
    
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