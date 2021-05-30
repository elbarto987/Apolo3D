<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


if(session_status() == PHP_SESSION_NONE){
    session_start();
}

function conexion($usuario,$contra){
         
    try {
        $con= new PDO('mysql:host=localhost;dbname=plataforma',$usuario,$contra);
        return $con;
        
    } catch (PODExeption $e) {
        return $e->getMessage();
    }
   
}
function enviarDatosRegistro($datos){
        
        $con=conexion("root","");
        
        $consulta = $con->prepare('INSERT INTO usuario (usuario_id, usuario_nombre,usuario_email, usuario_rutafoto, usuario_user, usuario_pass)
                                    VALUES (null,:nombre,:email,:foto,:user,:pass)');
        $consulta->execute(array(
            ':nombre'=>"",
            ':email'=>$datos[0],
            ':foto'=>"",
            ':user'=>$datos[1],
            ':pass'=>$datos[2]
        ));

        
     }



function ActualizarDatos($datos){
            
    
        $con=conexion("root","");
       
        if(!empty($datos[1])){
        $consulta = $con->prepare('UPDATE `plataforma`.`usuario` SET `usuario_pass` = :pass WHERE `usuario`.`usuario_user` = :user;');
        $consulta->execute(array(':pass'=>$datos[1],':user'=>$datos[3]));
        }
        
        if(!empty($datos[2])){
        $consulta = $con->prepare(' UPDATE `plataforma`.`usuario` SET `usuario_nombre` = :nombre WHERE `usuario`.`usuario_user` = :user;');
        $consulta->execute(array(':nombre'=>$datos[2],':user'=>$datos[3]));
        }

        if(!empty($datos[4])){ 
            $consulta = $con->prepare(' UPDATE `plataforma`.`usuario` SET `usuario_descripcion` = :descripcion WHERE `usuario`.`usuario_user` = :user;');
            $consulta->execute(array(':descripcion'=>$datos[4],':user'=>$datos[3]));
            }
        
        
     }





function Datos($dato){
    $con=conexion("root","");
    $consulta = $con->prepare("SELECT * FROM usuario WHERE usuario_email = :usuario");
    $consulta->execute(array(':usuario'=>$dato));   
    $resultado = $consulta->fetchALL();
    return $resultado;
}
function verificar_registro($pos,$dato){
    
    if($pos==0){
        $con=conexion("root","");
        $consulta = $con->prepare("SELECT * FROM usuario WHERE usuario_email = :usuario");
        $consulta->execute(array(':usuario'=>$dato));   
        $resultado = $consulta->fetchALL();
        return $resultado;
    }else{
        $con=conexion("root","");
        $consulta = $con->prepare("SELECT * FROM usuario WHERE usuario_user = :usuario");
        $consulta->execute(array(':usuario'=>$dato,));   
        $resultado = $consulta->fetchALL();
        return $resultado;
    }
}
function ValidarPass($datos){
        $var1 = false;
        $var2 = false;
        $var3 = false;
        $var4 = false;
        $num=strlen($datos);
    for ($i = 0; $i < $num; $i++) {
        
      
        if (ord($datos[$i]) >= 48 && ord($datos[$i]) <= 57) {
            $var1 = true;
        }

        if (ord($datos[$i]) >= 65 && ord($datos[$i]) <= 90) {
            $var2 = true;
        }

        if ((ord($datos[$i]) >= 33 && ord($datos[$i]) <= 47) || (ord($datos[$i]) >= 58 && ord($datos[$i]) <= 64) || (ord($datos[$i]) >= 91 && ord($datos[$i]) <= 96) || (ord($datos[$i]) >= 124 && ord($datos[$i]) <= 224)) {
            $var3 = true;
        }
    }

    if (strlen($datos) >= 10) {
        $var4 = true;
    }

    if ($var1 && $var2 && $var3 && $var4) {
         return true;
    } else {
              
        return false;
    }

}
function usuario_session($datos){
  
        $con=conexion("root","");
        $consulta = $con->prepare("SELECT * FROM `usuario` WHERE usuario_user = :usuario AND usuario_pass = :pass  OR usuario_email = :usuario AND usuario_pass = :pass");
        $consulta->execute(array(
            ':usuario'=>$datos[0],
            ':pass'=>$datos[1]
        )); 

        $resultado = $consulta->fetchALL();  

        
        return $resultado; 
        
}
function EnviarCodigo($datos,$e){

    $start_session = session_status();
    
    if($start_session == PHP_SESSION_NONE){
        session_start();
        
    }

   if($_SESSION['contador']==0){
             $_SESSION['codigo'] = mt_rand(10000000,99999999);
             
         }
     
         if($e==1){
            $registro = '<h1 style="text-align: center; font-size:20px;">APOLO 3D</h1><p style="width: 80%; margin:auto; padding:50px; background-color:#13849641; border-radius:5px;  text-align: center; font-size:20px;">Gracias por haberte registrado en nuestra pagina, para acabar con el registro digita el codigo <b>'.$_SESSION['codigo'].'</b> en la misma pagina donde te registraste</p>';
            }else{
            $registro = '<h1 style="text-align: center; font-size:20px;">APOLO 3D</h1><p style="width: 80%; margin:auto; padding:50px; background-color:#13849641; border-radius:5px;  text-align: center; font-size:20px;">Codigo de recuperacion de contraseña, si usted no solicito la recuperacion de contraseña de su cuenta en la pagina <b>APOLO 3D</b> ingnore este mensaje. Digite el cogido <b>'.$_SESSION['codigo'].'</b> y acontinuacion podra cambiar su contraseña</p>';
            }
    $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'miguelsuarez@unisangil.edu.co';                     // SMTP username
    $mail->Password   = 'elidiomadelosdioses';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('miguelsuarez@unisangil.edu.co', 'Mailer');
    $mail->addAddress($datos[0],$datos[1]);     // Add a recipient
    
        

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Apolo 3D';
    $mail->Body    = $registro;
    $mail -> addAttachment ( 'imagenes/3D.gif' );
    
    $mail->send();
   // echo 'Message has been sent';
} catch (Exception $e) {
    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}
function Codigo($datos){
    
  if($datos == $_SESSION['codigo']){
        $_SESSION['codigo']=0;
        return true;
    }else{
        
        return false;
    }
}
function usuario_recuperacion($datos){

    $con=conexion("root","");
    $consulta = $con->prepare("SELECT usuario_email, usuario_user FROM `usuario` WHERE usuario_user = :usuario  OR usuario_email = :usuario");
    $consulta->execute(array(
        ':usuario'=>$datos
    )); 

    $resultado = $consulta->fetchALL();  

    
    return $resultado; 
    
}
function Cambiarpass($datos){

    $con=conexion("root","");
    $consulta = $con->prepare("UPDATE usuario SET usuario_pass = :pass WHERE usuario.usuario_email =:user");
    $consulta ->execute(array(
        ':pass'=>$datos[1],
        ':user'=>$datos[0]
    ));

}
function enviarFoto($resultado,$user){

    $con=conexion("root","");
    $consulta = $con->prepare("UPDATE usuario SET  usuario_rutafoto = :ruta WHERE usuario.usuario_user=:us");
    $consulta ->execute(array(
        ':ruta'=> $resultado,
        ':us'=>$user      
    ));
  

}
function FotosPerfil($id){
     $array = array();
    $path = "Img_Perfil/".$id;
		if(file_exists($path)){
			$directorio = opendir($path);
			while($archivo = readdir($directorio)){
            
                $array[] .="Img_Perfil/".$id."/".$archivo;
            }

            return $array;
		}
}
function UsuarioDisponible($dato){

    do{
        $tem = $dato;
        $tem .="_".mt_rand(100,999);
    }while(!empty(verificar_registro(1,$tem)));
    
    return $tem;

}
 function EliminarFoto($dato){
    if(file_exists($dato)){
       unlink($dato);
    } 
    
 }                       
function eliminarDir($carpeta){
    foreach(glob($carpeta . "/*") as $archivo_carpeta){
        if(is_dir($archivo_carpeta)){
            eliminarDir($archivo_carpeta);
        }else{
            unlink($archivo_carpeta);
        }
    }
    rmdir($carpeta);
}
function EnviarModelo($nombre,$descripcion,$resultadomodelo,$resultadoFoto,$user){
    
    $con=conexion("root","");
        
    $consulta = $con->prepare('INSERT INTO modelo3d (modelo_nombre, modelo_descripcion,modelo_ruta, modelo_ruta_foto, usuario_usuario_id)
                                VALUES (:nombre,:descripcion,:modelo,:foto,:user)');
    $consulta->execute(array(
        ':nombre'=>$nombre,
        ':descripcion'=>$descripcion,
        ':modelo'=>$resultadomodelo,
        ':foto'=>$resultadoFoto,
        ':user'=>$user
    ));

}
function EditarModelo($nombre,$descripcion,$resultadoFoto,$user){
   
    $con=conexion("root","");
    
   if(!empty($nombre)){ 
    $consulta = $con->prepare("UPDATE `modelo3d` SET `modelo_nombre` = '$nombre'
    WHERE `modelo3d`.`modelo_id` = $user;");
    $consulta->execute(); 
   }
   if(!empty($descripcion)){
    $consulta = $con->prepare("UPDATE `modelo3d` SET `modelo_descripcion` = '$descripcion'
    WHERE `modelo3d`.`modelo_id` = $user;");
    $consulta->execute(); 
   }
   if(!empty($resultadoFoto)){
    $consulta = $con->prepare("UPDATE `modelo3d` SET  `modelo_ruta_foto` = '$resultadoFoto'
    WHERE `modelo3d`.`modelo_id` = $user;");
    $consulta->execute(); 
   }
  
}
function DatosIndex(){
    $con = conexion("root","");
    $consulta = $con->prepare("SELECT * FROM modelo3d ");
    $consulta->execute();   
    $resultado = $consulta->fetchALL();
    return $resultado;
    
}
function DatosUsers($dato){
    $con = conexion("root","");
    $consulta = $con->prepare("SELECT usuario_user,usuario_rutafoto,usuario_id FROM usuario where usuario_id=$dato");
    $consulta->execute();   
    $resultado = $consulta->fetchALL();
    return $resultado;
}
function Mismodelos($datos){
    $con = conexion("root","");
    $consulta = $con->prepare("SELECT *FROM modelo3d where usuario_usuario_id=$datos");
    $consulta->execute();   
    $resultado = $consulta->fetchALL();
    return $resultado;
}
function NombreModelo($datos){
    $con = conexion("root","");
    $consulta = $con->prepare("SELECT modelo_nombre FROM modelo3d where modelo_nombre='$datos'");
    $consulta->execute();   
    $resultado = $consulta->fetchALL();
    return $resultado;
}
function NombreModelocon($dato,$dato2){
    $con = conexion("root","");
    $consulta = $con->prepare("SELECT modelo_nombre FROM modelo3d where modelo_nombre='$dato' and modelo_id != $dato2");
    $consulta->execute();   
    $resultado = $consulta->fetchALL();
    return $resultado;
}
function DatosModelo($dato){
    $con = conexion("root","");
    $consulta = $con->prepare("SELECT * FROM modelo3d where modelo_id='$dato'");
    $consulta->execute();   
    $resultado = $consulta->fetchALL();
    return $resultado;
}
function Numero($tabla,$dato){
    $con = conexion("root","");
    $consulta = $con->prepare("SELECT count(*) FROM $tabla where modelo_modelo_id='$dato'");
    $consulta->execute();   
    $resultado = $consulta->fetchALL();
    return $resultado;
}
function Comentarios($dato){
    $con = conexion("root","");
    $consulta = $con->prepare("SELECT * FROM comentario where modelo_modelo_id='$dato' ORDER BY comentario_id DESC");
    $consulta->execute();   
    $resultado = $consulta->fetchALL();
    return $resultado;
}
function EnviarComentario($comentario,$modelo,$user){
    $con=conexion("root","");
        
    $consulta = $con->prepare("INSERT INTO comentario (comentario_id, comentario, comentario_usuario, comentario_fecha, modelo_modelo_id) 
                               VALUES (NULL, '$comentario', '$user', current_timestamp(), '$modelo');");
    $consulta->execute();

    return $consulta;
}
function EditarComentario($comentario,$id){
    $con=conexion("root","");
        
    $consulta = $con->prepare("UPDATE `comentario` SET `comentario` = '$comentario' 
                                WHERE `comentario`.`comentario_id` = $id;");
    $consulta->execute();

    return $consulta;
}
function EditarReplica($comentario,$id){
   $con=conexion("root","");
        
    $consulta = $con->prepare(" UPDATE `replicacomentario` SET `comentario` = '$comentario' 
                                WHERE `replicacomentario`.`Replicacomentario_id` = $id;
    ");
    $consulta->execute();

    return $consulta;
}
function Replicas($dato){
    $con = conexion("root","");
    $consulta = $con->prepare("SELECT * FROM replicacomentario where replica_comentario_id='$dato'");
    $consulta->execute();   
    $resultado = $consulta->fetchALL();
    return $resultado;
}
function EnviarReplica($comentario,$idcomentario,$user){
    $con = conexion("root","");
    $consulta = $con->prepare("INSERT INTO replicacomentario (Replicacomentario_id, comentario, comentario_usuario, comentario_fecha, replica_comentario_id) 
                               VALUES (NULL, '$comentario', '$user', current_timestamp(), '$idcomentario');");
    $consulta->execute();   
    $resultado = $consulta->fetchALL();
    return $resultado;
}
function Vista($user,$model){
    $con = conexion("root","");
    $consulta = $con->prepare("SELECT * FROM view where view_usuario = $user and modelo_modelo_id=$model");
    $consulta ->execute();
    $resultado = $consulta->fetchALL(); 
    if(empty($resultado[0][0])){
        $in=$con ->prepare("INSERT INTO view (view_id, view_usuario, view_fecha, modelo_modelo_id) 
                            VALUES (NULL, '$user', current_timestamp(), '$model');");
        $in->execute(); 
    }
    
}
function like($user,$model){
    $con = conexion("root","");
    $consulta = $con->prepare("SELECT * FROM megusta where megusta_usuario = $user and modelo_modelo_id=$model");
    $consulta ->execute();
    $resultado = $consulta->fetchALL();
    return $resultado;
}
function Dlike($user,$model,$op){
    $con = conexion("root","");
    if($op==true){
      $consul = $con->prepare("INSERT INTO megusta (megusta_id, megusta_usuario, megusta_fecha, modelo_modelo_id) 
                               VALUES (NULL, '$user', current_timestamp(), '$model');");
    $consul->execute();
   
    }else{
      $consul = $con->prepare("DELETE from megusta where megusta_usuario=$user and modelo_modelo_id=$model;");
      $consul->execute();
    }
}
function Fecha($dato){
    $fecha="";
    for($i=0;$i<11;$i++){
        $fecha.=$dato[$i];
    }

    return $fecha;
}
function EliminarComentario($dato){
    $con = conexion("root","");
    $consulta = $con->prepare("DELETE FROM `replicacomentario` WHERE `replicacomentario`.`replica_comentario_id` = $dato");
    $consulta ->execute();
    
    $con = conexion("root","");
    $consulta = $con->prepare("DELETE FROM `comentario` WHERE `comentario`.`comentario_id` = $dato");
    $consulta ->execute();
    $resultado =$consulta->fetchALL();
    return $resultado;

}
function EliminarReplica($dato){
    $con = conexion("root","");
    $consulta = $con->prepare("DELETE FROM `replicacomentario` WHERE `replicacomentario`.`Replicacomentario_id` = $dato");
    $consulta ->execute();
    $resultado =$consulta->fetchALL();
    return $resultado;
}
function Eliminarmodelo($elimol){
    $con = conexion("root","");
    
    $consulta = $con->prepare("DELETE FROM `view` WHERE modelo_modelo_id = $elimol");
    $consulta ->execute();
    
   $consulta = $con->prepare("DELETE FROM `megusta` WHERE modelo_modelo_id = $elimol");
    $consulta ->execute();

    $consulta = $con->prepare("SELECT comentario_id FROM comentario WHERE modelo_modelo_id=$elimol");
    $consulta ->execute();
    $resultado=$consulta->fetchALL();
    for($i=0;$i<sizeof($resultado);$i++){
        $tem=$resultado[$i][0];
        EliminarComentario($tem);
    }

    $consulta = $con->prepare("SELECT modelo_ruta FROM modelo3d WHERE modelo_id=$elimol");
    $consulta ->execute();
    $resultado=$consulta->fetchALL();

    EliminarFoto($resultado[0][0]);

    $consulta = $con->prepare("SELECT modelo_ruta_foto FROM modelo3d WHERE modelo_id=$elimol");
    $consulta ->execute();
    $resultado=$consulta->fetchALL();

    EliminarFoto($resultado[0][0]);

    $consulta = $con->prepare("DELETE FROM `modelo3d` WHERE modelo_id = $elimol");
    $consulta ->execute();
    $resultado=$consulta->fetchALL();

    return ;
   
    
}
function DatosPerfil($dato){
    $con=conexion("root","");
    $consulta = $con->prepare("SELECT * FROM `usuario` WHERE usuario_id = $dato");
    $consulta->execute(); 
    $resultado = $consulta->fetchALL();  
    return $resultado; 
}
function ModelosPerfil($dato){
    $con = conexion("root","");
    $consulta = $con->prepare("SELECT * FROM modelo3d WHERE usuario_usuario_id=$dato;");
    $consulta->execute();   
    $resultado = $consulta->fetchALL();
    return $resultado;
}
function Likes($dato){
    $con = conexion("root","");
    $re=0;
    for($i=0;$i<sizeof($dato);$i++){
        $tem =$dato[$i][0];
    $consulta = $con->prepare("SELECT * FROM megusta WHERE modelo_modelo_id=$tem ;");
    $consulta->execute();   
    $resultado= $consulta->fetchALL();
    $re += sizeof($resultado);
    }
    return $re;
}
function view($dato){
    $con = conexion("root","");
    $re=0;
    for($i=0;$i<sizeof($dato);$i++){
        $tem =$dato[$i][0];
        $consulta = $con->prepare("SELECT * FROM view WHERE modelo_modelo_id=$tem;");
        $consulta->execute();   
        $resultado = $consulta->fetchALL();
        $re += sizeof($resultado);
        }
        return $re;
}
function comPerfil($dato){
    $con = conexion("root","");
    $re=0;
    for($i=0;$i<sizeof($dato);$i++){
        $tem =$dato[$i][0];
        $consulta = $con->prepare("SELECT * FROM comentario WHERE modelo_modelo_id=$tem;");
        $consulta->execute();   
        $resultado = $consulta->fetchALL();
        $re += sizeof($resultado);
        }
        return $re;
}
function Extencion($dato){
    $i=strlen($dato)-1;
    $tem="";
    while($dato[$i] != '.'){
        $tem =$dato[$i].$tem;
        $i--;
    }

    if($tem == "3mf"){
        $tem = 0;
    }elseif($tem == "stl"){
        $tem = 1;
    }elseif($tem == "obj"){
        $tem = 2;
    }
    return $tem;
}

function ExtencionM($dato){
    $i=strlen($dato)-1;
    $tem="";
    while($dato[$i] != '.'){
        $tem =$dato[$i].$tem;
        $i--;
    }
    return $tem;
}
?>


