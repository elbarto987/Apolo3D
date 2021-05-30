<?php


  if(isset($_POST['comentario'])){
    require('Validar.php');
   $comentario = trim(filter_var($_POST['comentario'],FILTER_SANITIZE_STRING));
   if(!empty($comentario)){
       if(strlen($comentario)>=401){
        echo "Error! numero de caracteres exedido, maximo 400 caracteres";
       }else{
        if(empty(EnviarReplica($_POST['comentario'],$_POST['idcomentario'],$_POST['user']))){
          echo "Respuesta exitosa!";
        }
       }
   }else{
        echo "Error, Comentario vacio!";
   }
  }elseif($_POST['model']){
    require('Validar.php');
    if(empty(like($_POST['user'],$_POST['model']))){
       Dlike($_POST['user'],$_POST['model'],true);
        
    }else{
        Dlike($_POST['user'],$_POST['model'],false);
    }

  }else{
       header('location:index.php');
  }
?>