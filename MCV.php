<?php

require('Validar.php');

if(!empty(like($_SESSION['user'][0][0],$_SESSION['Modelo'][0][0])))
$like = 'imagenes/like.png'; 
else 
$like = 'imagenes/likeBlack.png';
    
  echo "
    <div class=\"item Megusta\" onClick=\"javascript:like('";echo $_SESSION['user'][0][0]; echo"','";echo $_SESSION['Modelo'][0][0]; echo"');\">";
         $numero =Numero('megusta',$_SESSION['Modelo'][0][0]);
         echo "<img src="; echo $like." alt=''><i>";echo $numero[0][0]; echo"</i>
    </div>
    <div class=\"item\">";
           $numero =Numero('comentario',$_SESSION['Modelo'][0][0]);
         echo "<img src='imagenes/speech-bubble.png' alt=''><i>";echo $numero[0][0]; echo "</i>
    </div>
    <div class=\"item\">";
        $numero =Numero('view',$_SESSION['Modelo'][0][0]);
        echo "<img src='imagenes/visibility.png' alt=''><i>";echo $numero[0][0]; echo"</i>
    </div>";
 

?>