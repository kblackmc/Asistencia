<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
<h1 class="text-info"><i class="fas fa-solid fa-user-tag"></i>  CATEGORIAS Y PUESTOS</h1>
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

<!--FIN del cont principal-->
<?php
require_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT id,puesto,area,categoria FROM detallepuesto ";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
        <div class="row">
        
            <div class="col-lg-12">   
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal"> <i class="fas fa-solid fa-plus"></i> Nuevo Puesto</button>    
            <a href="categorias.php" class="btn btn-danger"><i class="fas fa-solid fa-user-tag"></i>  Agregar Categoria</a>
            </div>    
        </div>    
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-dark table-borderless table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>PUESTO</th>     
                                <th>AREA</th>
                                <th>CATEGORIA</th>                             
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['puesto'] ?></td>
                                <td><?php echo $dat['area'] ?></td>
                                <td><?php echo $dat['categoria'] ?></td>                                
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
        <div class="modal-content rounded">
            <div class="modal-header">
            <i class="fas fa-solid fa-user-tag"></i>
            <h5 class=" modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form  id="formPersonas">    
            <div class="modal-body">
            <div class="container">
            <div class="row">
            <?php
                $mysqli = new mysqli('localhost:3308', 'root', '', 'EPP');
            ?>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-address-card"></i>
                <label for="puesto" class="col-form-label">Puesto:</label>
                <input type="text" class="form-control" id="puesto" required>
                </div>  
                </div>
                <div class="col-6">
                <div class="form-group">
                <i class="fas fa-address-card"></i>
                <label for="area" class="col-form-label">Area:</label>
                <input type="text" class="form-control" id="area" required>
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
    <script type="text/javascript" src="maincategorias.js"></script>  
    <script type="text/javascript" src="javascrip/clock.js"></script>

    

</body>

</html>


