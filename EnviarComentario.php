<?php


  if(isset($_POST['comentario'])){
    require('Validar.php');
   $comentario = trim(filter_var($_POST['comentario'],FILTER_SANITIZE_STRING));
   if(!empty($comentario)){
       if(strlen($comentario)>=400){
         echo "Error! numero de caracteres exedido, maximo 400 caracteres";
       }else{
        if(!empty(EnviarComentario($_POST['comentario'],$_POST['modelo'],$_POST['user']))){
          echo "Comentario Guardado!";
        }
       }
   }else{
     echo "Error, Comentario vacio!";
   }
  }else{
    header('location:index.php');
  }
?>