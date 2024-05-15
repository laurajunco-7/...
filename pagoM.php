<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Colegio Gabriel García Márquez</title>
  <link rel="stylesheet" href="css/menu.css">
  <link rel="stylesheet" href="css/pagoM.css">
  <link rel="shortcut icon" href="img/logo ggm.png" type="image/x-icon">
</head>
<body>
<header style=" z-index: 100;">
                <img src="img/logo ggm.png" alt=""class ="logo">
                <h3>Colegio Gabriel García Márquez</h3>
                <nav >
                  <ul class="menu-horizontal">
                    <li><a href="index.html"class="label1" >Inicio</a></li>
                    <li><a href="conocenos.html" class="label1">Conócenos</a></li>
                    <li><a href="contact.html"class="label1">Contáctenos</a> </li>
                    <li>
                      <a class="barra"  href="iniciosesion.html">Iniciar Sesión</a>
                      <ul class="menu-vertical">    
			  <li><a href="iniciosesion.html"class=lat2>Matrícula</a></li>
			  <li><a href="iniciosesion.html" class=lat2>Pensión</a></li>
			  <li><a href="login_A.html" class=lat2>Administrador</a></li>
                      </ul>
                    </li>
                  </ul>
                </nav>
        </header>


<?php
$inc = include("conexion.php");

if ($inc) {
    $busqueda_realizada = false;

    if (isset($_GET['buscar'])) {
        $busqueda = $_GET['buscar'];
        $consulta = "SELECT Id_Estudiante, Nombres, Apellidos, No_Tarjeta_Identidad, Foto FROM Estudiante 
        WHERE Nombres LIKE '%$busqueda%'";
        $busqueda_realizada = true;
    } else {
        $consulta = "SELECT Id_Estudiante, Nombres, Apellidos, No_Tarjeta_Identidad, Foto FROM Estudiante";
    }

    $result = mysqli_query($conexion, $consulta);

    if ($result) {
?>
        <form action="" method="GET" class="form-busqueda" autocomplete="off">
            <input type="text" class="buscar" name="buscar" placeholder="Buscar por nombre">
            <button class="submitBtn" type="submit">Buscar</button>
        </form>

        <?php if ($busqueda_realizada) { ?>
            <form action="" class="form-principal">
                <?php while ($row = $result->fetch_array()) {
                    $Nombres = $row['Nombres'];
                    $Apellidos = $row['Apellidos'];
                    $No_Tarjeta_Identidad = $row['No_Tarjeta_Identidad'];
                    $Foto = $row['Foto'];
                ?>
                    <div class="foto">
                      <img width="140px" height="145px" src="data:image/png;base64, <?php echo base64_encode($Foto); ?>" alt="Foto del estudiante">
                    </div>

                    <div class="inputContainer">
                        <input class="inputE" type="text" name="Nombres" placeholder="Nombre" value="<?php echo $Nombres; ?>">
                    </div>

                    <div class="inputContainer">
                        <input class="inputE" type="text" name="Apellidos" placeholder="Apellido" value="<?php echo $Apellidos; ?>">
                    </div>

                    <div class="inputContainer">
                        <input class="inputE" type="text" name="No_Tarjeta_Identidad" placeholder="N° de documento" value="<?php echo $No_Tarjeta_Identidad; ?>">
                    </div>

                    <div class="boton">
                        <a class="submitBt" href="facturaM.php?Id_Estudiante=<?php echo $row['Id_Estudiante']; ?>">Generar Factura</a>
                    </div>
                <?php } ?>
            </form>
        <?php } ?>
<?php
    }
}
?>

<html>
<footer>
    <div class="v-line6M"></div>
  
    <div class="footer">
  
      <div class="contac">
  
        <div class="tex1f">
  
          <h2>Contacto</h2>
        </div>
        <div class="tex1f1">
          <h5>Tunja - Boyacá Tv. 3 #67 - 14</h5>
        </div>
        <div class="tex1f3">
          <h5>+57 314 3316222</h5>
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
          <li><a href="index.html" class="label12">Principal</a></li>
          <li><a href="conocenos.html" class="label12">Conócenos</a></li>
          <li><a href="contact.html" class="label12">Contáctenos</a> </li>
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
  </div>
  </footer>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap');
*{
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
}
header {
    background-color: #f6f4ba;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100px;
    padding-top: 10px;
}
.menu-horizontal{
    margin-top: 30px;
}
h3{
    margin-left: 180px;
    top: -50px;
    position: relative;
}
.logo {
    margin-left: 70px;
    margin-top: 10px;
    width: 55px;
    height: 65px;
}

.form-busqueda {
  text-align: center;
  margin-top: 140px;
}
.buscar {
  width: 800px;
  padding: 10px;
  border: 2px solid #ccc;
  border-radius: 12px;
  box-sizing: border-box;
  font-size: 1em;
  margin-left: -20px;
}
.buscar::placeholder {
color: #aaa;
}
.buscar:focus {
outline: none;
border-color: #45a049;
}
.submitBtn {
  width: 150px;
  padding: 10px;
  background-color: #4CAF50;
  color: white;
  border: none;
  border-radius: 12px;
  cursor: pointer;
  justify-content: center;
  font-size: 1em;
  text-decoration: none;
  margin-left: 10px; /* Ajusta este valor según sea necesario */
  margin-top: 0; /* Elimina el margen superior */
}

.submitBtn:hover {
  background-color: #45a049;
}
.boton{
  width: 250px;
  padding: 10px;
  background-color: #4CAF50;
  border: none;
  border-radius: 12px;
  font-size: 1em;
  margin-left: 40%;
  text-align: center;
}
.boton>a{
text-decoration: none;
color: white;
}
.boton>a:hover{
background-color: #45a049;
}
.inputE {
  width: 500px;
  padding: 8px;
  border: 2px solid #ccc;
  border-radius: 12px; 
  box-sizing: border-box; 
  text-align: center;
  font-size: 1em;
}
.inputE:focus {
  outline: none;
  border-color: #45a049;
}
.inputContainer {
  margin-bottom: 10px;
  justify-content: center;
  margin-left: 30%;
}
.foto{
  margin-left: 43%;
}
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
footer{
  height: 380px;
  background-color: #308446;
  box-shadow: 0 5px 11px 5px  #f1ee90;
  color: white;
}
  </style>
</body>
</html>