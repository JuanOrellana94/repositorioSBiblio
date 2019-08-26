<?php 
  	include("../vars.php");
	include("../sessionControl/conection.php");
	session_start();
	

    $extencionesValidas = array('jpeg', 'jpg'); // valid extencionensions
	$direccion = '../../../img/portadapdf/'; // upload directory
	if(!empty($_POST['modallibcodPortada']) || !empty($_POST['modallibtitPortada']) || $_FILES['subirPortada'])
	{
		$img = $_FILES['subirPortada']['name'];
		$tmp = $_FILES['subirPortada']['tmp_name'];
		// get uploaded file's extencionension
		$extencion = strtolower(pathinfo($img, PATHINFO_EXTENSION));
		// can upload same image using rand function
		$imagenSubir = rand(1000,1000000).$img;
		// check's valid format
		if(in_array($extencion, $extencionesValidas)) 
		{ 
			$direccion = $direccion.strtolower($imagenSubir); 
			if(move_uploaded_file($tmp,$direccion)) 
			{
			
			$libcod = $_POST['modallibcodPortada'];
			$libtit = $_POST['modallibtitPortada'];
			echo "1";
	
			
			$insRegistro=mysqli_query($conexion,"
			UPDATE tbl_documentos SET		
			doc_portada='img/portadapdf/$imagenSubir'
			WHERE id_documento='$libcod';
		    ")
	    or die ('ERROR INS-INS:'.mysqli_error($conexion));

			
			}
		} 
		else 
		{
			echo '0';
		}
	}
 ?>