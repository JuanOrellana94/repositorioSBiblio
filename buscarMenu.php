<!--ASPECTO VISUAL DE LA PAGINA DE AUTORES-->
    <!--CONTENEDOR PARA TABLA DE AUTORES/MODALES PARA AGREGAR Y ELIMINAR AUTORES--> 
<!DOCTYPE html>
<html lang="en">
   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <TITLE>SISTEMA DE BIBLIOTECA, VERSION PROTOTIPO 1.0, 2019</TITLE>
    <!-- Bootstrap -->
    <script src="src/js/jquery-3.4.0.min.js"></script>
    <script src="src/js/bootstrap.bundle.min.js"></script>
    <script src="src/js/jsSession.js"></script>
    <script src="src/js/jsRedirects.js"></script>
   
    <!-- Bootstrap -->
    <link rel="stylesheet" href="src/css/bootstrap.css">  
    <!--<link rel="stylesheet" href="src/css/imgbutton.css"> -->
     <!-- credit here -->
    <link rel="stylesheet" href="src/css/datePickerPureCSS.css">
    <script src="src/js/insertProcess/jsLibros.js"></script>

    <link href="src/css/background.css" rel="stylesheet"/>

    <link href="src/css/select2.min.css" rel="stylesheet"/>
    <link href="src/css/select2-bootstrap4.css" rel="stylesheet"/>
    <script src="src/js/select2.min.js"></script>
    <link href="src/css/jquery.tagsinput.css" rel="stylesheet"/>
    <script src="src/js/jquery.tagsinput.js"></script>
    

<style type="text/css">
progress[value] {
  /* Reset the default appearance */
  -webkit-appearance: none;
   appearance: none;

  width: 250px;
  height: 20px;
}der-radius: 9px;  
}
  </style>
    

  </head>


  <?php 
  include("src/libs/vars.php");
  include("src/libs/sessionControl/conection.php");
 
  session_start();
  if (isset($_SESSION['autorizado'])) {
      # code...

    unset($_SESSION);

    session_destroy();
  
  }

   ?>  
<body style="background-color:#4A0A0A;">
  
    <div class="row" style="margin-left: 1%; margin-right: 1%;">
      <div class="col-lg-10">
        <nav class="navbar navbar-expand-md" style="background-color:#4A0A0A;" >
          <a href="inicio.php">
          <div>
            <img src="img/icons/LogoSys.png" width="100" height="100" alt="" >
          </div>
           </a> 
          <div style="vertical-align: middle; margin: 5px; color:white">
               <p class="font-weight-light"> <h3> Repositorio de documentos</h3></p>       
          </div>  
                             
        </nav>
      </div>
      <div class="col-lg-2">
        <?php
          if (!isset($_SESSION[ "Logeado" ])){
              ?>
              <div class="navbar flex-row-reverse text-white"  style="margin: 5px">
                <table>        
                  <tr>                  
                    <td align="center" width="100px" ><img class="pequeña" src="img/icons/User.png" alt=""></td>
                  </tr>
                  <tr>       
                    <td width="100px" align="center"><button  type="button" class="btn btn-outline-light my-2 my-sm-0" id="Iniciar"  onclick="rediLogin()">Acceder</button></td>
                  </tr>       
                </table>        
              </div>
             
              <?php
            } else  {
              ?>
              <div class="navbar flex-row-reverse  text-white"  style="margin: 5px">
                <table>        
                  <tr>
                    <td align="right" width="130px"> <font color="white"> <?php echo $_SESSION["nombreComp"]?></font></td>
                    <td></td>
                    <td align="center" width="100px" ><img class="pequeña" src="img/icons/User.png" alt=""></td>
                  </tr>
                  <tr>
                    <td align="right" width="130px">  <font color="white"><?php echo $_SESSION["existeNombre"]?> </font></td>
                    <td></td>
                    <td width="100px" align="center"><button  type="button" class="btn btn-outline-light my-2 my-sm-0" id="cerrarSec"  onclick="cerrar()">Cerrar</button></td>
                  </tr>       
                </table>        
              </div>
              <?php
              }
         
        ?>
        
      </div>
    </div>
     <div class="container-fluid" > 
    <div class="col-sm-12">  
      <div class="card">   
        

    <?php
     
     ?>
  
<?php if (isset($_SESSION[ "existe" ])) {
  # code...
 ?>      

   <!--DIRECCION DE LA UBICACION ACTUAL-->     
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Menu de administrador: subir archivos</a></li>   
    </ol>
  </nav>   

<!--DIRECCION DE LA UBICACION ACTUAL-->     
     

<!--INICIO CONTENEDOR DE CATALOGO DE  CODIGO DE BARRA LIBROS-->    
<div class="container-fluid" > 
    <div class="col-sm-12">  
      <div class="card">   
        <div class="card-header">
          <div class="row mx-auto">
            <div style="vertical-align: middle; margin: 5px">
               <p class="font-weight-light"> <h3> Publicar un nuevo documento</h3>  Seleccione el archivo PDF en su equipo mediante el boton Elegir archivos: <br>Posteriormente  realice click en Subir archivos, le mostrara una alerta de confirmacion de la publicacion.                      
            </div>           
          </div>     
        </div>
        <!--Cuerpo del panel-->         
        <div class="card-body">              
          <div class="row">            
            <div class="col-md-12">
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-5">                     
                        <div align="center" class="input-group"> 
                         <form id="upload_form" enctype="multipart/form-data" method="post"> 
                           <div>
                            <label  for="TituloLabel">Titulo del documento</label></div>
                           <div> <input  type="text" maxlength="56" class="form-control" name="formdocutit" id="formdocutit"  placeholder="" ></div><br>
                            
                                <div><label for="TituloLabel">Criterios de Busqueda (Usa Tab entre cada criterio)</label></div>
                                <div><input  type="text"   class="block-tab" name="formdocutag" id="formdocutag" maxlength="23" placeholder="" ></div>                   
                        
                            <br>
                             <div><label for="TituloLabel">Ingrese una descripcion del documento</label></div>
                                <div><textarea  type="text" class="form-control " maxlength="380" rows="10" cols="30" name="formdocudes" id="formdocudes"  placeholder="" ></textarea></div>

                        
                            <br>
              
                        <div>
                            <label for="TituloLabel">Seleccione un documento</label></div>
                        <div> <input required="" style="width:100%" id="file1"  type="file" multiple  name="file1" accept=".pdf" required="" /></div> <br><br>
                        
                         <table><tr><td>
                         <button type="button" class="btn btn-primary" onclick="uploadFile()">Subir Archivo</button> </td><td>                 
                        <progress id="barradeprogreso" value="0" max="100" style="width:300px"></progress></td> </tr>
                        </table>
                       <td><div id="respuesta" style="color: red; font-weight: bold; text-align: center;"></div></td>
                         <h3 id="estado"></h3>
                          <p id="peso_cargado"></p>                  
                         
                       </form>                   
                          </div> 
                        </div>                                      
                    </div>
                </div>
              </div>
            </div>
          </div>  
        </div>
         <!--Fin delcuerpo del panel-->
    
      </div>
       <!--Fin Panel/card para el catalogo de libros-->
    </div>
</div>


  
<?php }?> 

<!--DIRECCION DE LA UBICACION ACTUAL-->     
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="">Repositorio de archivos</a></li>   
    </ol>
  </nav>        

  
<div class="container-fluid" > 
 <!--     -->
        <!--Cuerpo del panel--> 

        <div class="card-body">              
          <div class="row">            
            <div class="col-md-12">
              <div class="card">
              <div class="card-body"> 
                 <!--   -->            
                        <td height="50"><div class="col-sm-0">  
                          <div class="card">   
                          <div class="card-header">
                          <div class="row mx-auto">
                             <div style="vertical-align: middle; margin: 5px">
                          <p class="font-weight-light"> <h3>  Catalogo de Archivos</h3>  Descarga de documentos</p>       
                             </div>           
                            </div>

                         </div>

                       </tr>
              
              </div>
              <div class="card-header">

          <div class="row" style="margin-top: 10px">
         
            <div class="col-sm-5">
              <div class="row">
                <img src="img/icons/menuQueryLight.png" width="65" height="65" alt="" style="margin-right: 1%">
         


                <form name="formBusqueda" id="formBusqueda">          
                  <div class="input-group ">               
                    <input type="text" class="form-control form-control-lg"  placeholder="Buscar PDF" id="textBusqueda" name="textBusqueda"> 
                    <div class="input-group-prepend">
                      <button class="btn btn-outline-info" type="button" onclick="recargarTabla()"> Buscar </button>
                    </div> 
                  </div>
                  <small id="dateHelp" class="form-text text-muted">Categorias</small>
                </form>
              </div>                       
            </div>
            <div class="col-sm-3">
              <div name="cargandoFeedback" id="cargandoFeedback" align="left"> </div>
            </div>  
            <div class="col-sm-2">
              <div name="accionFeedback" id="accionFeedback"> </div>
            </div>
            <div class="col-sm-2">
              <div class="btn-group float-right" role="group" aria-label="Opciones"> 
               
                <button class="btn btn-light float-right" type="button" onclick="recargarTablaLimpiar();" data-toggle="tooltip" data-placement="top" title="Recargar Tabla">
                  <img src="img/icons/BookauthorReload.png" width="60" height="60">
                </button>
                <button class="btn btn-light float-right" type="button" onclick="rediMenuOPT();" data-toggle="tooltip" data-placement="top" title="Volver al menu principal">
                  <img src="img/icons/menuRegresar.png" width="60" height="60">
                </button>

               
                
              </div>
            </div>
          </div>
             
        </div>
            </div>
          </div>  
        </div>
        <div align="center" name="cargarTabla" id="cargarTabla">
         
         <!--Fin delcuerpo del panel-->
      </div>
       <!--Fin Panel/card para el catalogo de libros-->
    </div>
</div>
<!--MODAL PARA ver detalle-->

<div class="modal fade" id="modalVerDetalles" tabindex="-1" role="dialog" aria-labelledby="modalVerDetalles" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4A0A0A;">
        <h5 class="modal-title" id="newEditorialModal"><img src="img/portadapdf/defaultpdf.jpg" width="30" height="30"> &nbsp;<a style="color:white";>Descripcion del PDF </a></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background: #D5D9DF;">
        <form id="formEditEditorial" name="formEditEditorial">
          <div class="row">
           
            <div class="col-sm-10">

              <table class="table" cellspacing="2" cellpadding="1">                       
                       <tr align="left"> 
                         <td><h6>
                         <div align="center"> <textarea id="verEjemplardetadqui" type="text" class="form-control " maxlength="380" rows="10" cols="30"  ></textarea> </div></td>                        
                       </tr>                                      
                      
                     </table>
             
            </div>
         
           </div>          
            
        </form>

      </div>
      <div class="modal-footer" style="background: #D5D9DF;">
         <div id="respuestaEditarEditorial" style="color: red; font-weight: bold; text-align: center;"></div>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
     
    </div>
  </div>
</div>

<!--MODAL PARA ver pdf-->

<div class="modal fade" id="modalVerPdf" tabindex="-1" role="dialog" aria-labelledby="modalVerPdf" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #4A0A0A;">
        <h5 class="modal-title" id="newmodalVerPdf"><img src="img/portadapdf/defaultpdf.jpg" width="30" height="30"> &nbsp;<a style="color:white";>Leer PDF </a></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background: #D5D9DF;">
        <form id="formEditEditorial" name="formEditEditorial">
          <div class="row">
           
            <div class="col-sm-10">

                                      
                       <div id="cargarPDF"></div>                                    
                      
                 
             
            </div>
         
           </div>          
            
        </form>

      </div>
      <div class="modal-footer" style="background: #D5D9DF;">
         <div id="respuestaEditarEditorial" style="color: red; font-weight: bold; text-align: center;"></div>

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
     
    </div>
  </div>
</div>
<!--MODAL PARA SUBIR PORTADA DEL pdf-->

<div class="modal fade" id="fotografiaModal" tabindex="-1" role="dialog" aria-labelledby="fotografiaModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #D5D9DF;">
        <h5 class="modal-title" id="newEditorialModalTittle"><img src="img/icons/BookCover.png" width="30" height="30"> Agregar una portada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background: #D5D9DF;">
        <form id="formFotografia" name="formFotografia ">
          <div class="row">         
            <div class="col-sm-12 ">
              <div class="form-group ">
                <div class="alert alert-success" role="alert">
                  Subir una imagen de portada 
                </div>
                
                <input type="text" class="form-control" name="modallibcodPortada" id="modallibcodPortada" aria-describedby="modallibcodPortada" placeholder="Codigo Libro" hidden="true">
                 <input type="text" class="form-control" name="modallibtitPortada" id="modallibtitPortada" aria-describedby="modallibtitPortada" placeholder="Codigo Libro" hidden="true">
                <div id="preview" class="d-flex justify-content-center"> <img src="img/icons/BookCover2.png" class="img-fluid"/></div>
                <div id="errorMensaje" class="d-flex justify-content-center"></div><br>
                     <div class="d-flex justify-content-center">
                      <input style="width:90%" id="subirPortada"  type="file" accept="image/jpeg" name="subirPortada" />
                    </div>                 
              </div>
     
            </div>
          </div> 
          <div class="d-flex justify-content-center">
            <div class="btn-group">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="button" type="submit" class="btn btn-primary" onclick="subirFotografia()">Subir portada</button>
            </div>
          </div>     
        </form>
      </div>
      <div class="modal-footer d-flex justify-content-center" style="background: #D5D9DF;">
         
      
      </div>
     
    </div>
  </div>
</div>

<!--MODAL PARA ELIMINAR PDF -->

<div class="modal fade" id="modalEliminarpdf" tabindex="-1" role="dialog" aria-labelledby="modalEliminarpdf" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #D5D9DF;">
        <h5 class="modal-title" id="newEditorialModalTittle"><img src="img/icons/BookEditWideDel.png" width="35" height="30"> Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background: #D5D9DF;">
        <form id="deleteForm" name="deleteForm">
          <div class="row">         
            <div class="col-sm-12">
              <div class="form-group">
                <div id=notificationLabel style="color: black; font-weight: bold; text-align: center;"><label for="TituloLabel">Esta es una accion <h5> Permanente. </h5> Desea Eliminar libro?</label></div>                
                <input type="text" class="form-control" name="modallibcod" id="modallibcod" aria-describedby="modallibcod" placeholder="Editorial" hidden="true">
                <input type="text" class="form-control" name="modallibtit" id="modallibtit" aria-describedby="modallibtit" placeholder="Editorial" hidden="true">

                <h4>
                  <div id="deleteLabel" style="color: red; font-weight: bold; text-align: center;"></div>
                </h4>
              </div>
            </div>
          </div>    
        </form>
        <div id="answerDeletePrint" style="color: red; font-weight: bold; text-align: center;"></div>
      </div>
      <div class="modal-footer" style="background: #D5D9DF;">
         
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="eliminarpdf()">Eliminar</button>
      </div>
     
    </div>
  </div>
</div>


<script type="text/javascript">



function _(el){
  return document.getElementById(el);
}
function uploadFile(){
 if($("#formdocutit").val()==""){
           $("#respuesta").show();
           $("#respuesta").html("&nbsp;&nbsp;Ingrese el titulo del documento"); 
      }else if ($("#formdocudes").val()=="") {
           $("#respuesta").show();
           $("#respuesta").html("&nbsp;&nbsp;Ingrese una descripcion del documento"); 
      }else if ($("#formdocutag").val()=="") {
           $("#respuesta").show();
           $("#respuesta").html("&nbsp;&nbsp;Ingrese almenos un criterio de busqueda"); 
      }else if($("#file1").val()==""){
           $("#respuesta").show();
           $("#respuesta").html("&nbsp;&nbsp;Seleccione un archivo tipo pdf"); 
      }else {
        $("#respuesta").hide();

  var file = _("file1").files[0];
  var titulo = document.getElementById("formdocutit").value;
  var creiterio = document.getElementById("formdocutag").value;
   var descripcion = document.getElementById("formdocudes").value;
  
  
  var formdata = new FormData();
  formdata.append("file1", file);
  formdata.append('titulo', titulo);
  formdata.append('criterio', creiterio);
  formdata.append('descripcion', descripcion);
  var ajax = new XMLHttpRequest();
  ajax.upload.addEventListener("progress", progressHandler, false);
  ajax.addEventListener("load", completeHandler, false);
  ajax.addEventListener("error", errorHandler, false);
  ajax.addEventListener("abort", abortHandler, false);
  ajax.open("POST", "upload4.php");
  ajax.send(formdata);
  $("#file1").val('');
  document.getElementById("formdocutit").value='';
  document.getElementById("formdocutag").value='';
  document.getElementById("formdocudes").value='';
}
function progressHandler(event){
  _("peso_cargado").innerHTML = "Subiendo "+event.loaded+" bytes de "+event.total;
  var percent = (event.loaded / event.total) * 100;
  _("barradeprogreso").value = Math.round(percent);
  _("estado").innerHTML = Math.round(percent)+"% Subiendo... porfavor espera..";
}
function completeHandler(event){
  _("estado").innerHTML = event.target.responseText;
  _("barradeprogreso").value = 0;
}
function errorHandler(event){
  _("estado").innerHTML = "Upload Failed";
}
function abortHandler(event){
  _("estado").innerHTML = "Upload Aborted";
}
}

</script>


<!--Script para recargar tabla al abrir esta pagina el scrip esta incluido en <top.php> dir src/js/tables/loader.js-->
<script>
    window.onload = function () {     
        
      recargarTabla();
     


       $('.block-tab').on('keydown', function(e) { 
      if (e.keyCode == 9) e.preventDefault(); 
      });
           $('#formdocutag').tagsInput({      
              'defaultText':'Nueva',     
              'height':'50px',
              'width':'350px',
              'placeholderColor' : '#003764'
            });
      
      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          recargarTabla();
          event.preventDefault();
          return false;
        
        }
      });

  };
//Funcion para recargar tabla
function recargarTabla(){
   //Mostrar gif de cargando a la par de la barra de busqueda
  $("#cargandoFeedback").show();
  $("#cargandoFeedback").html(' <img src="img/structures/replace.gif" style="max-width: 60%; margin-top:-10%; margin-left:-30%">').show(200);

  var busqueda=$("#textBusqueda").val(); 
  busqueda=busqueda.trim().replace(/ /g, '%20');

  $("#cargarTabla").load("verArchivos.php?pagina=1&busqueda="+busqueda);
  
  setTimeout( function() {
      $("#cargandoFeedback").hide(500);
                           
    }, 1000);
}


function recargarTablaLimpiar(){
    document.getElementById("formBusqueda").reset();
    $("#cargandoFeedback").show();
      $("#cargandoFeedback").html(' <img src="img/structures/replace.gif" style="max-width: 60%; margin-top:-10%; margin-left:-30%">').show(200);

  var busqueda=$("#textBusqueda").val();

  var ordenar=$("#textBusquedaordenar").val();  
 $("#cargarTabla").load("verArchivos.php?pagina=1&&busqueda="+busqueda);
    setTimeout( function() {
      $("#cargandoFeedback").hide(500);
                           
    }, 1000);

  
}

//Ver detalles

$('#modalVerDetalles').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // 

       var varformdocumentodes  = button.data('varformdocumentodes')
       var modal = $(this) 
       $("#verEjemplardetadqui").html(varformdocumentodes); 
     
       
      
    })
//Ver pdf

$('#modalVerPdf').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // 

       var varformdocumentoid  = button.data('varformdocumentoid')
       var modal = $(this) 
       
       $("#cargarPDF").load("archivo.php?id="+varformdocumentoid);
  
     
       
      
    })


// SUBIR PORTADA

function subirFotografia(){
   $("#errorMensaje").html('<img src="img/structures/replace.gif" style="max-width: 50%">').show(500);
   var formData = new FormData($("#formFotografia")[0]);

  $.ajax({
   url: "src/libs/insertProcess/subirPortada.php",
   type: "POST",
   data: formData,
   contentType: false,
   cache: false,
   processData:false,
   beforeSend : function()
   {
    $("#preview").fadeOut();
   
   },
   success: function(data)
      {
    if(data==0)
    {
     // invalid file format.
     $("#errorMensaje").html("Archivo Invalido").fadeIn();
    }
    else if (data==1)
    { recargarTabla();
     // Ver imagen subida
     $("#preview").html(data).fadeIn();
     $("#formFotografia")[0].reset();
     $("#accionFeedback").show();
     $("#accionFeedback").html("<div class='alert alert-success' role='alert'> Portada actualizada </div>");
     setTimeout(
    function() {
         
          $("#accionFeedback").hide(500);        
    }, 6000);
     $("#errorMensaje").hide(500);
     $("#errorMensaje").fadeOut();
   $('#fotografiaModal').modal('hide');
    
    }
      },
    error: function(e) 
      {
    $("#errorMensaje").html(e).fadeIn();
    $("#errorMensaje").hide(500);
      }          
    });
}

// ELIMINAR PDF

function eliminarpdf(){

  if ($("#modallibcod").val()==""){
    $("#answerDeletePrint").show();
    $("#answerDeletePrint").html("Codigo de archivo");
  }else {
    $("#answerDeletePrint").html('<img src="img/structures/replace.gif" style="max-width: 60%">').show(500);
    var url = "upload/eliminarPDF.php";
    $.ajax({
      type: "POST",
      url: url,
      data: $("#deleteForm").serialize(),
      success: function (data){
          if (data==1) {
            //sucess
            $("#accionFeedback").show();
            $("#accionFeedback").html("<div class='alert alert-success' role='alert'> El Archivo fue eliminado </div>");

            recargarTabla();
            setTimeout(
                function() {
                  $("#answerDeletePrint").hide(500);
                  $("#accionFeedback").hide(500);
                  
            }, 6000);
            $('#modalEliminarpdf').modal('hide');
          }else{
            $("#answerDeletePrint").show();
            $("#answerDeletePrint").html(data);

          }     
          
      }
    });
  }
}

 // modal para subir portada
 $('#fotografiaModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      var varformdocumentonom = button.data('varformdocumentonom')
      var varformdocumentoid = button.data('varformdocumentoid')
      var varformdocumentopor = button.data('varformdocumentopor') // Extract info from data-* attributes

      $("#errorMensaje").html('').show(500);
     
      var modal = $(this)

      $("#preview").html('<img src="'+varformdocumentopor+'" style="max-width: 50%">')
      document.getElementById('modallibcodPortada').value = varformdocumentoid;
      document.getElementById('modallibtitPortada').value = varformdocumentonom;
      
      
    })

  //TRIGGER EN MODAL PARA ELIMINAR PDF
     $('#modalEliminarpdf').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal

      var varformdocumentonom = button.data('varformdocumentonom')
      var varformdocumentotit = button.data('varformdocumentotit')
      var varformdocumentoid = button.data('varformdocumentoid') // Extract info from data-* attributes


      
      var modal = $(this)

      $("#deleteLabel").html(varformdocumentotit);
      document.getElementById('modallibcod').value = varformdocumentoid;
      document.getElementById('modallibtit').value = varformdocumentonom;
      
      
    })

</script>