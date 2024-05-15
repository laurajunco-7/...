<html>
    <title>Colegio Gabriel García Márquez</title>
    <link rel="stylesheet" href="css/facturaM.css">
    <link rel="stylesheet" href="css/menu.css">
    <link rel="stylesheet" href="css/button.css">
    <link rel="shortcut icon" href="img/logo ggm.png" type="image/x-icon">
  <header>
    <img src="img/logo ggm.png" alt=""class ="logo">
    <h3>Colegio Gabriel García Márquez</h3>
    <nav >
      <ul class="menu-horizontal">
        <li><a href="Index.html"class="label1" >Inicio</a></li>
        <li><a href="conocenos.html" class="label1">Conócenos</a></li>
              <li><a href="contact.html"class="label1">Contáctenos</a> </li>
        <li>
          <a class="barra"  href="iniciosesion.html">Iniciar Sesión</a>
          <ul class="menu-vertical">    
              <li><a href="pagoM.php"class=lat2>Matrícula</a></li>
              <li><a href="pagoP.php" class=lat2>Pensión</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </header>
</html>


<?php
include("conexion.php");

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ggm";

$conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

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
        "Estudiante: " . $datos_estudiante['Nombres'] . " " . $datos_estudiante['Apellidos'] . "<br>";
        "Ciudad: " . $datos_pago['Ciudad'] . "<br>";
        "Fecha: " . $datos_pago['Fecha'] . "<br>";
        "Descuento: " . $datos_pago['Descuento'] . "<br>";
        "Monto: " . $datos_pago['Monto'] . "<br>";
        "Tipo de Funcionario: " . $datos_pago['Tipo_Funcionario'] . "<br>";
        "Grado: " . $datos_estudiante['Nombre_Grado'] . "<br>";
        "No. Tarjeta de Identidad: " . $datos_estudiante['No_Tarjeta_Identidad'] . "<br>";
    } else {
        echo "No se encontraron datos para el estudiante con ID $Id_Estudiante.";
    }
}

mysqli_close($conexion);
?>  


<form action="factPDF.php" method="GET" class="form">
    <div class="datosEst">        
        <div class="inputContainer">
            <input type="text" class="inputE" name="ciudad" placeholder="Ciudad" value="<?php echo isset($datos_pago['Ciudad']) ? $datos_pago['Ciudad'] : ''; ?>">
        </div>

        <div class="inputContainer">
            <input type="text" class="inputE" name="Nombre" placeholder="Nombre" value="<?php echo isset($datos_estudiante['Nombres']) && isset($datos_estudiante['Apellidos']) ? $datos_estudiante['Nombres'] . ' ' . $datos_estudiante['Apellidos'] : ''; ?>">
        </div>
         
        <div class="inputContainer">
            <input type="text" class="inputE" name="Documento" placeholder="N° de documento" value="<?php echo isset($datos_estudiante['No_Tarjeta_Identidad']) ? $datos_estudiante['No_Tarjeta_Identidad'] : ''; ?>">
        </div>

        <div class="inputContainer">
            <input type="text" class="inputE" name="Grado" placeholder="Grado" value="<?php echo isset($datos_estudiante['Nombre_Grado']) ? $datos_estudiante['Nombre_Grado'] : ''; ?>">
        </div>
    </div>

    <div class="datosP">        
        <div class="inputContainer">
            <input type="text" class="inputP" name="datos" placeholder="Fecha" value="<?php echo isset($datos_pago['Fecha']) ? $datos_pago['Fecha'] : ''; ?>">
        </div>

        <div class="inputContainer">
            <input type="text" class="inputP" name="datos" placeholder="Descuento" value="<?php echo isset($datos_pago['Descuento']) ? $datos_pago['Descuento'] : ''; ?>">
        </div>
         
        <div class="inputContainer">
            <input type="text" class="inputP" name="datos" placeholder="Valor Total" value="<?php echo isset($datos_pago['Monto']) ? $datos_pago['Monto'] : ''; ?>">
        </div>

        <div class="inputContainer">
            <input type="text" class="inputP" name="datos" placeholder="Recibido por: " value="<?php echo isset($datos_pago['Tipo_Funcionario']) ? $datos_pago['Tipo_Funcionario'] : ''; ?>">
        </div>
    </div>

    <input type="hidden" name="buscar" value="<?php echo isset($_GET['buscar']) ? $_GET['buscar'] : ''; ?>">
    <center>
    <input type="hidden" name="Id_Estudiante" value="<?php echo $Id_Estudiante; ?>">

    <button class="download-button" name="buscar" >
      <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line y2="13" x2="8" y1="13" x1="16"></line><line y2="17" x2="8" y1="17" x1="16"></line><polyline points="10 9 9 9 8 9"></polyline></svg> Descargar</div>
      <div class="download">
      <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line y2="3" x2="12" y1="15" x1="12"></line></svg>
      </div>
      
    </button>
    </center>
</form>

<footer>
    <div class="v-line6M"></div>

    <div class="footer">
      <div class="contac">
        <div class="tex1f">
          <H2>Contacto</H2>
        </div>
        <div class="tex1f1">
          <h5>Tunja - Boyacá Tv. 3 #67 - 14</H5>
        </div>
        <div class="tex1f3">
          <h5>+57 314 3316222</H5>
        </div>
        <div class="tex1f2">
          <h5>Secretaria@colegiogabrielgarciamarquez.edu.co</H5>
        </div>
      </div>
    </div>
  
    <div class="alinmenu">
      <nav class="menu2">
        <div class="tex1fM">
          <H3>Menú</H3>
        </div>
        <ul class="menu-horizontal2">
          <li><a href="#" class="label12">Principal</a></li>
  
          <li><a href="#" class="label12">Conócenos</a></li>
          <li><a href="#" class="label12">Contáctenos</a> </li>
        </ul>
      </nav>
    </div>
  
    <div class="v-line7M"></div>
  
    <div class="redes">
        <div class="tex2ff">
            <H2>Redes Sociales</H2>
        </div>
        <div class="social">
        <a class="fac" href="#"><img
            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAACXBIWXMAAAsTAAALEwEAmpwYAAACd0lEQVR4nO2Zv2sUQRTHP+evwigSrCyiAWOpTXpBxcRcCkn8BVrZif+AjUJQSA5Jo4VpbMQiJtrE/CCojZ3YGEQx9nYaE6PRxOJWBp4Qwu7czuzb3Tm4L3zhmn1vPszsm7fvoKWWgtceoArUgGlgEfgO/BWb35+A58AI0CfPBKGKLGgSWAciR/8BJoAzEqsUXQDeeyw+yQvAYJEAR4BXigBb/QLoyhviHLCSI0QkXgUu5wFgzu9QAQDRFtc03x0TaKwEiEj8QAtmpESISHwnK8SlACAi8ZUs1emn0iLMffFQSraJux/YB7QDncBRYLRBjB/AYR8QrRL7EjiQIt/VFLHmXSHOK0HMAjtS5kwDYjyQFqKidGN/kyOEMsi7tFWsT2k3hh0gXEAioDdNwEklkGOWHN3Afcn1328dYo83gtjr2cXGVZjtFoiNjPF/A7ttIFXFTjZJj5Ry9NhAakpJXltyfCniHZxWSjKXEL8iX4saOaZsIJ8V74847VKKH8lnc6KWmgjkqw1ko4lA1rVBBqT522zbdKQ9wXcd85q1JmrZA+Q0Onri0QIlarFEENNDueT9aAs2WxLINmBNs/wOlwRySPvzt98j4HXpnza7y3Ihdsf4mkfeXhuIacR+eQQtuvyuAW2NtvlpE4BMkEI9TQByKg2IOccfAgZZwEFnAwapUuA4KC+QeTzUKVPxUEBWgIN4yjSE9QBA6sBFMup2ACBDKOleiSCjKOuGwzHTAKlr7kTcX2/LBYAsucx4s3SqMzmCTAEdFKh+y5jTB+SNzJ1L03HgsYxJXUFWZfJoYgQjs8iTwE0pDHHaCTwDbgEn5JmWWiJg/QOlYrQmouYwLQAAAABJRU5ErkJggg=="
            alt="facebook"></a>
        <a class="socialT" href="https://www.facebook.com/colggmtunja/?locale=es_LA"><h4>facebook</h4></a>
        <a class="ins" href="#"><img
            src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAACXBIWXMAAAsTAAALEwEAmpwYAAACzElEQVR4nO2ZTU8UQRCGn2FdLyI3MfAjUK9GMQomEhORZPkzKgc/4kcQInLyrCCLCSH+Bi8C4aiINxEi3lw8Eta0qU0qlc3s9PTMLAnzJp1sMlXVb+1UVVfXQIkSJU4UeoBrwCywAewBh0Az5ToUG87WDDAMRHmRvwlsBpBNujaAkSyJV4DnBRBvmvUGOJUF+Y/G8B/gFXAdGBCZEPsDwA1gDmiYvVYD7f8nqg2+A86RH/qBRbOny7fUMa8NPaQ4PDZ7uzfkXW02zT9fJCLgvUlsr+o0bGI+z7C5DfwEdoAxE046J674GJ1Vii4P8sSO2uuHefZaPXvpY3Q9ZfxVgUlJxC3gryz3e0GeVT0cGFXP1nwc2FOKrswlwQTwPUF9dzJ3ld6YOOHI3zI2B5Xero8Duj2oJEj4FykOqmeiG4eKaTsSQ2/UCZb8L+AecAE4I+sicF+eWSey5OKtNGFkl4DeGPmzQN3ojHfLgdMm5pcS1mons6z0ttskdiEOTJqwifvn272JfaVfC+SSSkn3LC7mffEg4UmfmwPflMwQ/nCJ3dLfCuSSSulAyfiETwtOp6V/EMilKw70mX4rhMvJDKEFJeMOKV9MKf23gVwyKaOuNPqEz+9ul9GqOcjqHgfZh+NwkCFdpZZd7vAm+gz5I+AO8cjVAaQh0/L7ckhdkurUK7+nTNi49TRjLqnbaetEp3Uk5HvyaqfTXGjGJZ47kd9OEDbBF5qQK2VNepuvcti59UVKZa1DwhJzpfyMB2aUopuYdQvzisd02rFKQ0YcReO8aVe8xiqRDJNayq51LhKRXJD0RMJ77D5iku8RxSACnpi93SA5FfSAqynjvv6cw6Zu9vSK/XZ1eNUYbMjEbFTKXOh4fVBszZuYd2sldLzezQ8cc1mQ17gMfCqA+HpIzCdJsKsyaF2T0zH0I9+u2JqWUpnbR74SJUpw/PAPTR8Xwmzb1i8AAAAASUVORK5CYII="
            alt="instagram"></a>
        <a class="socialT" href="https://www.instagram.com/colggmtunja/"><h4>instagram</h4></a>
    </div>
</footer>




<style>
.alinmenu{
  padding-left: 110px;
  margin-top: -50px;
  margin-left: -7%;
  width: 20%;
  height: 50%;
 }
 .contac{
  padding-top: 90px;
  margin-top: 140px;
  width: 20%;
  margin-left: 70px;
  }
 .menu2{
  margin-left: 600px;
  margin-top: -50px;
 }
 .tex1fM{
  display: inline-block;
  padding-left: 22px;
  margin-bottom: 5px;
  margin-left: -170px;
 }
 .mb-4{
  margin-top: 20px;
 }
 .mb-5{
  margin-top: 44px;
  margin-bottom: -20px;
 }
.tex1f1>h5{
  bottom: 10px;
}
.tex2f1>h2{
  bottom: 10px;
}
.tex3f1>h2{
  top: 10px;
}

.socialT>h4{
  color: white;
  margin-left: 10px;

}
.fac img {
  filter: brightness(0) invert(1) sepia(1) hue-rotate(180deg) saturate(5);
}

.ins img {
  filter: brightness(0) invert(1) sepia(1) hue-rotate(180deg) saturate(5);
}
.tex2ff>h2{
  color: white;
}
.socialT:hover h4{
  color: black;
}
footer{
  height: 380px;
  background-color: #308446;
  box-shadow: 0 5px 11px 5px  #f1ee90;
  color: white;
}
.v-line1M{
  margin-top: 6px;
  border-left: 3px solid #000;
  height:27px;
  left: 10%;
  position: absolute;
}
h3.ti :hover{
color: #308446;}

/*Lienas footer*/
.v-line6M{
  margin-top: 80px;
  border-left: 3px solid white;
  height:220px;
  left: 38%;
  position: absolute;
}
.v-line7M{
  margin-top: -217px;
  border-left: 3px solid white;
  height:220px;
  left: 67%;
  position: absolute;
}
/*iconos*/
.redes{
  margin-left: 1025px;
  margin-top: -250px;
}
.socialT{
  color: white;
  text-decoration: none;
  margin-left: 79px;
  margin-top: -30px; 
}
.socialT:hover{
  color: white ;
}
.social{
  width:48px;
  right:0;
  padding-bottom: 20px;
  gap: 30px;
  margin-left: 50.5px;
  margin-top: -40px;
}
.tex2ff{
  margin-bottom: 50px;
}
.menu2>ul{
    margin-top: -50px;
}
</style>