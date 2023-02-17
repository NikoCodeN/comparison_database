<?php
require '../php/conexion.php';
$con = conectar();
$limpiar= "DELETE FROM  interna";
$limpia = $con->query($limpiar);
header("location:../administrador/basesinterna.php");
$conexion->close();
?>