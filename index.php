<?php

$start_session=session_status();
if($start_session==PHP_SESSION_NONE){
    session_start();
}



if(isset($_SESSION['user'])){

    require('indexSesion.php');
}else{
    require('Validar.php');
    $_SESSION['DatosModelos']=DatosIndex();
    $_SESSION['M']=-1;
   $errores="";
if(isset($_POST['submit'])){

    $datos=array(
        trim(filter_var($_POST['user'],FILTER_SANITIZE_EMAIL)),
        $_POST['pass']
    );
        $datos[1]=hash('sha512',$datos[1]);
        $resultado = usuario_session($datos);
        
        if(!empty($resultado)){
            session_start();
            $_SESSION['user']=$resultado;
            header('location:indexSesion.php');
        }else{
             $errores.="<li>Usuario o Contraseña Incorrectos!</li>";
             
        }
    }

    require('index.view.php');

}





?>