<?php

session_start();

if(isset($_SESSION['user'])){
    header('location:indexSesion.php');
}

require('Validar.php');


$ver1 = -1;
$ver  = -1;
$ver2 = -1;
$errores="";
$correcto="";
$errorCodigo="";
$codigo="";
$pass="";
$tem="";

if(isset($_SESSION['datos'])){
    $datos=array(
        $_SESSION['datos'][0],
        $_SESSION['datos'][1]
    );
    
}

 
if(isset($_POST['su'])){

    if(empty($_POST['correo'])){

        $errores .="<li>El campo de correo no puede estar vacio</li>";
    }

    if(empty($_POST['usuario'])){
        $errores .="<li>El campo de usuario no puede estar vacio</li>";
    }

    if(empty($_POST['pass'])){
        $errores .="<li>El campo de contraseña no puede estar vacio</li>";
    }

    if(empty($_POST['confirmacion'])){
        $errores .="<li>El campo de confirmar contraseña no puede estar vacio</li>";
    }

    if(empty($_POST['terminos'])){
        $errores .="<li>Debe aceptar terminos y condiciones!</li>";
    }

    if(!ValidarPass($_POST['pass'])){
          $pass="t";
    }
   
    $datos= array(
        trim(filter_var($_POST['correo'],FILTER_SANITIZE_EMAIL)),
        trim(filter_var($_POST['usuario'],FILTER_SANITIZE_STRING)),
        $_POST['pass'],
        $_POST['confirmacion'],
         );

          if(!empty(verificar_registro(0,$datos[0]))){
                $errores.='<li>Correo no disponible!</li>';
                $ver = 0;
            }elseif(strlen($datos[0])>=60){
                $errores.='<li>Longitud de cadena correo exedida! maximo 60 caracteres</li>';
                $ver1 = 1;
            }
            
            if(!empty(verificar_registro(1,$datos[1]))){
                    $errores.='<li>Usuario no disponible!</li>';
                    $tem.="<li>Usuario disponible: ".UsuarioDisponible($datos[1])."</li>";
                    $ver1 = 1;
            }elseif(strlen($datos[1])>=20){
                $errores.='<li>Longitud de cadena usuario exedida! maximo 20 caracteres</li>';
                $ver1 = 1;
            }

            
        
            if($datos[2]==$datos[3]){
                $datos[2]= hash('sha512',$datos[2]);
            }else{
                $errores.="<li>Las Contraseñas son diferentes!</li>";
                $ver2=5;
            }
           
            if($ver == -1 && $ver1 == -1 && $ver2 == -1){
               $correcto="t"; 
               $start_session=session_status();
               if($start_session==PHP_SESSION_NONE){
                session_start();
               }
               
               $_SESSION['datos']=$datos;
               $_SESSION['contador']=0;
               EnviarCodigo($datos,1);
               header('location:SendData.php');
                               
     }
 
    }

   

 
 require('Registro.view.php');


/*$ php -S 127.0.0.1:8000 -t www;*/
?>




