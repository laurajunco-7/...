<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nombres = isset($_REQUEST['Nombres']) ? $_REQUEST['Nombres'] : null;
    $Apellidos = isset($_REQUEST['Apellidos']) ? $_REQUEST['Apellidos'] : null;
    $Id_Grado = isset($_REQUEST['Id_Grado']) ? $_REQUEST['Id_Grado'] : null;
    $Fecha_Nacimiento = isset($_REQUEST['Fecha_Nacimiento']) ? $_REQUEST['Fecha_Nacimiento'] : null;
    $Lugar_Nacimiento = isset($_REQUEST['Lugar_Nacimiento']) ? $_REQUEST['Lugar_Nacimiento'] : null;
    $RH = isset($_REQUEST['RH']) ? $_REQUEST['RH'] : null;
    $No_Registro_Civil = isset($_REQUEST['No_Registro_Civil']) ? $_REQUEST['No_Registro_Civil'] : null;
    $No_Tarjeta_Identidad = isset($_REQUEST['No_Tarjeta_Identidad']) ? $_REQUEST['No_Tarjeta_Identidad'] : null;
    $Direccion = isset($_REQUEST['Direccion']) ? $_REQUEST['Direccion'] : null;
    $Barrio = isset($_REQUEST['Barrio']) ? $_REQUEST['Barrio'] : null;
    $Telefono = isset($_REQUEST['Telefono']) ? $_REQUEST['Telefono'] : null;
    $Id_Eps = isset($_REQUEST['Id_Eps']) ? $_REQUEST['Id_Eps'] : null;
    $Genero = isset($_REQUEST['Genero']) ? $_REQUEST['Genero'] : null;
    $Correo_Electronico = isset($_REQUEST['Correo_Electronico']) ? $_REQUEST['Correo_Electronico'] : null;
    $Foto = isset($_REQUEST['Foto']) ? $_REQUEST['Foto'] : null;

    $hostDB = '127.0.0.1';
    $nombreDB = 'ggm';
    $usuarioDB = 'root';
    $contrasenyaDB = '';

    $hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
    $miPDO = new PDO($hostPDO, $usuarioDB, $contrasenyaDB);

    $miInsert = $miPDO->prepare('INSERT INTO estudiante (Nombres, Apellidos, Id_Grado, Fecha_Nacimiento, Lugar_Nacimiento,
    RH, No_Registro_Civil, No_Tarjeta_Identidad, Direccion, Barrio, Telefono, Id_Eps, Genero, Correo_Electronico, 
    Foto) VALUES (:Nombres, :Apellidos, :Id_Grado, :Fecha_Nacimiento, :Lugar_Nacimiento,
    :RH, :No_Registro_Civil, :No_Tarjeta_Identidad, :Direccion, :Barrio, :Telefono, :Id_Eps, :Genero, :Correo_Electronico, 
    :Foto)');

    $miInsert->execute(array(
    'Nombres' => $_POST['Nombres'],
    'Apellidos' => $_POST['Apellidos'],
    'Id_Grado' => $_POST['Id_Grado'],
    'Fecha_Nacimiento' => $_POST['Fecha_Nacimiento'],
    'Lugar_Nacimiento' => $_POST['Lugar_Nacimiento'],
    'RH' => $_POST['RH'],
    'No_Registro_Civil' => $_POST['No_Registro_Civil'],
    'No_Tarjeta_Identidad' => $_POST['No_Tarjeta_Identidad'],
    'Direccion' => $_POST['Direccion'],
    'Barrio' => $_POST['Barrio'],
    'Telefono' => $_POST['Telefono'],
    'Id_Eps' => $_POST['Id_Eps'],
    'Genero' => $_POST['Genero'],
    'Correo_Electronico' => $_POST['Correo_Electronico'],
    'Foto' => $_POST['Foto']
));

    header('Location: estudiantes.php');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Colegio Gabriel García Márquez</title>
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
          <a class="barra"  href="../iniciosesion.html">Iniciar Sesión</a>
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

    <form action="" method="post">
        <center><h2>Crear Estudiante</h2></center>
        <p>
            <label for="Nombres">Nombres</label>
            <input id="Nombres" type="text" name="Nombres">
        </p>
        <p>
            <div>Apellidos</div>
            <input id="Apellidos" type="text" name="Apellidos">
        </p>
        <p>
        <div>
            <label for="Id_Grado">Grado:</label>
                <select id="Id_Grado" name="Id_Grado">
                    <option value="1">Transición</option>
                    <option value="2">Primero</option>
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
        </div>
        </p>
        <p>
            <div>Fecha Nacimiento</div>
            <input id="Fecha_Nacimiento" type="date" name="Fecha_Nacimiento">
        </p>
        <p>
            <div>Lugar Nacimiento</div>
            <input id="Lugar_Nacimiento" type="text" name="Lugar_Nacimiento">
        </p>
        <p>
            <div>RH</div>
            <input id="RH" type="text" name="RH">
        </p>
        <p>
            <div>No Registro Civil</div>
            <input id="No_Registro_Civil" type="text" name="No_Registro_Civil">
        </p>
        <p>
            <div>No Tarjeta Identidad</div>
            <input id="No_Tarjeta_Identidad" type="text" name="No_Tarjeta_Identidad">
        </p>
        <p>
            <div>Dirección</div>
            <input id="Direccion" type="text" name="Direccion">
        </p>
        <p>
        <p>
            <div>Barrio</div>
            <input id="Barrio" type="text" name="Barrio">
        </p>
        </p>
        <p>
            <div>Teléfono</div>
            <input id="Telefono" type="text" name="Telefono">
        </p>
        <p>
        <div>
            <label for="Id_Eps">EPS:</label>
                <select id="Id_Eps" name="Id_Eps">
                    <option value="1">Salud Total</option>
                    <option value="2">Coomeva</option>
                    <option value="3">SURA</option>
                    <option value="4">Nueva EPS</option>
                    <option value="5">Sanitas</option>
                    <option value="6">Aliansalud</option>
                    <option value="7">Compensar</option>
                    <option value="8">Cajacopi</option>
                    <option value="9">Cruz Blanca</option>
                    <option value="10">Mutual Ser</option>
                    <option value="11">Famisanar</option>
                    <option value="12">Capital Salud</option>
                    <option value="13">Saludvida</option>
                    <option value="14">Comfacor</option>
                    <option value="15">Comparta</option>
                    <option value="16">Comfamiliar</option>
                    <option value="17">Mutualidad de los Carlistas</option>
                    <option value="18">Emdisalud</option>
                    <option value="19">Coosalud </option>
                    <option value="20">Savia Salud</option>
                </select>
        </div>
        </p>
        <p>
            <div>Género</div>
            <input id="Genero" type="text" name="Genero">
        </p>
        <p>
            <div>Correo Electrónico</div>
            <input id="Correo_Electronico" type="text" name="Correo_Electronico">
        </p>
        <p>
            <label for="Foto">Foto:</label>
            <input type="file" id="Foto" name="Foto">
        </p>

        <p>
            <center>
            <a href="estudiantes.php" class="btn-default">Regresar</a>
            <input class="btn-primary" type="submit" value="Guardar">
            </center>
            
        </p>
    </form>
</body>
</html>