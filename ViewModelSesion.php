<?php
$star_session =session_status();
if($star_session==PHP_SESSION_NONE){
    session_start();
}

require('Validar.php');

if(!isset($_SESSION['user']) || empty($_GET['id']) || DatosModelo($_GET['id']) == null){
    header('location:index.php');
}




$_SESSION['Modelo']=DatosModelo($_GET['id']); 
$_SESSION['Modelos']=DatosIndex();
$_SESSION['Comentarios']=Comentarios($_SESSION['Modelo'][0][0]);
Vista($_SESSION['user'][0][0],$_SESSION['Modelo'][0][0]);

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

<body data-sa-theme="3" class="" onload="Comentarios();">
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
                    <a href="SendModel.php" class="top-nav__themes" data-sa-target=".themes"><i class="zmdi zmdi-palette"></i>Subir</a>
                </li>

                <li class="dropdown hidden-xs-down">
                    <a href="AlmacenModelos.php"><i class="zmdi zmdi-more-vert"></i>Mis Modelos</a>


                </li>

                <li class="dropdown hidden-xs-down">
                    <a href="" data-toggle="dropdown" aria-expanded="false"><i class="zmdi zmdi-check-circle"></i>
                        <div class="cuenta">Cuenta <img class="user__img" src="<?php if(!empty($_SESSION['user'][0][3])) echo $_SESSION['user'][0][3]; else echo 'imagenes/user.png';?>" alt="">
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

        <section class="Seccion">
        
        <div class="iz">
                 
                <div class="Modelo">

                       <div id="canvas"></div>   

                     <div class="caracteristicas">
                     <h2><?php echo $_SESSION['Modelo'][0][1];?></h2>
                     <div id="LC">
                                
                     </div>
                     <div class="DU">
                         <a href="PerfilSession.php?idPerfil=<?php echo $_SESSION['Modelo'][0][5];?>">
                             <?php $foto = DatosUsers($_SESSION['Modelo'][0][5]);?>
                             <img class="user__imgModelo" src="<?php if(!empty($foto)) echo $foto[0][1]; else echo 'imagenes/user.png'; ?>" alt="">
                             <i><?php if(!empty($foto)) echo $foto[0][0];?></i>
                         </a>
                     </div>
                     </div>
                     <div class="linea"></div>                           
                     
                     <div class="controles">
                         <div class="color">
                         </div>
                         <div class="pantalla">
                         </div>    
                     </div>
                 </div>

                 
                 <div class="TituloTeoria"> <h2>Teoria</h2></div>

                 <div class="descripcion">
                 
                   <?php echo $_SESSION['Modelo'][0][2]; ?>

                </div>


             <div class="TituloComentarios"> <h2>Comentarios</h2></div>
             <div class="Comentario" id="COM">
                             <img class="user__img" src="<?php echo $_SESSION['user'][0][3] ?>" alt="">
                             <form  method="POST">
                                 <input type="text" name="coment" placeholder="Agrega un comentario publico..." id="com">
                                 <input type="button" id="comentario" class="BtnComentario" value="Comentar" readonly=»readonly» onClick="EnviarDatos($('#com').val(),<?php echo $_SESSION['Modelo'][0][0];?>,<?php echo $_SESSION['user'][0][0];?>);">
                             </form>
             </div>

             <div id="espere" class="Registrate"></div>
             <div id="ComentariosD"></div>
            

        </div>

        <div class="der">
         <div class="sugerencias">
                 <h2>Modelos</h2>
                 <?php for($i=0;$i<sizeof($_SESSION['Modelos']);$i++):  if($_SESSION['Modelos'][$i][0]!=$_SESSION['Modelo'][0][0]):?>
                 <div class="Modelos">
                    <a href="ViewModelSesion.php?id=<?php echo $_SESSION['Modelos'][$i][0];?>">
                        <img class="user__imgModelos" src="<?php echo $_SESSION['Modelos'][$i][4]; ?>" alt="">
                        <p class="Mo"><?php echo $_SESSION['Modelos'][$i][1]; ?></p>
                    </a>
                 </div>
                 <?php endif; endfor;?>
         </div>
        </div>

 </section>


    </main>
    <footer class="footer Recursos-loginFooter">
        <p>©Todos los derechos reservados.</p>

         <ul class="nav footer__nav">
             <a class="nav-link" href="#Header">Inicio</a>

            <a class="nav-link" href="">Cuenta</a>

            <a class="nav-link" href="">Nosotros</a>

             <a class="nav-link" href="">Cerrar Sesion</a>

             <a class="nav-link" href="">Contactanos</a>
        </ul>
    </footer>          

         <template id="my-template">
            <swal-title>
            Eliminar Comentario? 
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

</body>
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
    <script type="module" >
       import * as THREE from './javasCript/THREE/Threejs/three.module.js';
       import {ThreeMFLoader} from './javasCript/THREE/Threejs/3MFLoader.js';
       import {STLLoader} from './javasCript/THREE/Threejs/STLLoader.js';
       import {OBJLoader} from './javasCript/THREE/Threejs/OBJLoader.js';
       import {OrbitControls} from './javasCript/THREE/Threejs/OrbitControls.js';
       import {MTLLoader} from './javasCript/THREE/Threejs/MTLLoader.js';
      
       let op = '<?php echo Extencion($_SESSION['Modelo'][0][3]);?>';
      
       if(op == 0){

        let scene, camera, renderer, object;

            function init(dato){
                scene = new THREE.Scene();
                scene.background =  new THREE.Color(0x123456);
                renderer = new THREE.WebGLRenderer({alpha:true});
                
                camera = new THREE.PerspectiveCamera(
                    75,
                    window.innerWidth/window.innerHeight,
                    0.1,
                    2000
                ); 
                camera.position.z=10;

                renderer = new THREE.WebGLRenderer();
                renderer.setSize(910,550);
                document.getElementById('canvas').appendChild(renderer.domElement);

                let loader = null;
                    loader = new ThreeMFLoader();
                    loader.load(dato,(object)=>{
                        object.scale.set(1,1,1);
                        object.position.set(0,0,0);
                        object.rotation.set(Math.PI,Math.PI,Math.PI);
                        scene.add(object);
                    })

           let Control = new OrbitControls(camera,renderer.domElement);
                             
            let luz = new THREE.DirectionalLight(0xffffff);
                luz.position.set(0,0,10);
                scene.add(luz);

            let luz2 = new THREE.DirectionalLight(0xffffff);
                luz2.position.set(0,0,-10);
                scene.add(luz2);

            let light3 = new THREE.HemisphereLight(0xffffff);
                light3.position.set(0, 100, 0);
                scene.add(light3);


            animate();
                
            }

            function animate(){
                requestAnimationFrame(animate);
                renderer.render(scene,camera);
            }
          
           

            init('<?php echo $_SESSION['Modelo'][0][3];?>',);

       }else if(op == 1){
        
        let scene, camera, renderer, object;

        function init(){
            scene = new THREE.Scene();
            scene.background =  new THREE.Color(0x123456);
            camera = new THREE.PerspectiveCamera(
                75,
                window.innerWidth/window.innerHeight,
                0.1,
                2000
            );

            camera.position.z=10;

            renderer = new THREE.WebGLRenderer({alpha:true});
            renderer.setSize(910,550);
            document.getElementById('canvas').appendChild(renderer.domElement);
            scene.add(object);

            let control =new OrbitControls(camera,renderer.domElement);

            let luz = new THREE.DirectionalLight(0xffffff);
                luz.position.set(0,0,10);
                scene.add(luz);

            let luz2 = new THREE.DirectionalLight(0xffffff);
                luz2.position.set(0,0,-10);
                scene.add(luz2);

           
            animate();
            
        }

        function animate(){
            requestAnimationFrame(animate);
            renderer.render(scene,camera);
        }

        let loader = null;
            loader = new STLLoader();
            loader.load('<?php echo $_SESSION['Modelo'][0][3];?>',(model)=>{
                object = new THREE.Mesh(
                    model,
                    new THREE.MeshLambertMaterial({color:0x00ff00})
                );
                object.scale.set(1,1,1);
                object.position.set(0,0,0);
                object.rotation.set(Math.PI,Math.PI,Math.PI);
                init();
            })


       }else if(op == 2){

        let scene, camera, renderer, object;

        function init(dato){

            scene = new THREE.Scene();
            scene.background = new THREE.Color(0x123456);
            renderer = new THREE.WebGLRenderer({alpha:true});
            camera =  new THREE.PerspectiveCamera(
                75,
                window.innerWidth/window.innerHeight,
                0.1,
                2000
            );
            camera.position.z=10;

            renderer =  new THREE.WebGLRenderer();
            renderer.setSize(910,550);
            document.getElementById('canvas').appendChild(renderer.domElement); 

            
           let loader = null;
                loader = new OBJLoader();
                loader.load(dato,(object)=>{
                    scene.add(object);
                })

            let control =new OrbitControls(camera,renderer.domElement);

            let luz = new THREE.DirectionalLight(0xffffff);
                luz.position.set(0,0,10);
                scene.add(luz);

            let luz2 = new THREE.DirectionalLight(0xffffff);
                luz2.position.set(0,0,-10);
                scene.add(luz2);

           

            animate();



        }


        function animate(){
            requestAnimationFrame(animate);
            renderer.render(scene,camera);
        }

        init('<?php echo $_SESSION['Modelo'][0][3];?>');

       }

</script>