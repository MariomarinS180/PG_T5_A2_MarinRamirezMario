<?php
include('../scripts/php/conexiones_BD/conexion_bd_escuela.php');
$con = new ConexionBDEscuela();
$conexion = $con->getConexion();
if($_SERVER['REQUEST_METHOD']=='POST'){
    $cadenaJSON =file_get_contents('php://input');

    if($cadenaJSON==false){
        echo "No Hay cadena JSON";
    }else{
        $datos = json_decode($cadenaJSON, true);
        $nc = $datos['nc'];
        $n = $datos['n'];
        $pa = $datos['pa'];
        $sa = $datos['sa'];
        $e = $datos['e'];
        $s = $datos['s'];
        $c = $datos['c'];
        $sql = "UPDATE Alumnos SET nom='$n', pa='$pa', sa='$sa',edad=$e,semes=$s,carr='$c' WHERE Numcon='$nc'";
        $res = mysqli_query($conexion, $sql);
        $respuesta =array();
        if($res){
            $respuesta['exito']= true;
            $respuesta['Mensaje']= "Modificación Correcta";
            $resJSON = json_encode($respuesta);
        }else{
            $respuesta['exito']= false;
            $respuesta['Mensaje']= "Modificación Incorrecta";
            $resJSON = json_encode($respuesta);
        }
        echo $resJSON;
    }
}
?>