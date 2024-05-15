<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Crear - CRUD PHP</title>
<link rel="stylesheet" href="../css/facturaM.css">
<link rel="stylesheet" href="../css/menu.css">
<link rel="shortcut icon" href="../img/logo ggm.png" type="image/x-icon">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Acudiente_Nombres = isset($_POST['Acudiente_Nombres']) ? $_POST['Acudiente_Nombres'] : null;
    $Acudiente_Apellidos = isset($_POST['Acudiente_Apellidos']) ? $_POST['Acudiente_Apellidos'] : null;
    $Estudiante_Nombres = isset($_POST['Estudiante_Nombres']) ? $_POST['Estudiante_Nombres'] : null;
    $Estudiante_Apellidos = isset($_POST['Estudiante_Apellidos']) ? $_POST['Estudiante_Apellidos'] : null;
    $No_Documento = isset($_POST['No_Documento']) ? $_POST['No_Documento'] : null;
    $Direccion = isset($_POST['Direccion']) ? $_POST['Direccion'] : null;
    $Id_Barrio = isset($_POST['Id_Barrio']) ? $_POST['Id_Barrio'] : null;
    $Ocupacion = isset($_POST['Ocupacion']) ? $_POST['Ocupacion'] : null;
    $Parentesco = isset($_POST['Parentesco']) ? $_POST['Parentesco'] : null;
    $Telefono = isset($_POST['Telefono']) ? $_POST['Telefono'] : null;
    $Correo_Electronico = isset($_POST['Correo_Electronico']) ? $_POST['Correo_Electronico'] : null;
    

    if (empty($Estudiante_Nombres) || empty($Estudiante_Apellidos) || empty($Id_Barrio)) {
        header('Location: acudientes.php?error=missing_fields');
        exit; 
    }

    $hostDB = '127.0.0.1';
    $nombreDB = 'ggm';
    $usuarioDB = 'root';
    $contrasenyaDB = '';

    $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
    $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);

    $estudianteQuery = $miPDO->prepare('SELECT Id_Estudiante FROM estudiante WHERE Nombres = ? AND Apellidos = ?');
    $estudianteQuery->execute([$Estudiante_Nombres, $Estudiante_Apellidos]);
    $idEstudiante = $estudianteQuery->fetchColumn();

    $miInsert = $miPDO->prepare('INSERT INTO acudiente (Nombres, Apellidos, Id_Estudiante, No_Documento, Direccion, 
    Id_Barrio, Ocupacion, Parentesco, Telefono, Correo_Electronico) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

    $miInsert->execute([$Acudiente_Nombres, $Acudiente_Apellidos, $idEstudiante, $No_Documento, $Direccion, $Id_Barrio, 
    $Ocupacion, $Parentesco, $Telefono, $Correo_Electronico]);

    header('Location: acudientes.php');
    exit; 
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear - CRUD PHP</title>
    <link rel="stylesheet" href="../css/facturaM.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="shortcut icon" href="../img/logo ggm.png" type="image/x-icon">
</head>
<body>

<form action="" method="post">
    <center><h2>Crear Acudiente</h2></center>
    <p>
        <div>Acudiente</div>
        <input type="text" name="Acudiente_Nombres" placeholder="Nombres">
        <input type="text" name="Acudiente_Apellidos" placeholder="Apellidos">
    </p>
    <p>
        <div>Estudiante</div>
        <input type="text" name="Estudiante_Nombres" placeholder="Nombres">
        <input type="text" name="Estudiante_Apellidos" placeholder="Apellidos">
    </p>
    <p>
        <div>No de Documento</div>
        <input id="No_Documento" type="text" name="No_Documento">
    </p>
    <p>
        <div>Dirección</div>
        <input id="Direccion" type="text" name="Direccion">
    </p>
    <p>
    <div>
        <label for="Id_Barrio">Barrio:</label>
            <select id="Id_Barrio" name="Id_Barrio">
                <option value="1">Muiscas</option>
                <option value="2">Sanitas</option>
                <option value="3">Segundo</option>
                <option value="4">Tercero</option>
                <option value="5">Cuarto</option>
                <option value="6">Quinto</option>
                <option value="7">Sexto</option>
                <option value="8">Séptimo</option>
                <option value="9">Octavo</option>
                <option value="10">Noveno</option>
                <option value="11">Décimo</option>
                <option value="12">Once</option>
            </select>
    </p>
    <p>
        <div>Ocupación</div>
        <input id="Ocupacion" type="text" name="Ocupacion">
    </p>
    <p>
        <div>Parentesco</div>
        <input id="Parentesco" type="text" name="Parentesco">
    </p>
    <p>
        <div>Teléfono</div>
        <input id="Telefono" type="text" name="Telefono">
    </p>
    <p>
        <div>Correo Electrónico</div>
        <input id="Correo_Electronico" type="text" name="Correo_Electronico">
    </p>
    <p>
        <center>
            <a href="pension.php" class="btn-default">Regresar</a>
            <input class="btn-primary" type="submit" value="Guardar">
        </center>
    </p>
</form>
</body>
</html>




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