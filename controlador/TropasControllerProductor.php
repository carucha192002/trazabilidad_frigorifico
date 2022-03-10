<?php
include '../modelo/tropasproductor.php';
$tropas = new TropasProductor();
if($_POST['funcion']=='rellenar_desdetropas'){
    $tropas->rellenar_desdetropas();
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->desdetropas
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='buscar'){
    $tropas->buscar();
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_tropas,
            'matarife'=>$objeto->matarife,
            'procedencia'=>$objeto->procedencia,
            'especiesanimal'=>$objeto->especiesanimal,
            'vigencia'=>$objeto->vigencia,
            'desde'=>$objeto->desde,
            'cantidad'=>$objeto->cantidad,
            'hasta'=>$objeto->hasta,
            'avatar'=>'../img/tropas/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='marcador'){
    $id_ingresos=$_POST['id_ingresos'];
    $tropas->marcador($id_ingresos);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'marcador'=>$objeto->marcador
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}

if($_POST['funcion']=='listar'){
    $tropas->buscar_listados();    
    $json= array();
    foreach ($tropas->objetos as $objeto) {
        $json['data'][]=$objeto;
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='comprobar'){
    $matarife=$_POST['matarife'];
    $especie=$_POST['especie'];
    $tropas->comprobar($matarife,$especie);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'numero'=>$objeto->numerotropa,
            'usados'=>$objeto->usados
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='comprobartropas'){
    $matarife=$_POST['matarife'];
    $especie=$_POST['especie'];
    $ano=$_POST['ano'];
    $tropas->comprobartropas($matarife,$especie,$ano);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'numero'=>$objeto->numerotropa,
        );
    }
    $jsonstring=json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='comprobarano'){
    $ano=$_POST['ano'];
    $matarife=$_POST['matarife'];
    $especie=$_POST['especie'];
    $tropas-> comprobarano($matarife,$especie,$ano);
}

if($_POST['funcion']=='listartropas'){
    $id=$_POST['id'];
    $tropas->listartropas($id);
    $json= array();
    foreach ($tropas->objetos as $objeto) {
        $json['data'][]=$objeto;

    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
} 
if($_POST['funcion']=='id_matarife'){
    $id=$_POST['identificador'];
    $tropas->id_matarife($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'identificador'=>$objeto->id_matarife
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='ver'){
    $id=$_POST['id'];
    $tropas->ver($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id_ingresos,
            'ano'=>$objeto->ano,
            'fecha'=>$objeto->fecha,
            'libro'=>$objeto->libro,
            'folio'=>$objeto->folio,
            'destino'=>$objeto->destino,
            'especie'=>$objeto->especie,
            'raza'=>$objeto->raza,
            'cantidad'=>$objeto->cantidad,
            'kilos'=>$objeto->kilos,
            'muertos'=>$objeto->muertos,
            'caidos'=>$objeto->caidos,
            'enpie'=>$objeto->enpie,
            'kilosenpie'=>$objeto->kilosenpie,
            'conservacion'=>$objeto->conservacion,
            'vencimiento'=>$objeto->vencimiento,
            'corral'=>$objeto->corral,
            'corralero'=>$objeto->corralero,
            'matarife'=>$objeto->matarife,
            'productor'=>$objeto->productor,
            'guia'=>$objeto->guia,
            'fechaguia'=>$objeto->fechaguia,
            'dtamodal'=>$objeto->dtamodal,
            'fechadtamodal'=>$objeto->fechadtamodal,
            'numdtamodal'=>$objeto->numdtamodal,
            'dtafeedlot'=>$objeto->dtafeedlot,
            'llenarprocedencia'=>$objeto->llenarprocedencia,
            'provinciamodal'=>$objeto->provinciamodal,
            'localidadmodal'=>$objeto->localidadmodal,
            'CPmodal'=>$objeto->cpmodal,
            'llenartransporte'=>$objeto->llenartransporte,
            'llenarchofer'=>$objeto->llenarchofer,
            'dnimodal'=>$objeto->dnimodal,
            'camionmodal'=>$objeto->camionmodal,
            'habilitacionmodal'=>$objeto->habilitacionmodal,
            'horasdeviajemodal'=>$objeto->horasdeviajemodal,
            'TRImodal'=>$objeto->trimodal,
            'lavadomodal'=>$objeto->lavadomodal,
            'prescintomodal'=>$objeto->prescintomodal,
            'prescintomodalacoplado'=>$objeto->prescintomodalacoplado,
            'observacionmodal'=>$objeto->observacionmodal,
            'kiloscueromodal'=>$objeto->kiloscuerosmodal,
            'numtropas'=>$objeto->numtropas
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='verificarcorrales'){
    $id=$_POST['id'];
    $tropas->verificarcorrales($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'corral'=>$objeto->corral,
            'cantidad'=>$objeto->cantidad,
            'especie'=>$objeto->especie,
            'subespecie'=>$objeto->subespecie
        );
    }
    $jsonstring=json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='verprincipal'){
    $id=$_POST['id'];
    $tropas->verprincipal($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(
            'id_ingresos'=>$objeto->id_ingresos,
            'cargo'=>$objeto->cargodatos,
            'ano'=>$objeto->ano,
            'fecha'=>$objeto->fecha,
            'libro'=>$objeto->libro,
            'folio'=>$objeto->folio,
            'destino'=>$objeto->destino,
            'especie'=>$objeto->especie,
            'cantidad'=>$objeto->cantidad,
            'kilos'=>$objeto->kilos,
            'muertos'=>$objeto->muertos,
            'caidos'=>$objeto->caidos,
            'enpie'=>$objeto->enpie,
            'kilosenpie'=>$objeto->kilosenpie,
            'conservacion'=>$objeto->conservacion,
            'vencimiento'=>$objeto->vencimiento,
            'corral'=>$objeto->corral,
            'corralero'=>$objeto->corralero,
            'matarife'=>$objeto->matarife,
            'productor'=>$objeto->productor,
            'guia'=>$objeto->guia,
            'fechaguia'=>$objeto->fechaguia,
            'dtamodal'=>$objeto->dtamodal,
            'fechadtamodal'=>$objeto->fechadtamodal,
            'llenarprocedencia'=>$objeto->llenarprocedencia,
            'provinciamodal'=>$objeto->provinciamodal,
            'localidadmodal'=>$objeto->localidadmodal,
            'CPmodal'=>$objeto->cpmodal,
            'llenartransporte'=>$objeto->transporte,
            'llenarchofer'=>$objeto->llenarchofer,
            'dnimodal'=>$objeto->dnimodal,
            'habilitacionmodal'=>$objeto->habilitacionmodal,
            'horasdeviajemodal'=>$objeto->horasdeviajemodal,
            'lavadomodal'=>$objeto->lavadomodal,
            'prescintomodal'=>$objeto->prescintomodal,
            'prescintomodalacoplado'=>$objeto->prescintomodalacoplado,
            'observacionmodal'=>$objeto->observacionmodal,
            'kiloscueromodal'=>$objeto->kiloscuerosmodal,
            'numtropas'=>$objeto->numtropas,
            'subespecie'=>$objeto->subespecie,
            'digestormuertos'=>$objeto->digestormuertos,
            'digestorcaidos'=>$objeto->digestorcaidos,
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='verclasificacion'){
    $id=$_POST['id'];
    $tropas->verclasificacion($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(       
            'subespecie'=>$objeto->subespecie,
            'cantidad'=>$objeto->enpie,
            'kilos'=>$objeto->kilosenpie

        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='vercorral'){
    $id=$_POST['id'];
    $tropas->vercorral($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(       
            'corral'=>$objeto->corral,
            'corralero'=>$objeto->corralero,
            'enpie'=>$objeto->enpie
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='verfoto'){
    $id=$_POST['id'];
    $tropas->verfoto($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(       
            'nombre'=>$objeto->nombre,
            'avatar'=>'../img/'.$objeto->avatar
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='datos'){
    $id=$_POST['id'];
    $tropas->datos($id);
}
if($_POST['funcion']=='datosvalidos'){
    $id=$_POST['id'];
    $tropas->datosvalidos($id);
    $json=array();
    foreach ($tropas->objetos as $objeto) {
        $json[]=array(       
            'fecha'=>$objeto->fecha,
            'edito'=>$objeto->edito
            
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
?>
