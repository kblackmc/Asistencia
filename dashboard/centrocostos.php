<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1 class="text-info"><i class="fas fa-solid fa-mountain"></i>  CENTRO DE COSTOS</h1>
    <div class="date">
    <span id="weekDay" class="weekDay"></span>, 
    <span id="day" class="day"></span> de
    <span id="month" class="month"></span> del
    <span id="year" class="year"></span>
</div>
<div class="clock">
    <span id="hours" class="hours"></span> :
    <span id="minutes" class="minutes"></span> :
    <span id="seconds" class="seconds"></span>
</div>
    
    
 <?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id,Nombre,codigo,Departamento,Provincia,Distrito,Estado FROM ccostos where Estado='Activo'";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>



<div class="container">
        <div class="row">
            <div class="col-lg-12">
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-borderless table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center table-dark ">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>CODIGO</th>
                                <th>Departamento</th>                                
                                <th>Provincia</th>
                                <th>Distrito</th>
                                <th>Estado</th>    
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['Nombre'] ?></td>
                                <td><?php echo $dat['codigo'] ?></td>
                                <td><?php echo $dat['Departamento'] ?></td>
                                <td><?php echo $dat['Provincia'] ?></td>
                                <td><?php echo $dat['Distrito'] ?></td>
                                <td><?php if($dat['Estado'] == 'Activo'){
							        	echo '<span class="label success">Activo</span>';
						          	}
                            else if ($dat['Estado'] == 'No Activo' ){
							        	echo '<span class="label info">No Activo</span>';
							            }
                            else if ($dat['Estado'] == 'En espera' ){
							        	    echo '<span class="label warning">En espera</span>';
							              } ?></td>             
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
      
        <form id="formPersonas">    
            <div class="modal-body">
            <div class="container">
            <div class="row">
            <div class="col-6">
                <div class="form-group">
                <label for="Nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="Nombre">
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                <label for="codgio" class="col-form-label">Codigo: </label>
                <input type="text" value="JRDCC<?php $n=rand(100,100000); echo $n ; ?>"class="form-control" id="codigo">
                </div>      
                </div> 
                <div class="col-6">
                <div class="form-group">
                <label for="Departamento" class="col-form-label">Departamento: </label>
                <input type="text" class="form-control" id="Departamento">
                </div>      
                </div>   
                <div class="col-6">       
                <div class="form-group">
                <label for="Provincia" class="col-form-label">Provincia: </label>
                <input type="text" class="form-control" id="Provincia">
                </div>       
                </div>  
                <div class="col-6">  
                <div class="form-group">
                <label for="Distrito" class="col-form-label">Distrito: </label>
                <input type="text" class="form-control" id="Distrito">
                </div> 
                </div>
                <div class="col-6">  
                <div class="form-group">
                <i class="fas fa-user-tag"></i>
                <label for="Estado" class="col-form-label">Estado:</label>
                <input type="text" value="Activo" class="form-control" id="Estado" readonly>
                </div>  
                </div>      
            </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
        </div>
        
</div>  
      
</div>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>