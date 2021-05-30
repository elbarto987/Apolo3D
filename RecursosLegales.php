<?php

session_start();

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
                    <a href="" data-toggle="dropdown" aria-expanded="false"><i class="zmdi zmdi-check-circle"></i><div class="cuenta">Cuenta</div></a>

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

                            <a href="Registro.php" class="listview__item">
                                <div class="listview__content">
                                    <div class="listview__heading">Registrarse</div>

                                    <div class="progress mt-1">
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                </li>

            </ul>


        </header>




        

            <div class="Recursos">
                <div class="Parrafo">
                    <h2>USO DE DATOS PERSONALES </h2>
                    <p>Que mediante la Ley 1581 de 2012 se expidió el Régimen General de Protección de Datos Personales, el cual, de conformidad con su artículo 1, tiene por objeto "( .. .) desarrollar el derecho constitucional que tienen todas las personas
                        a conocer, actualizar y rectificar las informaciones que se hayan recogido sobre ellas en bases de datos o archivos, y los demás derechos, libertades y garantías constitucionales a que se refiere el artículo 15 de la Constitución
                        Política; así como el derecho a la información consagrado en el artículo 20 de la misma.</p>

                    <p>Que la Ley 1581 de 2012 constituye el marco general de la protección de los datos personales en Colombia, por consiguiente se solicita su autorización para realizar el tratamiento de sus datos personales.</p>

                    <br>

                </div>
                <div class="Parrafo">
                    <h2>DERECHOS DE AUTOR</h2>
                    <p>Los contenidos, textos, fotografías, diseños, logotipos, imágenes, sonidos, vídeos, animaciones, grabaciones, programas de computador, códigos fuente y, en general, cualquier creación intelectual existente en este sitio oficial, así
                        como el propio sitio en su conjunto como obra artística multimedia están protegidos como derechos de autor por la legislación en materia de propiedad intelectual. Quedan exceptuados de esta protección aquellos archivos o programas
                        de computador que no cuentan con titularidad de los autores y los programas de acceso gratuito (freeware) que el usuario puede descargar desde diversas páginas de este sitio con el fin de posibilitar el acceso a las mismas. Se
                        trata, en todo caso, de aplicaciones que tienen el carácter de dominio público por expresa voluntad de sus autores</p>
                    <br>
                </div>
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



    <script src="javasCript/Modal.js"></script>
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