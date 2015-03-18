<?php 
require dirname(__FILE__) . '/' . 'dbconfig.php';
$conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD) or die ("connessione impossibile"/* . mysql_error()*/);
mysql_select_db(DB_NAME, $conn) or die ("no database"/* . mysql_error()*/);

$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
echo $uri[4];
echo $_SERVER['REQUEST_METHOD'];