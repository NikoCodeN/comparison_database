<?php
require '../php/conexion.php';
$con = conectar();

session_start();
$Email=$_SESSION['Email'];

if(!isset($_SESSION['Email'])){
    header('location:../login.html');
}

$query = "SELECT usuario.Id_Usuario, usuario.Nombre,usuario.Apellidos,usuario.Email, rol.	Rol, regionales.Regional , centros.Centro  FROM usuario INNER JOIN rol ON usuario.Id_Rol = rol.Id_Rol INNER JOIN regionales ON usuario.Id_Regional = regionales.Id_Regional  INNER JOIN centros ON usuario.	Id_Centro = centros.Id_Centro " ; 
$listado = mysqli_query($con,$query);

$mensaje = $_GET['mensaje'] ?? null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Id_Usuario=$_POST['Id_Usuario'];
    $Id_Usuario = filter_var($Id_Usuario, FILTER_VALIDATE_INT);

    if($Id_Usuario){
        $result= "DELETE FROM usuario WHERE Id_Usuario = $Id_Usuario ";
        $resultado=mysqli_query($con,$result);
         
        if($resultado) {
              header ('Location: index.php');
        }
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>PHP</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../css/indexadmin.css">
<link rel="stylesheet" href="../css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script  src="../js/jquery.dataTables.min.js"></script>

<script>
	$(document).ready(function(){
		$('#mitabla').DataTable({
			"order": [[1, "asc"]],
			"language":{
				"lengthMenu": "Mostrar _MENU_ registros por pagina",
				"info": "Mostrando pagina _PAGE_ de _PAGES_",
				"infoEmpty": "No hay registros disponibles",
				"infoFiltered": "(filtrada de _MAX_ registros)",
				"loadingRecords": "Cargando...",
				"processing":     "Procesando...",
				"search": "Buscar:",
				"zeroRecords":    "No se encontraron registros coincidentes",
				"paginate": {
					"next":       "Siguiente",
					"previous":   "Anterior"
				},					
			}
		});	
	});	
</script>

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
    <main class="contenedor1" >
    <div class="main-top">
      <a class="cerrar" href="../php/cerrarsesion.php">
      <i class="fa fa-sign-out">cerrar sesion</i></a>
      </div>
<div class="container">
<h1>Administrar Usuarios</h1> <br>
<?php if($mensaje === 'actualizado'): ?>
      <p class="alerta"> Usuario Actualizado Correctamente</p>
      <?php endif; ?>
<a  href="insertarusu.php"><button class="boton"> Insertar Usuario</button></a> 
<a  href="reportesusu.php"><button class="boton"> Reportes</button></a> <br>
<br>
<div>
<table class="display" id="mitabla">
<thead>
<th>Nombres</th>
<th>Apellidos</th>
<th>Correo</th>
<th>Rol</th>
<th>Regional</th>
<th>Centro</th>
<th>Editar</th>
<th>Eliminar</th>
</thead>
<tbody><!--Mostrar los resultados-->
<?php while($usuario = mysqli_fetch_assoc($listado)):?>
                   
<tr>
<td> <?php echo $usuario['Nombre']; ?> </td>
<td> <?php echo $usuario['Apellidos']; ?> </td>
<td> <?php echo $usuario['Email']; ?> </td>
<td> <?php echo $usuario['Rol']; ?> </td>
<td> <?php echo $usuario['Regional']; ?> </td>
<td> <?php echo $usuario['Centro']; ?> </td>

<td> <a href="../administrador/editar.php?ID=<?php echo $usuario['Id_Usuario']; ?>" class="botonA">Editar</a></td>

<td><form method="POST">
    <input type="hidden" name="Id_Usuario" value="<?php echo $usuario['Id_Usuario']; ?>">
    <input type="submit" class="botonE" value="Eliminar">
    </form></td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</body>
</html>

<?php 
// cerrar conexion
mysqli_close($con);
?>