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
    $Funcionario_Nombres = isset($_POST['Funcionario_Nombres']) ? $_POST['Funcionario_Nombres'] : null;
    $Funcionario_Apellidos = isset($_POST['Funcionario_Apellidos']) ? $_POST['Funcionario_Apellidos'] : null;
    $Acudiente_Nombres = isset($_POST['Acudiente_Nombres']) ? $_POST['Acudiente_Nombres'] : null;
    $Acudiente_Apellidos = isset($_POST['Acudiente_Apellidos']) ? $_POST['Acudiente_Apellidos'] : null;
    $Estudiante_Nombres = isset($_POST['Estudiante_Nombres']) ? $_POST['Estudiante_Nombres'] : null;
    $Estudiante_Apellidos = isset($_POST['Estudiante_Apellidos']) ? $_POST['Estudiante_Apellidos'] : null;
    $Ciudad = isset($_POST['Ciudad']) ? $_POST['Ciudad'] : null;
    $Fecha = isset($_POST['Fecha']) ? $_POST['Fecha'] : null;
    $Descuento = isset($_POST['Descuento']) ? $_POST['Descuento'] : null;
    $Monto = isset($_POST['Monto']) ? $_POST['Monto'] : null;

    if (empty($Funcionario_Nombres) || empty($Funcionario_Apellidos) || empty($Acudiente_Nombres) || empty($Acudiente_Apellidos) || empty($Estudiante_Nombres) || empty($Estudiante_Apellidos)) {

        header('Location: matricula.php?error=missing_fields');
        exit; 
    }

    $hostDB = '127.0.0.1';
    $nombreDB = 'ggm';
    $usuarioDB = 'root';
    $contrasenyaDB = '';

    $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
    $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);

    $funcionarioQuery = $miPDO->prepare('SELECT Id_Funcionario FROM funcionarios WHERE Nombres = ? AND Apellidos = ?');
    $acudienteQuery = $miPDO->prepare('SELECT Id_Acudiente FROM acudiente WHERE Nombres = ? AND Apellidos = ?');
    $estudianteQuery = $miPDO->prepare('SELECT Id_Estudiante FROM estudiante WHERE Nombres = ? AND Apellidos = ?');

    $funcionarioQuery->execute([$Funcionario_Nombres, $Funcionario_Apellidos]);
    $acudienteQuery->execute([$Acudiente_Nombres, $Acudiente_Apellidos]);
    $estudianteQuery->execute([$Estudiante_Nombres, $Estudiante_Apellidos]);

    $idFuncionario = $funcionarioQuery->fetchColumn();
    $idAcudiente = $acudienteQuery->fetchColumn();
    $idEstudiante = $estudianteQuery->fetchColumn();

    $miInsert = $miPDO->prepare('INSERT INTO matricula (Id_Funcionario, Id_Acudiente, Id_Estudiante, Ciudad, Fecha, Descuento, Monto) 
    VALUES (?, ?, ?, ?, ?, ?, ?)');

    $miInsert->execute([$idFuncionario, $idAcudiente, $idEstudiante, $Ciudad, $Fecha, $Descuento, $Monto]);

    header('Location: matricula.php');
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
    <center><h2>Crear Matricula</h2></center>
    <p>
        <div>Funcionario</div>
        <input type="text" name="Funcionario_Nombres" placeholder="Nombres">
        <input type="text" name="Funcionario_Apellidos" placeholder="Apellidos">
    </p>
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
        <div>Ciudad</div>
        <input id="Ciudad" type="text" name="Ciudad">
    </p>
    <p>
        <div>Fecha</div>
        <input id="Fecha" type="date" name="Fecha">
    </p>
    <p>
        <div>Descuento</div>
        <input id="Descuento" type="text" name="Descuento">
    </p>
    <p>
        <div>Monto</div>
        <input id="Monto" type="text" name="Monto">
    </p>
    <p>
        <center>
            <a href="matricula.php" class="btn-default">Regresar</a>
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