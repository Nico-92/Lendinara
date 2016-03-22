<?php
/* RECUPERO IL PARAMETRO IN FORMATO JSON, LO DECODIFICO */
if (isset($_GET['blocchi']) && isset($_GET['file'])) {
    $file = $_GET['file'];
    $blocchi = $_GET['blocchi'];
    $myfile = fopen($_SERVER['DOCUMENT_ROOT'].'/Lendinara/utils/'. $file . '.json',"w");
    fwrite($myfile, $blocchi);
    fclose($myfile);
} 
else {
    echo "Dati mancanti";
}
?>