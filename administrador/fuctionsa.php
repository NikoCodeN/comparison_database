<?php
function insertar_datos($Tipo_Documento,$Numero_Documento,$Nombre,$Apellidos,$Nombre_de_Vigencia,$Nombre_Prueba,$Tipo_Prueba,$Estado_Ejecucion,$Regional,$Centro_Formacion,$Estado_Evaluacion,$Porcentaje_Afinidadareadevocacion1,$Resultadoareadevocacion1,$Porcentaje_Afinidadareadevocacion2,$Resultadoareadevocacion2,$programastituladossugeridos){
    global $con;
    $sentencia = "insert into interna (Tipo_Documento,Numero_Documento,Nombre,Apellidos,Nombre_de_Vigencia,Nombre_Prueba,Tipo_Prueba,Estado_Ejecucion,Regional,Centro_Formacion,Estado_Evaluacion,Porcentaje_Afinidadareadevocacion1,Resultadoareadevocacion1,Porcentaje_Afinidadareadevocacion2,Resultadoareadevocacion2,programastituladossugeridos) values('$Tipo_Documento','$Numero_Documento','$Nombre','$Apellidos','$Nombre_de_Vigencia','$Nombre_Prueba','$Tipo_Prueba','$Estado_Ejecucion','$Regional','$Centro_Formacion','$Estado_Evaluacion','$Porcentaje_Afinidadareadevocacion1','$Resultadoareadevocacion1','$Porcentaje_Afinidadareadevocacion2','$Resultadoareadevocacion2','$programastituladossugeridos')";
    $ejecutar = mysqli_query($con,$sentencia);
    return $ejecutar;
}
?>