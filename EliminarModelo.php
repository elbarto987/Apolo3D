<?php 


if(!isset($_POST['confirmar'])){
    header('location:index.php');
}else{
    require('Validar.php');
      $tem =Eliminarmodelo($_POST['Elimol']);
    if(empty($tem)){
        echo "Borrado Correctamente!";
    }else{
       echo "Error!, no se pudo eliminar";
    }
}

?>