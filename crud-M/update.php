<?php
    include '../conexion.php';

    $Id_Estudiante = $_POST['Id_Estudiante'];
    $Nombres = $_POST['Nombres'];
    $Apellidos = $_POST['Apellidos'];
    $Nombre_Grado = $_POST['Nombre_Grado'];
    $Fecha_Nacimiento = $_POST['Fecha_Nacimiento'];
    $Lugar_Nacimiento = $_POST['Lugar_Nacimiento'];
    $RH = $_POST['RH'];
    $No_Registro_Civil = $_POST['No_Registro_Civil'];
    $No_Tarjeta_Identidad = $_POST['No_Tarjeta_Identidad'];
    $Direccion = $_POST['Direccion'];
    $Barrio = $_POST['Barrio'];
    $Telefono = $_POST['Telefono'];
    $Nombre_EPS = $_POST['Nombre_EPS'];
    $Genero = $_POST['Genero'];
    $Correo_Electronico = $_POST['Correo_Electronico'];
    $Foto = $_POST['Foto'];

    // Obtén el nombre del archivo y la ubicación temporal
$Foto = $_FILES['Foto']['name'];
$Foto_temp = $_FILES['Foto']['tmp_name'];

// Mueve la foto cargada al directorio de destino
$destino = "carpeta_destino/" . $Foto;
move_uploaded_file($Foto_temp, $destino);


$sql = "UPDATE estudiante SET Nombres='$Nombres', Apellidos='$Apellidos', Id_Grado='$Nombre_Grado', Fecha_Nacimiento='$Fecha_Nacimiento',
Lugar_Nacimiento='$Lugar_Nacimiento', RH='$RH', No_Registro_Civil='$No_Registro_Civil', No_Tarjeta_Identidad='$No_Tarjeta_Identidad', 
Direccion='$Direccion', Barrio='$Barrio', Telefono='$Telefono', Id_EPS='$Nombre_EPS',
Genero='$Genero', Correo_Electronico='$Correo_Electronico', Foto='$Foto' WHERE Id_Estudiante = '$Id_Estudiante'";


    $resultado = mysqli_query($conexion, $sql);
    if($resultado) {
        header('Location: estudiantes.php');
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
                    <a href="estudiantes.php" class="btn btn-primary">Regresar</a>
                </div>
            </div>
        </div>
    </body>
</html>