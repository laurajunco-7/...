<html>
<link rel="stylesheet" href="../css/facturaM.css">
<link rel="stylesheet" href="../css/menu.css">
<link rel="shortcut icon" href="../img/logo ggm.png" type="image/x-icon">
<style>
/* Estilos para el formulario */
body {
    font-family: Arial, sans-serif;
}
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-top: 150px;
}
h2 {
    text-align: center;
}
form {
    margin-top: 20px;
}
label {
    font-weight: bold;
}
input[type="text"],
input[type="date"],
select,
textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
    margin-top: 5px;
}
input[type="submit"]:hover {
background-color: #45a049;
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
input[type="file"] {
    margin-top: 5px;
}
img {
    margin-top: 5px;
    max-width: 150px;
    max-height: 155px;
}
.form-group {
    margin-bottom: 15px;
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
</html>


<?php
require '../conexion.php';

function get_data($mysqli, $sql, $params, ...$values) {
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param($params, ...$values);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

if (isset($_GET['Id_Estudiante'])) {
    $Id_Estudiante = $_GET['Id_Estudiante'];

    $row = get_data($conexion, "SELECT * FROM estudiante WHERE Id_Estudiante =?", 'i', $Id_Estudiante);
    $grados = get_data($conexion, "SELECT Nombre_Grado FROM grados WHERE Id_Grado =?", 'i', $row['Id_Grado']);
    $eps = get_data($conexion, "SELECT Nombre FROM eps WHERE Id_EPS =?", 'i', $row['Id_Eps']);
}  else {
    echo "ID de estudiante no válido";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Registro</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <h2 style="text-align:center">Modificar Estudiante</h2>
        </div>
        
        <form class="form-horizontal" method="POST" action="update.php" autocomplete="off" enctype="multipart/form-data">

            <input type="hidden" name="Id_Estudiante" value="<?php echo $row['Id_Estudiante']; ?>">

            <div class="form-group">
                <label for="Nombres" class="col-sm-2 control-label">Nombres</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Nombres" name="Nombres" placeholder="Nombres" value="<?php echo $row['Nombres']; ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="Apellidos" class="col-sm-2 control-label">Apellidos</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Apellidos" name="Apellidos" placeholder="Apellidos" value="<?php echo $row['Apellidos']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Nombre_Grado" class="col-sm-2 control-label">Grado</label>
                <br>
                <select name="Nombre_Grado" id="Nombre_Grado">
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
            <div class="form-group">
                <label for="Fecha_Nacimiento" class="col-sm-2 control-label">Fecha Nacimiento</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="Fecha_Nacimiento" name="Fecha_Nacimiento" placeholder="Fecha_Nacimiento" value="<?php echo $row['Fecha_Nacimiento']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Lugar_Nacimiento" class="col-sm-2 control-label">Lugar Nacimiento</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Lugar_Nacimiento" name="Lugar_Nacimiento" placeholder="Lugar_Nacimiento" value="<?php echo $row['Lugar_Nacimiento']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="RH" class="col-sm-2 control-label">RH</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="RH" name="RH" placeholder="RH" value="<?php echo $row['RH']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="No_Registro_Civil" class="col-sm-2 control-label">No Registro Civil</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="No_Registro_Civil" name="No_Registro_Civil" placeholder="No_Registro_Civil" value="<?php echo $row['No_Registro_Civil']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="No_Tarjeta_Identidad" class="col-sm-2 control-label">No Tarjeta Identidad</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="No_Tarjeta_Identidad" name="No_Tarjeta_Identidad" placeholder="No_Tarjeta_Identidad" value="<?php echo $row['No_Tarjeta_Identidad']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Direccion" class="col-sm-2 control-label">Dirección</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Direccion" name="Direccion" placeholder="Direccion" value="<?php echo $row['Direccion']; ?>" required>
                </div>
            </div>
            <div class="form-group">
            <label for="Barrio" class="col-sm-2 control-label">Barrio</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Barrio" name="Barrio" placeholder="Barrio" value="<?php echo $row['Barrio']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Telefono" class="col-sm-2 control-label">Telefono</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Telefono" name="Telefono" placeholder="Telefono" value="<?php echo $row['Telefono']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Nombre_EPS" class="col-sm-2 control-label">EPS</label>
                <br>
                <select name="Nombre_EPS" id="Nombre_EPS">
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
            <div class="form-group">
                <label for="Genero" class="col-sm-2 control-label">Genero</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Genero" name="Genero" placeholder="Genero" value="<?php echo $row['Genero']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Correo_Electronico" class="col-sm-2 control-label">Correo Electronico</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Correo_Electronico" name="Correo_Electronico" placeholder="Correo_Electronico" value="<?php echo $row['Correo_Electronico']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Foto" class="col-sm-2 control-label">Foto</label>
                    <div class="col-sm-10">
                    <input type="file" id="Foto" name="Foto" accept="image/*">
                    </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <center><a href="estudiantes.php" class="btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button></center>
                </div>
            </div>
        </form>
    </div>
</body>
</html>