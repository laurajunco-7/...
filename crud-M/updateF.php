<?php
    include '../conexion.php';

    $Id_Funcionario = $_POST['Id_Funcionario'];
    $Nombres = $_POST['Nombres'];
    $Apellidos = $_POST['Apellidos'];
    $No_Documento = $_POST['No_Documento'];
    $Telefono = $_POST['Telefono'];
    $Correo_Electronico = $_POST['Correo_Electronico'];
    $Tipo_Funcionario = $_POST['Tipo_Funcionario'];

    $sql = "UPDATE funcionarios SET Id_Funcionario='$Id_Funcionario', Nombres='$Nombres', Apellidos='$Apellidos', No_Documento='$No_Documento',
    Telefono='$Telefono', Correo_Electronico='$Correo_Electronico', Tipo_Funcionario='$Tipo_Funcionario' WHERE Id_Funcionario = '$Id_Funcionario'";

    $resultado = mysqli_query($conexion, $sql);
    if($resultado) {
        header('Location: funcionarios.php');
    } else {
        $mensaje = "ERROR AL MODIFICAR";
    }

?>

<html lang="es">
    <body>
        <div class="container">
            <div class="row">
                <div class="row" style="text-align:center">
                    <h3><?php echo $mensaje; ?></h3>
                    <a href="funcionarios.php" class="btn btn-primary">Regresar</a>
                </div>
            </div>
        </div>
    </body>
</html>