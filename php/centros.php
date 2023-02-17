<?php
	require ('conexion.php');
    $con = conectar();
	
	$Id_Regional = $_POST['Id_Regional'];

	
	$queryM = "SELECT Id_Centro,Centro FROM centros WHERE Id_Regional = '$Id_Regional'";
	$resultadoM = mysqli_query($con,$queryM);
	
	$html= "<option value=''>Seleccione Centro </option>";
	
	while($rowM = $resultadoM->fetch_assoc()){
		$html.= "<option value='".$rowM['Id_Centro']."'>".$rowM['Centro']."</option>";
	}
	echo $html;
?>