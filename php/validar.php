<?php
require 'Conexion.php';

$Email=$_POST['Email'];
$Contraseña=$_POST['Contraseña'];
session_start();
$_SESSION['Email']=$Email;

$con=mysqli_connect("localhost","root","","comparision_database");

$consulta="SELECT * FROM usuario where Email='$Email' and Contraseña='$Contraseña'";
$resultado=mysqli_query($con,$consulta);


//$filas=$resultado->mysqli_fetch_assoc();
$filas=$resultado->fetch_array();


if(isset($filas['Id_Rol']) && $filas['Id_Rol']==1){ //cliente 
   
    header("location:../usuario/vistausuario.php");

}else
if(isset($filas['Id_Rol']) && $filas['Id_Rol']==2){ //administrador
  
header("location:../administrador/vistaadmin.php");
}
else
?>

<link rel="stylesheet" href="../css/validar.css">
<div class="box">
<div class ="box2">
<h1 class="bad">ERROR EN LA AUTENTIFICACION</h1>
<a href="../index.html" class=boton>Volver a Iniciar Sesion</a>
</div>
</div>

<?php

mysqli_free_result($resultado);
mysqli_close($con);

?>

