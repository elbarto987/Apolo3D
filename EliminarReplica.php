<?php

if(isset($_POST['EliCom'])){
   require('Validar.php'); 
    if(empty(EliminarReplica($_POST['EliCom']))){
       echo "Eliminado Correctamente";
    }else{
        echo "Error!, Algo ocurrio por favor intente de nuevo";
    }
}else{
    header('location:index.php');
}




?>