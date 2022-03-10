<?php
include '../modelo/devolucion.php';
$devolucion = new Devolucion();

if($_POST['funcion']=='buscardespacho'){
    $devolucion->buscardespacho();
    $json=array();
    foreach ($devolucion->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_faenados,
            'tropa'=>$objeto->tropa,
            'especie'=>$objeto->especie,
            'despiece'=>$objeto->despieces,
            'camara'=>$objeto->camara,
            'garron'=>$objeto->garron,
            
            
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='buscardespachobarras'){
    $valor=$_POST['valor'];
    $devolucion->buscardespachobarras($valor);
    $json=array();
    foreach ($devolucion->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_faenados,
            'tropa'=>$objeto->tropa,
            'especie'=>$objeto->especie,
            'despiece'=>$objeto->despieces,
            'camara'=>$objeto->camara,
            'garron'=>$objeto->garron,
            'peso'=>$objeto->peso,
            'productor'=>$objeto->productor,
            'matarife'=>$objeto->nombre,
            'dte'=>$objeto->dte          

        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='buscardespachoexiste'){
    $valor=$_POST['valor'];
    $devolucion->buscardespachoexiste($valor);

}
if($_POST['funcion']=='buscar'){
    $devolucion->buscar();
    $json=array();
    $fecha_actual = new DateTime();
    foreach ($devolucion->objetos as $objeto) {
        $vencimiento = new DateTime($objeto->vencimiento);
        $diferencia = $vencimiento->diff($fecha_actual);
        $mes = $diferencia->m;
        $dia = $diferencia->d;
        $verificado = $diferencia->invert;
        if($verificado==0){
            $estado='danger';
            $mes=$mes*(-1);
            $dia=$dia*(-1);
        }
        else{
            if($mes>3){
             $estado='ligth';
            }
            if($mes<=3){
             $estado='warning';
            }
        }
        $json[]=array(
            'id'=>$objeto->id_faenados,
            'tropa'=>$objeto->tropa,
            'especie'=>$objeto->especie,
            'despieces'=>$objeto->despieces,
            'vencimiento'=>$objeto->vencimiento,
            'camara'=>$objeto->camara,
            'garron'=>$objeto->garron,
            'productor'=>$objeto->productor,
            'nomconservacion'=>$objeto->nomconservacion,
            'vidautil'=>$objeto->vidautil,   
            'fecha'=>$objeto->fecha,                     
            'mes'=>$mes,
            'dia'=>$dia,
            'estado'=>$estado            
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='borrar'){
    $id = $_POST['id'];
    $devolucion->borrar($id);
}
if($_POST['funcion']=='buscar_id'){
    $id=$_POST['id_producto'];
    $garron=$_POST['garron'];
    $devolucion->buscar_id($id);
    $json=array();
    foreach ($devolucion->objetos as $objeto) {
        $devolucion->obtener_stock($objeto->tropa,$garron);
        foreach ($devolucion->objetos as $obj) {
            $total = $obj->total;
        }
        $json[]=array(
            'id'=>$objeto->id_faenados,
            'tropa'=>$objeto->tropa,
            'especie'=>$objeto->especie,
            'vencimiento'=>$objeto->vencimiento,
            'despieces'=>$objeto->despieces,
            'unidad'=>'1',
            'stock'=>$total,
            'camara'=>$objeto->camara,
            'garron'=>$objeto->garron,
            'productor'=>$objeto->productor,
            'fecha'=>$objeto->fecha,
            'nomconservacion'=>$objeto->nomconservacion,
            'vidautil'=>$objeto->vidautil,
            'peso'=>$objeto->peso,
            'matarife'=>$objeto->matarife,

            
            
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='verificar_stock'){
    $error=0;
    $productos=json_decode($_POST['productos']);
    
    foreach ($productos as $objeto) {
        $devolucion->obtener_stock ($objeto->tropa,$objeto->garron);
        foreach ($devolucion->objetos as $obj) {
            $total=$obj->total;
        }
        if($total>=$objeto->cantidad && $objeto->cantidad>0){
            $error=$error+0;
        }
        else{
            $error=$error+1;
        }
    }   
    echo $error; 
}
if($_POST['funcion']=='cargardevolucion'){
    $id = $_POST['id_producto'];
    $devolucion->cargardevolucion($id);
}

if($_POST['funcion']=='recuperardatos'){
    $id=$_POST['id_producto1'];
    $devolucion->recuperardatos($id);
    $json=array();
    foreach ($devolucion->objetos as $objeto) {
        $json[]=array(
            'tropas'=>$objeto->tropas,
            'productor1'=>$objeto->productor,
            'garron'=>$objeto->garron,
            'especie1'=>$objeto->especie,
            'peso'=>$objeto->peso,
            'estado1'=>$objeto->estado,
            'maximo'=>$objeto->maximo,
            'nombrematarife1'=>$objeto->nombrematarife
           
            
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>