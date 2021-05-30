<?php

$start_session =session_status();

if($start_session == PHP_SESSION_NONE){
    session_start();
}

if(isset($_SESSION['user'])){
    header('location:indexSesion.php');
}

?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/app.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r122/three.min.js">
    </script>
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
        <div id="alerta">
            <a href="javascript:salirAlert();"><img src="imagenes/cancelar.png" alt=""></a>
            <h2>ERROR!</h2>
            <h4>Contraseña insegura, por favor vuelva a digitar una contraseña valida </h4>
            <p>Su contraseña minimo debe tener:</p>
            <p>Un letra mayuscula</p>
            <p>Un numero</p>
            <p>Un caracter especial</p>
            <p>Debe tener minimo 10 caracteres</p>
        </div>
                
        <header class="header" id="Header">

                <div class="navigation-trigger hidden-xl-up" data-sa-action="aside-open" data-sa-target=".sidebar">
                    <i><img src="imagenes/btn-menu.png" alt=""></i>
                </div>

                <div class="logo hidden-sm-down">
                    <h1><a href="index.php">APOLO</a></h1>
                </div>
                <div id="animacionHeader">
                    <section id="img-3d"><img src="imagenes/3D.gif" alt=""></section>
                </div>



                <ul class="top-nav">

                    <li class="hidden-xs-down">
                        <a href="index.php" class="top-nav__themes" data-sa-target=".themes"><i class="zmdi zmdi-palette"></i>Inicio</a>
                    </li>



                    <li class="dropdown hidden-xs-down">
                        <a href="index.php#nosotros"><i class="zmdi zmdi-apps"></i>Nosotros</a>

                    </li>

                    <li class="dropdown hidden-xs-down">
                        <a href="RecursosLegales.php"><i class="zmdi zmdi-more-vert"></i>Recursos Legales</a>


                    </li>

                    <li class="dropdown hidden-xs-down">
                        <a href="" data-toggle="dropdown" aria-expanded="false"><i class="zmdi zmdi-check-circle"></i>
                            <div class="cuenta">Cuenta</div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right dropdown-menu--block" role="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(50px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                            <div class="dropdown-header">Registro</div>

                            <div class="listview listview--hover">

                                <a href="Login.php" class="listview__item">
                                    <div class="listview__content">
                                        <div class="listview__heading">Iniciar Sesion</div>

                                        <div class="progress mt-1">
                                        </div>
                                    </div>
                                </a>

                                

                            </div>
                        </div>
                    </li>

                </ul>


        </header>

         
            <div id="Registro">
                <h1>Registro</h1>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <div id="datos">
                        
                        <label for="">
                                <input type="email" name="correo" placeholder="Correo electronico" required value="<?php  if($ver !=0  && !empty($datos[0])) echo $datos[0];?>">
                        </label>
                        <label for="">
                                <input type="text" name="usuario" placeholder="Usuario" required value="<?php if($ver1 !=1  && !empty($datos[1])) echo $datos[1];?>">
                        </label>
                            <?php if(!empty($tem)):?>
                                <div class="tem">
                                    <ul>  
                                        <?php echo $tem?>
                                    </ul>
                            </div>
                            <?php endif;?>

                        <p id="contraseñadevil"></p>
                        <label for="">
                                <input type="password" id="micontraseña" name="pass" placeholder="Contraseña" required onchange="Validar();" >
                            </label>
                        <label for="">
                                <input type="password"  name="confirmacion" placeholder="Confirmar contraseña" required>
                        </label>
                            <?php if(!empty($errores)): ?>
                                <div class="errores">
                                    <ul>  
                                        <?php echo $errores?>
                                    </ul>
                            </div>
                            <?php elseif(!empty($pass)):?>
                                <script>
                                    document.getElementById("alerta").style.display = "block";
                                </script>
                           <?php endif; ?>
                            
                        <div id="terminosycondiciones">
                            <label for="">
                                <input type="checkbox" name="terminos" id="chex" required>    
                                <p>Acepto los <a href="RecursosLegales.php" > teminos y condiciones </p> </a>
                                </label>
                        </div>

                        <input type="submit" name="su" class="btnRegistro" value="Registrarse">
                        
                        <div id="reenviar">
                            <p>Ya tienes una cuenta?,<a href="Login.php">Inicia Sesion  Aqui</a></p>
                            
                        </div>

                    </div>

                </form>
               
            </div>
            

      
        
        <footer class="footer hidden-xs-down">
            <p>©Todos los derechos reservados.</p>

            <ul class="nav footer__nav">
                <a class="nav-link" href="#Header">Inicio</a>

                <a class="nav-link" href="">Cuenta</a>

                <a class="nav-link" href="">Nosotros</a>

                <a class="nav-link" href="">Contactanos</a>
            </ul>
        </footer>

    </main>



    <!-- Javascript -->
    <!-- Vendors -->
    <script src="javasCript/Modal.js"></script>
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