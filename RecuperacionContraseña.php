<?php 


$start_session =session_status();

if($start_session == PHP_SESSION_NONE){
    session_start();
}

if(isset($_SESSION['user'])){
    header('location:indexSesion.php');
}
require('validar.php');



    $_SESSION['estado']=0;
    $errorCodigo="";

if(isset($_POST['submit'])){

    $datos = trim(filter_var($_POST['codigo'],FILTER_SANITIZE_EMAIL));
   
    if(!empty($resultado = usuario_recuperacion($datos))){

        $start_session = session_status();

    if($start_session==PHP_SESSION_NONE){
        session_start();
       }

        $_SESSION['estado']=1;
        $_SESSION['contador']=0;
        $_SESSION['codigoR']=$resultado;
        EnviarCodigo($_SESSION['codigoR'][0],0);
        

    }else{
        $errorCodigo="<li>El correo no se encuentra!</li>";
    }
    
}

if(isset($_POST['sub'])){

    $codigo=trim(filter_var($_POST["codigo"],FILTER_SANITIZE_STRING));

    $start_session=session_status();
    if($start_session==PHP_SESSION_NONE){
        session_start();
        
       }
    
    
    
   if(Codigo($codigo)){     
        
     $_SESSION['estado']=2; 
        
    }else{

        if($_SESSION['contador']<5){

        $_SESSION['estado']=1;
        $_SESSION['contador']++;
        $errorCodigo="<li>Codigo incorrecto!</li> ";

        }else{
            ?><script>alert('Numero de intentos superado!, por favor intentelo de nuevo');</script>;<?php 
        }
    }


}

if(isset($_POST['cambio'])){
    $datos=array(
        $_POST['pass'],
        $_POST['confirmacion']
    );

    if($datos[0]==$datos[1]){

        $datos[1]= hash('sha512',$datos[1]);
        $d= array(
            $_SESSION['codigoR'][0][0],
            $datos[1]
        );
        Cambiarpass($d);
        $_SESSION['codigoR'][0][0]=null;
        header('location:Login.php');
    }else{
        $_SESSION['estado']=2;
       $errorCodigo = "<li>Las contraseñas no coinciden!</li>";
    }
}

require('RecuperacionContraseña.view.php');
?>