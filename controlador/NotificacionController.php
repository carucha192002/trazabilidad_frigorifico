<?php
include_once'../modelo/config.php';
include_once '../modelo/Notificacion.php';
$notificacion = new Notificacion();
session_start();
$tipo=$_SESSION['us_tipo'];
 if($_POST['funcion']=='read_notificaciones'){
     if(!empty($_SESSION['usuario'])){
        if($tipo==3){
            $notificacion->read_root();
            $json=array();
            foreach ($notificacion->objetos as $objeto) {
                $json[]=array(
                    'titulo'=>$objeto->usuario.' '.'ha realizado una pregunta sobre la tropa N°'.$objeto->tropas,
                    'contenido'=>$objeto->contenido,
                    'imagen'=>$objeto->imagen,
                    'url_1'=>$objeto->tropas,
                    'fecha_creacion'=>$objeto->fecha_creacion,
                    'tropas'=>$objeto->tropas,
                    'ingresos'=>openssl_encrypt($objeto->ingresos,CODE,KEY),
                  
                );
    
            }
            $jsonstring=json_encode($json);
            echo $jsonstring;
        } else if($tipo==4){
            $id_usuario=$_SESSION['usuario'];
            $notificacion->read($id_usuario);
            $json=array();
            foreach ($notificacion->objetos as $objeto) {
                $json[]=array(
                    'titulo'=>$objeto->asunto,
                    'contenido'=>$objeto->contenido,
                    'imagen'=>'matarife/'.$objeto->imagen,
                    'url_1'=>$objeto->url_1,
                    'fecha_creacion'=>$objeto->fecha_creacion,
                    'tropas'=>$objeto->titulo,
                    'ingresos'=>openssl_encrypt($objeto->id,CODE,KEY),
                  
                );
    
            }
            $jsonstring=json_encode($json);
            echo $jsonstring;
        }
   
     }else{
         echo 'error, el usuario no esta en sesion';
     }
  
 }
 if($_POST['funcion']=='read_all_notificaciones'){
    if(!empty($_SESSION['usuario'])){
        if($tipo==3){
       $notificacion->read_all_notificaciones();
       $json=array();
       foreach ($notificacion->objetos as $objeto) {
           $json[]=array(
            'id'=>openssl_encrypt($objeto->id,CODE,KEY),
               'titulo'=>$objeto->titulo,
               'asunto'=>$objeto->asunto,
               'contenido'=>$objeto->contenido,
               'imagen'=>$objeto->imagen,
               'url_1'=>$objeto->url_1,
               'fecha_creacion'=>$objeto->fecha_creacion,
               'estado_abierto'=>$objeto->estado_abierto,
           );

       }
       $jsonstring=json_encode($json);
       echo $jsonstring;
    } else if($tipo==4){
        $id_usuario=$_SESSION['usuario'];
        $notificacion->read_all_notificaciones_usuario($id_usuario);
       $json=array();
       foreach ($notificacion->objetos as $objeto) {
           $json[]=array(
            'id'=>openssl_encrypt($objeto->id,CODE,KEY),
               'titulo'=>$objeto->titulo,
               'asunto'=>$objeto->asunto,
               'contenido'=>$objeto->contenido,
               'imagen'=>$objeto->imagen,
               'url_1'=>$objeto->url_1,
               'fecha_creacion'=>$objeto->fecha_creacion,
               'estado_abierto'=>$objeto->estado_abierto,
           );

       }
       $jsonstring=json_encode($json);
       echo $jsonstring;
    }
    }else{
        echo 'error, el usuario no esta en sesion';
    }
 
}
  
 
