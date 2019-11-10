<?php 
 session_start();
      include("src/libs/vars.php");
      include("src/libs/sessionControl/conection.php");
 ?>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
         
<?php 

    $conexion->set_charset("utf8");
    
         
    $insRegistro=mysqli_query($conexion,"select * from tbl_documentos where id_documento=".$_GET['id']."")
            or die ('ERROR INS-INS:'.mysqli_error($conexion));           
            
           while ($dataLibros=mysqli_fetch_assoc($insRegistro)){
                if($dataLibros['nombre_archivo']==""){?>
         <p>NO tiene archivos</p>
                <?php }else{ ?>
                  
                     <h5 align="justify"><p><?php echo $dataLibros['descripcion']; ?></p></h5>
                
                <?php } } ?>
    </body>
</html>
