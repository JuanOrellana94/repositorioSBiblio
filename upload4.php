<?php

$fileName = $_FILES["file1"]["name"]; // The file name
$extension = explode(".",$fileName);
$num = count($extension)-1;
if($extension[$num] == "pdf"){
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
$destino = "upload/" . $fileName;
$titulo=$_POST['titulo'];
$criterio=$_POST['criterio'];
$descripcion=$_POST['descripcion'];
echo "<br>";

if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: porfavor seleccione el archivo pdf";
    exit();
}
if(move_uploaded_file($fileTmpLoc, "upload/$fileName")){

  // conexion a la base de datos

  $servidor="localhost";
  $usuario="bibliocnx";
  $clave="Biblioteca123$";
  $base="addrepositorio";

    $conexion=mysqli_connect("$servidor","$usuario","$clave")or die ("Error al conectar");
    mysqli_select_db($conexion,"$base");
       
    $checkValidation="SELECT * FROM tbl_documentos WHERE titulo='$titulo' ;";

    $resultado=mysqli_query($conexion, $checkValidation) or die(mysqli_error($conexion));


    $dataRow = mysqli_fetch_array($resultado);  

   
   if($dataRow==0) {

    echo '<div style="color: green; font-weight: bold; text-align: center;"><h5>Nuevo archivo agregado</div>'; 
     
      


    $conexion->set_charset("utf8");
    
         
    $insRegistro=mysqli_query($conexion,"INSERT INTO tbl_documentos(titulo,descripcion,tamanio,tipo,nombre_archivo,tagdocumento) VALUES('$titulo','$descripcion','$fileSize bytes','$destino','$fileName','$criterio');")
            or die ('ERROR INS-INS:'.mysqli_error($conexion));           
}else{


    echo '<div style="color: red; font-weight: bold; text-align: center;"><h5>Ya se registro un archivo con este titulo</div>';
   

}
   

} else {
    echo "move_uploaded_file function failed";
}
}else{
    echo "el archivo subido no es pdf, se eliminara del servidor";
    array_map('unlink', glob("upload/$fileName")); 
}
?>
