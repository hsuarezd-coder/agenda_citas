<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'hpaxn521';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);

if (!$conn) {
    die('Error al conectar a la base de datos: ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db('inb', $conn);
?>
