<?php

/*CONNESSIONE AL DATABASE */
require '../' . 'dbconfig.php';

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
    $nominativo = explode(" ", preg_replace('!\s+!', ' ', trim($array['nominativo'])));
    if(count($nominativo) == 2){
        $ris = $ris . '{ "fields" :{ "Cognome": "' . $nominativo[0] . '",';
        $ris = $ris . '"Nome": "' . $nominativo[1] . '",';
    }else{
        if(count($nominativo) == 3){
            $ris = $ris . '{ "fields" :{ "Cognome": "' . $nominativo[0] . " " . $nominativo[1] . '",';
            $ris = $ris . '"Nome": "' . $nominativo[2] . '",';
        }else{
            $ris = $ris . '{ "fields" :{"Nome": "' . trim($array['nominativo']) . '",';
        }
    }    
   /* $ris = $ris . '"datanascita": "' . trim($datanascita) . '",';
    $ris = $ris . '"luogonascita": "' . trim($array['luogonascita']) . '",';
    $ris = $ris . '"via": "' . trim($array['via']) . '",';
    $ris = $ris . '"cap": "' . trim($array['cap']) . '",';
    $ris = $ris . '"citta": "' . trim($array['citta']) . '",';
    $ris = $ris . '"email": "' . trim($array['email']) . '",';
    $ris = $ris . '"telefono": "' . trim($array['telefono']) . '",';*/
    $ris = $ris . '"Codice fiscale": "' . trim($array['codicefiscale']) . '",';
    $ris = $ris . '"Tipo assicurazione": "' . 'Base' . '",';
    
    //$ris = $ris . '"varie": "'.trim ($array['sangue'] ).'",';
    if ($array_lendinara['tesserael'] != '') {
        $ris = $ris . '"Numero Tessera": "' . $array_lendinara['tesserael'] . '",';
        $ris = $ris . '"Data emissione": "' . $data_el . '",';
        if($data_el){
            $datascadenza = explode('-', $data_el);
            $datascadenza[2] = intval($datascadenza[2]);
            $datascadenza[2]++;
            $datascadenza = join('-', $datascadenza);
            $ris = $ris . '"Data scadenza": "' . $datascadenza . '",';
        }else{
            $ris = $ris . '"Data scadenza": "' . $data_el . '",';
        }
    } 
    else {
        $ris = $ris . '"Numero Tessera": "' . $array_lendinara['tesseracsen'] . '",';
        $ris = $ris . '"Data emissione": "' . $data_csen . '",';
        if($data_csen){
            $datascadenza = explode('-', $data_csen);
            $datascadenza[2] = intval($datascadenza[2]);
            $datascadenza[2]++;
            $datascadenza = join('-', $datascadenza);
            $ris = $ris . '"Data scadenza": "' . $datascadenza . '",';
        }else{
            $ris = $ris . '"Data scadenza": "' . $data_csen . '",';
        }
        
    }
    
    /*$ris = $ris . '"tessera_fmi": "'.$array_motorclub['tessera'].'",';
    $ris = $ris . '"data_fmi": "'.$array_motorclub['datatessera'].'",';
    $ris = $ris . '"tessera_sport": "'.$array_motorclub['tesserasport'].'",';
    $ris = $ris . '"data_sport": "'.$array_motorclub['datasport'].'",';
    $ris = $ris . '"licenza": "'.$array_motorclub['licenza'].'",';
    $ris = $ris . '"data_licenza": "'.$array_motorclub['datalicenza'].'",';*/
    $ris = $ris . '"id": "' . $id . '"';
    if ($i == mysql_num_rows($result) - 1) {
        $ris = $ris . '}}';
    } 
    else {
        $ris = $ris . '}},';
        $i++;
    }
}
$ris = $ris . ']}';
echo $ris;

mysql_close();
?>