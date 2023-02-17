<?php 
require '../php/conexion.php';
$con = conectar();

session_start();

$Email=$_SESSION['Email'];
$consulta="SELECT Id_Usuario FROM usuario where Email='$Email'";
$r=mysqli_query($con,$consulta);
$filas= $r->fetch_array();
$_SESSION['Id_Usuario'] = $filas['Id_Usuario'];
$Id_Usuario=$_SESSION['Id_Usuario'];

if(!isset($_SESSION['Email'])){
    header('location:vistausuario.php');
}

$sql="SELECT interna.Numero_Documento,interna.Nombre,externa.Apellidos,externa.Id_Enumerar,externa.Codigo_Centro,externa.Id_Usuario,externa.fecha_subida FROM interna INNER JOIN externa  ON interna.Numero_Documento=externa.Numero_Documento and interna.Nombre=externa.Nombre GROUP BY interna.Numero_Documento,interna.Nombre,externa.Apellidos ORDER BY externa.Id_Enumerar ";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>inicio</title>
  <link rel="stylesheet" href="../css/comparar.css"/>
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
  <div class="contenedor">
    <nav>
      <ul>
        <li><a href="#" class="logo">
          <img src="../img/sena.jpg">
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
      <main class="contenedor1" >
      <h1>Informes</h1>
      <div><a href="generarexcel.php" class="botonC">Generar Excel</a><a href="vistausuario.php" class="botonB">Regresar</a></div>
<table class=row border="1">
 <thead>
    <tr>
      <th>Id</th>
      <th>Id Enumeracion</th>
      <th>Numero Documento</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Id Usuario</th>
      <th>Fecha de subida</th>
    </tr>
  </thead>
  <tbody>
    <?php $resultado = mysqli_query($con,$sql);
    if($resultado and $Id_Usuario='Id_Usuario'){
    $n=0; while($row = mysqli_fetch_assoc($resultado)){ $n++;?>
    <tr>
      <td><?php echo $n; ?></td>
      <td><?php echo $row["Id_Enumerar"]; ?></td>
      <td><?php echo $row["Numero_Documento"]; ?></td>
      <td><?php echo $row["Nombre"]; ?></td>
      <td><?php echo $row["Apellidos"]; ?></td>
      <td><?php echo $row["Id_Usuario"]; ?></td>
      <td><?php echo $row["fecha_subida"]; ?></td>
    </tr>
    <?php } mysqli_free_result($resultado);}
    else{
      echo"intente nuevamente";
    }
    ?>
  </tbody>
</table>