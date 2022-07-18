<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
<h1 class="text-info"><i class="fas fa-regular fa-glasses"></i>   BUSQUEDAS AVANZADAS</h1>
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
</div>

<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id,nombres, apellidos, dni, nacionalidad, edad, sexo,gruposanguineo,estadocivil,fechanacimiento,paisnacimiento,lugarnacimiento,departamento,provincia,distrito,categoria,puesto,fingreso,unidadfuncional,centrocostos,estado FROM personal";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>



<div class="container">
        <div class="row">
                <div class="col-lg-12">
<div class="card text-center">
<div class="card text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a href="#home" class="nav-link active" data-bs-toggle="tab">Empleados</a>
            </li>
            <li class="nav-item">
                <a href="#profile" class="nav-link" data-bs-toggle="tab">Centro de Costos</a>
            </li>
            <li class="nav-item">
                <a href="#messages" class="nav-link" data-bs-toggle="tab">Asistencias</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="home">
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
							        	echo '<span class="label warning">InActivo</span>';
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
                <a href="#" class="btn btn-primary">Descargar</a>
            </div>
            <div class="tab-pane fade" id="profile">
                <h5 class="card-title">Profile tab content</h5>
                <p class="card-text">Here is some example text to make up the tab's content. Replace it with your own text anytime.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            <div class="tab-pane fade" id="messages">
                <h5 class="card-title">Messages tab content</h5>
                <p class="card-text">Here is some example text to make up the tab's content. Replace it with your own text anytime.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    </div>
</div>
 
</div>
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

 

  
    <!-- datatables JS -->
    <script type="text/javascript" src="vendor/datatables/datatables.min.js"></script>    
    <!-- código propio JS --> 
  
    <script type="text/javascript" src="javascrip/clock.js"></script>

    <script type="text/javascript" src="javascrip/busquedas.js"></script>

</body>

</html>


