<?php 

$start_session=session_status();
if($start_session==PHP_SESSION_NONE){
session_start();
}



if(!isset($_SESSION['user'])){
    header('location:index.php');
}else{


require('Validar.php');

$var=true;
$_SESSION['user'];
$errores="";
$pass="";
$b="";
if(isset($_POST['submit'])){  

        $datos=array(

             $_POST['pass'],
             $_POST['Cpass'],
             trim(filter_var($_POST['nombre'],FILTER_SANITIZE_STRING)),
             $_SESSION['user'][0][4],
             $_POST['descripcion']
        );

        if(!empty($datos[0])){
            if(!ValidarPass($_POST['pass'])){
                $pass="t";
          }
            if($datos[0]==$datos[1]){
                 $datos[1]= hash('sha512',$datos[1]);
            }else{
                $errores.="<li>Las contraseñas no son iguales</li>";
            }
        }

        if(strlen($datos[2])>=45){
            $errores.='<li>Longitud de cadena nombre exedida! maximo 45 caracteres</li>';
            $datos[2]="";
        }

        if(strlen($datos[4])>=1000){
            $errores.='<li>Longitud de cadena descripcion exedida! maximo 1000 caracteres</li>';
            $datos[2]="";
        }


        if(!empty($_FILES['archivo']) && $_FILES['archivo']['size'] > 0 ){ 

          
            if($_FILES['archivo']['error']>0){
                $errores .= "<li>error al cargar la imagen de perfil</li>";
            }else{
 if(!file_exists("Img_Perfil")){
                    mkdir("Img_Perfil");
                }
                if(!empty($_SESSION['user'][0][3]))
                eliminarDir('Img_Perfil/'.$_SESSION['user'][0][4]); 

                $perimitidos=array("image/png","image/jpg","image/gif","image/jpeg");
                if(in_array($_FILES['archivo']['type'],$perimitidos) ){
                    
                    $ruta ='Img_Perfil/'.$_SESSION['user'][0][4].'/';
                    $archivo = $ruta.$_FILES['archivo']['name'];

                    if(!file_exists($ruta)){
                        mkdir($ruta);
                    }

                    if(!file_exists($archivo)){

                        $resultado = @move_uploaded_file($_FILES['archivo']['tmp_name'],$archivo);

                        if($resultado){
                            
                            enviarFoto($ruta.$_FILES['archivo']['name'],$_SESSION['user'][0][4]);
                            $b .="<li>Archivo guardado</li>";
                        }else{
                             $errores .= "<li>Error! archivo no guardado</li>";
                        }
                    }

                }else{
                    $errores .= "<li>Archivo no Permitido</li>";
                }
            }

            $_FILES['archivo']=null;
        }


        

       if(empty($errores)){
          
        ActualizarDatos($datos); 
        if(!empty($datos[2])){
            $_SESSION['user']=Datos($_SESSION['user'][0][2]);
        }
        $b="<li>Datos guardados exitosamente!</li>";
        }
    }

    require('Configuraciones.view.php');
}
?>
