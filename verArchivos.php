<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

.flip-card {
  background-color: transparent;
  width: 300px;
  height: 300px;
  perspective: 1000px;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
}

.flip-card-front {
  background-color: white;
  color: black;
}

.flip-card-back {
  background-color: #2980b9;
  color: white;
  transform: rotateY(180deg);
}
</style>
</head>




</html>


<?php 
  session_start();
      include("src/libs/vars.php");
      include("src/libs/sessionControl/conection.php");
 $limite = 12;
  if (isset($_GET["pagina"])) { 
    $pagina  = $_GET["pagina"]; 
  } else {
    $pagina=5; 
  };

    if (isset($_GET["busqueda"])) { 
    $textBusqueda  = $_GET["busqueda"]; 
  } else {
    $textBusqueda=""; 
  };
 ?>

<body>
    
       
           <?php
             
            
           $filas_resultado=mysqli_query($conexion,"SELECT count(id_documento) from tbl_documentos where titulo like '%$textBusqueda%' OR tagdocumento LIKE '%$textBusqueda%'

            ");
        
           $filas = mysqli_fetch_row($filas_resultado);  
           $todal_filas = $filas[0];  
           $total_paginas = ceil($todal_filas / $limite); 
            ?>
                           <nav aria-label="Page navigation">
          <ul class='pagination justify-content-center' id="pagination">
                      <?php

                      $printEnd=0;
                      $rangoLeash='4';//TEMP                    
                      if ($pagina<=$rangoLeash+2) {
                        $rangoInferior='1';
                      }else{
                        $rangoInferior= $pagina-$rangoLeash;
                        ?>
                          <li class='page-item'  id="1"> <a class="page-link" href='pagination.php?page=1'> 1 </a> </li>
                          <li class='page-item'  > <a class="page-link"> ... </a> </li>    
                        <?php
                      }

                      if ($pagina>=($total_paginas-$rangoLeash)){
                        $rangoSuperior=$total_paginas;
                      }else{
                        $rangoSuperior= $pagina+$rangoLeash;
                        $printEnd=1;

                      }  



                        if(!empty($total_paginas)){
                          for($i=$rangoInferior; $i<=$rangoSuperior; $i++){ 
                  if($i == $pagina){ ?>
                    <li class='page-item active'  id="<?php echo $i;?>"> <a class="page-link" href='pagination.php?page=<?php echo $i;?>'>
                      <?php echo $i;?></a>
                    </li> 
                          
                              <?php } else {?>
                              <li class='page-item'id="<?php echo $i;?>"><a class="page-link" href='pagination.php?page=<?php echo $i;?>'><?php echo $i;?></a></li>
                            <?php }?>    
                        <?php }
                    }//Here

                    if ($printEnd==1) {                 
                    ?>
              <li class='page-item'  > <a class="page-link"> ... </a> </li>
              <li class='page-item'  id="<?php echo $total_paginas;?>"> <a class="page-link" href='pagination.php?page=1'> <?php echo $total_paginas;?> </a> </li>      
                 <?php
                    }
                    ?>
                      </ul>
         </nav>   

 <script>

   <?php


  $inicia_desde = ($pagina-1) * $limite;  

  ?>
                        
    $("#pagination li").on('click',function(e){
    e.preventDefault();
      $("#cargarTabla").html('<img src="img/structures/replace.gif" style="max-width: 50%">');
      $("#pagination li").removeClass('active');
      $(this).addClass('active');
          var paginaNumero = this.id;
        $("#cargarTabla").load("verArchivos.php?pagina="+ paginaNumero +"&busqueda=" + $("#textBusqueda").val());
      });
</script>

     <table class="table table-hover table-responsive" align="left">
    <?php      
            $selTable=mysqli_query($conexion,"SELECT * from tbl_documentos where titulo like '%$textBusqueda%' OR tagdocumento LIKE '%$textBusqueda%'
                ORDER BY id_documento
                LIMIT $inicia_desde, $limite;");          
           if (mysqli_num_rows($selTable)==0){
               echo "<div id='respuesta' style='color: red; font-weight: bold; text-align: center;'>  
                 La busqueda no devolvió ningún resultado </div>";
              } else{
            $orden=1;  

            while ($dataLibros=mysqli_fetch_assoc($selTable)){?>
           <?php if ($orden==1){ ?>               
        
            <tr>
                  <td style="width:350px;">
              
                <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Titulo:&nbsp;&nbsp;</strong><?php echo $dataLibros['titulo']; ?></div> <br>      
               <div style="width:245px;  float:right;" align="left"> 
               <div  align="left">
                 <div class="flip-card">
                 <div class="flip-card-inner">
                 <div class="flip-card-front">
                <?php echo "<img src='$dataLibros[doc_portada]' width='250' height='300'>" ?> 
                 </div>
                  <div class="flip-card-back">
                     <h1>Descripcion</h1> 
                     <p><?php echo $dataLibros['descripcion'];?> </p>

            <div align="center">
                <div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalVerPdf" 
                                 data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"                                 
                                 title="Mostrar Documento">
                                    <img  src="img/icons/instruccion.png" width="20" height="20"><p>Leer documento</p>
                                </button> 

                                </div>
                               
                   </div>
                   </div>
                  </div>  
                 </div>
              </div>

          
                                <br>

                          <?php if (isset($_SESSION[ "Logeado" ])): ?>
                            
                          
                            
                          

                         <div style='color: green; font-weight: bold; text-align: center;'>OPCION DE ADMINISTRADOR</div><br>
                        <div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalEliminarpdf" 
                                 data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"
                                 data-varformdocumentonom="<?php echo $dataLibros['nombre_archivo'];?>"
                                 data-varformdocumentotit="<?php echo $dataLibros['titulo'];?>"                                   
                                 title="Eliminar PDF">
                                    <img  src="img/icons/itemD.png" width="35" height="30">
                                </button>
                                 <button type="button" class="btn btn-light"  data-toggle="modal" data-target="#fotografiaModal"
                            data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"
                              data-varformdocumentotit="<?php echo $dataLibros['titulo'];?>"
                             data-varformdocumentopor="<?php echo $dataLibros['doc_portada'];?>"
                                title="Portada del Documento"   
                           ><img src="img/icons/BookCover.png" width="35" height="30"></button>

                            
                        <?php endif ?> 

                                </div>



              </div>
             
             </td>           
         
          <?php $orden=2;   }elseif ($orden==2) { # code...
           ?> <td style="width:350px;">
              
                <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Titulo:&nbsp;&nbsp;</strong><?php echo $dataLibros['titulo']; ?></div> <br>      
               <div style="width:245px;  float:right;" align="left"> 
                 
                 <div class="flip-card">
                 <div class="flip-card-inner">
                 <div class="flip-card-front">
                <?php echo "<img src='$dataLibros[doc_portada]' width='250' height='300'>" ?> 
                 </div>
                  <div class="flip-card-back">
                     <h1>Descripcion</h1> 
                     <p><?php echo $dataLibros['descripcion'];?> </p>

            <div align="center">
                <div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalVerPdf" 
                                 data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"                                 
                                 title="Mostrar Documento">
                                    <img  src="img/icons/instruccion.png" width="20" height="20"><p>Leer documento</p>
                                </button> 

                                </div>
                               
                   </div>
                   </div>
                 </div>
              </div>

          
                                <br>
                          <?php if (isset($_SESSION[ "Logeado" ])): ?>
                            
                          

                         <div style='color: green; font-weight: bold; text-align: center;'>OPCION DE ADMINISTRADOR</div><br>
                          <div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalEliminarpdf" 
                                 data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"
                                 data-varformdocumentonom="<?php echo $dataLibros['nombre_archivo'];?>"
                                 data-varformdocumentotit="<?php echo $dataLibros['titulo'];?>"  

                                 title="Eliminar PDF">
                                    <img  src="img/icons/itemD.png" width="35" height="30">
                                </button>
                               <button type="button" class="btn btn-light"  data-toggle="modal" data-target="#fotografiaModal"
                            data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"
                              data-varformdocumentotit="<?php echo $dataLibros['titulo'];?>"
                             data-varformdocumentopor="<?php echo $dataLibros['doc_portada'];?>"
                                title="Portada del Documento"   
                           ><img src="img/icons/BookCover.png" width="35" height="30"></button>
                            
                        <?php endif ?>         
                                </div>

              </div> 
             </td>
             <?php $orden=3;   }elseif ($orden==3) { # code...
           ?> <td style="width:350px;">
              
                <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Titulo:&nbsp;&nbsp;</strong><?php echo $dataLibros['titulo']; ?></div> <br>      
               <div style="width:245px;  float:right;" align="left"> 
                 
                 <div class="flip-card">
                 <div class="flip-card-inner">
                 <div class="flip-card-front">
                <?php echo "<img src='$dataLibros[doc_portada]' width='250' height='300'>" ?> 
                 </div>
                  <div class="flip-card-back">
                     <h1>Descripcion</h1> 
                     <p><?php echo $dataLibros['descripcion'];?> </p>

            <div align="center">
                <div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalVerPdf" 
                                 data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"                                 
                                 title="Mostrar Documento">
                                    <img  src="img/icons/instruccion.png" width="20" height="20"><p>Leer documento</p>
                                </button> 

                                </div>
                               
                   </div>
                   </div>
                 </div>
              </div>

          
                                <br>
                          <?php if (isset($_SESSION[ "Logeado" ])): ?>
                            
                          

                         <div style='color: green; font-weight: bold; text-align: center;'>OPCION DE ADMINISTRADOR</div><br>
                          <div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalEliminarpdf" 
                                 data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"
                                 data-varformdocumentonom="<?php echo $dataLibros['nombre_archivo'];?>"
                                 data-varformdocumentotit="<?php echo $dataLibros['titulo'];?>"  

                                 title="Eliminar PDF">
                                    <img  src="img/icons/itemD.png" width="35" height="30">
                                </button>
                               <button type="button" class="btn btn-light"  data-toggle="modal" data-target="#fotografiaModal"
                            data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"
                              data-varformdocumentotit="<?php echo $dataLibros['titulo'];?>"
                             data-varformdocumentopor="<?php echo $dataLibros['doc_portada'];?>"
                                title="Portada del Documento"   
                           ><img src="img/icons/BookCover.png" width="35" height="30"></button>
                            
                        <?php endif ?>         
                                </div>

              </div> 
             </td>  
           <?php $orden=4;   }elseif ($orden==4) {
           ?>
                <td style="width:350px;">
              
                <div align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Titulo:&nbsp;&nbsp;</strong><?php echo $dataLibros['titulo']; ?></div> <br>      
               <div style="width:245px;  float:right;" align="left"> 
                 
                 <div class="flip-card">
                 <div class="flip-card-inner">
                 <div class="flip-card-front">
                <?php echo "<img src='$dataLibros[doc_portada]' width='250' height='300'>" ?> 
                 </div>
                  <div class="flip-card-back">
                     <h1>Descripcion del Documento</h1> 
                     <p><?php echo $dataLibros['descripcion'];?> </p>
                   
            <div align="center">
                <div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalVerPdf" 
                                 data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"                                 
                                 title="Mostrar Documento">
                                    <img  src="img/icons/instruccion.png" width="20" height="20"><p>Leer documento</p>
                                </button> 

                                </div>
                               
                   </div>
                   </div>
                 </div>
              </div>

          
                                <br>
                          <?php if (isset($_SESSION[ "Logeado" ])): ?>
                            
                          
                            
                          

                         <div style='color: green; font-weight: bold; text-align: center;'>OPCION DE ADMINISTRADOR</div><br>
                          <div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalEliminarpdf" 
                                 data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"
                                 data-varformdocumentonom="<?php echo $dataLibros['nombre_archivo'];?>"
                                 data-varformdocumentotit="<?php echo $dataLibros['titulo'];?>"   

                                 title="Eliminar PDF">
                                    <img  src="img/icons/itemD.png" width="35" height="30">
                                </button>
                                 <button type="button" class="btn btn-light"  data-toggle="modal" data-target="#fotografiaModal"
                            data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"
                              data-varformdocumentotit="<?php echo $dataLibros['titulo'];?>"
                             data-varformdocumentopor="<?php echo $dataLibros['doc_portada'];?>"
                                title="Portada del Documento"   
                           ><img src="img/icons/BookCover.png" width="35" height="30"></button>
                            
                        <?php endif ?>         
                                </div>

              </div>
              </div> 
             </td>
             </tr> 
          <?php $orden=1; } ?>      
          <?php  } ?>
            
        </table>      
    
   <?php } ?>
           
     
</body>
