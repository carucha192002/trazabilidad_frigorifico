<?php
include_once '../modelo/Notificacion.php';
include_once '../modelo/pregunta.php';
include_once '../modelo/respuesta.php';
include_once '../modelo/Usuario.php';
include_once '../modelo/config.php';
$pregunta = new Pregunta();
$respuesta = new Respuesta();
$usuario = new Usuario();
$notificacion = new Notificacion();

session_start();

 if($_POST['funcion']=='verificar_producto'){
     $id_ingresos=$_POST['id_ingresos'];
       if(is_numeric($id_ingresos)){
            $bandera='';
            $id_usuario=$_SESSION['usuario'];
            $tipo=$_SESSION['us_tipo'];
            $avatar=$_SESSION['avatar'];
            $id_usuario_sesion=0;
            $usuario_sesion='';
            $avatar_sesion='';
            if(!empty($_SESSION['us_tipo'])){
                $id_usuario_sesion=1;
                $usuario_sesion=$_SESSION['usuario'];
                $avatar_sesion=$avatar;
            }
            if($id_usuario_sesion==1){
                if($_SESSION['us_tipo']==3){
                    $bandera='1';
                }else{
                    $bandera='2';
                }
            }else{
                $bandera='0';
            }
          $pregunta->read($id_ingresos);
          $preguntas=array();
          foreach ($pregunta->objetos as $objeto) {
            $respuesta->read($objeto->id);
            $rpst=array();
            if(!empty($respuesta)){
                foreach($respuesta->objetos as $objeto1){
                    $rpst=array(
                        'id'=>$objeto1->id,
                        'contenido'=>$objeto1->contenido,
                        'fecha_creacion'=>$objeto1->fecha_creacion,     
                        'nombre_usuario'=>$objeto1->usuario, 
                        'avatar_usuario'=>$objeto1->avatar_usuario,               
                    );
            }
        }
              $preguntas[]=array(
                  'id'=>$objeto->id,
                  'contenido'=>$objeto->contenido,
                  'fecha_creacion'=>$objeto->fecha_creacion,
                  'estado_respuesta'=>$objeto->estado_respuesta,
                  'username'=>$objeto->usuario,
                  'avatar'=>$objeto->avatar,
                  'respuesta'=>$rpst,
              );

          }
           $json=array(
               'id'=>$id_ingresos,
               'bandera'=>$bandera,
               'usuario_sesion'=>$usuario_sesion,
               'avatar_sesion'=>$avatar_sesion,
               'avatar'=>$avatar,
               'preguntas'=>$preguntas,
    
           );
        
            $jsonstring=json_encode($json);
            echo $jsonstring;
        }else{
            echo 'error';
        }
        
 }
 if($_POST['funcion']=='realizar_pregunta'){
    if(!empty($_SESSION['usuario'])){
       $pgt=$_POST['pregunta'];
       $id_ingresos=$_POST['id_ingresos'];
       $id_usuario=$_SESSION['usuario'];
       $pregunta->create($pgt,$id_ingresos,$id_usuario);

       $respuesta->llenar_productos1($id_ingresos);
       $titulo=$respuesta->objetos[0]->tropas;
       $imagen=$respuesta->objetos[0]->imagen;
       $asunto='Alguien realizo una pregunta en la tropa '.$titulo;
       $url='vista/descripcion.php?name='.$titulo.'&&id='.$id_ingresos;
       $notificacion->create($titulo,$asunto,$pgt,$imagen,$url,$id_usuario);
       $json=array(
           'mensaje1'=>'pregunta creada',
           'mensaje2'=>'notificacion creada',
       );
       $jsonstring=json_encode($json);
       echo $jsonstring;
    }else{
        echo 'error, el usuario no esta en sesion';
    }
 
}

if($_POST['funcion']=='productor_root'){
    $id_usuario=$_SESSION['usuario'];
    $pregunta->productor_root();
    $respuesta->productor_tropas($id_usuario);
    $tropas=array();
    foreach ($respuesta->objetos as $objeto) {
        $tropas=array(
            'numtropas'=>$objeto->numtropas,
        );
     }
    foreach ($pregunta->objetos as $objeto) {
        $json[]=array(
            'nombre'=>$objeto->nombre,
            'id'=>$objeto->id_usuario,
            'avatar'=>'../img/'.$objeto->avatar,
            'tropas'=>$tropas,
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='tropas_rellenar'){
    $id_usuario=$_SESSION['matarife'];
    $respuesta->tropas_rellenar($id_usuario);
    $json=array();
    foreach ($respuesta->objetos as $objeto) {
        $json[]=array(
            'tropa'=>$objeto->tropa,
            'fecha'=>$objeto->fecha,
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

