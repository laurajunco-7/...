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

if (isset($_GET['Id_Pension'])) {
    $Id_Pension = $_GET['Id_Pension'];

    $row = get_data($conexion, "SELECT p.*, 
                            f.Nombres AS funcionario_nombres, f.Apellidos AS funcionario_apellidos,
                            a.Nombres AS acudiente_nombres, a.Apellidos AS acudiente_apellidos,
                            e.Nombres AS estudiante_nombres, e.Apellidos AS estudiante_apellidos
                            FROM pension p 
                            LEFT JOIN funcionarios f ON p.Id_Funcionario = f.Id_Funcionario 
                            LEFT JOIN acudiente a ON p.Id_Acudiente = a.Id_Acudiente 
                            LEFT JOIN estudiante e ON p.Id_Estudiante = e.Id_Estudiante 
                            WHERE p.Id_Pension =?", 'i', $Id_Pension);

    if ($row === null) {
        echo "No se encontró ninguna matricula con el ID proporcionado.";
        exit;
    }
} else {
    echo "ID de pensión no proporcionado.";
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
            <h2 style="text-align:center">Editar Pensión</h2>
        </div>
        
        <form class="form-horizontal" method="POST" action="updateP.php" autocomplete="off">
            <input type="hidden" name="Id_Pension" value="<?php echo $row['Id_Pension']; ?>">

            <div class="form-group">
                <label for="funcionario_nombres" class="col-sm-2 control-label">Nombres del Funcionario</label>
                <div class="col-sm-10">
                    <input type="text" name="funcionario_nombres" id="funcionario_nombres" value="<?php echo $row['funcionario_nombres']; ?>">
                    <input type="text" name="funcionario_apellidos" id="funcionario_apellidos" value="<?php echo $row['funcionario_apellidos']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="acudiente_nombres" class="col-sm-2 control-label">Nombres del Acudiente</label>
                <div class="col-sm-10">
                    <input type="text" name="acudiente_nombres" id="acudiente_nombres" value="<?php echo $row['acudiente_nombres']; ?>">
                    <input type="text" name="acudiente_apellidos" id="acudiente_apellidos" value="<?php echo $row['acudiente_apellidos']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="estudiante_nombres" class="col-sm-2 control-label">Nombres del Estudiante</label>
                <div class="col-sm-10">
                    <input type="text" name="estudiante_nombres" id="estudiante_nombres" value="<?php echo $row['estudiante_nombres']; ?>">
                    <input type="text" name="estudiante_apellidos" id="estudiante_apellidos" value="<?php echo $row['estudiante_apellidos']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="Ciudad" class="col-sm-2 control-label">Ciudad</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Ciudad" name="Ciudad" placeholder="Ciudad" value="<?php echo $row['Ciudad']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Fecha" class="col-sm-2 control-label">Fecha</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="Fecha" name="Fecha" placeholder="Fecha" value="<?php echo $row['Fecha']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Descuento" class="col-sm-2 control-label">Descuento</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Descuento" name="Descuento" placeholder="Descuento" value="<?php echo $row['Descuento']; ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="Monto" class="col-sm-2 control-label">Monto</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="Monto" name="Monto" placeholder="Monto" value="<?php echo $row['Monto']; ?>" required>
                </div>
            </div>
            <!-- Otros campos del formulario -->

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <center><a href="pension.php" class="btn-default">Regresar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button></center>
                </div>
            </div>
        </form>
    </div>
</body>
</html>