<?php
function insertar_datos($Id_Enumerar,$Tipo_Documento,$Numero_Documento,$Nombre,$Apellidos,$Nombres_Apellidos,$Email,$Codigo_Regional,$Regional,$Codigo_Centro,$Centro_Formacion,$Institucion_Educativa,$Id_Usuario){
    global $con;
    $sentencia = "insert into externa (Id_Enumerar,Tipo_Documento,Numero_Documento,Nombre,Apellidos,Nombres_Apellidos,Email,Codigo_Regional,Regional,Codigo_Centro,Centro_Formacion,Institucion_Educativa,Id_Usuario) values('$Id_Enumerar','$Tipo_Documento','$Numero_Documento','$Nombre','$Apellidos','$Nombres_Apellidos','$Email','$Codigo_Regional','$Regional','$Codigo_Centro','$Centro_Formacion','$Institucion_Educativa','$Id_Usuario')";
    $ejecutar = mysqli_query($con,$sentencia);
    return $ejecutar;
}
?>