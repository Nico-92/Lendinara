<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    /*  RECUPERO IL NOMINATIVO CORRISPONDENTE ALL'ID*/
    $query = "SELECT nominativo FROM iscritti where id='$id'";
    $result = mysql_query($query, $conn) or die('Error, retrive name from id query failed' . mysql_error());
    $array = mysql_fetch_array($result);
    $nome = $array['nominativo'];
    
    $query3 = "delete from r1 where nominativo='$nome'";
    mysql_query($query3, $conn) or die('Error, delete from r1 failed' . mysql_error());
    
    $query3 = "delete from iscritti where id='$id'";
    mysql_query($query3, $conn) or die('Error, delete from iscritti failed' . mysql_error());
    $query3 = "delete from lendinara where id='$id'";
    mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());
    $query3 = "delete from motorclub where id='$id'";
    mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());
    $query3 = "delete from esterni where id='$id'";
    mysql_query($query3, $conn) or die('Error, insert query failed' . mysql_error());
    
    if ($result) {
        echo "true";
    } 
    else {
        echo "Errore durante l'eliminazione";
    }
}
mysql_close();
?>