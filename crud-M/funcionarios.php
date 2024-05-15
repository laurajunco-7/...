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
  padding: 7px;
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
$error = false;
$config = include '../config.php';

try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);

} catch(PDOException $e) {
    $error = $e->getMessage();
}

if (isset($_POST['Nombres']) && !empty($_POST['Nombres'])) {
$consultaSQL = "SELECT * FROM funcionarios WHERE Nombres LIKE '%" . $_POST['Nombres'] . "%'";
}else{
    $consultaSQL = "SELECT * FROM funcionarios";
}
$sentencia = $conexion->prepare($consultaSQL);
$sentencia->execute();
$funcionarios = $sentencia->fetchAll();
?>

<div class="container">
  <div class="row">
    <div class="col-md-12">
    <center><h2 class="mt-3">Lista de Funcionarios</h2></center>
    <br>
    <div class="boton">
      <a href="crearF.php">Crear</a>
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
            <th>No de Documento</th>
            <th>Teléfono</th>
            <th>Correo Electrónico</th>
            <th>Tipo de Funcionario</th>
          </tr>
        </thead>
        <tbody>
<?php
        if (!empty($funcionarios)) {
    foreach ($funcionarios as $funcionario) {
        echo "<tr>";
        echo "<td>{$funcionario['Id_Funcionario']}</td>";
        echo "<td>{$funcionario['Nombres']}</td>";
        echo "<td>{$funcionario['Apellidos']}</td>";
        echo "<td>{$funcionario['No_Documento']}</td>";
        echo "<td>{$funcionario['Telefono']}</td>";
        echo "<td>{$funcionario['Correo_Electronico']}</td>";
        echo "<td>{$funcionario['Tipo_Funcionario']}</td>";
        echo "<td><a class='bt-editar' href=\"editarF.php?Id_Funcionario={$funcionario['Id_Funcionario']}\">Editar</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>No se encontraron funcionarios</td></tr>";
}

?>


</div>
</div>