<?php

require('Validar.php');

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if(!empty($_GET['idModelCon'])){
    $_SESSION['Modelocon']=DatosModelo($_GET['idModelCon']);
}

if(empty($_SESSION['Modelocon']) || !isset($_SESSION['user']) ){
    header('location:index.php');
}


$errores="";
$correcto="";
$archivoFoto="";


if(isset($_POST['submit'])){
    
    
    
    if(empty($_POST['NombreModel'])){
        $errores .="<li>No hay nombre</li>";
    }

    if(empty($_POST['descripcion'])){
        $errores .="<li>No hay descripcion</li>";
    }

    if(empty($_FILES['Foto'])){
        $errores .="<li>No hay foto del modelo</li>";
    }
    if(!empty(NombreModelocon($_POST['NombreModel'],$_SESSION['Modelocon'][0][0]))){
        $errores .="<li>Nombre del modelo duplicado</li>";
    }
    
    $datos = array(
            
        trim(filter_var($_POST['NombreModel'],FILTER_SANITIZE_STRING)),
        $_POST['descripcion']
    );

    
 
    if(strlen($datos[0])>=20){
        $errores .="<li>Longitud de cadena nombre exedida! maximo 20 caracteres</li>";
        $datos[0]="";
    }

    if(strlen($datos[1])>=3000){
        $errores .="<li>Longitud de cadena descripcion exedida! maximo 3000 caracteres</li>";
        $datos[1]="";
    }

    
    

    if((!empty($_FILES['Foto']) && $_FILES['Foto']['size']>0)){
       
        if($_FILES['Foto']['error']>0){
            $errores .="<li>Error al cargar la imagen</li>";
        }else{

            $permitidosFoto = array("image/png","image/jpg","image/gif","image/jpeg");
            
            if(!in_array($_FILES['Foto']['type'],$permitidosFoto)){
                $errores .="<li>Foto no permitida!</li>";
               
        }else{
               
                $rutaFoto ="Modelos/".$_SESSION['user'][0][4]."/";
                $archivoFoto=$rutaFoto.$_FILES['Foto']['name'];
               
                
                if(!file_exists($rutaFoto)){
                    mkdir($rutaFoto);
                }
                   if(file_exists($archivoFoto)){
                   $errores .="<li>Foto duplicada!</li>";
                   }else{
                    EliminarFoto($_SESSION['Modelocon'][0][4]); 
                   }

                if(empty($errores)){

                    $resultadoFoto = @move_uploaded_file($_FILES['Foto']['tmp_name'],$archivoFoto);
                if(!$resultadoFoto){
                    
                }
              
                    
                }
              
            }

        }

        $_FILES['Foto'] = null;
       
    }

    
    if(empty($errores)){ 
        EditarModelo($datos[0],$datos[1] , $archivoFoto , $_SESSION['Modelocon'][0][0]);
        $correcto .="<li>Datos guardados</li>";
        $datos = null;
        $_SESSION['Modelocon']=DatosModelo($_SESSION['Modelocon'][0][0]);
    }

}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/app.css">
    
</head>

<body data-sa-theme="3" class="">
    <main class="main">
        <div class="page-loader" style="display: none;">
            <div class="page-loader__spinner">
                <svg viewBox="25 25 50 50">
                    <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
                </svg>
            </div>
        </div>

    <header class="header" id="Header">

                <div class="navigation-trigger hidden-xl-up" data-sa-action="aside-open" data-sa-target=".sidebar">
                    <i style="background-color:rgba(255,255,255,.5); padding: 10px; border-radius: 5px; margin-left: 15px;"><img
                            src="imagenes/btn-menu.png" alt=""></i>
                </div>

                <div class="logo hidden-sm-down">
                    <h1><a href="index.php">APOLO</a></h1>
                </div>
                <div id="animacionHeader">
                    <section id="img-3d"><img src="imagenes/3D.gif" alt=""></section>
                </div>



                <ul class="top-nav">

                    <li class="hidden-xs-down">
                        <a href="indexSesion.php" class="top-nav__themes" data-sa-target=".themes"><i class="zmdi zmdi-palette"></i>Inicio</a>
                    </li>


                    <li class="dropdown hidden-xs-down">
                        <a href="IndexSesion.php#nosotrosLogin" class="top-nav__themes" data-sa-target=".themes"><i class="zmdi zmdi-palette"></i>Nosotros</a>
                    </li>

                    <li class="dropdown hidden-xs-down">
                        <a href="RecusosLegalesSesion.php"><i class="zmdi zmdi-more-vert"></i>Recursos Legales</a>


                    </li>

                    <li class="dropdown hidden-xs-down">
                        <a href="" data-toggle="dropdown" aria-expanded="false"><i class="zmdi zmdi-check-circle"></i>
                            <div class="cuenta">Cuenta  <img class="user__img" src="<?php if(!empty($_SESSION['user'][0][3])) echo $_SESSION['user'][0][3]; else echo 'imagenes/user.png';?>" alt="">
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--block" role="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(50px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <div class="dropdown-header">Mi cuenta</div>

                            <div class="listview listview--hover">

                                <a href="" class="listview__item">
                                    <div class="listview__content">
                                        <div class="listview__heading">Ver Perfil</div>

                                        <div class="progress mt-1">
                                        </div>
                                    </div>
                                </a>

                                <a href="Configuraciones.php" class="listview__item">
                                    <div class="listview__content">
                                        <div class="listview__heading">Configuracion de la Cuenta</div>

                                        <div class="progress mt-1">
                                        </div>
                                    </div>
                                </a>

                                <a href="cerrar.php" class="listview__item">
                                    <div class="listview__content">
                                        <div class="listview__heading">Cerrar Sesion</div>

                                        <div class="progress mt-1">
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </li>

                </ul>


    </header>


    <aside class="sidebar">
            <div class="scroll-wrapper scrollbar-inner" style="position: relative;">
                <div class="scrollbar-inner scroll-content scroll-scrolly_visible" style="height: auto; margin-bottom: -17px; margin-right: -17px; max-height: 569px;">

                    <div class="user">
                        <div class="user__info" data-toggle="dropdown">
                            <img class="user__img" src="<?php if(!empty($_SESSION['user'][0][3])) echo $_SESSION['user'][0][3]; else echo 'imagenes/user.png';?>" alt="">
                            <div>
                                <div class="user__name"><?php if(isset($_SESSION['user'][0][1]))echo $_SESSION['user'][0][1];else echo"";?></div>
                                <div class="user__email"><?php if(isset($_SESSION['user'][0][2]))echo $_SESSION['user'][0][2];else echo"";?></div>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">Ver Perfil</a>
                            <a class="dropdown-item" href="Configuraciones.php">Configuraciones de la Cuenta</a>
                            <a class="dropdown-item" href="cerrar.php">Cerrar Sesion</a>
                        </div>
                    </div>

                    <ul class="navigation">
                        <li class="@@indexactive"><a href="AlmacenModelos.php"><i class="zmdi zmdi-home"></i>Almacen de Modelos</a></li>

                        <li class="">
                            <a href="SendModel.php"><i></i> Subir Modelos</a>

                        </li>
                        <li class="@@widgetactive"><a href="" data-toggle="dropdown"><i class="zmdi zmdi-widgets"></i>
                                Pantalla</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="" class="dropdown-item" data-sa-action="fullscreen">Pantalla completa</a>
                                <a href="" class="dropdown-item">Salir de Pantalla compreta</a>
                                <a href="" class="dropdown-item">Configuraciones</a>
                            </div>

                        </li>

                        <li class="@@typeactive"><a href=""><i class="zmdi zmdi-format-underlined"></i>Registro de actividad </a></li>



                        <li class="navigation__sub @@tableactive">
                            <a href=""><i class="zmdi zmdi-view-list"></i> </a>

                            <ul>
                                <li class="@@normaltableactive"><a href="">HTML Table</a></li>
                                <li class="@@datatableactive"><a href="">Data Table</a></li>
                            </ul>
                        </li>






                    </ul>
                </div>
                <div class="scroll-element scroll-x scroll-scrolly_visible">
                    <div class="scroll-element_outer">
                        <div class="scroll-element_size"></div>
                        <div class="scroll-element_track"></div>
                        <div class="scroll-bar" style="width: 88px;"></div>
                    </div>
                </div>
                <div class="scroll-element scroll-y scroll-scrolly_visible">
                    <div class="scroll-element_outer">
                        <div class="scroll-element_size"></div>
                        <div class="scroll-element_track"></div>
                        <div class="scroll-bar" style="height: 446px; top: 0px;"></div>
                    </div>
                </div>
            </div>
    </aside>





        <section class="content">
            <div id="configuracionCuenta">

                <h1>Editar Modelo</h1>
                
                <?php if(!empty($errores)): ?>
                                <div class="CF">
                                    <ul>  
                                        <?php echo $errores?>
                                    </ul>
                                </div>
                        <?php endif;?>
                        <?php if(!empty($correcto)): ?>
                                <div class="C">
                                    <ul>  
                                        <?php echo $correcto?>
                                    </ul>
                                </div>
                        <?php endif;?>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="post" enctype="multipart/form-data" >
                    <fieldset id="InfoCuenta">
                        
                        <div>
                            <h2>Nombre del modelo</h2>
                            <label for="">
                                <input type="text" id="NombreModel" name="NombreModel" placeholder="Nombre" value="<?php if(!empty($_SESSION['Modelocon'])) echo $_SESSION['Modelocon'][0][1];?>" required>
                            </label>

                        </div>
                        <div>
                            <h2>Descripcion del modelo</h2>
                            <label for="">
                            <script  src="javaScript/ckeditor/ckeditor.js"></script>
                            <textarea id="ckeditor" class="ckeditor"  name="descripcion" rows="10%" cols="60"  required ><?php if(!empty($_SESSION['Modelocon'])) echo $_SESSION['Modelocon'][0][2];?></textarea>
                            </label>
                        </div>
                        <div>
                            <section>
                                <div id="mostrar">
                                <p>Foto</p><img src='<?php  if(!empty($_SESSION['Modelocon'])) echo $_SESSION['Modelocon'][0][4];?>' class='user__imgM' />
                                </div>
                            </section >
                            
                            <div id="botonFoto">
                                    <p>Reemplazar foto?</p>
                                    <input type="file" name="Foto" id="BF">
                            </div>

                            <script src="javasCript/jquery.min.js"></script>
                            <script>
                        
                                function filePreview(input){
                                            var permitidos = ["image/png","image/jpg","image/gif","image/jpeg"];
                                            var p=false;
                                        if(input.files && input.files[0]){ 
                                            var reader = new FileReader();
                                            
                                            for(var i=0;i<permitidos.length;i++){
                                                if(permitidos[i]==input.files[0].type){
                                                    p=true;
                                                    break;
                                                }
                                            }

                                            if(p){
                                                reader.onload = function(e){
                                                $('#mostrar').html("<p>Foto</p><img src='"+e.target.result+"' class='user__imgM' />");
                                            }
                                            reader.readAsDataURL(input.files[0]);
                                            }else{
                                                alert("Archivo no permitido");
                                            }
                                            
                                            
                                        }
                                        }

                                        $("#BF").change(function(){
                                        filePreview(this); 
                                    });


                            </script>
                                        
                            
                        </div>
                        <div>
                            <section>
                                <div id="mostrarModelo">
                                <p>Modelo</p><img src='<?php if(!empty($_SESSION['Modelocon'])) echo $_SESSION['Modelocon'][0][3];?>' class='user__imgM' />
                                </div>
                            </section >
                            
                            <div id="botonFoto">
                                    <p>Eliminar modelo?</p>
                                    <input type="button" name="Modelo" id="BFM" onclick="BorrarModelo(<?php echo $_SESSION['Modelocon'][0][0];?>);">
                            </div>
                           
                        </div>


                       
                    </fieldset>
                
                    <input type="submit" name="submit" class="btbRegistroCon" value="Guardar cambios" style="margin: 20px 450px ;">
                </form>

              

            </div>

            

        </section>

    </main>
</body>
<template id="my-template">
            <swal-title>
            Eliminar Modelo? 
            </swal-title>
            <swal-icon type="warning" color="red"></swal-icon>
            <swal-button type="confirm">
            Borrar
            </swal-button>
            <swal-button type="cancel">
            Cancelar
            </swal-button>
            <swal-param name="allowEscapeKey" value="false" />
            <swal-param
            name="customClass"
            value='{ "popup": "my-popup" }' />
        </template>
<footer class="footer hidden-xs-down Recursos-login Recursos-loginFooter">
                <p>©Todos los derechos reservados.</p>

                <ul class="nav footer__nav">
                    <a class="nav-link" href="#Header">Inicio</a>

                    <a class="nav-link" href="">Cuenta</a>

                    <a class="nav-link" href="">Nosotros</a>

                    <a class="nav-link" href="">Cerrar Sesion</a>

                    <a class="nav-link" href="">Contactanos</a>
                </ul>
            </footer>


<!-- Javascript -->
<!-- Vendors --> 
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="javasCript/Modal.js"></script>
<script src="javasCript/Ajax.js"></script>
<script src="javasCript/recarga.js"></script>
<script src="javasCript/jquery_005.js"></script>
<script src="javasCript/popper.js"></script>
<script src="javasCript/bootstrap.js"></script>
<script src="javasCript/jquery_002.js"></script>
<script src="javasCript/jquery-scrollLock.js"></script>

<script src="javasCript/jquery_004.js"></script>
<script src="javasCript/jquery.js"></script>
<script src="javasCript/jquery_006.js"></script>
<script src="javasCript/curvedLines.js"></script>
<script src="javasCript/jquery_003.js"></script>

<!-- App functions and actions -->
<script src="javasCript/app.js"></script>
