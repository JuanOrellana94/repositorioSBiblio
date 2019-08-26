<?php 
	include("../src/libs/vars.php");
	include("../src/libs/sessionControl/conection.php");
	date_default_timezone_set("America/El_Salvador");
	session_start();


	$modallibcod=$_POST['modallibcod'];
	$modallibtit=$_POST['modallibtit'];

		$insRegistro=mysqli_query($conexion,"DELETE FROM tbl_documentos WHERE 	id_documento='$modallibcod'	    
		    ;")
		    or die ('ERROR INS-INS:'.mysqli_error($conexion));	         

         array_map('unlink', glob("$modallibtit"));

	echo "1";

 ?>