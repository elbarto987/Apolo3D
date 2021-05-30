<?php
$star_session =session_status();
if($star_session==PHP_SESSION_NONE){
    session_start();
}

$errores="";

require('Validar.php');

if(!empty($_GET['id'])){
    $_SESSION['Modelo']=DatosModelo($_GET['id']);
}

if(isset($_SESSION['user']) || empty($_SESSION['Modelo'])){
    header('location:indexSesion.php');
}

$_SESSION['Modelos']=DatosIndex($_SESSION['Modelo'][0][0]);
$_SESSION['Comentarios']=Comentarios($_SESSION['Modelo'][0][0]);

if(isset($_POST['submit'])){

    $datos=array(
        trim(filter_var($_POST['user'],FILTER_SANITIZE_EMAIL)),
        $_POST['pass']
    );
        $datos[1]=hash('sha512',$datos[1]);
        $resultado = usuario_session($datos);
        
        if(!empty($resultado)){
            session_start();
            $_SESSION['user']=$resultado;
            header('location:ViewModelSesion.php?id='.$_SESSION['Modelo'][0][0]);
        }else{
             $_GET['id']=$_SESSION['Modelo'][0][0];
             $errores.="<li>Usuario o Contraseña Incorrectos! </li>";
             
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
    <link  rel="icon"   href="imagenes/3D.gif" type="image/gif" />
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

        <div id="login" style="margin-top:5px;">
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

        
        
        <section class="Seccion">
        
               <div class="iz">
                   <div class="Modelo">
                  
                       
                       <div id="canvas"></div>    
                       
            
                            <div class="caracteristicas">
                            <h2><?php echo $_SESSION['Modelo'][0][1];?></h2>
                            <div id="LC">
                                <div class="item">
                                    <?php $numero =Numero('megusta',$_SESSION['Modelo'][0][0]);?>
                                    <img src='imagenes/likeBlack.png' alt=''><i><?php echo $numero[0][0];?></i>
                                </div>
                                <div class="item">
                                    <?php $numero =Numero('comentario',$_SESSION['Modelo'][0][0]);?>
                                    <img src='imagenes/speech-bubble.png' alt=''><i><?php echo $numero[0][0];?></i>
                                </div>
                                <div class="item">
                                    <?php $numero =Numero('view',$_SESSION['Modelo'][0][0]);?>
                                    </i><img src='imagenes/visibility.png' alt='' style="margin-top:-5px;"><i><?php echo $numero[0][0];?>
                                </div>
                            </div>
                            <div class="DU">
                            <?php $foto = DatosUsers($_SESSION['Modelo'][0][5]);?>
                                <a href="Perfil.php?idPerfil=<?php echo $foto[0][2];?>">
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
                        
                            <p><?php echo $_SESSION['Modelo'][0][2]; ?></p>
                      </div>


                    <div class="TituloComentarios"> <h2>Comentarios</h2></div>

                    
                    <div class="Registrate">
                        <p>Inicia sesion para que puedas comentar</p>
                        <a href="javascript:abrir()">Iniciar sesion</a>
                    </div>
                    <?php for($i=0;$i<sizeof($_SESSION['Comentarios']);$i++): $l="g".$i; $s="h".$i; $j="i".$i; $k="j".$i; $t="k".$i;?>
                        <div class="comentarios">
                            
                        <div class="E">
                         <div class="UC">
                                 <a href="">
                                     <?php $foto = DatosUsers($_SESSION['Comentarios'][$i][2])?>
                                     <img class="user__imgModelo" src="<?php if(!empty($foto)) echo $foto[0][1]; else echo 'imagenes/user.png'; ?>" alt="">
                                     <i><?php echo $foto[0][0]?></i>
                                 </a>
                                 <p class="Fecha"> <?php echo Fecha($_SESSION['Comentarios'][$i][3]); ?></p>
                         </div>
                         <div class="Com">
                             <p><?php echo $_SESSION['Comentarios'][$i][1]; ?></p>
                         </div>
                         <?php $replicas = Replicas($_SESSION['Comentarios'][$i][0]);?>
                         <?php if(sizeof($replicas)>=1):  if(sizeof($replicas)>=1) $value="Ver Respuesta"; else $value="Ver ".sizeof($replicas)." Respuestas"; ?>
                         <div><input type="botton" class="BotonAmpliar"onClick="javascript:AmpliarReplica('<?php echo $t;?>','<?php echo $j;?>','<?php echo $value;?>')" id="<?php echo $t;?>" value="<?php echo $value;?>" readonly=»readonly»></div>
                         <?php endif;?>
                          
                             
                         </div>
                         <?php $replicas = Replicas($_SESSION['Comentarios'][$i][0]);?>
                         <div class="ReplicaCom" id="<?php echo $j;?>">
                         <?php for($h=0;$h<sizeof($replicas);$h++):
                            $fo = DatosUsers($replicas[$h][2]);
                            ?>
                         
                             <div class="UC">
                                <a href="">
                                     <img class="user__imgModelo" src="<?php if(!empty($fo)) echo $fo[0][1]; else echo 'imagenes/user.png';?>" alt="">
                                     <i><?php echo $fo[0][0];?></i>
                                     <p class="Fecha"><?php echo Fecha($replicas[$h][3]);?></p>
                                 </a>
                             </div>
                             <div class="Com">
                                  <p><?php echo $replicas[$h][1];?></p>
                             </div>
                             <?php endfor;?> 
                         </div>  
                                              
                     </div>
                           

                          <?php endfor;?>
                   </div>

               <div class="der">
                <div class="sugerencias">
                        <h2>Modelos</h2>
                        <?php for($i=0;$i<sizeof($_SESSION['Modelos']);$i++): if($_SESSION['Modelos'][$i][0]!=$_SESSION['Modelo'][0][0]):?>
                        <div class="Modelos">
                            <a href="ViewModel.php?id=<?php echo $_SESSION['Modelos'][$i][0];?>">
                                <img class="user__imgModelos" src="<?php echo $_SESSION['Modelos'][$i][4]; ?>" alt="">
                                <p class="Mo"><?php echo $_SESSION['Modelos'][$i][1]; ?></p>
                            </a>
                        </div>
                        <?php endif; endfor;?>
                </div>
               </div>

        </section>


        
    </main>
    <footer class="footer hidden-xs-down">
            <p>©Todos los derechos reservados.</p>

            <ul class="nav footer__nav">
                <a class="nav-link" href="index.php">Inicio</a>

                <a class="nav-link" href="Login.php">Cuenta</a>

                <a class="nav-link" href="index.php#nosotros">Nosotros</a>

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
           //let responsive = new THREE.BoxGeometry(1,1,1);
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
          
           

            init('<?php echo $_SESSION['Modelo'][0][3];?>');

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

            let light3 = new THREE.HemisphereLight(0xffffff);
                light3.position.set(0, 100, 0);
                scene.add(light3);

            animate();



        }


        function animate(){
            requestAnimationFrame(animate);
            renderer.render(scene,camera);
        }

        init('<?php echo $_SESSION['Modelo'][0][3];?>');

       }
         

    
    
    

    </script>