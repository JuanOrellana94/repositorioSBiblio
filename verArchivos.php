<?php 
  session_start();
      include("src/libs/vars.php");
      include("src/libs/sessionControl/conection.php");
 $limite = 10;
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
    
        <table class="table table-bordered table-hover"  style="background-color: #FFFFFF;">          
           <?php
             
            
           $filas_resultado=mysqli_query($conexion,"SELECT count(id_documento) from tbl_documentos where titulo like '%$textBusqueda%'");
           $filas = mysqli_fetch_row($filas_resultado);  
           $todal_filas = $filas[0];  
           $total_paginas = ceil($todal_filas / $limite); 
            ?>
                <nav aria-label="Page navigation">
                        <ul class='pagination justify-content-center"' id="pagination">
                        <?php if(!empty($total_paginas)):for($i=1; $i<=$total_paginas; $i++):  
                            if($i == $pagina):?>
                                    <li class='page-item active'  id="<?php echo $i;?>"><a class="page-link" href='pagination.php?page=<?php echo $i;?>'><?php echo $i;?></a></li> 
                            <?php else:?>
                            <li class='page-item'id="<?php echo $i;?>"><a class="page-link" href='pagination.php?page=<?php echo $i;?>'><?php echo $i;?></a></li>
                            <?php endif;?>    
                        <?php endfor;endif;?>
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

    <?php      
            $selTable=mysqli_query($conexion,"SELECT * from tbl_documentos where titulo like '%$textBusqueda%'               
                ORDER BY id_documento
                LIMIT $inicia_desde, $limite;");
            if (mysqli_num_rows($selTable)==0){
             echo "<div id='respuesta' style='color: red; font-weight: bold; text-align: center;'>  
               La busqueda no devolvió ningún resultado </div>";
            } else {

            $orden=1;           
            while ($dataLibros=mysqli_fetch_assoc($selTable)){?>
           <?php if ($orden==1){ ?>               
          
            <tr>
             <td>
              <div style="width:500px; padding:0px;" align="right"><?php echo "<img src='$dataLibros[doc_portada]' width='150' height='200'>" ?>
                  
               <div style="width:245px;  float:right;" align="left"> 
                &nbsp;&nbsp;Titulo:&nbsp;&nbsp;<?php echo $dataLibros['titulo']; ?> <br>             
                &nbsp;&nbsp;Peso:&nbsp;&nbsp;<?php echo $dataLibros['tamanio']; ?>  <br>             
                &nbsp;&nbsp;Detalles:&nbsp;&nbsp;<div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalVerDetalles" 
                                 data-varformdocumentodes="<?php echo $dataLibros['descripcion'];?>"                                 
                                 title="Mostrar Documento">
                                    <img  src="img/icons/pregunta.png" width="35" height="30">
                                </button>
                            
                                 
                                </div><br>
                  &nbsp;&nbsp;Opciones:<div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalVerPdf" 
                                 data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"                                 
                                 title="Mostrar Documento">
                                    <img  src="img/icons/verEjemplar.png" width="35" height="30">
                                </button>
                            
                                 
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
         
          <?php $orden=2;   }elseif ($orden==2) { # code...
           ?>
                      <td>
              <div style="width:500px; padding:0px;" align="right"><?php echo "<img src='$dataLibros[doc_portada]' width='150' height='200'>" ?>
                  
               <div style="width:245px;  float:right;" align="left"> 
                &nbsp;&nbsp;Titulo:&nbsp;&nbsp;<?php echo $dataLibros['titulo']; ?> <br>             
                &nbsp;&nbsp;Peso:&nbsp;&nbsp;<?php echo $dataLibros['tamanio']; ?>  <br>             
                &nbsp;&nbsp;Detalles:&nbsp;&nbsp;<div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalVerDetalles" 
                                 data-varformdocumentodes="<?php echo $dataLibros['descripcion'];?>"                                 
                                 title="Mostrar Documento">
                                    <img  src="img/icons/pregunta.png" width="35" height="30">
                                </button>
                            
                                 
                                </div><br>
                &nbsp;&nbsp;Opciones:<div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalVerPdf" 
                                 data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"                                 
                                 title="Mostrar Documento">
                                    <img  src="img/icons/verEjemplar.png" width="35" height="30">
                                </button> 
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
           <?php $orden=3;   }elseif ($orden==3) {
           ?>
             <td>
              <div style="width:500px; padding:0px;" align="right"><?php echo "<img src='$dataLibros[doc_portada]' width='150' height='200'>" ?>
                  
                <div style="width:245px;  float:right;" align="left"> 
                &nbsp;&nbsp;Titulo:&nbsp;&nbsp;<?php echo $dataLibros['titulo']; ?> <br>             
                &nbsp;&nbsp;Peso:&nbsp;&nbsp;<?php echo $dataLibros['tamanio']; ?>  <br>             
                &nbsp;&nbsp;Detalles:&nbsp;&nbsp;<div class="btn-group" role="group" aria-label="Opciones">
                               <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalVerDetalles" 
                                 data-varformdocumentodes="<?php echo $dataLibros['descripcion'];?>"                                 
                                 title="Mostrar Documento">
                                    <img  src="img/icons/pregunta.png" width="35" height="30">
                                </button>
                            
                                 
                                </div><br>
                &nbsp;&nbsp;Opciones:<div class="btn-group" role="group" aria-label="Opciones">
                                <button type="button" class="btn btn-light" data-toggle="modal"
                                 data-target="#modalVerPdf" 
                                 data-varformdocumentoid="<?php echo $dataLibros['id_documento'];?>"                                 
                                 title="Mostrar Documento">
                                    <img  src="img/icons/verEjemplar.png" width="35" height="30">
                                </button>
                            
                                 
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
