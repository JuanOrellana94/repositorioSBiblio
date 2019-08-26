<?php
//CERRAR LA SESION
	include("../vars.php");
	include "conection.php";
	session_start();
	
	
	unset($_SESSION);

	session_destroy();
	
	mysqli_close($conexion);
	
	echo "Sesion cerrada";



?>