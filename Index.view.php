<?php

$start_session=session_status();
if($start_session==PHP_SESSION_NONE){
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
    <link  rel="icon"   href="imagenes/3D.gif" type="image/gif" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r122/three.min.js">
    </script>
</head>
 <div id="login" style="margin-top:7%;">
             <h2>Iniciar Sesion</h2>
             <a href="javascript:cerrar()"><img src="imagenes/cancelar.png" alt=""></a>
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
<body data-sa-theme="3" class="">
    <main class="main" id="main">
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
                    <a href="RecursosLegales.php"><i class="zmdi zmdi-more-vert"></i>Recursos Legales</a>


                </li>

                <li class="dropdown hidden-xs-down">
                    <a href="" data-toggle="dropdown" aria-expanded="false"><i class="zmdi zmdi-check-circle"></i>
                        <div class="cuenta">Cuenta</div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right dropdown-menu--block" role="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(50px, 38px, 0px); top: 0px; left: 0px; will-change: transform;">
                        <div class="dropdown-header">Registro</div>

                        <div class="listview listview--hover">

                            <a href="javascript:abrir()" class="listview__item">
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

        <div id="inicio">
                <div id="contenido">
                    <P><i>Construye, diseña y comparte tus diseños para que mas personas se diviertan y aprendan explorando
                            modelos en tercera dimención con la web APOLO 3D </i> </P>
                 </div>    
                <div id="canvasIndex"></div>
               
        </div>
        <div id="opIndex">
            
            <div id="slider">
                <ul>
                    <li>
                           <div id="nosotros">
                                <h2>Nosotros</h2>
                                <p>Apolo 3D, está inspirada en la mitología griega bajo los Dioses prometedores del conocimiento, las artes y el sol.
                                Desarrollada en la promesa de fortalecer previos conocimientos bajo herramientas tecnológicas que viven cotidianamente entre los seres humanos. 
                                Permite al Usuario interactuar con modelos tridimensionales y la posibilidad generar historial de diseños personalizados, una buena herramienta de enseñanza para el docente e interactividad con el estudiante.</p>
                                <p>Diseñada por: Miguel Ángel Suárez Sánchez, Carlos Fernando Mahecha Almonacid y Yannis Stefania Ávila Parra, estudiantes de Ingeniería de Sistemas.</p>

                            </div>
                    
                    </li>
                    <li>
                        <div id="elementoss">
                            <img src="imagenes/Webp.net-gifmaker.gif" alt="">
                        </div>
                    </li>
                    <li>
                        <div id="elementoss">
                            <h2>Interactividad</h2>
                        </div>
                    </li>
                    <li>
                        <div id="elementoss">
                            <h2>Comunidad</h2>
                        </div>
                    </li>
                </ul>
            </div>
            
        </div>

        <section class="contenidoIndex">

            <div class="imagenesContenido">
             <?php $tem=0;
               for($i=0;$i<sizeof($_SESSION['DatosModelos']);$i++):?>
               <?php $foto = DatosUsers($_SESSION['DatosModelos'][$i][5]);?>
                   <a href='Perfil.php?idPerfil=<?php echo $_SESSION['DatosModelos'][$i][5];?>'>
                    <div class='imagen'>
                        <div class="imgUser">
                                
                                <img class="user__img" src="<?php if(!empty($foto)) echo $foto[0][1]; else echo 'imagenes/user.png'; ?>" alt="">
                                <i><?php if(!empty($foto)) echo $foto[0][0];?></i>
                        </div>
                        <a href="ViewModel.php?id=<?php echo $_SESSION['DatosModelos'][$i][0];?>">
                                <div>
                                    <div id='modelo'>
                                        <img src='<?php echo $_SESSION['DatosModelos'][$i][4]?>'>
                                    </div>  
                                    <h4><?php echo $_SESSION['DatosModelos'][$i][1]?></h4>
                                    <div id="LCC">
                                                <div class="item">
                                                    <?php $numero =Numero('megusta',$_SESSION['DatosModelos'][$i][0]);?>
                                                    <img src='imagenes/likeBlack.png' alt=''><i><?php echo $numero[0][0];?></i>
                                                </div>
                                                <div class="item">
                                                    <?php $numero =Numero('comentario',$_SESSION['DatosModelos'][$i][0]);?>
                                                    <img src='imagenes/speech-bubble.png' alt=''><i><?php echo $numero[0][0];?></i>
                                                </div>
                                                <div class="item">
                                                    <?php $numero =Numero('view',$_SESSION['DatosModelos'][$i][0]);?>
                                                    <img src='imagenes/visibility.png' alt='' style="margin-top:-5px;"><i><?php echo $numero[0][0];?></i>
                                                </div>
                                    </div>
                                </div>

                        </a>
                    </div>
                </a>
               <?php endfor; ?>               

            </div>



            

        </section>


        
    </main>
   
</body>
<footer class="footer">
            <p>©Todos los derechos reservados.</p>

            <ul class="nav footer__nav">
                <a class="nav-link" href="index.php">Inicio</a>

                <a class="nav-link" href="">Cuenta</a>

                <a class="nav-link" href="">Nosotros</a>

                <a class="nav-link" href="">Contactanos</a>
            </ul>
        </footer>

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

    <script type="module" >
       import * as THREE from './javasCript/THREE/Threejs/three.module.js';
       import {ThreeMFLoader} from './javasCript/THREE/Threejs/3MFLoader.js';
       import {STLLoader} from './javasCript/THREE/Threejs/STLLoader.js';
       import {OBJLoader} from './javasCript/THREE/Threejs/OBJLoader.js';
       import {OrbitControls} from './javasCript/THREE/Threejs/OrbitControls.js';
       import {MTLLoader} from './javasCript/THREE/Threejs/MTLLoader.js';
      
     

        let scene, camera, renderer, object;

        

            scene = new THREE.Scene();
            scene.background = new THREE.Color('#138496');
            renderer = new THREE.WebGLRenderer({alpha:true});
            camera =  new THREE.PerspectiveCamera(
                75,
                window.innerWidth/window.innerHeight,
                0.1,
                2000
            );
            camera.position.z=10;

            renderer =  new THREE.WebGLRenderer();
            renderer.setSize(500,400);
            document.getElementById('canvasIndex').appendChild(renderer.domElement); 
           
            
           let loader = null;
                loader = new OBJLoader();
                loader.load('imagenes/Logo.obj',(object)=>{
                   
                    object.scale.set(5,5,5);
                    scene.add(object);
                })

            let control =new OrbitControls(camera,renderer.domElement);
                
                control.minDistance = 10;
                control.maxDistance = 12;
                control.autoRotate=true;
                control.autoRotateSpeed=5.0;
                control.enablePan=false;
            let luz = new THREE.DirectionalLight(0xffffff);
                luz.position.set(0,0,10);
                scene.add(luz);

            let luz2 = new THREE.DirectionalLight(0xffffff);
                luz2.position.set(0,0,-10);
                scene.add(luz2);

            animate();



            

                 var i=0;
        function animate(){
            requestAnimationFrame(animate);
            control.update();
            renderer.render(scene,camera);
        }

        

    
    </script>