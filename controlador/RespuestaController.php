<?php
include_once '../modelo/config.php';
include_once '../modelo/respuesta.php';
include_once '../modelo/pregunta.php';
include_once '../modelo/Notificacion.php';
$respuesta = new Respuesta();
$pregunta = new Pregunta();
$notificacion = new Notificacion();
session_start();


if($_POST['funcion']=='realizar_respuesta'){
    $id_usuario = $_SESSION['usuario'];
    if(!empty($_SESSION['usuario'])){
       $resp=$_POST['respuesta'];
       $id_ingresos=$_POST['id_ingresos'];
       $id_pregunta=$_POST['id_pregunta'];
       $respuesta_usuario=$_SESSION['nombre_usuario'];
       $formateado=str_replace(" ","+",$_SESSION['product-verification']);
       $id_ingresos_format=openssl_decrypt($formateado,CODE,KEY);
       $respuesta->llenar_productos($id_pregunta);
       $titulo=$respuesta->objetos[0]->tropa;
       $imagen=$respuesta->objetos[0]->imagen;
       $asunto='El usuario root te respondio';
       $url='vista/adm_notificaciones.php?name='.$titulo.'&&id='.$formateado;
      $respuesta->create($resp,$id_pregunta,$respuesta_usuario);
       $pregunta->read_propietario_pregunta($id_pregunta);
       $id_propietario_pregunta=$pregunta->objetos[0]->id;
      $notificacion->create($titulo,$asunto,$resp,$imagen,$url,$id_propietario_pregunta);
       $json=array(
          'mensaje1'=>'respuesta creada',
           'mensaje2'=>'notificacion creada'
       );
       $jsonstring=json_encode($json);
       echo $jsonstring;
    }else{
        echo 'error, el usuario no esta en sesion';
    }
 
}
if($_POST['funcion']=='realizar_respuesta_ver'){
    $id_usuario = $_SESSION['usuario'];
    if(!empty($_SESSION['usuario'])){
       $resp=$_POST['respuesta'];
       $id_ingresos=$_POST['id_ingresos'];
       $id_pregunta=$_POST['id_pregunta'];
       $respuesta_usuario=$_SESSION['nombre_usuario'];
       $id_ingresos_format=openssl_encrypt($id_ingresos,CODE,KEY);
       $respuesta->llenar_productos($id_pregunta);
       $titulo=$respuesta->objetos[0]->tropa;
       $imagen=$respuesta->objetos[0]->imagen;
       $asunto='El usuario root te respondio';
       $url='vista/adm_notificaciones.php?name='.$titulo.'&&id='.$id_ingresos_format;
        $respuesta->create($resp,$id_pregunta,$respuesta_usuario);
       $pregunta->read_propietario_pregunta($id_pregunta);
       $id_propietario_pregunta=$pregunta->objetos[0]->id;
      $notificacion->create($titulo,$asunto,$resp,$imagen,$url,$id_propietario_pregunta);
       $json=array(
          'mensaje1'=>'respuesta creada',
           'mensaje2'=>'notificacion creada'
       );
       $jsonstring=json_encode($json);
       echo $jsonstring;
    }else{
        echo 'error, el usuario no esta en sesion';
    }
 
}
    
?>