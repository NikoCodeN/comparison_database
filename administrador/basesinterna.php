<?php 
require_once '../php/conexion.php';
$con = conectar();

session_start();

$Email=$_SESSION['Email'];

if(!isset($_SESSION['Email'])){
    header('location:vistaadmin.php');
}

if(isset($_POST["enviar"])){
    require_once("fuctionsa.php");
    
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
                $resultado = insertar_datos($datos[0],$datos[1],$datos[2],$datos[3],$datos[4],$datos[5],$datos[6],$datos[7],$datos[8],$datos[9],$datos[10],$datos[11],$datos[12],$datos[13],$datos[14],$datos[15]);
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
 
</head>
<body>
  <div class="contenedor">
    <nav>
      <ul>
        <li><a href="#" class="logo">
        <img src="../img/Sena_Colombia_logo.svg.png">
          <span class="nav-item">Administrador</span><br>
        </a></li>
        <li><a href="vistaadmin.php" class="texnav">
          <i class="fa fa-user"></i>
          <span class="nav-item">Perfil</span>
        </a></li>
        <li><a href="basesinterna.php" class="texnav">
          <i class="fa fa-database"></i>
          <span class="nav-item">Bases Internas</a></i>
        </a></li>
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
      <h1 class="base">Base Interna</h1>
      <div class="todo">
      <div class="parrafo1">
        <p class="parrafo"><strong>BIENVENIDO A LA PLATAFORMA CONTROL Y CRUCE DE INFORMACIÓN ORIENTACIÓN VOCACIONAL Y OCUPACIONAL SENA</strong></p>
        <p class="parrafo"><strong>Por favor ingrese la base de datos. Recuerde que el archivo debe ser en formato csv para tener una carga exitosa.</strong></p><br>
    </div>
    <div class="formulario">
        <form action="basesinterna.php" class="formulariocompleto" method="post" enctype="multipart/form-data">
            <input type="file" name="archivo" class="form-control"/>
            <input type="submit" value="SUBIR ARCHIVO" class="form-control" name="enviar">
        </form>
    </div><br>
<div>
<div><a class="botonC" href="comparara.php">Comparacion</a><a class="botonB" href="generarexcela.php">Generar Excel</a><a class="botonX" href="../php/limpiari.php">Limpiar Tabla</a></div>
</div>
</div><br>
<div class="row">
            <table id="mitabla">
                    <tr>
                        <th>Tipo Documento</th>
                        <th>Numero Documento</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Nombre de Vigencia</th>
                        <th>Nombre Prueba</th>
                        <th>Tipo Prueba</th>
                        <th>Estado Ejecucion</th>
                        <th>Regional</th>
                        <th>Centro Formacion</th>
                        <th>Estado Evaluacion</th>
                        <th>Porcentaje Afinidad area de vocacion1</th>
                        <th>Resultado areade vocacion1</th>
                        <th>Porcentaje Afinidad area de vocacion2</th>
                        <th>Resultado area de vocacion2</th>  
                        <th>programas titulados sugeridos</th>    
                    </tr>
                    <?php
                        $sql="SELECT * from interna";
                        $result=mysqli_query($con,$sql);

                        while($mostrar=mysqli_fetch_array($result)){
                    ?>
                     <tr>
                        <td><?php echo $mostrar ['Tipo_Documento']?></td>
                        <td><?php echo $mostrar ['Numero_Documento']?></td>
                        <td><?php echo $mostrar ['Nombre']?></td>
                        <td><?php echo $mostrar ['Apellidos']?></td>
                        <td><?php echo $mostrar ['Nombre_de_Vigencia']?></td>
                        <td><?php echo $mostrar ['Nombre_Prueba']?></td>
                        <td><?php echo $mostrar ['Tipo_Prueba']?></td>
                        <td><?php echo $mostrar ['Estado_Ejecucion']?></td>
                        <td><?php echo $mostrar ['Regional']?></td>
                        <td><?php echo $mostrar ['Centro_Formacion']?></td>
                        <td><?php echo $mostrar ['Estado_Evaluacion']?></td>
                        <td><?php echo $mostrar ['Porcentaje_Afinidadareadevocacion1']?></td>
                        <td><?php echo $mostrar ['Resultadoareadevocacion1']?></td>
                        <td><?php echo $mostrar ['Porcentaje_Afinidadareadevocacion2']?></td>
                        <td><?php echo $mostrar ['Resultadoareadevocacion2']?></td>
                        <td><?php echo $mostrar ['programastituladossugeridos']?></td>
                    </tr>
                    <?php
                    }
                    ?>
            </table>
        </div>
</section> 
</main>      
</body>
</html>