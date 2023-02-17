<?php
require '../php/conexion.php';
$con = conectar();

$query = "SELECT * FROM regionales ORDER BY Regional ASC";
$resultado= mysqli_query($con,$query);

if(isset($_POST['insert']))
{
 
    $Nombre=$_POST['Nombre'];
    $Apellidos=$_POST['Apellidos'];
    $Email=$_POST['Email'];
    $Contraseña=$_POST['Contraseña'];
    $Id_Rol=$_POST['Id_Rol'];
    $Id_Regional=$_POST['Id_Regional'];
    $Id_Centro=$_POST['Id_Centro'];
  
    $result=$con->query("CALL insertarporadmin('$Nombre','$Apellidos','$Email','$Contraseña','$Id_Rol','$Id_Regional','$Id_Centro')");

if($result)
{
    header("location:index.php");
}
else
{
    header("location:index.php");
}
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title> </title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/editar.css">
        <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</head>
<body>

<div class="contenedor">
    <nav>
      <ul>
        <li><a href="#" class="logo">
        <img src="../img/Sena_Colombia_logo.svg.png">
          <span class="nav-item">Administrador</span>
        </a></li>
        <li><a href="vistaadmin.php" class="texnav">
          <i class="fa fa-user"></i>
          <span class="nav-item">Perfil</span>
        </a></li>
        <li><a href="basesinterna.php" class="texnav">
          <i class="fa fa-database"></i>
          <span class="nav-item">Bases Interna</span></i>
        </a></li>
        <li><a href="basesexternas.php" class="texnav">
          <i class="fa fa-database"></i>
          <span class="nav-item">Bases Externas</i>
        </a></li>
        <li><a href="index.php" class="texnav">
          <i class="fa fa-cog">
          <span class="nav-item">Usuarios</i>
        </a></li>
      </ul>
    </nav>
    <section class="perfil">
    <div class="main-top">
      <a class="cerrar" href="../php/cerrarsesion.php">
      <i class="fa fa-sign-out">cerrar sesion</i></a>
      </div>

<div class="container">
    <div class="contenedor1">
        <form   name="insertrecord" method="POST">
            <h1>Regístrarsar usuario |</h1> <br>  
            
            <p>Nombre:</p><input type="text" name="Nombre"> <br>
            
            <p>Apellidos:</p><input type="text"  name="Apellidos"> <br>
            
            <p>Correo Electronico:</p><input type="text"  name="Email"> <br>
            
            <p>Contraseña:</p><input type="password"  name="Contraseña"> <br>
            <label  for="Id_Rol">Rol</label>
               <select name="Id_Rol">
                     <option value="">--Seleccione--</option>
                     <option value="1">Usuario</option>
                     <option value="2">Administrador</option> <br> <br>      
               </select> <br>
               <div>
               <label for="Id_Regional">Regional</label>
               <select name="Id_Regional" id="Id_Regional">
                      <option value="">--Seleccione regional--</option>
            <?php while($row = $resultado->fetch_assoc()) { ?>
                <option value="<?php echo $row ['Id_Regional']?>"><?php echo $row ['Regional']?></option>
                <?php } ?>  
            </div></select><br> 
            <div> 
            <label  for="Id_Rol">Centro</label>
            <select name="Id_Centro" id="Id_Centro" >
                  <option value="">--Seleccione centro--</option>
            </select></div>

            <input class="boton" type="submit" name="insert" value="enviar">
        </form>
    </div>
</body>
<script language="javascript">
    $(document).ready(function(){
        $("#Id_Regional").on('change', function () {
            $("#Id_Regional option:selected").each(function () {
                Id_Regional=$(this).val();
                $.post("../php/centros.php", { Id_Regional: Id_Regional }, function(data){
                    $("#Id_Centro").html(data);
                });			
            });
       });
    });
    </script> 
</html>