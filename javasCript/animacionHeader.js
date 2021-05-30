
//Escena
var scena = new THREE.Scene();
scena.fog = new THREE.Fog(0xffffff, 0.1, 8);
/*
    var loader=new THREE.TextureLoader();
    loader.load('./uno.jpg',function(texture){
        scena.background=texture;
    })
     */


//camara
var camara = new THREE.PerspectiveCamera(
    105,
    window.innerWidth / window.innerHeight,
    0.1,
    2000
);

var newcamara = new THREE.OrthographicCamera(5, -5, 5, -5, 3, 10);
var helper = new THREE.CameraHelper(newcamara);

scena.add(helper);

//renderer 

var renderer = new THREE.WebGLRenderer();
renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setSize(200, 70);
document.getElementById('canvas').appendChild(renderer.domElement);

//geometria

var geometry = new THREE.BoxGeometry();
var material = new THREE.MeshBasicMaterial({ color: 0xffffff });
var cube = new THREE.Mesh(geometry, material);
cube.position.z = -5;
scena.add(cube);

//camara.position.z=5;

//animation
var i = 0;
var animate = function() {
    requestAnimationFrame(animate);


    camara.lookAt(newcamara.position);

    camara.position.x = Math.cos(i) * 10
    camara.position.z = Math.sin(i) * 9

    i += 0.01;

    cube.rotation.x += 0.1;
    cube.rotation.y += 0.1;

    renderer.render(scena, camara);

}

animate();