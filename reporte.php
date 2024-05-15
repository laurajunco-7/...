<?php
require "conexion.php";
require "fpdf/fpdf.php";

$nombreE = $_POST['nombreE'];

$sql = "SELECT e.Nombres, e.Apellidos, g.Nombre_Grado FROM Estudiante 
AS e INNER JOIN grados AS g ON e.Id_Grado=g.Id_Grado WHERE e.Nombres LIKE '$nombreE'";

$resultado = $mysqli->query($sql);

$pdf = new fpdf("L", "mm", array(100, 150));
$pdf->AliasNbPages();
$pdf-> AddPage();
$pdf-> SetFont("Arial", "B", 12);
$pdf->Cell(15);
$pdf-> Cell(100, 5, "Factura",0, 0, "C");
$pdf-> SetFont("Arial", "", 9);
$pdf-> Cell(10, 5, "Fecha: ". date("d/m/Y"),0, 1, "C");
$pdf->Image("img/logo ggm.png", 10, 4, 10, );

$pdf-> Ln(2);

$pdf-> SetFont("Arial", "B", 9);
$pdf->Cell(40, 5, "Nombre",1 ,0, "C");
$pdf->Cell(40, 5, "Apellido",1, 0, "C");
$pdf->Cell(40, 5, "Grado",1, 1, "C");

$pdf-> SetFont("Arial", "", 9);

while($fila = $resultado->fetch_assoc()){
$pdf->Cell(40, 5, $fila['Nombres'],1 ,0, "C");
$pdf->Cell(40, 5, $fila['Apellidos'],1, 0, "C");  
$pdf->Cell(40, 5, $fila['Nombre_Grado'],1, 1, "C"); 
}

$pdf->Output();
?>