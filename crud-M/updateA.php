<?php
require '../conexion.php';

function id_exists($mysqli, $table, $column, $value) {
    $sql = "SELECT COUNT(*) as count FROM $table WHERE $column = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $value);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    return $row['count'] > 0;
}

if (isset($_POST['Id_Acudiente'])) {
    $Id_Acudiente = $_POST['Id_Acudiente'];
    $Nombres = $_POST['Nombres'];
    $Apellidos = $_POST['Apellidos'];
    $estudiante_nombres = $_POST['estudiante_nombres'];
    $estudiante_apellidos = $_POST['estudiante_apellidos'];
    $No_Documento = $_POST['No_Documento'];
    $Direccion = $_POST['Direccion'];
    $Barrio = $_POST['Barrio'];
    $Ocupacion = $_POST['Ocupacion'];
    $Parentesco = $_POST['Parentesco'];
    $Telefono = $_POST['Telefono'];
    $Correo_Electronico = $_POST['Correo_Electronico'];

    $estudiante_id = null;

    if (id_exists($conexion, 'estudiante', 'Nombres', $estudiante_nombres) && id_exists($conexion, 'estudiante', 'Apellidos', $estudiante_apellidos)) {
        // Obtener el ID del estudiante
        $sql = "SELECT Id_Estudiante FROM estudiante WHERE Nombres = ? AND Apellidos = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $estudiante_nombres, $estudiante_apellidos);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $estudiante_id = $row['Id_Estudiante'];
    }

    // Construir la consulta UPDATE
    $sql = "UPDATE acudiente SET Nombres=?, Apellidos=?, Id_Estudiante=?, No_Documento=?, Direccion=?, Barrio=?,
    Ocupacion=?, Parentesco=?, Telefono=?, Correo_Electronico=? WHERE Id_Acudiente = ?";
    
    // Preparar la consulta
    $stmt = $conexion->prepare($sql);

    // Enlazar parámetros
    $stmt->bind_param("ssisssssssi", $Nombres, $Apellidos, $estudiante_id, $No_Documento, $Direccion, $Barrio,
    $Ocupacion, $Parentesco, $Telefono, $Correo_Electronico, $Id_Acudiente);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        header('Location: acudientes.php');
    } else {
        $mensaje = "ERROR AL MODIFICAR: " . $stmt->error;
    }
} else {
    $mensaje = "ID de matrícula no proporcionado.";
}
echo $mensaje;
?>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Modificación</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-theme.css" rel="stylesheet">
    <script src="../js/jquery-3.1.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="row" style="text-align:center">
                <h3><?php echo $mensaje; ?></h3>
                <a href="acudientes.php" class="btn btn-primary">Regresar</a>
            </div>
        </div>
    </div>
</body>
</html>