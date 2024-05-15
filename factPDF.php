<?php
require("conexion.php");
require('fpdf/fpdf.php');

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ggm";

$conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(isset($_GET['Id_Estudiante'])) {
    $Id_Estudiante = $_GET['Id_Estudiante'];

    $consulta_pago = "SELECT Ciudad, Fecha, Descuento, Monto, Tipo_Funcionario 
                      FROM Matricula
                      INNER JOIN Funcionarios ON Matricula.Id_Funcionario = Funcionarios.Id_Funcionario
                      WHERE Matricula.Id_Estudiante = $Id_Estudiante"; 
    $resultado_pago = mysqli_query($conexion, $consulta_pago);

    $consulta_estudiante = "SELECT Nombres, Apellidos, No_Tarjeta_Identidad, Nombre_Grado 
                            FROM Estudiante 
                            INNER JOIN Grados ON Estudiante.Id_Grado = Grados.Id_Grado
                            WHERE Estudiante.Id_Estudiante = $Id_Estudiante"; 
    $resultado_estudiante = mysqli_query($conexion, $consulta_estudiante);

    if ($resultado_pago && $resultado_estudiante) {
        $datos_pago = mysqli_fetch_assoc($resultado_pago);
        $datos_estudiante = mysqli_fetch_assoc($resultado_estudiante);

        if ($datos_estudiante && $datos_pago) {
            $pdf = new fpdf("L", "mm", array(100, 150));
            $pdf->isUnicode = true;
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont("Arial", "B", 15);
            $pdf->Cell(0, 10, utf8_decode("Factura de Matrícula"), 0, 1, "C");
            $pdf->Image("img/logo ggm.png", 10, 8, 12, 0); 
            $pdf->SetFont("Arial", "", 10);

            $pdf->Cell(0, -11, "Fecha: ".$datos_pago['Fecha'], 0, 1,"R");
            $pdf->Cell(0, 13, "", 0, 1); 
            $pdf->Cell(0, 8, utf8_decode("Nombre: ".$datos_estudiante['Nombres']." ".$datos_estudiante['Apellidos']), 0, 1,"C");
            $pdf->Cell(0, 8, "No. Documento: ".$datos_estudiante['No_Tarjeta_Identidad'], 0, 1,"C");
            $pdf->Cell(0, 8, utf8_decode("Grado: ".$datos_estudiante['Nombre_Grado']), 0, 1,"C");
            $pdf->Cell(0, 8, utf8_decode("Ciudad: ".$datos_pago['Ciudad']), 0, 1,"C");
            $pdf->Cell(0, 8, "Descuento: ".$datos_pago['Descuento'], 0, 1,"C");
            $pdf->Cell(0, 8, "Monto: ".$datos_pago['Monto'], 0, 1,"C");
            $pdf->Cell(0, 8, "Tipo de Funcionario: ".$datos_pago['Tipo_Funcionario'], 0, 1,"C");

            $pdf->Output("FacturaMatricula.pdf", "D");
        }
    }
}
mysqli_close($conexion);
?>