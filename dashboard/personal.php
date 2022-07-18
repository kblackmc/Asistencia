<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1 class="text-info"> <i class="fas fa-solid fa-fingerprint text-danger"></i>  OBREROS REGISTRADOS</h1>
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
<hr style="border-top:1px dotted #000;"/>
</div>

<?php
include "cone.php";
$db = connect();
$query=$db->query("select * from personal where estado = 'Activo'");
$empleados = array();
$n=0;
while($r=$query->fetch_object()){ $empleados[]=$r; $n++;}

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

<div class="container">
        <div class="row">
        
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal"> <i class="fas fa-solid fa-plus"></i> Nuevo Obrero</button> 
            <button id="GenerarMysql" type="button" class="btn btn-warning" data-toggle="modal"><i class="fas fa-solid fa-file-pdf"></i> Generar PDF</button>   
            <a href="excel.php" class="btn btn-danger"><i class="fas fa-solid fa-table"></i> Descargar excel</a>
            </div>    
        </div>  
        <hr style="border-top:1px dotted #000;"/>  
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center table-dark">
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
                                <th>Fecha Nacimiento</th>
                                <th>Pais Nacimiento</th>   
                                <th>Domicilio</th>              
                                <th>Departamento</th>
                                <th>Provincia</th>
                                <th>Distrito</th>
                                <th>Categoria</th>
                                <th>Cargo</th>
                                <th>Fecha Ingreso</th>
                                <th>Unidad Funcional</th>
                                <th>Centro Costos</th>
                                <th>Estado</th>
                                <th>Opciones</th>
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
                            
                                <td><?php if($dat['estado'] == 'Activo'){
							        	echo '<span class="label success">Activo</span>';
						          	}
                            else if ($dat['estado'] == 'No Activo' ){
							        	echo '<span class="label info">No Activo</span>';
							            }
                            else if ($dat['estado'] == 'En espera' ){
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
            <i class="fas fa-user-tie"> </i>
            <h5 class=" modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
            <div class="container">
            <div class="row">
            <?php
                $mysqli = new mysqli('localhost:3308', 'root', '', 'EPP');
            ?>
            <div class="col-6">
                <div class="form-group">
                <i class="fas fa-user"></i>
                <label for="nombres" class="col-form-label">Nombres:</label>
                <input type="text"  class="form-control" id="nombres" required>
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-address-card"></i>
                <label for="apellidos" class="col-form-label">Apellidos:</label>
                <input type="text" class="form-control" id="apellidos" required>
                </div>  
                </div>
                <div class="col-6">              
                <div class="form-group">
                <i class="fas fa-briefcase"></i>
                <label for="dni" class="col-form-label">DNI:</label>
                <input type="text" class="form-control" id="dni" maxlength="8" required>
                </div> 
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-briefcase"></i>
                <label for="nacionalidad" class="col-form-label">Nacionalidad:</label>
                <select type="text" class="form-control" id="nacionalidad" required>
                <option selected>Seleccione Nacionalidad:</option>
                 <?php
                   $query = $mysqli -> query ("SELECT * FROM nacionalidades");
                  while ($valores = mysqli_fetch_array($query)) {
                 echo '<option value="'.$valores['nacion'].'">'.$valores['nacion'].'</option>';
                   }
                   ?>                  
                </select>
                </div> 
                </div>
                <div class="col-6">                 
                <div class="form-group">
                <i class="fas fa-mountain"></i>
                <label for="edad" class="col-form-label">EDAD:</label>
                <input type="number" class="form-control" id="edad" maxlength="3" required>
                </div>
                </div>
                <div class="col-6">             
                <div class="form-group">
                <i class="fas fa-briefcase"></i>
                <label for="sexo" class="col-form-label">Genero:</label>
                <select type="text" class="form-control" id="sexo" required>
                <option selected>Seleccione genero:</option>
              <?php
          $query = $mysqli -> query ("SELECT * FROM genero");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores['nombre'].'">'.$valores['nombre'].'</option>';
          }
        ?>           
                </select>
                </div> 
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-pencil-ruler"></i>
                <label for="gruposanguineo" class="col-form-label">Grupo Sanguineo:</label>
                <input type="text" class="form-control" id="gruposanguineo" required>
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-pencil-ruler"></i>
                <label for="estadocivil" class="col-form-label">E. Civil:</label>
                <select type="text" class="form-control" id="estadocivil" required>
                <option selected>Seleccione E. Civil:</option>
              <?php
          $query = $mysqli -> query ("SELECT * FROM ecivil");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores['nombre'].'">'.$valores['nombre'].'</option>';
          }
        ?>                  
                </select>
                </div>   
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-pencil-ruler"></i>
                <label for="fechanacimiento" class="col-form-label">Fecha Nacimiento:</label>
                <input type="date" step="1"  min="1940-01-01" max="2006-12-31" value="<?php echo date("Y-m-d", $time);?>" class="form-control" id="fechanacimiento" required>
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-briefcase"></i>
                <label for="paisnacimiento" class="col-form-label">Pais de Nacimiento:</label>
                <input type="text" class="form-control" id="paisnacimiento" required>
                </div> 
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-briefcase"></i>
                <label for="lugarnacimiento" class="col-form-label">Domicilio:</label>
                <input type="text" class="form-control" id="lugarnacimiento" required>
                </div> 
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-briefcase"></i>
                <label for="departamento" class="col-form-label">Departamento:</label>
                <input type="text" class="form-control" id="departamento" required>
                </div> 
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-briefcase"></i>
                <label for="provincia" class="col-form-label">Provincia:</label>
                <input type="text" class="form-control" id="provincia" required>
                </div> 
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-briefcase"></i>
                <label for="distrito" class="col-form-label">Distrito:</label>
                <input type="text" class="form-control" id="distrito" required>
                </div> 
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-briefcase"></i>
                <label for="categoria" class="col-form-label">Categoria:</label>
                <select type="text" class="form-control" id="categoria" required>
                <option selected>Seleccione categoria:</option>
                 <?php
                   $query = $mysqli -> query ("SELECT * FROM categoria");
                  while ($valores = mysqli_fetch_array($query)) {
                 echo '<option value="'.$valores['categoria'].'">'.$valores['categoria'].'</option>';
                   }
                   ?>                  
                </select>
                </div> 
                </div>
                
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-briefcase"></i>
                <label for="puesto" class="col-form-label">Puesto:</label>
                <select type="text" class="form-control" id="puesto" required>
                <option selected>Seleccione puesto:</option>
                 <?php
                   $query = $mysqli -> query ("SELECT * FROM detallepuesto");
                  while ($valores = mysqli_fetch_array($query)) {
                 echo '<option value="'.$valores['puesto'].'">'.$valores['puesto'].'</option>';
                   }
                   ?>                  
                </select>
                </div> 
                </div>
                   

                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-pencil-ruler"></i>
                <label for="fingreso" class="col-form-label">Fecha de Ingreso:</label>
                <input type="date" step="1"  min="1977-01-01" max="2040-12-31" value="<?php echo date("Y-m-d", $time);?>" class="form-control" id="fingreso" required>
                </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-briefcase"></i>
                <label for="unidadfuncional" class="col-form-label">Unidad Funcional:</label>
                <input type="text" class="form-control" id="unidadfuncional" required>
                </div> 
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-briefcase"></i>
                <label for="centrocostos" class="col-form-label">Centro de Costos:</label>
                <select type="text" class="form-control" id="centrocostos" required>
                <option selected>Seleccione C. Costos:</option>
                 <?php
                   $query = $mysqli -> query ("SELECT * FROM ccostos");
                  while ($valores = mysqli_fetch_array($query)) {
                 echo '<option value="'.$valores['Nombre'].'">'.$valores['Nombre'].'</option>';
                    }
                     ?>                  
                </select>

                </div> 
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-user-tag"></i>
                <label for="estado" class="col-form-label">Estado:</label>
                <input type="text" value="Activo" class="form-control" id="estado" readonly>
                </div>    
                </div>   
                <div class="col-6">
                <div class="form-group">   
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-solid fa-qrcode"></i> Generar QR</button>      
                </div>    
                </div>
              </div>
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal"> <i class="fas fa-solid fa-ban"></i> Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="custom-tooltip" title="Guardar Personal"><i class="fas fa-solid fa-cloud"></i> Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    
    



<!--FIN del cont principal-->

 

</div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; PMO-PIURA-2021</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Confirma salir y cerrar Sesión?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
          <a class="btn btn-primary" href="../bd/logout.php">Salir</a>
  
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script src="plugins/sweetalert2/sweetalert2.all.min.js"></script>   
  
    <!-- datatables JS -->
    <script type="text/javascript" src="vendor/datatables/datatables.min.js"></script>    
    <!-- código propio JS --> 
    <script type="text/javascript" src="mainpersonal.js"></script>  
    <script type="text/javascript" src="javascrip/clock.js"></script>
     <script src="jspdf.min.js"></script>
    <script src="jspdf.plugin.autotable.min.js"></script>

    <script>
$("#GenerarMysql").click(function(){
 
  var pdf = new jsPDF({
orientation: 'landscape', textcolor: '#2245E0'});
  pdf.text(90,20,"LISTADO DE OBREROS ACTIVOS");
  
 
  var columns = ["ID", "NOMBRES", "APELLIDOS", "DNI", "NACIONALIDAD", "EDAD", "SEXO", "G. SANGUINEO", "E. CIVIL", "F. NACIMIENTO"];
  var data = [
<?php foreach($empleados as $c):?>
 [<?php echo $n; ?>, "<?php echo $c->nombres; ?>", "<?php echo $c->apellidos; ?>", "<?php echo $c->dni; ?>", "<?php echo $c->nacionalidad; ?>", "<?php echo $c->edad; ?>", "<?php echo $c->sexo; ?>", "<?php echo $c->gruposanguineo; ?>", "<?php echo $c->estadocivil; ?>", "<?php echo $c->fechanacimiento; ?>"],
<?php endforeach; ?>  
  ];

  pdf.autoTable(columns,data,
    { margin:{ top: 25  }}
  );

  pdf.save('ListadoObreros.pdf');
  

});
</script>   


</body>

</html>