<?php
require("conexion.php");
require('fpdf/fpdf.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Id_Estudiante = $_POST['Id_Estudiante'];
    $Ciudad = $_POST['Ciudad'];
    $Fecha = $_POST['Fecha'];
    $Descuento = $_POST['Descuento'];
    $Monto = $_POST['Monto'];
    $Tipo_Funcionario = $_POST['Tipo_Funcionario'];
    $buscar = isset($_POST['buscar']) ? $_POST['buscar'] : '';

    $consulta_estudiante = "SELECT Nombres, Apellidos, No_Tarjeta_Identidad, Nombre_Grado 
                            FROM Estudiante 
                            INNER JOIN Grados ON Estudiante.Id_Grado = Grados.Id_Grado
                            WHERE Estudiante.Id_Estudiante = $Id_Estudiante"; 
    $resultado_estudiante = mysqli_query($conexion, $consulta_estudiante);

    if ($resultado_estudiante) {
        $datos_estudiante = mysqli_fetch_assoc($resultado_estudiante);

        if ($datos_estudiante) {
            $pdf = new fpdf("L", "mm", array(100, 150));
            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont("Arial", "B", 15);
            $pdf->Cell(0, 10, utf8_decode("Factura de Pensión"), 0, 1, "C");
            $pdf->Image("img/logo ggm.png", 10, 8, 12, 0); 
            $pdf->SetFont("Arial", "", 10);

            $pdf->Cell(0, -11, "Fecha: ".$Fecha, 0, 1,"R");
            $pdf->Cell(0, 13, "", 0, 1); 
            $pdf->Cell(0, 8, utf8_decode("Nombre: ".$datos_estudiante['Nombres']." ".$datos_estudiante['Apellidos']), 0, 1,"C");
            $pdf->Cell(0, 8, "No. Documento: ".$datos_estudiante['No_Tarjeta_Identidad'], 0, 1,"C");
            $pdf->Cell(0, 8, utf8_decode("Grado: ".$datos_estudiante['Nombre_Grado']), 0, 1,"C");
            $pdf->Cell(0, 8, utf8_decode("Ciudad: ".$Ciudad), 0, 1,"C");
            $pdf->Cell(0, 8, "Descuento: ".$Descuento, 0, 1,"C");
            $pdf->Cell(0, 8, "Monto: ".$Monto, 0, 1,"C");
            $pdf->Cell(0, 8, utf8_decode("Tipo de Funcionario: ".$Tipo_Funcionario), 0, 1,"C");

            $pdf->Output("FacturaPension.pdf", "D");
        }
    }
}
mysqli_close($conexion);
?>