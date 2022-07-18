<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1 class="text-info"> <i class="fas fa-solid fa-qrcode"></i>  REGISTRAR ASISTENCIA QR</h1>
</div>

<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

date_default_timezone_set('America/Lima');
$date1 = date('Y-m-d');
$date2 = date('Y-m-d');
$consultas = "SELECT id,nombres, dni,puesto,centrocostos,fecha,entrada,salida FROM lista WHERE fecha BETWEEN '$date1' AND '$date2'";
$resultados = $conexion->prepare($consultas);
$resultados->execute();
$datos=$resultados->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
        <div class="row">
        
            <div class="col-lg-12">            
            <a href="verasistencias.php" class="btn btn-warning"><i class="fas fa-solid fa-eye"></i> VER ASISTENICIAS</a> 
            <button id="" type="button" class="btn btn-info" data-toggle="modal"><i class="fas fa-solid fa-file-pdf"></i> GENERAR REPORTE</button>   
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                <div class="card text-center">
                <div class="card-header">
                    <div class="clock">
                        <span id="hours" class="hours"></span> :
                        <span id="minutes" class="minutes"></span> :
                        <span id="seconds" class="seconds"></span>
                    </div>
                </div>
                 <div class="card-body">
                 <div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Special title treatment</h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
   <div class="col-sm-6">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">ASISTENCIAS REGISTRADAS</h5>
        <div class="input-group input-daterange">
        <label class="ml-3 form-control-placeholder" id="start-p" for="start">Desde:</label>
         <input type="date" class="form-control" name="fechahora" step="1" min="2021-01-01T00:00Z" max="2030-12-31T12:00Z" value="<?php date_default_timezone_set('America/Lima'); echo date("Y-m-d");?>" readonly>
          <label class="ml-3 form-control-placeholder" id="end-p" for="end">Hasta:</label>
          <input type="date" class="form-control" name="fechahora" step="1" min="2021-01-01T00:00Z" max="2030-12-31T12:00Z" value="<?php date_default_timezone_set('America/Lima'); echo date("Y-m-d");?>" readonly>
        </div>
      
        <div class="table-responsive">        
                        <table id="tablaAsistencias" class="table table-dark table-borderless table-striped table-bordered table-condensed" style="width:100%">
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
                            <?php                            
                            foreach($datos as $dat1) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat1['id'] ?></td>
                                <td><?php echo $dat1['nombres'] ?></td>
                                <td><?php echo $dat1['dni'] ?></td>
                                <td><?php echo $dat1['puesto'] ?></td>
                                <td><?php echo $dat1['centrocostos'] ?></td>
                                <td><?php echo $dat1['fecha'] ?></td>
                                <td><?php echo $dat1['entrada'] ?></td>
                                <td><?php echo $dat1['salida'] ?></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
        <a href="#" class="btn btn-danger"><i class="fas fa-solid fa-file-pdf"></i> Generar PDF</a>  
    </div>
  </div>
</div>
                </div>
         <div class="card-footer text-muted">
         <div class="date">
    <span id="weekDay" class="weekDay"></span>, 
    <span id="day" class="day"></span> de
    <span id="month" class="month"></span> del
    <span id="year" class="year"></span>
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
    <script type="text/javascript" src="mainasistencias.js"></script>  
    <script type="text/javascript" src="javascrip/clock.js"></script>
    

</body>

</html>