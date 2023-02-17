<?php 
require '../php/conexion.php';
$con = conectar();
header("Content-Type: applecation/vnd.ms-excel; charset=iso-8859-1");
header("content-Disposition: attachment; filename=datos-usuario.xls");

session_start();

$Email=$_SESSION['Email'];
$consulta="SELECT Id_Usuario FROM usuario where Email='$Email'";
$res=mysqli_query($con,$consulta);
$filas= $res->fetch_array();
$_SESSION['Id_Usuario'] = $filas['Id_Usuario'];
$Id_Usuario=$_SESSION['Id_Usuario'];

if(!isset($_SESSION['Email'])){
    header('location:vistaadmin.php');
}

$sql= "SELECT interna.Numero_Documento,interna.Nombre ,externa.Apellidos,externa.Id_Usuario FROM interna INNER JOIN externa ON interna.Numero_Documento=externa.Numero_Documento  and interna.Nombre=externa.Nombre";
?>
<table border="1">
 <thead>
    <tr>
      <th>Id</th>
      <th>Numero Documento</th>
      <th>Nombre</th>
      <th>Apellidos</th>
      <th>ID Usuario</th>
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
      <td><?php echo $row["Id_Usuario"]; ?></td>
    </tr>
    <?php } mysqli_free_result($resultado);?>
  </tbody>
</table>