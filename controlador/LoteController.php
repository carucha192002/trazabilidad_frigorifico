<?php
include '../modelo/Lote.php';
$lote = new Lote();

if($_POST['funcion']=='buscardespacho'){
    $lote->buscardespacho();
    $json=array();
    foreach ($lote->objetos as $objeto) {
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
    $lote->buscardespachobarras($valor);
    $json=array();
    foreach ($lote->objetos as $objeto) {
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
    $lote->buscardespachoexiste($valor);
}
if($_POST['funcion']=='buscar'){
    $lote->buscar();
    $json=array();
    $fecha_actual = new DateTime();
    foreach ($lote->objetos as $objeto) {
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
    $lote->borrar($id);
}
if($_POST['funcion']=='buscar_id'){
    $id=$_POST['id_producto'];
    $garron=$_POST['garron'];
    $lote->buscar_id($id);
    $json=array();
    foreach ($lote->objetos as $objeto) {
        $lote->obtener_stock($objeto->tropa,$garron);
        foreach ($lote->objetos as $obj) {
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
        $lote->obtener_stock ($objeto->tropa,$objeto->garron);
        foreach ($lote->objetos as $obj) {
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
?>