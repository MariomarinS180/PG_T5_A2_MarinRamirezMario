<?php

include('../scripts/php/conexiones_BD/conexion_bd_escuela.php');
$con = new ConexionBDEscuela();
$conexion = $con->getConexion();

if($_SERVER['REQUEST_METHOD']=='POST'){
    $cadenaJSON =file_get_contents('php://input');

    if($cadenaJSON==false){
        echo "No Hay cadena JSON";
    }else{
        $filtro = json_decode($cadenaJSON, true);
        $sql = "SELECT * FROM alumnos";
        $res = mysqli_query($conexion,$sql);

        $datos ['alumnos'] = array();
        if($res){
            while($fila = mysqli_fetch_assoc($res)){
                $alumno = array();
                $alumno['num_control'] =$fila['num_control'];
                $alumno['nombre'] =$fila['nom'];
                $alumno['primer_ap'] =$fila['pa'];
                $alumno['segundo_ap'] =$fila['sa'];
                $alumno['edad'] =$fila['edad'];
                $alumno['semestre'] =$fila['semes'];
                $alumno['carrera'] =$fila['carr'];
                array_push($datos['alumnos'], $alumno);
            }
            echo json_encode($datos);
        }else{
            $respuesta['exito']= false;
            $respuesta['Mensaje']= "error en la Insercion";
            $resJSON = json_encode($respuesta);
            echo $respuesta;
        }
    }
}
?>