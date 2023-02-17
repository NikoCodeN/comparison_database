<?php 
require '../php/conexion.php';
$con = conectar();

session_start();

$Email=$_SESSION['Email'];

if(!isset($_SESSION['Email'])){
    header('location:vistausuario.php');
}

$query="SELECT usuario.Id_Usuario, usuario.Nombre,usuario.Apellidos,usuario.Email,usuario.Contraseña, rol.	Rol, regionales.Regional , centros.Centro  FROM usuario INNER JOIN rol ON usuario.Id_Rol = rol.Id_Rol INNER JOIN regionales ON usuario.Id_Regional = regionales.Id_Regional  INNER JOIN centros ON usuario.	Id_Centro = centros.Id_Centro 
WHERE Email = '$Email'";
$listado=mysqli_query($con,$query);
$row=$listado->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>inicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/perfil.css"/>
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
  <div class="contenedor">
    <nav>
      <ul>
        <li><a href="#" class="logo">
          <img src="../img/Sena_Colombia_logo.svg.png">
          <span class="nav-item">Usuario</span><br>
        </a></li>
        <li><a href="vistausuario.php" class="texnav">
          <i class="fa fa-user"></i>
          <span class="nav-item">Perfil</span>
        </a></li>
        <li><a href="informes.php" class="texnav">
          <i class="fa fa-database"></i>
          <span class="nav-item">Bases Externas</a></i>
        </a></li>
      </ul>
    </nav>
    <section class="perfil">
    <div class="main-top">
    <a class="cerrar" href="../php/cerrarsesion.php">
      <i class="fa fa-sign-out">cerrar sesion</i></a>
      </div>
      <div class="datos">
      <table>
      <tbody>
      <tr>
      <h1>Perfil</h1>
      <td><strong>Nombre: </strong></td>
         <td><?php echo $row['Nombre'];?></td>
        </tr><tr>
         <td> <strong>Apellidos:</strong></td> 
         <td><?php echo $row['Apellidos'];?></td>
         </tr><tr>
         <td><strong>Correo: </strong></td>
         <td><?php echo $row['Email'];?></td>
        </tr><tr>
         <td><strong>Contraseña: </strong></td>
         <td><?php echo $row['Contraseña'];?></td>
         </tr><tr>
         <td><strong>Regional: </strong></td>
         <td><?php echo $row['Regional'];?></td>
         </tr><tr>
         <td><strong>Centro: </strong></td>
         <td><?php echo $row['Centro'];?></td>
         </tr>
         </tbody>
        </table>
      <div class="footer">
        <a  class="botonA" href="editarperfil.php?ID=<?php echo $row['Id_Usuario'];?>">Editar</a>
      </div>
    </div>
    </section>  

    
  </div>
</body>
</html>
