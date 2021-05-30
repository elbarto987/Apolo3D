import * as THREE from './Threejs/three.module.js';
import {STLLoader} from '/Threejs/STLLoader.js';
import {OrbitControls} from '/Threejs/OrbitControls.js';

window.location.href="index.html";
let scene, camera, renderer, object;

function init(){
    scene = new THREE.Scene();
    scene.background=new THREE.Color(0x2a003b)
    camera = new THREE.PerspectiveCamera(
        75,
        window.innerWidth/window.innerHeight,
        0.1,
        2000
    );

    camera.position.z=10;

    renderer = new THREE.WebGLRenderer();
    renderer.setSize(window.innerWidth,window.innerHeight);
    //document.body.appendChild(renderer.domElement);
    document.getElementById('canvas').appendChild(renderer.domElement);

    scene.add(object);

    let contro=new OrbitControls(camera,renderer.domElement);
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


function inicio(objeto){
    let loader = new STLLoader();
loader.load(objeto, (model)=>{
    object = new THREE.Mesh(
        model, 
        new THREE.MeshLambertMaterial({color: 0x00ff00})
    );
    object.scale.set(0.1, 0.1, 0.1);
    object.position.set(0,-5,0);
    object.rotation.x=-Math.PI/2;
    init();
});

}


