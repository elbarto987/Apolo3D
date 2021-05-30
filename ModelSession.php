<?php 

$star_session =session_status();
if($star_session==PHP_SESSION_NONE){
    session_start();
}




require('Validar.php');


$_SESSION['Comentarios']=Comentarios($_SESSION['Modelo'][0][0]);




for($i=0;$i<sizeof($_SESSION['Comentarios']);$i++){ 
    
    $l="g".$i; $s="h".$i; $j="i".$i; $k="j".$i; $t="k".$i; $com ='rep'.$i; $edi="m".$i;
    echo " 
       <div class=\"comentarios\">
        
        <div class=\"E\">
            <div class=\"UC\">
                    <a href=\"\">";
                         $foto = DatosUsers($_SESSION['Comentarios'][$i][2]);
                        echo "
                        <img class=\"user__imgModelo\" src=\"";if(!empty($foto)) echo $foto[0][1]; else echo "imagenes/user.png"; echo "\" alt=\"\">
                        <i>"; echo $foto[0][0]."</i>";
                   echo" </a> 
                   <p class=\"Fecha\">"; echo Fecha($_SESSION['Comentarios'][$i][3]); echo"</p>";
                  
                   if($_SESSION['user'][0][0] == $_SESSION['Comentarios'][$i][2]){ 
                   echo" <div class=\"user MenuMensaje\">
                        <div class=\"user__info\" data-toggle=\"dropdown\">";
                        echo" <img src=\"imagenes/menu.png\">";
                           
                       echo " </div>

                        <div class=\"dropdown-menu\">
                            <a class=\"dropdown-item nada\" href=\"javascript:BorrarComentario('"; echo $_SESSION['Comentarios'][$i][0]; echo"')\">Eliminar</a>
                            <a class=\"dropdown-item nada\" href=\"javascript:Editar('";echo $edi; echo"');\">Editar</a>
                         </div>
                    </div>";
                   }
             echo "</div>";
               
                    echo "<div class=\"ReplicaComentario\" id='";echo $edi."'>
                    <img class=\"user__img\" src=\"";if(!empty($_SESSION['user'][0][3])) echo $_SESSION['user'][0][3]; else echo 'imagenes/user.png';echo'">';
                    echo "<form >
                        <input style='width:240%;' type=\"text\" name=\"comentario\" value=\""; echo  $_SESSION['Comentarios'][$i][1]; echo"\" id='";echo $com."'>
                        <div class=\"botones\">
                           <input type=\"botton\" class=\"BtnComentario\" value=\"Editar\" onClick=\"javascript:EditarComentario($(";echo $com.").val(),"; echo $_SESSION['Comentarios'][$i][0].")\" readonly=»readonly»>
                           <input type=\"botton\" class=\"BtnComentario\" value=\"Cancelar\" onClick=\"javascript:SalirReplica('"; echo $edi."','"; echo $s."')\" readonly=»readonly»>
                        </div>
                    </form>
                    
            </div>";
          

         echo "  <div class=\"Com\">
                <p>";echo $_SESSION['Comentarios'][$i][1]."</p>
            </div>";
              $replicas = Replicas($_SESSION['Comentarios'][$i][0]);
              echo "<div class=\"reply\"><p onClick=\"javascript:Replica('";echo $l."','"; echo $s."')\" id=\""; echo $s."\">Responder</p></div>
            <div class=\"ReplicaComentario\" id='";echo $l."'>
                    <img class=\"user__img\" src=\"";if(!empty($_SESSION['user'][0][3])) echo $_SESSION['user'][0][3]; else echo 'imagenes/user.png';echo'">';
                    echo "<form >
                        <input type=\"text\" name=\"comentario\" placeholder=\"Responder este comentario...\" id='";echo $com."'>
                        <div class=\"botones\">
                           <input type=\"botton\" class=\"BtnComentario\" value=\"Comentar\" onClick=\"javascript:EnviarReplica($(";echo $com.").val(),"; echo $_SESSION['Comentarios'][$i][0].",";echo $_SESSION['user'][0][0].")\" readonly=»readonly»>
                           <input type=\"botton\" class=\"BtnComentario\" value=\"Cancelar\" onClick=\"javascript:SalirReplica('"; echo $l."','"; echo $s."')\" readonly=»readonly»>
                        </div>
                    </form>
                    
            </div>";
            if(sizeof($replicas)>=1){  if(sizeof($replicas)<=1) $value="Ver Respuesta"; else $value="Ver ".sizeof($replicas)." Respuestas";
            echo "<div><input type=\"botton\" class=\"BotonAmpliar\"onClick=\"javascript:AmpliarReplica('";echo $t."','"; echo $j."','"; echo $value."')\" id=\"";echo $t."\" value=\"";echo $value."\" readonly=»readonly»></div>";
            }                          
           echo" </div>
            
            <div class=\"ReplicaCom\" id='";echo $j."'>";
            for($h=0;$h<sizeof($replicas);$h++){
                $ediR="ediR".$replicas[$h][0];
                $fo = DatosUsers($replicas[$h][2]);
               echo " <div class=\"UC\">
                        <a >
                                <img class=\"user__imgModelo\" src=\""; if(!empty($fo)) echo $fo[0][1]; else echo 'imagenes/user.png';echo "\">
                                <i>"; echo $fo[0][0]."</i>
                        </a>
                        <p class=\"Fecha\">"; echo Fecha($replicas[$h][3]); echo"</p>";
                       
                        if($_SESSION['user'][0][0] == $replicas[$h][2]){ 
                        echo" <div class=\"user MenuMensaje\">
                        <div class=\"user__info\" data-toggle=\"dropdown\">";
                        echo" <img src=\"imagenes/menu.png\">";
                           
                       echo " </div>

                        <div class=\"dropdown-menu\">
                            <a class=\"dropdown-item nada\" href=\"javascript:EliminarReplica(";echo $replicas[$h][0]; echo ")\">Eliminar</a>
                            <a class=\"dropdown-item nada\" href=\"javascript:Editar('";echo $ediR; echo"');\">Editar</a>
                         </div>
                    </div>";
                        }
                  echo"  </div>";

                  echo "<div class=\"ReplicaComentario\" id='";echo $ediR."'>
                    <img class=\"user__img\" src=\"";if(!empty($_SESSION['user'][0][3])) echo $_SESSION['user'][0][3]; else echo 'imagenes/user.png';echo'">';
                    echo "<form >
                        <input  style='width:240%;' type=\"text\" name=\"comentario\" value=\""; echo $replicas[$h][1]; echo"\" id='";echo $com."'>
                        <div class=\"botones\">
                           <input type=\"botton\" class=\"BtnComentario\" value=\"Editar\" onClick=\"javascript:EditarReplica($(";echo $com.").val(),"; echo $replicas[$h][0].")\" readonly=»readonly»>
                           <input type=\"botton\" class=\"BtnComentario\" value=\"Cancelar\" onClick=\"javascript:SalirReplica('"; echo $ediR."','"; echo $s."')\" readonly=»readonly»>
                        </div>
                    </form>
                    
                  </div>";

                echo "<div class=\"Com\">
                     <p>"; echo $replicas[$h][1]."</p>
                </div>";
            } 
           echo" </div>  
                                 
        </div>";
            
     }
echo "</div>";



?>