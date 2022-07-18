<?php

	class Database8{
		private $con;
		private $dbhost="localhost:3308";
		private $dbuser="root";
		private $dbpass="";
		private $dbname="EPP";
		function __construct(){
			$this->connect_db();
		}
		public function connect_db(){
			$this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
			if(mysqli_connect_error()){
				die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
			}
		}
		
		public function sanitize($var){
			$return = mysqli_real_escape_string($this->con, $var);
			return $return;
		}
		public function updatetwo($password,$usuario){
            
			$sql = "UPDATE usuarios SET password='$password' WHERE usuario='$usuario'";
			$res = mysqli_query($this->con, $sql);
			if($res){
				return true;
			}else{
				return false;
			}
		}
	
		
		
	}
 
	
	

?>	

