<?php
if (isset($_GET['tipo'])) {
	$tipo = $_GET['tipo'];
 	$myfile = fopen($_SERVER['DOCUMENT_ROOT'].'/Lendinara/utils/'. $tipo . '.json',"r");
    $blocchi = fread($myfile, filesize($_SERVER['DOCUMENT_ROOT'].'/Lendinara/utils/'. $tipo . '.json'));
    fclose($myfile);
    echo $blocchi;
}else{
	echo "dati mancanti";
}
?>