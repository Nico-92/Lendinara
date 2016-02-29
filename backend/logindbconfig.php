<?php
session_start();
define('DB_HOST','localhost');
define('DB_NAME','utenti');
define('DB_USER','root');
define('DB_PASSWORD','');

$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Connessione impossibile");
mysql_select_db(DB_NAME, $conn) or die("Database non presente");
?>