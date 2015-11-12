<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Connessione impossibile");
mysql_select_db(DB_NAME, $conn) or die("Database non presente");

$query = "SELECT * FROM iscritti";
$result = mysql_query($query, $conn) or die('Error, select query1 failed'
 /* . mysql_error()*/
);

// $query_tessere_lendinara = "SELECT * FROM lendinara";
// $result_tessere_lendinara = mysql_query($query_tessere_lendinara, $conn) or die('Error, select query_tessere_lendinara failed'/* . mysql_error()*/);

//$array_lendinara=mysql_fetch_array($result_tessere_lendinara);
$i = 0;
$ris = '{ "risultato": [';
while ($array = mysql_fetch_array($result)) {
    $id = $array['id'];
    
    $query_tessere_lendinara = "SELECT * FROM lendinara where id = '$id'";
    $result_tessere_lendinara = mysql_query($query_tessere_lendinara, $conn) or die('Error, select query_tessere_motorclub failed' . mysql_error());
    $array_lendinara = mysql_fetch_array($result_tessere_lendinara);
    
    $datanascita = date('d-m-Y', strtotime($array['datanascita']));
    if ($array_lendinara['datael'] == '0000-00-00' || !$array_lendinara['datael']) {
        $data_el = '';
    } 
    else {
        $data_el = date('d-m-Y', strtotime($array_lendinara['datael']));
    }
    if ($array_lendinara['datacsen'] == '0000-00-00' || !$array_lendinara['datacsen']) {
        $data_csen = '';
    } 
    else {
        $data_csen = date('d-m-Y', strtotime($array_lendinara['datacsen']));
    }
    
    $ris = $ris . '{ "nome": "' . trim($array['nominativo']) . '",';
    $ris = $ris . '"datanascita": "' . trim($datanascita) . '",';
    $ris = $ris . '"luogonascita": "' . trim($array['luogonascita']) . '",';
    $ris = $ris . '"via": "' . trim($array['via']) . '",';
    $ris = $ris . '"cap": "' . trim($array['cap']) . '",';
    $ris = $ris . '"citta": "' . trim($array['citta']) . '",';
    $ris = $ris . '"email": "' . trim($array['email']) . '",';
    $ris = $ris . '"telefono": "' . trim($array['telefono']) . '",';
    
    //$ris = $ris . '"varie": "'.trim ($array['sangue'] ).'",';
    if ($array_lendinara['tesserael'] != '') {
        $ris = $ris . '"tessera": "' . $array_lendinara['tesserael'] . '",';
        $ris = $ris . '"data": "' . $data_el . '",';
    } 
    else {
        $ris = $ris . '"tessera": "' . $array_lendinara['tesseracsen'] . '",';
        $ris = $ris . '"data": "' . $data_csen . '",';
    }
    
    /*$ris = $ris . '"tessera_fmi": "'.$array_motorclub['tessera'].'",';
    $ris = $ris . '"data_fmi": "'.$array_motorclub['datatessera'].'",';
    $ris = $ris . '"tessera_sport": "'.$array_motorclub['tesserasport'].'",';
    $ris = $ris . '"data_sport": "'.$array_motorclub['datasport'].'",';
    $ris = $ris . '"licenza": "'.$array_motorclub['licenza'].'",';
    $ris = $ris . '"data_licenza": "'.$array_motorclub['datalicenza'].'",';*/
    $ris = $ris . '"id": "' . $id . '"';
    if ($i == mysql_num_rows($result) - 1) {
        $ris = $ris . '}';
    } 
    else {
        $ris = $ris . '},';
        $i++;
    }
}
$ris = $ris . ']}';
echo $ris;

mysql_close();
?>