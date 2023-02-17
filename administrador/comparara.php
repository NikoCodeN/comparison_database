<?php 
require '../php/conexion.php';
$con = conectar();

session_start();

$Email=$_SESSION['Email'];


if(!isset($_SESSION['Email'])){
    header('location:vistadmin.php');
}


$sql="SELECT interna.Numero_Documento,interna.Nombre,externa.Apellidos,externa.Id_Enumerar,externa.Codigo_Centro,externa.Id_Usuario,externa.fecha_subida FROM interna INNER JOIN externa ON interna.Numero_Documento=externa.Numero_Documento and interna.Nombre=externa.Nombre GROUP BY interna.Numero_Documento,interna.Nombre,externa.Apellidos ORDER BY externa.Id_Enumerar ";
//SELECT interna.Numero_Documento,interna.Nombre,externa.Apellidos,externa.Id_Enumerar,externa.Codigo_Centro,  externa.Id_Usuario FROM interna  INNER JOIN (SELECT DISTINCT Numero_Documento,Nombre FROM externa) externa ON interna.Numero_Documento=externa.Numero_Documento  and interna.Nombre=externa.Nombre

//SELECT i.Numero_Documento,i.Nombre,e.Apellidos,e.Id_Enumerar,e.Codigo_Centro, e.Id_Usuario FROM interna AS i INNER JOIN (SELECT DISTINCT Numero_Documento,Nombre,Apellidos,Id_Enumerar,Codigo_Centro FROM externa AS e)e ON i.Numero_Documento=e.Numero_Documento and i.Nombre=e.Nombre;
//SELECT externa.Id_Usuario ,externa.fecha_subida,externa.Id_Enumerar,externa.Codigo_Centro,interna.Numero_Documento,interna.Nombre,interna.Apellidos FROM externa INNER JOIN (SELECT DISTINCT interna.Numero_Documento,interna.Nombre,interna.Apellidos FROM interna)interna ON interna.Numero_Documento=externa.Numero_Documento and interna.Nombre=externa.Nombre;
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>inicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/comparar.css">
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
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
      <main class="contenedor1" >
      <h1>Informes</h1>
      <div><a href="generarexcela.php" class="botonC">Generar Excel</a><a href="vistaadmin.php" class="botonB">Regresar</a></div>
<table class=row border="1">
 <thead>
    <tr>
      <th>Id</th>
      <th>Id Enumeracion</th>
      <th>Numero Documento</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>Codigo Centro</th>
      <th>Id Usuario</th>
      <th>Fecha de subida</th>
    </tr>
  </thead>
  <tbody>
    <?php $resultado = mysqli_query($con,$sql);
    $n=0; while($row = mysqli_fetch_assoc($resultado)){ $n++;?>
    <tr>
      <td><?php echo $n; ?></td>
      <td><?php echo $row["Id_Enumerar"]; ?></td>
      <td><?php echo $row["Numero_Documento"]; ?></td>
      <td><?php echo $row["Nombre"]; ?></td>
      <td><?php echo $row["Apellidos"]; ?></td>
      <td><?php echo $row["Codigo_Centro"]; ?></td>
      <td><?php echo $row["Id_Usuario"]; ?></td>
      <td><?php echo $row["fecha_subida"]; ?></td>
    </tr>
    <?php } mysqli_free_result($resultado);?>
  </tbody>
</table>