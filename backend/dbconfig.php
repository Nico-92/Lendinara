<?php
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');

$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die("Connessione impossibile");
mysql_select_db($_COOKIE["DB_NAME"], $conn) or die("Database non presente");
?>