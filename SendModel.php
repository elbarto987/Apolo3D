<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['user'])){
    header('location:index.php');
}
require('Validar.php');

$errores="";
$correcto="";


if(isset($_POST['submit'])){

    
    if(empty($_POST['NombreModel'])){
        $errores .="<li>No hay nombre</li>";
    }

    if(empty($_POST['descripcion'])){
        $errores .="<li>No hay descripcion</li>";
    }

    if(empty($_FILES['Foto']) || $_FILES['Foto']['size'] <= 0 ){
        $errores .="<li>No hay foto del modelo</li>";
    }

    if(empty($_FILES['Modelo']) || $_FILES['Modelo']['size'] <= 0 ){
        $errores .="<li>No hay modelo</li>";
    }

    
    $datos = array(
            
        trim(filter_var($_POST['NombreModel'],FILTER_SANITIZE_STRING)),
        $_POST['descripcion']
    );

    if(empty(NombreModelo($_POST['NombreModel']))){
            
    }else{
        $errores .="<li>Nombre duplicado</li>";
        $datos[0]="";
    }
 
    if(strlen($datos[0])>=20){
        $errores .="<li>Longitud de cadena nombre exedida! maximo 20 caracteres</li>";
        $datos[0]="";
    }

    if(strlen($datos[1])>=3000){
        $errores .="<li>Longitud de cadena descripcion exedida! maximo 3000 caracteres</li>";
        $datos[1]="";
    }

    

    if((!empty($_FILES['Foto']) && $_FILES['Foto']['size']>0) && (!empty($_FILES['Modelo']) && $_FILES['Modelo']['size']>0)){
       
        if($_FILES['Foto']['error']>0){
            $errores .="<li>Error al cargar la imagen</li>";
        }else if($_FILES['Modelo']['error']>0){
            $errores .="<li>Error al cargar el modelo</li>";
        }else{

            $permitidosFoto = array("image/png","image/jpg","image/gif","image/jpeg");
            $permitidosModelo = array("obj","stl","3mf");

            if(!in_array($_FILES['Foto']['type'],$permitidosFoto)){
                $errores .="<li>Foto no permitida!</li>";
              
        }else if(!in_array(ExtencionM($_FILES['Modelo']['name']),$permitidosModelo)){
            $errores .="<li>Árchivo no permitido!</li>";
            }else{
               
                  if(!file_exists("Modelos")){
                    mkdir("Modelos");
               }
                $rutaFoto ="Modelos/".$_SESSION['user'][0][4]."/";
                $archivoFoto=$rutaFoto.$_FILES['Foto']['name'];
                $rutaModelo = "Modelos/".$_SESSION['user'][0][4]."/";
                $archivoModelo = $rutaModelo.$_FILES['Modelo']['name'];
                
                if(!file_exists($rutaFoto)){
                    mkdir($rutaFoto);
                }

                if(!file_exists($rutaModelo)){
                    mkdir($rutaModelo);
                }

                
                if(file_exists($archivoFoto)){
                   $errores .="<li>Foto duplicada!</li>";
            }else if(file_exists($archivoModelo)){
                 $errores .="<li>Modelo duplicado!</li>";
            }else{

                if(empty($errores)){

                    $resultadoFoto = @move_uploaded_file($_FILES['Foto']['tmp_name'],$archivoFoto);
                if($resultadoFoto){
                
                }else{
                    $errores .= "<li>Error! foto no guardada</li>";
                }
              
                $resultadoModelo = @move_uploaded_file($_FILES['Modelo']['tmp_name'],$archivoModelo);
                 if($resultadoModelo){
                   
                 }else{
                    $errores .= "<li>Error! Modelo no guardado</li>";
                }
                if(empty($errores)){
                    EnviarModelo($datos[0],$datos[1], $archivoModelo , $archivoFoto , $_SESSION['user'][0][0]);
                    $correcto .="<li>Datos guardados</li>";
                    $datos = null;
                }
                    
                }
              }
            }

        }

        $_FILES['Foto'] = null;
        $_FILES['Modelo'] = null;
    }

    

}

require('SendModel.view.php');


?>
