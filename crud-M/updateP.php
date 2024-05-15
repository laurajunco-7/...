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

if (isset($_POST['Id_Pension'])) {
    $Id_Pension = $_POST['Id_Pension'];
    $funcionario_nombres = $_POST['funcionario_nombres'];
    $funcionario_apellidos = $_POST['funcionario_apellidos'];
    $acudiente_nombres = $_POST['acudiente_nombres'];
    $acudiente_apellidos = $_POST['acudiente_apellidos'];
    $estudiante_nombres = $_POST['estudiante_nombres'];
    $estudiante_apellidos = $_POST['estudiante_apellidos'];
    $Fecha = $_POST['Fecha'];
    $Ciudad = $_POST['Ciudad'];
    $Descuento = $_POST['Descuento'];
    $Monto = $_POST['Monto'];

    $funcionario_id = null;
    $acudiente_id = null;
    $estudiante_id = null;
    
    if (id_exists($conexion, 'funcionarios', 'Nombres', $funcionario_nombres) && id_exists($conexion, 'funcionarios', 'Apellidos', $funcionario_apellidos)) {

        $sql = "SELECT Id_Funcionario FROM funcionarios WHERE Nombres = ? AND Apellidos = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $funcionario_nombres, $funcionario_apellidos);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $funcionario_id = $row['Id_Funcionario'];
    }

    if (id_exists($conexion, 'acudiente', 'Nombres', $acudiente_nombres) && id_exists($conexion, 'acudiente', 'Apellidos', $acudiente_apellidos)) {

        $sql = "SELECT Id_Acudiente FROM acudiente WHERE Nombres = ? AND Apellidos = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $acudiente_nombres, $acudiente_apellidos);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $acudiente_id = $row['Id_Acudiente'];
    }

    if (id_exists($conexion, 'estudiante', 'Nombres', $estudiante_nombres) && id_exists($conexion, 'estudiante', 'Apellidos', $estudiante_apellidos)) {

        $sql = "SELECT Id_Estudiante FROM estudiante WHERE Nombres = ? AND Apellidos = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $estudiante_nombres, $estudiante_apellidos);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $estudiante_id = $row['Id_Estudiante'];
    }

    $sql = "UPDATE pension SET Id_Funcionario=?, Id_Acudiente=?, 
            Id_Estudiante=?, Fecha=?, Ciudad=?, Descuento=?, 
            Monto=? WHERE Id_Pension = ?";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iiissssi", $funcionario_id, $acudiente_id, $estudiante_id, $Fecha, $Ciudad, $Descuento, $Monto, $Id_Pension);

    if ($stmt->execute()) {
        header('Location: pension.php');
    } else {
        $mensaje = "ERROR AL MODIFICAR: " . $stmt->error;
    }
} else {
    $mensaje = "ID de pensión no proporcionado.";
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
                <a href="pension.php" class="btn btn-primary">Regresar</a>
            </div>
        </div>
    </div>
</body>
</html>