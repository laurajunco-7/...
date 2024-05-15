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
              <li><a href="../admin.html" class=lat2>Administrador</a></li>
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
          m.Id_Matricula, 
          f.Nombres AS Nombres_Funcionario, 
          f.Apellidos AS Apellidos_Funcionario,
          a.Nombres AS Nombres_Acudiente, 
          a.Apellidos AS Apellidos_Acudiente,
          e.Nombres AS Nombres_Estudiante,
          e.Apellidos AS Apellidos_Estudiante, 
          m.Ciudad, 
          m.Fecha, 
          m.Descuento, 
          m.Monto
      FROM Matricula m
      INNER JOIN Funcionarios f ON m.Id_Funcionario = f.Id_Funcionario
      INNER JOIN Acudiente a ON m.Id_Acudiente = a.Id_Acudiente
      INNER JOIN Estudiante e ON m.Id_Estudiante = e.Id_Estudiante
      WHERE e.Nombres LIKE :busqueda OR e.Apellidos LIKE :busqueda";
      
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->bindValue(':busqueda', '%' . $busqueda . '%', PDO::PARAM_STR);
} else {
    // Consulta normal
    $consultaSQL = "SELECT 
          m.Id_Matricula, 
          f.Nombres AS Nombres_Funcionario, 
          f.Apellidos AS Apellidos_Funcionario,
          a.Nombres AS Nombres_Acudiente, 
          a.Apellidos AS Apellidos_Acudiente,
          e.Nombres AS Nombres_Estudiante,
          e.Apellidos AS Apellidos_Estudiante, 
          m.Ciudad, 
          m.Fecha, 
          m.Descuento, 
          m.Monto
      FROM Matricula m
      INNER JOIN Funcionarios f ON m.Id_Funcionario = f.Id_Funcionario
      INNER JOIN Acudiente a ON m.Id_Acudiente = a.Id_Acudiente
      INNER JOIN Estudiante e ON m.Id_Estudiante = e.Id_Estudiante";
      
    $sentencia = $conexion->prepare($consultaSQL);
}

$sentencia->execute();
$matricula = $sentencia->fetchAll();
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
    <center><h2 class="mt-3">Lista de Matriculas</h2></center>
    <br>
    <div class="boton">
      <a href="crearM.php">Crear</a>
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
            <th>Funcionario</th>
            <th>Acudiente</th>
            <th>Estudiante</th>
            <th>Ciudad</th>
            <th>Fecha</th>
            <th>Descuento</th>
            <th>Monto</th>
          </tr>
        </thead>
        <tbody>

        <?php
foreach ($matricula as $fila) {
    $funcionario = isset($fila["Nombres_Funcionario"]) ? $fila["Nombres_Funcionario"] . ' ' . $fila["Apellidos_Funcionario"] : "";
    $acudiente = isset($fila["Nombres_Acudiente"]) ? $fila["Nombres_Acudiente"] . ' ' . $fila["Apellidos_Acudiente"] : "";
    $estudiante = isset($fila["Nombres_Estudiante"]) ? $fila["Nombres_Estudiante"] . ' ' . $fila["Apellidos_Estudiante"] : "";

    // Ahora puedes imprimir estos valores en las celdas correspondientes de la tabla
    ?>
    <tr>
        <td><?php echo ($fila["Id_Matricula"]); ?></td>
        <td><?php echo ($funcionario); ?></td>
        <td><?php echo ($acudiente); ?></td> 
        <td><?php echo ($estudiante); ?></td>
        <td><?php echo ($fila["Ciudad"]); ?></td>
        <td><?php echo ($fila["Fecha"]); ?></td>
        <td><?php echo ($fila["Descuento"]); ?></td>
        <td><?php echo ($fila["Monto"]); ?></td> 
        <td><a class="bt-editar" href="<?= 'editarM.php?Id_Matricula=' . ($fila["Id_Matricula"]) ?>">Editar</a></td>
    </tr>
<?php
}
?>

</div>
</div>