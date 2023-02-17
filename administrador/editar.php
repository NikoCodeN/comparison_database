<?php

$id = $_GET['ID'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
      header ('Location: index.php');
      
}
require '../Php/Conexion.php';
$con = conectar();


//prellenar el formulario porque que mamera tener que llenar todo

$consulta = "SELECT * FROM usuario WHERE Id_Usuario =${id}";
$resultado = mysqli_query($con,$consulta);
$usuario = mysqli_fetch_assoc($resultado);


$query1 = "SELECT * FROM regionales ORDER BY Regional ASC";
$resultado1= mysqli_query($con,$query1);

//Variable que sirve para verificar que el formulario este completamente lleno
$formincompleto = [];


$Nombre = $usuario['Nombre'];
$Apellidos = $usuario['Apellidos'];
$Email = $usuario['Email'];
$Contraseña = $usuario['Contraseña'];
$Id_Rol = $usuario['Id_Rol'];



//Validacion de campos en formulario

if($_SERVER['REQUEST_METHOD'] === 'POST') {

 //breve validacion en la pantalla de la inserccion de los datos

 
$Nombre=$_POST['Nombre'];
$Apellidos=$_POST['Apellidos'];
$Email=$_POST['Email'];
$Contraseña=$_POST['Contraseña'];
$Id_Rol=$_POST['Id_Rol'];
$Id_Regional=$_POST['Id_Regional'];
$Id_Centro=$_POST['Id_Centro'];

 //usando la variable form
 if(!$Nombre) {
      $formincompleto[] = "Upps debes añadir el nombre";
}

if(!$Apellidos) {
 $formincompleto[] = "Upps debes añadir el apellido";
 }

 if(!$Email) {
      $formincompleto[] = "Upps debes añadir el correo";
      }

 if(!$Contraseña) {
       $formincompleto[] = "Upps debes añadir añadir la contraseña";
 }

 if(!$Id_Rol) {
       $formincompleto[] = "Upps debes seleccionar el rol";
 }

 //revisar que el form vacio
 if(empty($formincompleto)) {

//insertar en la base de datos
      
$query="UPDATE usuario  SET  Nombre = '${Nombre}',Apellidos = '${Apellidos}', Email = '${Email}',  Contraseña = '${Contraseña}', Id_Rol='${Id_Rol}', Id_Regional='${Id_Regional}',
Id_Centro =${Id_Centro}   WHERE Id_Usuario= ${id} ";
     
$resultado = mysqli_query($con, $query);
if($resultado) {
   header('Location:index.php?mensaje=actualizado');
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="../css/editar.css">
      <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
      <title>Editar Usuarios</title>
      
</head>
<body>
<header>
</header>
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
      <h1>Editar Usuarios</h1>
      <?php foreach($formincompleto as $form): ?>
            <div class="alerta">
            <?php echo $form; ?>
            </div>
            <?php endforeach?>

      <!--FORMULARIO DE USUARIO-->
      <form  method="POST" name="" >

               <label for="Nombre">Nombres </label>
               <input type="text" id="Nombre" name='Nombre' placeholder="nombres" value="<?php echo $Nombre; ?>">

               <label for="Apellidos">Apellidos</label>
               <input type="text" id="Apellidos" name='Apellidos' placeholder="Apellidos" value="<?php echo $Apellidos; ?>">
               
               <label for="Email">Correo</label>
               <input type="text" id="Email" name="Email" placeholder="Correo electronico"  value="<?php echo $Email; ?>">

               <label for="Contraseña">Contraseña</label>
               <input type="password" id="Contraseña" name="Contraseña" placeholder="Contraseña"  value="<?php echo $Contraseña; ?>"> <br>

               <label for="Id_Rol">Rol</label>
               <select name="Id_Rol">
                     <option value="">--Seleccione--</option>
                     <option value="1">Usuario</option>
                     <option value="2">Administrador</option>
               </select>
               <div>
               <label for="Id_Regional">Regional</label>
               <select name="Id_Regional" id="Id_Regional">
                      <option value="">--Seleccione regional--</option>
            <?php while($row = $resultado1->fetch_assoc()) { ?>
                <option value="<?php echo $row ['Id_Regional']?>"><?php echo $row ['Regional']?></option>
                <?php } ?>  
            </div></select><br>
            <div>
            <label  for="Id_Rol">Centro</label>
            <select name="Id_Centro" id="Id_Centro" >
                  <option value="">--Seleccione centro--</option>
            </select></div>
       <br>
       <input class="boton" type="submit" value="actualizar"><br><br> 
   </form>    
</main>      
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