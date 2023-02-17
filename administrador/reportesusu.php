<?php 
require '../php/conexion.php';
$con = conectar();
header("Content-Type: applecation/vnd.ms-excel; charset=iso-8859-1");
header("content-Disposition: attachment; filename=datos-usuario.xls");

session_start();

$Email=$_SESSION['Email'];

if(!isset($_SESSION['Email'])){
    header('location:vistaadmin.php');
}
$query = "SELECT usuario.Id_Usuario, usuario.Nombre,usuario.Apellidos,usuario.Email, rol.Rol, regionales.Regional , centros.Centro  FROM usuario INNER JOIN rol ON usuario.Id_Rol = rol.Id_Rol INNER JOIN regionales ON usuario.Id_Regional = regionales.Id_Regional  INNER JOIN centros ON usuario.Id_Centro = centros.Id_Centro " ; 

?>
<table border="1">
 <thead>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Apellidos</th> 
      <th>Correo</th>
      <th>Rol</th>
      <th>Regional</th>
      <th>Centro</th>
    </tr>
  </thead>
  <tbody>
    <?php $resultado = mysqli_query($con,$query);
    $n=0; while($row = mysqli_fetch_assoc($resultado)){ $n++;?>
    <tr>
      <td><?php echo $n; ?></td>
      <td><?php echo $row["Nombre"]; ?></td>
      <td><?php echo $row["Apellidos"]; ?></td>
      <td><?php echo $row["Email"]; ?></td> 
      <td><?php echo $row["Rol"]; ?></td>
      <td><?php echo $row["Regional"]; ?></td>
      <td><?php echo $row["Centro"]; ?></td>
    </tr>
    <?php } mysqli_free_result($resultado);?>
  </tbody>
</table>