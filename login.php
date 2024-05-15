<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ggm"; 

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if (!$connection)
{
    die("No hay conexión: ". mysqli_connect_error());
}

$usuario = $_POST["Usuario"];
$contraseña = $_POST["Contraseña"];

$query = mysqli_query($connection, "SELECT * FROM login WHERE usuario = '".$usuario."' and contraseña = '".$contraseña."'");

$nr = mysqli_num_rows($query);

if ($nr == 1)
{
    echo "1";
}

else if ($nr == 0)
{
    echo "Usuario o contraseña incorrectos";
}
?>