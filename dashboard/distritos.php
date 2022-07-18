<?php require_once "vistas/parte_superior.php"?>

<body>
    <div class="container">
    <div class="row gx-2">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-12"><h2> <i class="fas fa-solid fa-share"></i>Agregar <b>Distritos</b></h2></div>
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>

            <?php
				include ("datapais/database3.php");
				$distrito= new Database3();
				if(isset($_POST) && !empty($_POST)){
                    $pais = $distrito->sanitize($_POST['pais']);
                    $departamento = $distrito->sanitize($_POST['departamento']);
                    $provincia = $distrito->sanitize($_POST['provincia']);
                    $nombre = $distrito->sanitize($_POST['nombre']);
					
					
					$res3 = $distrito->createfour($pais,$departamento,$provincia,$nombre,);
                    
					if($res3){
						$message= "Distrito ingresada con éxito";
						$class="alert alert-success";
					}else{
						$message="Error,Distrito ingresado anteriormente";
						$class="alert alert-danger";
					}
					
					?>
				<div class="<?php echo $class?>">
				  <?php echo $message;?>
				</div>	
					<?php
				}
	
			?>
                <div class="container overflow-hidden">
                
                <div class="p-5 border bg-light">
                <?php
                $mysqli = new mysqli('localhost:3308', 'root', '', 'EPP');
            ?>
				<form method="post">
				<div class="col">
					<label>Nombre del Pais:</label>
          <select type="text" class="form-control" name="pais" id="pais" required>
                <option selected>Seleccione Pais:</option>
                 <?php
                   $query = $mysqli -> query ("SELECT * FROM pais");
                  while ($valores = mysqli_fetch_array($query)) {
                 echo '<option value="'.$valores['nombrepais'].'">'.$valores['nombrepais'].'</option>';
                   }
                   ?>                  
                </select>
				</div>
                <div class="col">
					<label>Nombre del Departamento:</label>
          
				
          <select type="text" class="form-control" name="departamento" id="departamento" required>
                <option selected>Seleccione Departamento:</option>
                 <?php
                   $query = $mysqli -> query ("SELECT * FROM departamento");
                  while ($valores = mysqli_fetch_array($query)) {
                 echo '<option value="'.$valores['nombre'].'">'.$valores['nombre'].'</option>';
                   }
                   ?>                  
                </select>
				</div>
                <div class="col">
					<label>Nombre de la Provincia:</label>
          <select type="text" class="form-control" name="provincia" id="provincia" required>
                <option selected>Seleccione Provincia:</option>
                 <?php
                   $query = $mysqli -> query ("SELECT * FROM provincia");
                  while ($valores = mysqli_fetch_array($query)) {
                 echo '<option value="'.$valores['nombre'].'">'.$valores['nombre'].'</option>';
                   }
                   ?>                  
                </select>
				</div>
                <div class="col">
					<label>Nombre del Distrito:</label>
          
					<input type="text" name="nombre" id="nombre" class='form-control' maxlength="100" required >
				</div>
                <?php
                  echo "<br>";
                    ?>
				<div class="col-md-8 pull-right">
					<button type="submit" class="btn btn-danger">Guardar Distrito</button>
				</div>
                <hr>
                <a href="paisesciudades.php" class="btn btn-success"><i class="fas fa-solid fa-plane-departure"></i> Ir Paises</a>
                <a href="departamentos.php" class="btn btn-primary"><i class="fas fa-solid fa-plane-departure"></i> Ir a Departamentos</a>
				<a href="provincias.php" class="btn btn-warning"><i class="fas fa-solid fa-plane-departure"></i> Ir a Provincia</a>
				</form>
			</div>
        </div>
        <?php
                  echo "<br>";
                    ?>
    </div> 
    <table class="table table-striped table-hover">
                <thead class="text-center table-dark">
                    <tr>
                        <th>ID</th>
                        <th>PAIS</th>
                        <th>DEPARTAMENTO</th>
                        <th>PROVINCIAS</th>
                        <th>DISTRITO</th>
                    </tr>
                </thead>
				<?php 
				include ('datapais/readdistrito.php');
				$pais = new Database4();
				$listado=$pais->read();
				?>
                <tbody>
				<?php 
					while ($row=mysqli_fetch_object($listado)){
						$id=$row->id;
            $pais=$row->pais;
            $departamento=$row->departamento;
            $provincia=$row->provincia;
						$nombre=$row->nombre;
				?>
					<tr class="text-center">
                        <td><?php echo $id;?></td>
                        <td><?php echo $pais;?></td>
                        <td><?php echo $departamento;?></td>
                        <td><?php echo $provincia;?></td>
                        <td><?php echo $nombre;?></td>
                    </tr>	
				<?php
					}
				?>
                    
                    
                          
                </tbody>
            </table>
    </div>
    </div>
    </div>
    
</body>
<?php
                  echo "<br>";
                    ?>
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


  


</body>

</html>            