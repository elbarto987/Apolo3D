

function Comentarios(){
   
    var datos= $.ajax({
        url:'ModelSession.php',
        dataType:'text',
        async:false
    }).responseText;
    MVC();
    document.getElementById("ComentariosD").innerHTML=datos;

}

function MVC(){
    
    var f= $.ajax({
        url:'MCV.php',
        dataType:'text',
        async:false
    }).responseText;
    if(f!=null){
        document.getElementById("LC").innerHTML=f;
    }
}


function EnviarDatos(dato,modelo,user){

    dato=dato.trim();
    if(dato===null || dato===""){
        
    }else{
        var parametro = {"comentario": dato,"modelo": modelo,"user": user};
        
    $.ajax({
        data:parametro,
        url:"EnviarComentario.php",
        type:"POST",
        beforeSend: function(){
            document.getElementById('espere').style.display='block';
            $('#espere').html("Procesando, Espere por favor!");
        },
                
                success: function(responde){
                   document.getElementById('com').value="";
                   Comentarios();
                   MVC();
                    $('#espere').html(responde);
                    
                }
                
            });
    }
    
        
}

function EnviarReplica(comentario,idcomentario,user){
    
    comentario=comentario.trim();
    if(comentario===null || comentario===""){
        
    }else{
        var parametro = {"comentario": comentario,"idcomentario": idcomentario,"user": user};
        
    $.ajax({
        data:parametro,
        url:"EnviarReplica.php",
        type:"POST",
                
                success: function(responde){
                 
                    
                     Comentarios(); 
                     MVC();
                     Swal.fire({
                        title:responde,
                        icon:"info",
                        showCloseButton:'true',
                        timer:10000,
                        timerProgressBar:true
                    })         
                            
                }
                
            });
    }
    
        
}

function EditarComentario(comentario,idcomentario){
    comentario=comentario.trim();
    if(comentario===null || comentario===""){
        
    }else{
        var parametro = {"comentario": comentario,"idcomentario": idcomentario};
        
    $.ajax({
        data:parametro,
        url:"EditarComentario.php",
        type:"POST",
                
                success: function(responde){
                 
                    
                     Comentarios(); 
                     MVC();
                     Swal.fire({
                        title:responde,
                        icon:"info",
                        showCloseButton:'true',
                        timer:10000,
                        timerProgressBar:true
                    })        
                            
                }
                
            });
    }
    
}

function EditarReplica(comentario,idcomentario){
    comentario=comentario.trim();
    if(comentario===null || comentario===""){
        
    }else{
        var parametro = {"comentario": comentario,"idcomentario": idcomentario};
        
    $.ajax({
        data:parametro,
        url:"EditarReplica.php",
        type:"POST",
                
                success: function(responde){
                 
                    
                     Comentarios(); 
                     MVC();
                     Swal.fire({
                        title:responde,
                        icon:"info",
                        showCloseButton:'true',
                        timer:10000,
                        timerProgressBar:true
                    })         
                            
                }
                
            });
    }
}

function like(user,model){
    
   
    var parametro = {"user": user,"model":model};
        
    $.ajax({
        data:parametro,
        url:"EnviarReplica.php",
        type:"POST",
                
                success: function(responde){
                  Comentarios(); 
                  MVC(); 
                               
                }
                
            });
    }


    function BorrarComentario(dato){
        (async ()=>{
         const {value: confirm} = await Swal.fire({
             title:"Borrar Comentario?",
             template: '#my-template'
         })
     
         if(confirm){
            var parametro = {"EliCom": dato};
        
                $.ajax({
                    data:parametro,
                    url:"EliminarComentario.php",
                    type:"POST",
                            
                            success: function(responde){
                            Comentarios(); 
                            MVC(); 
                            Swal.fire({
                                title:responde,
                                icon:"info",
                                showCloseButton:'true',
                                timer:10000,
                                timerProgressBar:true
                            })           
                            }
                            
                        });

                        
                    }
        })()
     
     
     }

function EliminarReplica(dato){
    (async ()=>{
        const {value: confirm} = await Swal.fire({
            template: '#my-template'
        })
    
        if(confirm){
           var parametro = {"EliCom": dato};
       
               $.ajax({
                   data:parametro,
                   url:"EliminarReplica.php",
                   type:"POST",
                           
                           success: function(responde){
                           Comentarios(); 
                           MVC(); 
                           Swal.fire({
                               title:responde,
                               icon:"info",
                               showCloseButton:'true',
                               timer:10000,
                               timerProgressBar:true
                           })           
                           }
                           
                       });

                       
                   }
       })()
    
}
    
    
function BorrarModelo(dato){
  
    (async()=>{
        const {value: confirm}= await Swal.fire({
             template: '#my-template',
        })

        if(confirm){
          
            var parametro = {"Elimol": dato,"confirmar":true};
             
               $.ajax({
                   data:parametro,
                   url:"EliminarModelo.php",
                   type:"POST",
                           
                           success: function(responde){ 
                           Swal.fire({
                               title:responde,
                               icon:"info",
                               showCloseButton:'true',
                               timer:10000,
                               timerProgressBar:true                               
                           })           
                            window.serTimeout(window.location.href="AlmacenModelos.php",100000);
                           }
                           
                       });

              
        }

    })()
}



    
        
