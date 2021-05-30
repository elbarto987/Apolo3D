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
                        <a href="RecursosLegales.html"><i class="zmdi zmdi-more-vert"></i>Recursos Legales</a>


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


       
        <div id="codigo">
            <h2>Verifique su correo electronico</h2>
            <p>Hemos enviado un codigo de 8 digitos al correo: <b> <?php if(!empty($_SESSION['datos'][0])) echo $_SESSION['datos'][0]; else echo"No hay correo";?></b></p>
            <p>Por favor ingrese el codigo de verificacion para confirmar su correo electronico (No olvide revisar su carpeta de correo no deseado)</p>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <input type="text" placeholder="Digite el codigo" name="codigo" required>
                <div class="centrar"><input  type="submit" name="submit"  class="btnR" value="Enviar"></div>
            </form>
            <?php if(!empty($errorCodigo)):?>
                <div class="errores">
                    <ul>
                        <?php echo $errorCodigo?>
                    </ul>
                </div>
            <?php endif;?>
            <div id="reenviar"><p><a href="Login.php">Modificar datos?</a></p> </div>
            
        </div>
    
        
       

    </main>

</body>
<footer class="footer hidden-xs-down">
            <p>©Todos los derechos reservados.</p>

            <ul class="nav footer__nav">
                <a class="nav-link" href="#Header">Inicio</a>

                <a class="nav-link" href="">Cuenta</a>

                <a class="nav-link" href="">Nosotros</a>

                <a class="nav-link" href="">Contactanos</a>
            </ul>
</footer>



    <!-- Javascript -->
    <!-- Vendors -->
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
    <script src="javasCript/Ajax.js"></script>



