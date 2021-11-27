<?php

include('../scripts/php/conexiones_BD/conexion_bd_escuela.php');

$con = new ConexionBDEscuela(); 
$conexion = $con->getConexion(); 


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $cadenaJSON = file_get_contents('php//input');
    
    if($cadenaJSON==false){
        echo"No hay cadena JSON";
    }else{
        $datos = json_decode($cadenaJSON, true); 
        $num_control = $datos['num_control']; 
        $nombre = $datos['nombre'];
        $primer_ap= $datos['primer_ap'];
        $segundo_ap = $datos['segundo_ap'];
        $edad = $datos['edad'];
        $semestre = $datos['semestre'];
        $carrera = $datos['carrera'];

        $sql = "INSERT INTO alumnos VALUES('$num_control', '$nombre', '$primer_ap', '$segundo_ap', $edad, $semestre, '$carrera')"; 
        $res = mysqli_query($conexion, $sql);
        $respuesta = array(); 
        
        if($res){
            $respuesta['EXITO'] = true; 
            $respuesta['Mensaje'] = 'Insercción Correcta'; 
            $resJSON = json_encode($respuesta);
        }else{
            $respuesta['EXITO'] = false; 
            $respuesta['Mensaje'] = 'Error en la Insercción'; 
            $resJSON = json_encode($respuesta);
        }
        echo $resJSON;
    }
}
?>