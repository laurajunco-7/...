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
  padding: 8px;
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
</html>

<div class=" table-container">
<?php
require '../conexion.php';

$error = false;
$config = include '../config.php';

try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

} catch(PDOException $e) {
    $error = $e->getMessage();
}

// Buscador
if (isset($_POST['submit'])) {
    $busqueda = isset($_POST['Nombres']) ? $_POST['Nombres'] : '';
    $consultaSQL = "SELECT 
          a.Id_Acudiente, 
          a.Nombres, 
          a.Apellidos,
          e.Nombres AS Nombres_Estudiante,
          e.Apellidos AS Apellidos_Estudiante, 
          a.No_Documento,
          a.Direccion,
          a.Barrio,
          a.Ocupacion,
          a.Parentesco,
          a.Telefono,
          a.Correo_Electronico
      FROM acudiente a
      INNER JOIN Estudiante e ON a.Id_Estudiante = e.Id_Estudiante
      WHERE e.Nombres LIKE :busqueda OR e.Apellidos LIKE :busqueda";
      
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->bindValue(':busqueda', '%' . $busqueda . '%', PDO::PARAM_STR);
} else {
    // Consulta normal
$consultaSQL = "SELECT 
a.Id_Acudiente, 
a.Nombres, 
a.Apellidos,
e.Nombres AS Nombres_Estudiante,
e.Apellidos AS Apellidos_Estudiante, 
a.No_Documento,
a.Direccion,
a.Barrio,
a.Ocupacion,
a.Parentesco,
a.Telefono,
a.Correo_Electronico
FROM acudiente a
INNER JOIN Estudiante e ON a.Id_Estudiante = e.Id_Estudiante";

$sentencia = $conexion->prepare($consultaSQL);
      
    $sentencia = $conexion->prepare($consultaSQL);
}

$sentencia->execute();
$acudiente = $sentencia->fetchAll();
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
    <center><h2 class="mt-3">Lista de Acudientes</h2></center>
    <br>
    <div class="boton">
      <a href="crearA.php">Crear</a>
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
            <th>Nombre Estudiante</th>
            <th>No de Documento</th>
            <th>Dirección</th>
            <th>Barrio</th>
            <th>Ocupación</th>
            <th>Parentesco</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
          </tr>
        </thead>
        <tbody>

    <?php
    foreach ($acudiente as $fila) {
    $estudiante = isset($fila["Nombres_Estudiante"]) ? $fila["Nombres_Estudiante"] . ' ' . $fila["Apellidos_Estudiante"] : "";

    // Ahora puedes imprimir estos valores en las celdas correspondientes de la tabla
    ?>
    <tr>
        <td><?php echo ($fila["Id_Acudiente"]); ?></td>
        <td><?php echo ($fila["Nombres"]); ?></td>
        <td><?php echo ($fila["Apellidos"]); ?></td>
        <td><?php echo ($estudiante); ?></td>
        <td><?php echo ($fila["No_Documento"]); ?></td>
        <td><?php echo ($fila["Direccion"]); ?></td>
        <td><?php echo ($fila["Barrio"]); ?></td> 
        <td><?php echo ($fila["Ocupacion"]); ?></td>
        <td><?php echo ($fila["Parentesco"]); ?></td>
        <td><?php echo ($fila["Telefono"]); ?></td>
        <td><?php echo ($fila["Correo_Electronico"]); ?></td> 
        <td><a class="bt-editar" href="<?= 'editarA.php?Id_Acudiente=' . ($fila["Id_Acudiente"]) ?>">Editar</a></td>
    </tr>
<?php
}
?>

</div>
</div>