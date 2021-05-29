<?php 

define('DB_USER','u572963220_Racha' );
define('DB_PASSWORD','Racha0715908866');
define('DB_HOST','localhost');
define('DB_NAME', 'u572963220_Racha');

$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)or die('Could not connect to mysql'.mysqli_connect_error());
mysqli_set_charset($dbc,'utf8');
?>