<?php
include '../modelo/Matarife.php';
$matarife = new Matarife();
if($_POST['funcion']=='matarife_rellenar'){
    $matarife->rellenar_matarife();
    $json=array();
    foreach ($matarife->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_matarife,
            'nombre'=>$objeto->nombre
        );    }
    $jsonstring=json_encode($json);
    echo $jsonstring; 
}
if($_POST['funcion']=='matarife_rellenar_sub'){
    $id=$_POST['id'];
    $matarife->matarife_rellenar_sub($id);
    $json=array();
    foreach ($matarife->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_submatarife,
            'nombre'=>$objeto->nombre
        );    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
    
}
if($_POST['funcion']=='matarifecuit_rellenar'){
    $id=$_POST['id'];
    $matarife->rellenar_matarifecuit($id);
    $json=array();
    foreach ($matarife->objetos as $objeto) {
        $json[]=array(
            'cuit'=>$objeto->cuit,
            'nombre'=>$objeto->nombre,
            'id_matarife'=>$objeto->id_matarife,
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='fudepen_rellenar'){
    $id_matarife=$_POST['id_matarife'];
    $matarife->fudepen_rellenar($id_matarife);
    $json=array();
    foreach ($matarife->objetos as $objeto) {
        $json[]=array(
            'cuit'=>$objeto->cuit,
            'nombre'=>$objeto->nombre,
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='ver_subitem'){
    $id=$_POST['id'];
    $matarife->ver_subitem($id);
    $json=array();
    foreach ($matarife->objetos as $objeto) {
        $json[]=array(
            'cantidad'=>$objeto->cantidad,
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='crear'){
    $nombre = $_POST['nombre'];
    $avatar='matarife-default.jpg';
    $cuit=$_POST['cuit'];
    $establecimiento=$_POST['establecimiento'];
    $email=$_POST['email'];
    $ultimo=$_POST['ultimo'];
    $matarife->crear($nombre,$avatar,$cuit,$establecimiento,$email,$ultimo);
    
}
if($_POST['funcion']=='crear_subitem'){
    $nombre = $_POST['nombre'];
    $cuit=$_POST['cuit'];
    $identificador=$_POST['identificador'];
    $id=$_POST['id'];
    $matarife->crear_subitem($nombre,$cuit,$identificador,$id);
    
}
if($_POST['funcion']=='editar_subitem'){
    $nombre = $_POST['nombre'];
    $cuit=$_POST['cuit'];
    $identificador=$_POST['identificador'];
    $id=$_POST['id'];
    $matarife->editar_subitem($nombre,$cuit,$identificador,$id);
    
}
if($_POST['funcion']=='ultimo_matarife'){
    $matarife->ultimo_matarife();
    $json=array();
    foreach ($matarife->objetos as $objeto) {
        $json[]=array(
            'ultimo'=>$objeto->ultimo,
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
    
}
if($_POST['funcion']=='editar'){
    $nombre = $_POST['nombre'];
    $id_editado=$_POST['id'];
    $cuit=$_POST['cuit'];
    $establecimiento=$_POST['establecimiento'];
    $email=$_POST['email'];
    $matarife->editar($nombre,$id_editado,$cuit,$establecimiento,$email);
}
if($_POST['funcion']=='buscar'){
    $matarife->buscar();
    $json=array();
    foreach ($matarife->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_matarife,
            'nombre'=>$objeto->nombre,
            'cuit'=>$objeto->cuit,
            'establecimiento'=>$objeto->establecimiento,
            'email'=>$objeto->email,
            'cantidad'=>$objeto->cantidad,
            'avatar'=>'../img/matarife/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

if($_POST['funcion']=='borrar'){
    $id=$_POST['id'];
    $matarife->borrar($id);
}
if($_POST['funcion']=='borraritem'){
    $id=$_POST['id'];
    $identificador=$_POST['identificador'];
    $matarife->borraritem($id,$identificador);  
}
if($_POST['funcion']=='cambiar_logo'){
    $id=$_POST['id_logo_prod'];
    if(($_FILES['photo']['type']=='image/jpeg')||($_FILES['photo']['type']=='image/png')||($_FILES['photo']['type']=='image/gif')||($_FILES['photo']['type']=='image/jpg')){
        $nombre=uniqid().'-'.$_FILES['photo']['name'];
        $ruta='../img/matarife/'.$nombre;
        move_uploaded_file($_FILES['photo']['tmp_name'],$ruta);
        $matarife->cambiar_logo($id,$nombre);
        foreach ($matarife->objetos as $objeto) {
            if($objeto->avatar!='matarife-default.jpg'){
                unlink('../img/matarife/'.$objeto->avatar);
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
    if($_POST['funcion']=='matarife_rellenar'){
        $matarife->rellenar_matarife();
        $json=array();
        foreach ($matarife->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id_matarife,
                'nombre'=>$objeto->nombre
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
    }
}
if($_POST['funcion']=='cantidad_item'){
    $matarife->cantidad_item();
    $json= array();
    foreach ($matarife->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
} 

?>
