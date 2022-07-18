<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$nombres= (isset($_POST['nombres'])) ? $_POST['nombres'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$puesto = (isset($_POST['puesto'])) ? $_POST['puesto'] : '';
$centrocostos = (isset($_POST['centrocostos'])) ? $_POST['centrocostos'] : '';
$fecha = (isset($_POST['fecha'])) ? $_POST['fecha'] : '';
$entrada = (isset($_POST['entrada'])) ? $_POST['entrada'] : '';
$salida = (isset($_POST['salida'])) ? $_POST['salida'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';


switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO lista (nombres,dni,puesto,centrocostos,fecha,entrada,salida) VALUES('$nombres', '$dni','$puesto','$centrocostos','$fecha','$entrada','$salida')";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT id,nombres,dni,puesto,centrocostos,fecha,entrada,salida FROM listas ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2://baja
            $consulta = "DELETE FROM lista WHERE id='$id' ";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 
            
            $consulta = "SELECT id,nombres,dni,puesto,centrocostos,fecha,entrada,salida FROM listas ORDER BY id DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
         
            break; 

 case 3: //modificación
     $consulta = "UPDATE lista SET nombres='$nombres', dni='$dni', puesto='$puesto', centrocostos='$centrocostos',fecha='$fecha', entrada='$entrada', salida='$salida' WHERE id='$id' ";		
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();        
                
    $consulta = "SELECT id,nombres,dni,puesto,centrocostos,fecha,entrada,salida FROM personal WHERE id='$id' ";       
    $resultado = $conexion->prepare($consulta);
    $resultado->execute();
    $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
    break;  
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
