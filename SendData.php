<?php

require('validar.php');

if(!isset($_SESSION['datos'])){
    header("location:Registro.php");
}

$start_session =session_status();
if($start_session == PHP_SESSION_NONE){
    session_start();
}
    

if(isset($_POST['submit'])){

    $codigo=trim(filter_var($_POST["codigo"],FILTER_SANITIZE_STRING));

       
    $correo= $_SESSION['datos'][0];

    
    
   if(Codigo($codigo)){     
        enviarDatosRegistro($_SESSION['datos']);
        $_SESSION['datos']="";
        $_SESSION['contador'] = 0;
        header('location:Login.php');
        
    }else{

        if($_SESSION['contador']<4){
            $_SESSION['contador']++;
            $errorCodigo="<li>Codigo incorrecto!</li> ";
            
        }else{
           
               ?><script>
                   Swal.fire({
                                title:'Numero de intentos superado!, por favor intentelo de nuevo',
                                icon:"info",
                                showCloseButton:'true',
                                timer:10000,
                                timerProgressBar:true
                            })       
                </script>
                <?php 
                $_SESSION['contador']=0;
                session_destroy();
                header('location:Registro.php');
        }

        
    }


}


require('SendData.view.php');

?>