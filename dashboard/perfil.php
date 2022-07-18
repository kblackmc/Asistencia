<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
<h1 class="text-info"><i class="fas fa-solid fa-user-check"></i> Perfil </h1>
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

 
<div class="container">
<div class="row">
  <div class="col-sm-6">
    <div class="card text-bg-light">
    <div class="card-header"><center>PERFIL</center>
    </div>
      <div class="card-body">
      
      <center><img src="img/perfil.png" class="rounded-circle" width="150" /></center>
      <center><h2 class="card-title text-info" ><?php echo $_SESSION["s_usuario"];?></h2></center>
      <center><p class="card-text text-success" ><?php echo $_SESSION["s_tipo"];?></p></center>
      </div>
    </div>
  </div>

  
  <div class="col-sm-6">
    <div class="card text-bg-dark">
    <div class="card-header"><center>INFORMACIÓN</center>
    
  </div>
      <div class="card-body">
      
        <h5 class="card-title">Usuario</h5>
        <input type="text" id="usuario" name="usuario" value="<?php echo $_SESSION["s_usuario"];?>" class="form-control" >
        <br>
        <h5 class="card-title">Rol</h5>
        <input type="text" id="tipo" name="tipo" value="<?php echo $_SESSION["s_tipo"];?>" class="form-control" readonly>
        <br>
        <h5 class="card-title">Contraseña</h5>
        <input  class="form-control" id="contraseña" placeholder="Contraseña" value="<?php echo $_SESSION["s_pass"];?>" type="password">
        <div class="form-check">
         <input class="form-check-input" type="radio" onclick="mostrarContrasena()" name="flexRadioDefault" id="flexRadioDefault1" >
         <label class="form-check-label" for="flexRadioDefault1">
           Mostrar Contraseña
            </label>
        </div>
        <br>
        <h5 class="card-title">Nueva Contraseña</h5>
        <input  class="form-control" id="password" name="password" placeholder="Contraseña"  type="text" required>
        
        <br>
        <h5 class="card-title">Estado</h5>
        <input type="text" value="Activo" class="form-control" id="estado" readonly>
        <br>
        
    <?php
				include ("datapais/perfilupdate.php");
				$actualizarpassword= new Database8();
				if(isset($_POST) && !empty($_POST)){
                    $password = $actualizarpassword->sanitize($_POST['password']);
                    $usuario = $actualizarpassword->sanitize($_POST['usuario']);
					$res1 = $actualizarpassword->updatetwo($password,$usuario);
                    
					if($res1){
						$message= "Contraseña Modificada Correctamente";
						$class="alert alert-success";
					}else{
						$message="Error,al modificar contraseña";
						$class="alert alert-danger";
					}
					
					?>
				<div class="<?php echo $class?>">
				  <?php echo $message;?>
				</div>	
					<?php
				}
	
			?>
        
        <button type="submit" class="btn btn-success">Actualizar</button>
        
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
  <script type="text/javascript" src="javascrip/clock.js"></script>
 

  
    <!-- datatables JS -->
    <script type="text/javascript" src="vendor/datatables/datatables.min.js"></script>    

   
    <script>
  function mostrarContrasena(){
      var tipo = document.getElementById("contraseña");
      if(tipo.type == "password"){
          tipo.type = "text";
          
      }else{
          tipo.type = "password";
         
          
      }
  }
</script>
    

</body>

</html>


