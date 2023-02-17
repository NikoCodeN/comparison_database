<?php
require '../php/conexion.php';
$con = conectar();
$limpiar= "DELETE FROM  externa";
$limpia = $con->query($limpiar);
header("location:../administrador/basesexternas.php");
$conexion->close();
?>