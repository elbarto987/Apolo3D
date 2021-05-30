import * as THREE from './THREE/Threejs/three.module.js';
import {ThreeMFLoader} from './THREE/Threejs/3MFLoader.js';
import {STLLoader} from './THREE/Threejs/STLLoader.js';
import {OBJLoader} from './THREE/Threejs/OBJLoader.js';
import {OrbitControls} from './THREE/Threejs/OrbitControls.js';
import {MTLLoader} from './THREE/Threejs/MTLLoader.js';

function Modelo(modeloRuta, tem){
    if(tem == "3mf"){
     alert("entro");
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
        
        
    
            init(modeloRuta);
    
    }else if(tem == "stl"){
        
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
            loader.load(modeloRuta,(model)=>{
                object = new THREE.Mesh(
                    model,
                    new THREE.MeshLambertMaterial({color:0x00ff00})
                );
                object.scale.set(1,1,1);
                object.position.set(0,0,0);
                object.rotation.set(Math.PI,Math.PI,Math.PI);
                init();
            })
    
    
    }else if(tem == "obj"){
    
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
    
        init(modeloRuta);
    
    }
}