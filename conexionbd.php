<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ggm"; 

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_error()){
    echo 'No se pudo conectar', mysqli_connect_error();
    exit();
}else {
    echo 'Conectado a la base de datos';
}
?>