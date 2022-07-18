<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=obreros.xls");
?>
<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id,nombres, apellidos, dni, nacionalidad, edad, sexo,gruposanguineo,estadocivil,fechanacimiento,paisnacimiento,lugarnacimiento,departamento,provincia,distrito,categoria,puesto,fingreso,unidadfuncional,centrocostos,estado FROM personal where estado='Activo'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>
<table>
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Nombres</th>
                                <th>Apelldios</th>                                
                                <th>DNI</th>
                                <th>Nacionalidad</th>
                                <th>Edad</th>
                                <th>Genero</th>
                                <th>Grupo Sanguineo</th> 
                                <th>Estado Civil</th>
                                <th>Domicilio</th>
                                <th>Pais Nacimiento</th>   
                                <th>Lugar Nacimiento</th>              
                                <th>Departamento</th>
                                <th>Provincia</th>
                                <th>Distrito</th>
                                <th>Categoria</th>
                                <th>Cargo</th>
                                <th>Fecha Ingreso</th>
                                <th>Unidad Funcional</th>
                                <th>Centro Costos</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['nombres'] ?></td>
                                <td><?php echo $dat['apellidos'] ?></td>
                                <td><?php echo $dat['dni'] ?></td>
                                <td><?php echo $dat['nacionalidad'] ?></td>
                                <td><?php echo $dat['edad'] ?></td>
                                <td><?php echo $dat['sexo'] ?></td>
                                <td><?php echo $dat['gruposanguineo'] ?></td>
                                <td><?php echo $dat['estadocivil'] ?></td>
                                <td><?php echo $dat['fechanacimiento'] ?></td> 
                                <td><?php echo $dat['paisnacimiento'] ?></td>
                                <td><?php echo $dat['lugarnacimiento'] ?></td>
                                <td><?php echo $dat['departamento'] ?></td> 
                                <td><?php echo $dat['provincia'] ?></td>
                                <td><?php echo $dat['distrito'] ?></td> 
                                <td><?php echo $dat['categoria'] ?></td>
                                <td><?php echo $dat['puesto'] ?></td>
                                <td><?php echo $dat['fingreso'] ?></td>
                                <td><?php echo $dat['unidadfuncional'] ?></td>
                                <td><?php echo $dat['centrocostos'] ?></td> 
                                <td><?php echo $dat['estado'] ?></td>                                   
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>     