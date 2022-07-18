<?php
// simple conexion a la base de datos
function connect(){
	return new mysqli("localhost:3308","root","","EPP");
}

?>