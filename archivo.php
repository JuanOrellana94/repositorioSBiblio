<!DOCTYPE html>
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
        <!-- CONEXION AL SERVIDOR -->

        <?php
      $servidor="localhost";
      $usuario="root";
      $clave="";
      $base="repositorio";

    $conexion=mysqli_connect("$servidor","$usuario","$clave")or die ("Error al conectar");
    mysqli_select_db($conexion,"$base");


    $conexion->set_charset("utf8");
    
         
    $insRegistro=mysqli_query($conexion,"select * from tbl_documentos where id_documento=".$_GET['id']."")
            or die ('ERROR INS-INS:'.mysqli_error($conexion));           
            
           while ($dataLibros=mysqli_fetch_assoc($insRegistro)){
                if($dataLibros['nombre_archivo']==""){?>
         <p>NO tiene archivos</p>
                <?php }else{ ?>
        <iframe src="upload/<?php echo $dataLibros['nombre_archivo']; ?>" width="775" height="800"></iframe>
                
                <?php } } ?>
    </body>
</html>
