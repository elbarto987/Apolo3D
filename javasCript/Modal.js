
    
function abrir() {
    document.getElementById("login").style.display = "block";
    document.body.style.overflow="hidden";
    document.getElementById("main").style.opacity = "0.6";
    

}

function cerrar() {

    document.getElementById("login").style.display = "none";
    document.body.style.overflow="scroll";
    document.getElementById("main").style.opacity = "1";

}


function Validar() {
   
    let var1 = false,
        var2 = false,
        var3 = false,
        var4 = false;
    let contenido = document.getElementById("micontraseña").value;
    for (var i = 0; i < contenido.length; i++) {

        if (contenido.charCodeAt(i) >= 48 && contenido.charCodeAt(i) <= 57) {
            var1 = true;
        }

        if (contenido.charCodeAt(i) >= 65 && contenido.charCodeAt(i) <= 90) {
            var2 = true;
        }

        if ((contenido.charCodeAt(i) >= 33 && contenido.charCodeAt(i) <= 47) || (contenido.charCodeAt(i) >= 58 && contenido.charCodeAt(i) <= 64) || (contenido.charCodeAt(i) >= 91 && contenido.charCodeAt(i) <= 96) || (contenido.charCodeAt(i) >= 124 && contenido.charCodeAt(i) <= 254)) {
            var3 = true;
        }
    }

    if (contenido.length >= 10) {
        var4 = true;
    }

    if (var1 && var2 && var3 && var4) {

    } else {
        document.getElementById("alerta").style.display = "block";
        document.getElementById("micontraseña").value = ""; 
        document.getElementById("confirmacion").value = "";
    }


}

function salirAlert() {
    document.getElementById("alerta").style.display = "none";
}



function SubirModelo() {
    document.getElementById("subirModelo").style.display = "block";
}

function cerrarModelo() {
    document.getElementById("subirModelo").style.display = "none";
}

function Codigo(){
    
    document.getElementById("codigo").style.display = "block";
    body.style.overflow = "hidden";
}

function SalirCodigo(){
   document.getElementById("codigo").style.display = "none";
   document.getElementById("Registro").style.display = "block"; 
}

function Replica(dato,dato2){
 
    document.getElementById(dato).style.display="flex";
    document.getElementById(dato2).style.display="none";
    
}

function SalirReplica(dato,dato2){
    document.getElementById(dato).style.display="none";
    document.getElementById(dato2).style.display="block";
    
}



function ContraerReplica(dato,dato2,dato3){
  
    document.getElementById(dato).style.display="none";
    document.getElementById(dato2).style.display="none";
    document.getElementById(dato3).style.display="block";
    
}

function AmpliarReplica(dato,dato1,dato2){
    var op=true;
    
    if(document.getElementById(dato).value==dato2){
        document.getElementById(dato1).style.display="block";
        document.getElementById(dato).value="Ocultar Respuestas";
    }else{
       document.getElementById(dato1).style.display="none";
       document.getElementById(dato).value=dato2;
    }
    
}

function Editar(dato){
    
    document.getElementById(dato).style.display="block";
}







