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

if (isset($_GET['Id_Funcionario'])) {
    $Id_Funcionario = $_GET['Id_Funcionario'];

    $row = get_data($conexion, "SELECT * FROM funcionarios WHERE Id_Funcionario =?", 'i', $Id_Funcionario);

    if ($row === null) {
        echo "No se encontró ningún funcionario con el ID proporcionado.";
        exit;
    }
} else {
    echo "ID de funcionario no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Registro</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.css" rel="stylesheet">
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <h2 style="text-align:center">Editar Funcionario</h2>
        </div>
        
        <form class="form-horizontal" method="POST" action="updateF.php" autocomplete="off">
            <input type="hidden" name="Id_Funcionario" value="<?php echo $row['Id_Funcionario']; ?>">

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
                <label for="No_Documento" class="col-sm-2 control-label">No de Documento</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="No_Documento" name="No_Documento" placeholder="No_Documento" value="<?php echo $row['No_Documento']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Telefono" class="col-sm-2 control-label">Teléfono</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Telefono" name="Telefono" placeholder="Telefono" value="<?php echo $row['Telefono']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Correo_Electronico" class="col-sm-2 control-label">Correo Electrónico</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Correo_Electronico" name="Correo_Electronico" placeholder="Correo_Electronico" value="<?php echo $row['Correo_Electronico']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Tipo_Funcionario" class="col-sm-2 control-label">Tipo de Funcionario</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Tipo_Funcionario" name="Tipo_Funcionario" placeholder="Tipo_Funcionario" value="<?php echo $row['Tipo_Funcionario']; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <center><a href="funcionarios.php" class="btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button></center>
                </div>
            </div>
        </form>
    </div>
</body>
</html>