<?php
include '../modelo/camara.php';
include_once '../modelo/Historial.php';
$historial = new Historial();
$camara = new Camara();
if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre1'];
    $numero = $_POST['nombre'];
    $avatar='camara-default.jpg';
    $camara->crear($nombre,$avatar,$numero);
}
if($_POST['funcion']=='editar'){
    $nombre = $_POST['nombre1'];
    $id_editado=$_POST['id'];
    $numero = $_POST['nombre'];
    $camara->editar($nombre,$id_editado,$numero);
}
if($_POST['funcion']=='buscar'){
    $camara->buscar();
    $json=array();
    foreach ($camara->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_camara,
            'nombre'=>$objeto->nombre,
            'numero'=>$objeto->numero,
            'avatar'=>'../img/camara/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $camara->borrar($id);
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/camara/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $camara->cambiar_logo($id,$nombre);
        foreach ($camara->objetos as $objeto) {
            if($objeto->avatar!='camara-default.jpg'){
                unlink('../img/camara/'.$objeto->avatar);
            }            
        }
        $json= array();
        $json[]=array(
            'ruta'=>$ruta,
            'alert'=>'edit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
    else{
        $json= array();
        $json[]=array(
            'alert'=>'noedit'
        );
        $jsonstring = json_encode($json[0]);
        echo $jsonstring;
    }
}
if($_POST['funcion']=='rellenar_camaras'){
    $camara->rellenar_camaraes();
    $json=array();
    foreach ($camara->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_camara,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='buscarmov'){
    $camara->buscarmov();
    $json=array();
    foreach ($camara->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_faenados,
            'tropa'=>$objeto->tropa,
            'especie'=>$objeto->especie,
            'despiece'=>$objeto->despieces,
            'camara'=>$objeto->camara,
            'garron'=>$objeto->garron,
            'id_ingreso'=>$objeto->id_ingreso
            
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='movergarroncamara'){
    $datos= date_default_timezone_set('America/Argentina/Mendoza');
    $ano = date("Y");
    $fecha = date("d-m-Y");
    $tropa = $_POST['tropa'];
    $garron = $_POST['garron'];
    $camaraorigen = $_POST['camaraorigen'];
    $camaradestino = $_POST['camaradestino'];
    $despiece = $_POST['despiece'];
    $especie = $_POST['especie'];
    $camara->movergarroncamara($ano,$fecha,$tropa,$garron,$camaraorigen,$camaradestino,$despiece,$especie);
}
if($_POST['funcion']=='movergarroncamara1'){
    $checked=json_decode($_POST['json']);
    $datos= date_default_timezone_set('America/Argentina/Mendoza');
    $ano = date("Y");
    $fecha = date("d-m-Y");
    $tropa = $_POST['tropa'];
   
    $camaraorigen = $_POST['camaraorigen'];
    $camaradestino = $_POST['camaradestino1'];
    $despiece = $_POST['despiece'];
    $especie = $_POST['especie'];
    $i = 1;
    foreach ($checked as $prod) {
        $cantidad = $prod->id; 
        $camara->movergarroncamara1($ano,$fecha,$tropa,$camaraorigen,$camaradestino,$despiece,$especie,$cantidad);
}
   
}
if($_POST['funcion']=='mover'){
    $datos= date_default_timezone_set('America/Argentina/Mendoza');
    $ano = date("Y");
    $fecha = date("d-m-Y");
    $tropa = $_POST['tropa'];
    $garron = $_POST['garron'];
    $camaraorigen = $_POST['camaraorigen'];
    $camaradestino = $_POST['camaradestino'];
    $despiece = $_POST['despiece'];
    $especie = $_POST['especie'];
    $id = $_POST['id'];
    $camara->mover($ano,$fecha,$tropa,$garron,$camaraorigen,$camaradestino,$despiece,$especie,$id);
}
if($_POST['funcion']=='modificarcamara'){
    $id = $_POST['id'];
    $camaradestino = $_POST['camaradestino1'];
    $garron = $_POST['garron'];
    $camara->datos($id);
    $camara_destino=$camara->objetos[0]->camara;
    $id_ingreso=$camara->objetos[0]->id_ingreso;
    $descripcion='se ha movido el garron: '.$garron.' desde la camara: '.$camara_destino. ' hacia: '.$camaradestino;
    $historial->crear_historial($descripcion,8,4,$id_ingreso);
    $camara->modificarcamara($id,$camaradestino);

}
if($_POST['funcion']=='buscarultimoid'){
    $id = $_POST['id'];
    $camara->buscarultimoid($id);
    $json=array();
    foreach ($camara->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_movimiento
            
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='cambiarestado'){
    $ultimo = $_POST['ultimo'];
    $camara->cambiarestado($ultimo);
}
if($_POST['funcion']=='cambiarestado1'){
    $checked=json_decode($_POST['json']);
    $i = 1;
    foreach ($checked as $prod) {
        $cantidad = $prod->id; 
        var_dump($cantidad);
        
}
    
}
if($_POST['funcion']=='verificartropas'){
    $tropa=$_POST['tropa'];
    $camara->verificartropas($tropa);
    $json=array();
    foreach ($camara->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_faenados,
            'camara'=>$objeto->camara,
            'garron'=>$objeto->garron,
            'peso'=>$objeto->peso
            
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='movergarroncamaratoda'){
    $datos= date_default_timezone_set('America/Argentina/Mendoza');
    $ano = date("Y");
    $fecha = date("d-m-Y");
    $tropa = $_POST['tropa'];
    $camaraorigen = $_POST['camaraorigen'];
    $camaradestino = $_POST['camaradestino'];
    $despiece = $_POST['despiece'];
    $especie = $_POST['especie'];
    $camara->movergarroncamaratoda($ano,$fecha,$tropa,$camaraorigen,$camaradestino,$despiece,$especie);
}
if($_POST['funcion']=='modificarcamaratoda'){
    $checked=json_decode($_POST['json']);
    $camaradestino = $_POST['camaradestino'];
    $tropa = $_POST['tropa'];
    $id_ingresos = $_POST['id_ingresos'];
    $i = 1;
    foreach ($checked as $prod) {
        $cantidad = $prod->id; 
    $camara->modificarcamaratoda($cantidad,$camaradestino);
}
$camara->datos_camara($camaradestino);
$camara_destino=$camara->objetos[0]->nombre;
$descripcion='se ha movido la tropa: '.$tropa. ' hacia la camara: '.$camara_destino;
$historial->crear_historial($descripcion,8,4,$id_ingresos);
}
if($_POST['funcion']=='movertoda'){
    $checked=json_decode($_POST['json']);
    $datos= date_default_timezone_set('America/Argentina/Mendoza');
    $ano = date("Y");
    $fecha = date("d-m-Y");
  
    $tropa = $_POST['tropa'];
    $camaraorigen = $_POST['camaraorigen'];
    $camaradestino = $_POST['camaradestino1'];
    $despiece = $_POST['despiece'];
    $especie = $_POST['especie'];
    $i = 1;
    foreach ($checked as $prod) {
        $cantidad = $prod->id; 
        $camara->movertoda($ano,$fecha,$tropa,$cantidad,$camaraorigen,$camaradestino,$despiece,$especie);
        
    }
    
}
if($_POST['funcion']=='buscarultimoidtoda'){
    $tropa = $_POST['tropa'];
    $camara->buscarultimoidtoda($tropa);
    $json=array();
    foreach ($camara->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_movimiento
            
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='cambiarestadotoda'){
    $ultimo = $_POST['ultimo'];
    $camara->cambiarestadotoda($ultimo);
}
if($_POST['funcion']=='listarcamaras'){
    $camara->listarcamaras();
    $json= array();
    foreach ($camara->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
} 
if($_POST['funcion']=='datoscamara_rellenar'){
    $id=$_POST['id'];
    $camara->datoscamara_rellenar($id);
    $json=array();
    foreach ($camara->objetos as $objeto) {
        $json[]=array(
            'camara'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='bucaridcamaratoda'){
    $checked=json_decode($_POST['json']);
    $i = 1;
    foreach ($checked as $prod) {
        $cantidad = $prod->id; 
        $camara->bucaridcamaratoda($cantidad);
        
    }
}
if($_POST['funcion']=='crearcamaratoda'){
    $checked=json_decode($_POST['json']);
    $datos= date_default_timezone_set('America/Argentina/Mendoza');
    $ano = date("Y");
    $fecha = date("d-m-Y");
    $tropa = $_POST['tropa'];
   
    $camaraorigen = $_POST['camaraorigen'];
    $camaradestino = $_POST['camaradestino1'];
    $despiece = $_POST['despiece'];
    $especie = $_POST['especie'];
    $i = 1;
    foreach ($checked as $prod) {
        $cantidad = $prod->id; 
        $garron = $prod->garron; 
        $camara->crearcamaratoda($cantidad,$garron,$tropa,$camaraorigen,$camaradestino,$despiece,$especie,$fecha,$ano);
        
    }
}
?>
