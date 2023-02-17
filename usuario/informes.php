<?php 
require_once '../php/conexion.php';
$con = conectar();

session_start();

$Email=$_SESSION['Email'];
$consulta="SELECT Id_Usuario FROM usuario where Email='$Email'";
$resultado=mysqli_query($con,$consulta);
$filas= $resultado->fetch_array();
$_SESSION['Id_Usuario'] = $filas['Id_Usuario'];
$Id_Usuario=$_SESSION['Id_Usuario'];

if(!isset($_SESSION['Email'])){
    header('location:vistausuario.php');
}

if(isset($_POST["enviar"])){
    require_once("functions.php");
    
    $archivo = $_FILES["archivo"]["name"];
    $archivo_copiado=$_FILES["archivo"]["tmp_name"];
    $archivo_guardado = "copia_".$archivo;
    //echo $archivo."esta en la ruta temporal: " .$archivo_copiado;

    if(copy($archivo_copiado,$archivo_guardado)){
        //echo "se copeo correctamente el archivo temporal a nuestra carpeta <br/>";
    }else{
        echo "hubo un error<br/>";
    }

    if (file_exists($archivo_guardado)){
        //echo "si existe una copia <br/>";
        $fp = fopen($archivo_guardado,"r");
        $rows=0;
        while ($datos = fgetcsv($fp, 10000,";")){
            //echo $datos[0] ."" .$datos[1] ."" . $datos[2]."" . $datos[3]."" . $datos[4]."" . $datos[5]."" . $datos[6]."" . $datos[7]."" . $datos[8]."" . $datos[9]."" . $datos[10]."" . $datos[11]. "<br/>";
            $rows ++;
            if ($rows > 1){
                $resultado = insertar_datos($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6],$datos[7],$datos[8],$datos[9],$datos[10],$datos[11],$Id_Usuario);
            if($resultado){
                //echo "se inserto los datos correctamente<br/>";
            }else{
                //echo "no se insertaron<br/>";
            }
            }
        }
    }else{
        echo "no existe el archivo <br/>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>inicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/dasboard.css"/>
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
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
        <h1>Base Externa</h1>
      <div class="todo">
      <div class="parrafo1">
        <p class="parrafo"><strong>BIENVENIDO A LA PLATAFORMA CONTROL Y CRUCE DE INFORMACIÓN ORIENTACIÓN VOCACIONAL Y OCUPACIONAL SENA</strong></p>
        <p class="parrafo"><strong>Por favor ingrese la base de datos. Recuerde que el archivo debe ser en formato csv para tener una carga exitosa.</strong></p><br>
    </div>
    <div class="formulario">
        <form action="informes.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
            <input type="file" name="archivo" class="form-control"/>
            <input type="submit" value="SUBIR ARCHIVO" class="form-control" name="enviar">
        </form>
    </div>
    <br>
<div>
<div><a class="botonC" href="comparar.php">Comparacion</a><a class="botonB" href="generarexcel.php">Generar Excel</a><a class="botonX" href="../php/limpiar.php">Limpiar Tabla</a></div>
</div>
</div>
<div class="row">
            <table  id="mitabla">
                    <tr>
                        <th>Id Usuario</th>
                        <th>Tipo Documento</th>
                        <th>Numero_Documento</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Nombres y Apellidos</th>
                        <th>Email</th>
                        <th>Codigo Regional</th>
                        <th>Regional</th>
                        <th>Codigo Centro</th>
                        <th>Centro Formacion</th>
                        <th>Institucion Educativa</th>  
                        <th>Id_Usuario</th>
                    </tr>
                    <?php
                        $sql="SELECT * from externa WHERE $Id_Usuario=Id_Usuario";
                        $result=mysqli_query($con,$sql);

                        while($mostrar=mysqli_fetch_array($result)){
                    ?>
                     <tr>
                        <td><?php echo $mostrar ['Id_Enumerar']?></td>
                        <td><?php echo $mostrar ['Tipo_Documento']?></td>
                        <td><?php echo $mostrar ['Numero_Documento']?></td>
                        <td><?php echo $mostrar ['Nombre']?></td>
                        <td><?php echo $mostrar ['Apellidos']?></td>
                        <td><?php echo $mostrar ['Nombres_Apellidos']?></td>
                        <td><?php echo $mostrar ['Email']?></td>
                        <td><?php echo $mostrar ['Codigo_Regional']?></td>
                        <td><?php echo $mostrar ['Regional']?></td>
                        <td><?php echo $mostrar ['Codigo_Centro']?></td>
                        <td><?php echo $mostrar ['Centro_Formacion']?></td>
                        <td><?php echo $mostrar ['Institucion_Educativa']?></td>
                        <td><?php echo $mostrar ['Id_Usuario']?></td>
                    </tr>
                    <?php
                    }
                    ?>
            </table>
</section> 
</main>      
</body>
</html>