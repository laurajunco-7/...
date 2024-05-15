<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $Nombres = isset($_POST['Nombres']) ? $_POST['Nombres'] : null;
    $Apellidos = isset($_POST['Apellidos']) ? $_POST['Apellidos'] : null;
    $No_Documento = isset($_POST['No_Documento']) ? $_POST['No_Documento'] : null;
    $Telefono = isset($_POST['Telefono']) ? $_POST['Telefono'] : null;
    $Correo_Electronico = isset($_POST['Correo_Electronico']) ? $_POST['Correo_Electronico'] : null;
    $Tipo_Funcionario = isset($_POST['Tipo_Funcionario']) ? $_POST['Tipo_Funcionario'] : null;

    $hostDB = '127.0.0.1';
    $nombreDB = 'ggm';
    $usuarioDB = 'root';
    $contrasenyaDB = '';

    $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
    $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);
    
    $miInsert = $miPDO->prepare('INSERT INTO funcionarios (Nombres, Apellidos, No_Documento, Telefono, Correo_Electronico, Tipo_Funcionario) 
    VALUES (:Nombres, :Apellidos, :No_Documento, :Telefono, :Correo_Electronico, :Tipo_Funcionario)');

$miInsert->execute(array(
'Nombres' => $Nombres,
'Apellidos' => $Apellidos,
'No_Documento' => $No_Documento,
'Telefono' => $Telefono,
'Correo_Electronico' => $Correo_Electronico,
'Tipo_Funcionario' => $Tipo_Funcionario,
));

    header('Location: funcionarios.php');
    exit; 
}
?>

    <form action="" method="post">
        <center><h2>Crear Funcionario</h2></center>
        <p>
            <div>Nombres</div>
            <input id="Nombres" type="text" name="Nombres">
        </p>
        <p>
            <div>Apellidos</div>
            <input id="Apellidos" type="text" name="Apellidos">
        </p>
        <p>
            <div>No de Documento</div>
            <input id="No_Documento" type="text" name="No_Documento">
        </p>
        <p>
            <div>Teléfono</div>
            <input id="Telefono" type="text" name="Telefono">
        </p>
        <p>
            <div>Correo Electrónico</div>
            <input id="Correo_Electronico" type="email" name="Correo_Electronico">
        </p>
        <p>
            <div>Tipo de Funcionario</div>
            <input id="Tipo_Funcionario" type="text" name="Tipo_Funcionario">
        </p>
        <p>
            <center>
            <a href="funcionarios.php" class="btn-default">Regresar</a>
            <input class="btn-primary" type="submit" value="Guardar">
            </center>
            
        </p>
    </form>
</body>
</html>




<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear - CRUD PHP</title>
<link rel="stylesheet" href="../css/facturaM.css">
<link rel="stylesheet" href="../css/menu.css">
<link rel="shortcut icon" href="../img/logo ggm.png" type="image/x-icon">
<style>

body {
    font-family: Arial, sans-serif;
}
form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-top: 150px;
}
p {
    margin-bottom: 10px;
}
input[type="text"],
input[type="date"],
input[type="email"],
select {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    margin-top: 5px;
}
input[type="text"]:focus {
outline: none;
border-color: #45a049;
}
input[type="date"]:focus {
outline: none;
border-color: #45a049;
}
input[type="email"]:focus {
outline: none;
border-color: #45a049;
}
select:focus{
    outline: none;
border-color: #45a049; 
}
.btn-primary {
    width: 90px;
    padding: 10px;
    background-color: #4CAF50;
    border: none;
    border-radius: 12px;
    font-size: 1em;
    margin-left: 2%;
    text-align: center;
    margin-top: 20px; 
    color: white;
}
.btn-primary:hover {
    background-color: #45a049;
}
.btn-default{
    width: 100px;
    padding: 10px;
    background-color: #4CAF50;
    border: none;
    border-radius: 12px;
    font-size: 1em;
    margin-left: 2%;
    text-align: center;
    margin-top: 20px; 
}
.btn-default{
    text-decoration: none;
    color: white;
}
.bt-default>a:hover{
background-color: #45a049;
}
    </style>
      <header>
    <img src="../img/logo ggm.png" alt=""class ="logo">
    <h3>Colegio Gabriel García Márquez</h3>
    <nav >
      <ul class="menu-horizontal">
        <li><a href="../Index.html"class="label1" >Inicio</a></li>
        <li><a href="../conocenos.html" class="label1">Conócenos</a></li>
              <li><a href="../contact.html"class="label1">Contáctenos</a> </li>
        <li>
          <a class="barra"  href="iniciosesion.html">Iniciar Sesión</a>
          <ul class="menu-vertical">    
              <li><a href="../pagoM.php"class=lat2>Matrícula</a></li>
              <li><a href="../pagoP.php" class=lat2>Pensión</a></li>
              <li><a href="../admin.html.php" class=lat2>Administrador</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
</head>
<body>