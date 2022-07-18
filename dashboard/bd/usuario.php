<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$usuario= (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$tipo = (isset($_POST['tipo'])) ? $_POST['tipo'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$costos = (isset($_POST['costos'])) ? $_POST['costos'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

$pass = md5($password); 

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO usuarios (usuario,password,email,tipo,costos,estado) VALUES('$usuario', '$pass', '$email', '$tipo','$costos','$estado') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id,usuario,password,email,tipo,costos,estado FROM usuarios ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE  usuarios SET estado='Activo' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id,usuario,password,email,tipo,costos,estado FROM usuarios ORDER BY id DESC LIMIT 1";   
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "UPDATE  usuarios SET estado='No Activo' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT id,usuario,password,email,tipo,costos,estado FROM usuarios ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
     
        break;  

    case 4: //modificación
            $consulta = "UPDATE  usuarios SET usuario='$usuario', password='$pass', email='$email', tipo='$tipo', costos='$costos', estado='$estado' WHERE id='$id' ";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();        
            
            $consulta = "SELECT id,usuario,password,email,tipo,costos,estado FROM usuarios WHERE id='$id'";  
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break; 
             
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
