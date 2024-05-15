<html>
<title>Colegio Gabriel García Márquez</title>
<link rel="stylesheet" href="../css/facturaM.css">
<link rel="stylesheet" href="../css/menu.css">
<link rel="shortcut icon" href="../img/logo ggm.png" type="image/x-icon">
<style>
.table-container {
  margin-top: 150px;
}
table {
  width: 100%;
  border-collapse: collapse;
}
th, td {
  padding: 8px;
  text-align: center;
  border-bottom: 1px solid #ddd;
}
tr:hover {
  background-color: #f5f5f5;
}
.selected {
  background-color: #b3d9ff !important; 
}
.boton{
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
.boton>a{
text-decoration: none;
color: white;
}
.boton>a:hover{
background-color: #45a049;
}
.bt-editar{
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
.bt-editar{
  text-decoration: none;
  color: white;
}
.bt-editar>a:hover{
background-color: #45a049;
}
.buscar {
  width: 800px;
  padding: 10px;
  border: 2px solid #ccc;
  border-radius: 12px;
  box-sizing: border-box;
  font-size: 1em;
  margin-top: -40px;
}
.buscar::placeholder {
color: #aaa;
}
.buscar:focus {
outline: none;
border-color: #45a049;
}
.btn-primary{
  width: 145px;
  padding: 10px;
  background-color: #4CAF50;
  border: none;
  border-radius: 12px;
  font-size: 1em;
  margin-left: 87%;
  margin-top: -40px;
  text-align: center;
  color: white;
}
.btn-primary>button:hover{
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

<div class=" table-container">
<?php
$error = false;
$config = include '../config.php';

try {
  $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
  $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

} catch(PDOException $error) {
  $error = $error->getMessage();
}

if (isset($_POST['Nombres']) && !empty($_POST['Nombres'])) {
  $consultaSQL = "SELECT 
      e.Id_Estudiante, 
      e.Nombres, 
      e.Apellidos, 
      e.Fecha_Nacimiento, 
      e.Lugar_Nacimiento, 
      e.RH, 
      e.No_Registro_Civil, 
      e.No_Tarjeta_Identidad, 
      e.Direccion, 
      e.Barrio, 
      g.Nombre_Grado AS Grados, 
      ep.Nombre AS Eps, 
      e.Genero, 
      e.Telefono,
      e.Correo_Electronico, 
      e.Foto
  FROM Estudiante e
  INNER JOIN Grados g ON e.Id_Grado = g.Id_Grado
  INNER JOIN Eps ep ON e.Id_Eps = ep.Id_Eps
  WHERE e.Nombres LIKE '%" . $_POST['Nombres'] . "%'";

} else {
  $consultaSQL = "SELECT 
      e.Id_Estudiante, 
      e.Nombres, 
      e.Apellidos, 
      e.Fecha_Nacimiento, 
      e.Lugar_Nacimiento, 
      e.RH, 
      e.No_Registro_Civil, 
      e.No_Tarjeta_Identidad, 
      e.Direccion, 
      e.Barrio, 
      g.Nombre_Grado AS Grados, 
      ep.Nombre AS Eps, 
      e.Genero, 
      e.Telefono,
      e.Correo_Electronico, 
      e.Foto
  FROM Estudiante e
  INNER JOIN Grados g ON e.Id_Grado = g.Id_Grado
  INNER JOIN Eps ep ON e.Id_Eps = ep.Id_Eps";
}

$sentencia = $conexion->prepare($consultaSQL);
$sentencia->execute();
$estudiantes = $sentencia->fetchAll();
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
    <center><h2 class="mt-3">Lista de Estudiantes</h2></center>
    <br>
    <div class="boton">
      <a href="crearE.php">Crear</a>
    </div>
      <form class="form-in-line" method="post">
      <div class="form-group mr-3">
        <center>
        <input type="text" id="Nombres" name="Nombres" placeholder="Buscar por nombre" class="buscar">
        </center>
        
      </div>
      <button type="submit" name="submit" class="btn-primary">Ver resultados</button>
      </form>
    </div>
  </div>
</div>

<?php
if ($error) {
  ?>
  <div class="container mt-2">
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
          <?= $error ?>
        </div>
      </div>
    </div>
  </div>
<?php
}
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <br>
      <br>
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Grado</th>
            <th>Fecha Nacimiento</th>
            <th>Lugar Nacimiento</th>
            <th>RH</th>
            <th>No Registro Civil</th>
            <th>No Tarjeta Identidad</th>
            <th>Dirección</th>
            <th>Barrio</th>
            <th>Teléfono</th>
            <th>Eps</th>
            <th>Género</th>
            <th>Correo Electrónico</th>
            <th>Foto</th>
          </tr>
        </thead>
        <tbody>

        <?php
        foreach ($estudiantes as $fila) {
          $grado = isset($fila["Grados"]) ? $fila["Grados"] : "";
          $eps = isset($fila["Eps"]) ? $fila["Eps"] : "";
          ?>
          <tr>
              <td><?php echo ($fila["Id_Estudiante"]); ?></td>
              <td><?php echo ($fila["Nombres"]); ?></td>
              <td><?php echo ($fila["Apellidos"]); ?></td>
              <td><?php echo ($grado); ?></td> 
              <td><?php echo ($fila["Fecha_Nacimiento"]); ?></td>
              <td><?php echo ($fila["Lugar_Nacimiento"]); ?></td>
              <td><?php echo ($fila["RH"]); ?></td>
              <td><?php echo ($fila["No_Registro_Civil"]); ?></td>
              <td><?php echo ($fila["No_Tarjeta_Identidad"]); ?></td>
              <td><?php echo ($fila["Direccion"]); ?></td>
              <td><?php echo ($fila["Barrio"]); ?></td>
              <td><?php echo ($fila["Telefono"]); ?></td>
              <td><?php echo ($eps); ?></td> 
              <td><?php echo ($fila["Genero"]); ?></td>
              <td><?php echo ($fila["Correo_Electronico"]); ?></td>
              <td><img width="140px" height="145px" src="data:image/png;base64,<?php echo base64_encode($fila['Foto']) ?>"></td>

              <td>
                  <a class="bt-editar" href="<?= 'mofifi.php?Id_Estudiante=' . ($fila["Id_Estudiante"]) ?>">Editar</a>
              </td>
          </tr>
          <?php
      }?>
</div>
</div>