<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1 class="text-info"> <i class="fas fa-solid fa-users"></i>  ASISTENCIAS REGISTRADAS</h1>
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


<div class="container">
        <div class="row">
        
            <div class="col-lg-12">   
            
           
		<hr style="border-top:1px dotted #000;"/>
    <div class="col-lg-12"> 
		<form class="form-inline" method="POST" action="">
			<label>Fecha Desde: </label>
			<input type="date" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="Start"  name="date1"/>
			<label> Hasta </label>
			<input type="date" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="End"  name="date2"/>
			<button class="btn btn-primary" name="search"><span class="glyphicon glyphicon-search">Buscar</span></button>
      <a href="#" class="btn btn-danger"><i class="fas fa-solid fa-file-pdf"></i> Generar PDF</a>  
		</form>
    </div>
		<br /><br />
		<div class="table-responsive">	
        <table id="tablaAsistencias" class="table table-dark table-borderless table-striped table-center table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
					<tr>
                                <th>ID</th>                             
                                <th>NOMBRE</th>
                                <th>DNI</th>
                                <th>PUESTO</th>
                                <th>CENTRO DE COSTOS</th>
                                <th>FECHA</th>
                                <th>HORA ENTRADA</th>
                                <th>HORA SALIDA</th> 
                                <th>Opciones</th> 
					</tr>
				</thead>
				<tbody>
					<?php include'range.php'?>	
				</tbody>
			</table>
		</div>	
	</div>
        </div>  
    </div>   

<!--FIN del cont principal-->

 <!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded">
            <div class="modal-header">
            <i class="fas fa-solid fa-fingerprint text-danger fa-2x"></i>
            <h5 class=" modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form  id="formPersonas">    
            <div class="modal-body">
            <div class="container">
            <div class="row">
            
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-address-card"></i>
                <label for="nombres" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombres" required readonly>
                </div>  
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-address-card"></i>
                <label for="dni" class="col-form-label">DNI:</label>
                <input type="text" class="form-control" id="dni" required readonly>
                </div>  
                </div>  
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-user"></i>
                <label for="puesto" class="col-form-label">Puesto:</label>
                <input type="text"  class="form-control" id="puesto" required readonly> 
                </div>
                  </div>   
                  <div class="col-6">
                <div class="form-group">
                <i class="fas fa-user"></i>
                <label for="centrocostos" class="col-form-label">Centro de Costos:</label>
                <input type="text"  class="form-control" id="centrocostos" required readonly>
                </div>
                  </div>  
                  <div class="col-6">
                <div class="form-group">
                <i class="fas fa-pencil-ruler"></i>
                <label for="fecha" class="col-form-label">Fecha:</label>
                <input type="date" step="1"  min="1940-01-01" max="2090-12-31" value="<?php date_default_timezone_set('America/Lima'); echo date("Y-m-d");?>" class="form-control" id="fecha" required>
                
              </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-user"></i>
                <label for="entrada" class="col-form-label">Hora Entrada:</label>
                <input type="time"  class="form-control" id="entrada" required>
                </div>
                  </div> 
                  <div class="col-6">
                <div class="form-group">
                <i class="fas fa-user"></i>
                <label for="salida" class="col-form-label">Hora Salida:</label>
                <input type="time"  class="form-control" id="salida" required>
                </div>
                  </div> 
            </div>
            </div>
            </div>
            <div class="modal-footer">
            
                <button type="button" class="btn btn-light" data-dismiss="modal"><i class="fas fa-solid fa-ban"></i>  Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark"><i class="fas fa-solid fa-cloud"></i>  Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  

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
    <script type="text/javascript" src="javascrip/filtroasistencias.js"></script> 
    <script type="text/javascript" src="javascrip/clock.js"></script>
     <script src="jspdf.min.js"></script>
    <script src="jspdf.plugin.autotable.min.js"></script>



</body>

</html>