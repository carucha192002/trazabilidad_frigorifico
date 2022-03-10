<?php
include '../modelo/Clasificacion.php';
$clasificacion = new Clasificacion();
if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre'];
   
    $avatar='clas-default.jpg';
    $clasificacion->crear($nombre,$avatar);
}
if($_POST['funcion']=='editar'){
    $nombre = $_POST['nombre'];
    $id_editado=$_POST['id'];
   
    $clasificacion->editar($nombre,$id_editado);
}
if($_POST['funcion']=='buscar'){
    $clasificacion->buscar();
    $json=array();
    foreach ($clasificacion->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_clasificacion,
            'nombre'=>$objeto->nombre,
            'avatar'=>'../img/clas/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/clas/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $clasificacion->cambiar_logo($id,$nombre);
        foreach ($clasificacion->objetos as $objeto) {
            if($objeto->avatar!='clas-default.jpg'){
                unlink('../img/clas/'.$objeto->avatar);
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
if($_POST['funcion']=='rellenar_laboratorios'){
    $clasificacion->rellenar_laboratorios();
    $json=array();
    foreach ($clasificacion->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_laboratorio,
            'nombre'=>$objeto->nombre
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $clasificacion->borrar($id);
}
?>
