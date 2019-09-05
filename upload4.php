<?php 
 session_start();
      include("src/libs/vars.php");
      include("src/libs/sessionControl/conection.php");
 ?>
<?php

$fileName = $_FILES["file1"]["name"]; // The file name
$extension = explode(".",$fileName);
$num = count($extension)-1;
if($extension[$num] == "pdf"){
$fileTmpLoc = $_FILES["file1"]["tmp_name"]; // File in the PHP tmp folder
$fileType = $_FILES["file1"]["type"]; // The type of file it is
$fileSize = $_FILES["file1"]["size"]; // File size in bytes
$fileErrorMsg = $_FILES["file1"]["error"]; // 0 for false... and 1 for true
$titulo=$_POST['titulo'];
$destino = "upload/" . $titulo;
$criterio=$_POST['criterio'];
$descripcion=$_POST['descripcion'];
echo "<br>";

if (!$fileTmpLoc) { // if file not chosen
    echo "ERROR: porfavor seleccione el archivo pdf";
    exit();
}
if(move_uploaded_file($fileTmpLoc, "upload/$titulo")){

 
       
    $checkValidation="SELECT * FROM tbl_documentos WHERE titulo='$titulo' ;";

    $resultado=mysqli_query($conexion, $checkValidation) or die(mysqli_error($conexion));


    $dataRow = mysqli_fetch_array($resultado);  

   
   if($dataRow==0) {

    echo '<div style="color: green; font-weight: bold; text-align: center;"><h5>Nuevo archivo agregado</div>'; 
     
      


    $conexion->set_charset("utf8");
    
         
    $insRegistro=mysqli_query($conexion,"INSERT INTO tbl_documentos(titulo,descripcion,tamanio,tipo,nombre_archivo,tagdocumento) VALUES('$titulo','$descripcion','$fileSize bytes','$destino','$titulo','$criterio');")
            or die ('ERROR INS-INS:'.mysqli_error($conexion));           
}else{


    echo '<div style="color: red; font-weight: bold; text-align: center;"><h5>Ya se registro un archivo con este titulo</div>';
   

}
   

} else {
    echo "move_uploaded_file function failed";
}
}else{
    echo "el archivo subido no es pdf, se eliminara del servidor";
    array_map('unlink', glob("upload/$titulo")); 
}
?>
