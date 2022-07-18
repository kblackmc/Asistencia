<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$nombres = (isset($_POST['nombres'])) ? $_POST['nombres'] : '';
$apellidos = (isset($_POST['apellidos'])) ? $_POST['apellidos'] : '';
$dni = (isset($_POST['dni'])) ? $_POST['dni'] : '';
$nacionalidad = (isset($_POST['nacionalidad'])) ? $_POST['nacionalidad'] : '';
$edad = (isset($_POST['edad'])) ? $_POST['edad'] : '';
$sexo = (isset($_POST['sexo'])) ? $_POST['sexo'] : '';
$gruposanguineo = (isset($_POST['gruposanguineo'])) ? $_POST['gruposanguineo'] : '';
$estadocivil = (isset($_POST['estadocivil'])) ? $_POST['estadocivil'] : '';
$fechanacimiento = (isset($_POST['fechanacimiento'])) ? $_POST['fechanacimiento'] : '';
$paisnacimiento = (isset($_POST['paisnacimiento'])) ? $_POST['paisnacimiento'] : '';
$lugarnacimiento = (isset($_POST['lugarnacimiento'])) ? $_POST['lugarnacimiento'] : '';
$departamento = (isset($_POST['departamento'])) ? $_POST['departamento'] : '';
$provincia = (isset($_POST['provincia'])) ? $_POST['provincia'] : '';
$distrito = (isset($_POST['distrito'])) ? $_POST['distrito'] : '';
$categoria = (isset($_POST['categoria'])) ? $_POST['categoria'] : '';
$puesto = (isset($_POST['puesto'])) ? $_POST['puesto'] : '';
$fingreso = (isset($_POST['fingreso'])) ? $_POST['fingreso'] : '';
$unidadfuncional = (isset($_POST['unidadfuncional'])) ? $_POST['unidadfuncional'] : '';
$centrocostos = (isset($_POST['centrocostos'])) ? $_POST['centrocostos'] : '';
$estado = (isset($_POST['estado'])) ? $_POST['estado'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO personal (nombres, apellidos, dni, nacionalidad, edad, sexo,gruposanguineo,estadocivil,fechanacimiento,paisnacimiento,lugarnacimiento,departamento,provincia,distrito,categoria,puesto,fingreso,unidadfuncional,centrocostos,estado) VALUES('$nombres', '$apellidos', '$dni', '$nacionalidad', '$edad', '$sexo', '$gruposanguineo','$estadocivil','$fechanacimiento','$paisnacimiento','$lugarnacimiento','$departamento','$provincia','$distrito','$categoria','$puesto','$fingreso','$unidadfuncional', '$centrocostos','$estado') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id,nombres, apellidos, dni, nacionalidad, edad, sexo,gruposanguineo,estadocivil,fechanacimiento,paisnacimiento,lugarnacimiento,departamento,provincia,distrito,categoria,puesto,fingreso,unidadfuncional,centrocostos,estado FROM personal ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE personal SET nombres='$nombres', apellidos='$apellidos', dni='$dni', nacionalidad='$nacionalidad',edad='$edad', sexo='$sexo', gruposanguineo='$gruposanguineo', estadocivil='$estadocivil',fechanacimiento='$fechanacimiento',paisnacimiento='$paisnacimiento',lugarnacimiento='$lugarnacimiento',departamento='$departamento',provincia='$provincia',distrito='$distrito',categoria='$categoria',puesto='$puesto',fingreso='$fingreso',unidadfuncional='$unidadfuncional',centrocostos='$centrocostos', estado='$estado' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id,nombres, apellidos, dni, nacionalidad, edad, sexo,gruposanguineo,estadocivil,fechanacimiento,paisnacimiento,lugarnacimiento,departamento,provincia,distrito,categoria,puesto,fingreso,unidadfuncional,centrocostos,estado FROM personal WHERE id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "UPDATE  personal SET estado='No Activo' WHERE id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT id,nombres, apellidos, dni, nacionalidad, edad, sexo,gruposanguineo,estadocivil,fechanacimiento,paisnacimiento,lugarnacimiento,departamento,provincia,distrito,categoria,puesto,fingreso,unidadfuncional,centrocostos,estado FROM personal ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
