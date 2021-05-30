<?php

$start_session = session_status();

if($start_session == PHP_SESSION_NONE){
    session_start();
}

if(isset($_SESSION['user'])){
    header('location:indexSesion.php');
}

?>
<link rel="stylesheet" href="css/app.css">

    <script>
         document.getElementById("login").style.display = "block";
    </script>

<main class="main">
        <div class="page-loader" style="display: none;">
            <div class="page-loader__spinner">
                <svg viewBox="25 25 50 50">
                    <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
                </svg>
            </div>
        </div>
        <div id="logins">
             <h2>Iniciar Sesion</h2>
            
              <hr>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" method="POST">
                <input type="text"  name="user" placeholder="Digite su usuario o Email" required>
                <input type="password"  name="pass"  placeholder="Digite su contraseña" required>
                <input type="submit" name="submit" class="btnR" value="Entrar">
            </form>
           
            <?php if(!empty($errores)):?>
                <div class="errores">
                   <ul>
                        <?php echo $errores?>
                   </ul>
                   <script>
                        document.getElementById("login").style.display = "block";
                   </script>
                </div>
            <?php endif;?>
            <hr>
                <div id="link">
                    <a href="RecuperacionContraseña.php"><i>Olvide mi contraseña</i></a>
                    <a href="Registro.php"><i>Registrarme</i></a>
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
        <a href="RecursosLegales.php"><i class="zmdi zmdi-more-vert"></i>Recursos Legales</a>


    </li>

    <li class="dropdown hidden-xs-down">
        <a href="" data-toggle="dropdown" aria-expanded="false"><i class="zmdi zmdi-check-circle"></i>
            <div class="cuenta">Cuenta</div>
        </a>

        <div class="dropdown-menu dropdown-menu-right dropdown-menu--block" role="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(50px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
            <div class="dropdown-header">Registro</div>

            <div class="listview listview--hover">

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
  
        
