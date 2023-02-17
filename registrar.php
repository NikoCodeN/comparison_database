<?php
require 'php/conexion.php';
$con = conectar();

$query = "SELECT * FROM regionales ORDER BY Regional ASC";
$resultado= mysqli_query($con,$query);



if(isset($_POST['insert']))
{
 
    $Nombre=$_POST['Nombre'];
    $Apellidos=$_POST['Apellidos'];
    $Email=$_POST['Email'];
    $Contraseña=$_POST['Contraseña'];
    $Id_Regional=$_POST['Id_Regional'];
    $Id_Centro=$_POST['Id_Centro'];
    
    $result=$con->query("CALL insertar('$Nombre','$Apellidos','$Email','$Contraseña','$Id_Regional','$Id_Centro')");



if($result)
{
    header("location:index.html");
}
else
{
    header("location:error.html");
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
</head>
<body>
    <div class="contenedor">
        <form name="insertrecord" method="post">
            <h2>Regístrarse</h2> <br>
            <input type="text" placeholder="Nombre" name="Nombre">
            <input type="text" placeholder="Apellidos" name="Apellidos">
            <input type="text" placeholder="Correo Electronico" name="Email">
            <input type="password" placeholder="Contraseña" name="Contraseña">
            <br>
            <div><select name="Id_Regional" id="Id_Regional">
            <option value="">--Seleccione regional--</option>
            <?php while($row = $resultado->fetch_assoc()) { ?>
                <option value="<?php echo $row ['Id_Regional']?>"><?php echo $row ['Regional']?></option>
                <?php } ?>  
            </div></select> <br>
            <div><select name="Id_Centro" id="Id_Centro" >
            <option value="">--Seleccione centro--</option>
            </select></div><br>
            <input class="boton" type="submit" name="insert" value="enviar">
        </form> 
        
    </div>
</body>
<script language="javascript">
    $(document).ready(function(){
        $("#Id_Regional").on('change', function () {
            $("#Id_Regional option:selected").each(function () {
                Id_Regional=$(this).val();
                $.post("php/centros.php", { Id_Regional: Id_Regional }, function(data){
                    $("#Id_Centro").html(data);
                });			
            });
       });
    });
    </script>

</html>
