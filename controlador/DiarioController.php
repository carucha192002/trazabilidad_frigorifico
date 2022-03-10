<?php
include '../modelo/diario.php';
$reporte = new Diarios();
if($_POST['funcion']=='listar'){
    $reporte->buscar();    
    $json= array();
    foreach ($reporte->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='ver_todo'){
    $id=$_POST['id'];
    $fecha=$_POST['fecha'];
   $id_ingreso=$_POST['id_ingresos'];
    //$reporte->cantidad($id,$fecha,$id_ingreso);
    //$total=$reporte->objetos[0]->cantidad;
   $reporte->ver_todo($fecha);
   $json=array();
    foreach ($reporte->objetos as $objeto) {
       $reporte->promedios($objeto->id_ingreso);
             foreach ($reporte->objetos as $obj) {
        $promedio = $obj->promedio;
        $kgcarne = $obj->kgcarne;
        $total = $obj->cantidad;
        $json[]=array(
            'id_ingreso'=>$objeto->id_ingreso, 
            'fecha'=>$objeto->fecha,
            'id'=>$objeto->id_matarife,
            'tropa'=>$objeto->tropa,
            'cantidad'=>$objeto->cantidad,
            'total'=>$total,
            'clasificacion'=>$objeto->clasificacion,
            'garron'=>$objeto->garron,
            'dte'=>$objeto->dte,
            'corral'=>$objeto->corral,
            'kilosenpie'=>$objeto->kilosenpie,
            'tci'=>$objeto->tci,
            'promedio'=>$promedio,
            'kiloscarne'=>$kgcarne,
        
        );
    }
}
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='ver'){
    $id=$_POST['id'];
    $fecha_datos=$_POST['fecha'];
    $id_ingreso=$_POST['id_ingreso'];
    $fecha=date("Y", strtotime($fecha_datos));

   $reporte->ver($id,$fecha,$id_ingreso);
   $json=array();
    foreach ($reporte->objetos as $objeto) {

        $json[]=array(
            'garron'=>$objeto->garron,
            'tropa'=>$objeto->tropa,
            'especie'=>$objeto->especie,
            'peso'=>$objeto->peso,
            'productor'=>$objeto->productor,
            'establecimiento'=>$objeto->establecimiento,
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
}


?>
