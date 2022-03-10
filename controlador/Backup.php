<?php
	//include our function
	include 'function.php';
	include '../modelo/basededatos.php';
	
	$base = new Base();
	$day = date("l");
	session_start();
	$usuario= $_SESSION['usuario'];
	$datos= date_default_timezone_set('America/Argentina/Mendoza');
	$fecha = date("Y-m-d H:i:s");
	if(isset($_POST['backup'])){
		//get credentails via post
		$server = $_POST['server'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$dbname = $_POST['dbname'];
		//backup and dl using our function
		backDb($server, $username, $password, $dbname);
		$base->crear($day,$dbname,$usuario,$fecha);
		exit();
	}
	else{
		echo 'Rellena las credenciales de la base de datos';
	}
?>
