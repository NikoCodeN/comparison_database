<?php 
require '../php/conexion.php';
$con = conectar();

session_start();

$Email=$_SESSION['Email'];

if(!isset($_SESSION['Email'])){
    header('location:vistausuario.php');
}

$sql= "SELECT interna.Numero_Documento,interna.Nombre ,externa.Apellidos FROM interna INNER JOIN externa ON interna.Numero_Documento=externa.Numero_Documento where interna.Numero_Documento=externa.Numero_Documento  and interna.Nombre=externa.Nombre";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>inicio</title>
  <link rel="stylesheet" href="../css/dasboard.css"/>
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
      <main class="contenedor1" >
      <h1>Informes</h1>
      <div><a class=botonC href="generarexcel.php">Generar Excel</a><a class="botonB" href="informes.php">Regresar</a></div>
<table border="1">
 <thead>
    <tr>
      <th>Id</th>
      <th>Numero Documento</th>
      <th>Nombre</th>
      <th>Apellidos</th>
    </tr>
  </thead>
  <tbody>
    <?php $resultado = mysqli_query($con,$sql);
    $n=0; while($row = mysqli_fetch_assoc($resultado)){ $n++;?>
    <tr>
      <td><?php echo $n; ?></td>
      <td><?php echo $row["Numero_Documento"]; ?></td>
      <td><?php echo $row["Nombre"]; ?></td>
      <td><?php echo $row["Apellidos"]; ?></td>
    </tr>
    <?php } mysqli_free_result($resultado);?>
  </tbody>
</table>