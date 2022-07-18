<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$Nombre= (isset($_POST['Nombre'])) ? $_POST['Nombre'] : '';
$Departamento = (isset($_POST['Departamento'])) ? $_POST['Departamento'] : '';
$Provincia = (isset($_POST['Provincia'])) ? $_POST['Provincia'] : '';
$Distrito = (isset($_POST['Distrito'])) ? $_POST['Distrito'] : '';
$Estado = (isset($_POST['Estado'])) ? $_POST['Estado'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO ccostos (Nombre,Departamento,Provincia,Distrito,Estado) VALUES('$Nombre', '$Departamento', '$Provincia', '$Distrito','$Estado') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id,Nombre,Departamento,Provincia,Distrito,Estado FROM ccostos ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE ccostos SET Nombre='$Nombre', Departamento='$Departamento', Provincia='$Provincia', Distrito='$Distrito', Estado='$Estado' WHERE id='$id'";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id,Nombre,Departamento,Provincia,Distrito,Estado FROM ccostos WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "UPDATE  ccostos SET Estado='No Activo' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT id,Nombre,Departamento,Provincia,Distrito,Estado FROM ccostos where Estado='Activo' ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
     
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
