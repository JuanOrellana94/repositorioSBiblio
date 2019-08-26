<?php 
include("../vars.php");
include("conection.php");


//$usuAccount="19001";


$usuAccount=$_POST['usuAccNombre'];


$UsuPassword=md5($_POST['usuContrasena']);

//$UsuPassword=md5("19001");






$checkValidation="SELECT * from $tablaUsuarios WHERE 
($varContrasena='$UsuPassword' AND $varCarnet='$usuAccount') OR 
($varContrasena='$UsuPassword' AND $varAccNombre='$usuAccount');
";

$resultado=mysqli_query($conexion, $checkValidation) or die(mysqli_error($conexion));


$dataRow = mysqli_fetch_array($resultado);

if(isset($dataRow)){

  if($dataRow[$varCueEstatus]=="1"){

    //usuCueStatus. = 1= Desactivada
    echo "2";

  } else if($dataRow[$varCueEstatus]=="2") {
    //usuCueStatus. = 2= Bloqueada
    echo "3";



  }else if($dataRow[$varCueEstatus]=="0" || $dataRow[$varCueEstatus]=="3" ){
    //Condiciones de acceso cumplidas, session starts
    session_start();
    $_SESSION['usuCodigo']=$dataRow[$varUsuCodigo];
    $_SESSION['usuAccount']=$dataRow[$varAccNombre];
    $_SESSION['usuPriNombre']=$dataRow[$varPriNombre];
    $_SESSION['usuSegNombre']=$dataRow[$varSegNombre];
    $_SESSION['usuPriApellido']=$dataRow[$varPriApellido];
    $_SESSION['varSegApellido']=$dataRow[$varSegApellido];
    $_SESSION['usuCarnet']=$dataRow[$varCarnet];
    $_SESSION['usuCorreo']=$dataRow[$varCorreo];   
    $_SESSION['existe']=$dataRow[$varNivel];



    if( $_SESSION['existe'] == 0 ){
      $_SESSION['existeNombre']="Administrador";
    }else  if( $_SESSION['existe'] == 1 ){
      $_SESSION['existeNombre']="Bibliotecario";
    }else  if( $_SESSION['existe'] == 2 ){
      $_SESSION['existeNombre']="Personal";
    }else  if( $_SESSION['existe'] == 3 ){
      $_SESSION['existeNombre']="Estudiante";
    }else  if( $_SESSION['existe'] == 4 ){
      $_SESSION['existeNombre']="Auxiliar";
    }


    

    $_SESSION['nombreComp'] = $dataRow[$varPriNombre] .  " " . $dataRow[$varPriApellido];    

    


    if ($_POST['usuContrasena']==$usuAccount || $_POST['usuContrasena'] == "institutoJO19") {
      $_SESSION['Logeado']="renovar";  
    }else{
      $_SESSION['Logeado']="yes";  
    }

    if ($_SESSION['Logeado']=="renovar") {
      echo "1r";
    } else{
       echo "1";
    }
   
    //1 = Acceso al sistema

    }


  } else {

    echo "0";
         //Usuario existe/Password erroneo
  }


 ?>