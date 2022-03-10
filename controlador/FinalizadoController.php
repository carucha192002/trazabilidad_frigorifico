<?php
include '../modelo/finalizado.php';
$finalizado = new finalizado();
    if($_POST['funcion']=='buscar'){
        $finalizado->buscar();
        $json= array();
        foreach ($finalizado->objetos as $objeto) {
            $json['data'][]=$objeto;
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
 

    if($_POST['funcion']=='verificarcorrales'){
        $finalizado->verificarcorrales();
        $json=array();
        foreach ($finalizado->objetos as $objeto) {
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
    if($_POST['funcion']=='facturacion'){
        $id=$_POST['id'];
        $finalizado->facturacion($id);
        $json=array();
        foreach ($finalizado->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id,
                'ano'=>$objeto->ano,
                'garron'=>$objeto->garron,
                'peso'=>$objeto->peso,
                'kilos'=>$objeto->kilos,
                'destino'=>$objeto->destino
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
    }
    if($_POST['funcion']=='agregarconservacion'){
        $id=$_POST['id'];
        $respuesta=$_POST['respuesta'];
        $finalizado->agregarconservacion($id,$respuesta);

    }
    if($_POST['funcion']=='buscarconservacion'){
        $especie=$_POST['especie'];
        $finalizado->buscarconservacion($especie);
       
    }
    if($_POST['funcion']=='buscarconservacion1'){
        $especie=$_POST['especie'];
        $finalizado->buscarconservacion1($especie);
        $json=array();
        foreach ($finalizado->objetos as $objeto) {
            $json[]=array(
                'codigo'=>$objeto->codigo,
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    }
  
    if($_POST['funcion']=='verificardatos'){
        $id=$_POST['id'];
        $finalizado->verificardatos($id);
        $json=array();
        foreach ($finalizado->objetos as $objeto) {
            $json[]=array(
                'despiece'=>$objeto->despiece,
            );
        }
        $jsonstring=json_encode($json[0]);
        echo $jsonstring;
    
    }
    
    if($_POST['funcion']=='rellenar_cuarteados'){
        $especie=$_POST['especie'];
        $finalizado->rellenar_cuarteados($especie);
        $json=array();
        foreach ($finalizado->objetos as $objeto) {
            $json[]=array(
                'codigo'=>$objeto->codigo,
                'nombre'=>$objeto->despiece
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
    }    
    if($_POST['funcion']=='codigos_barras'){
        $id_ingresos = $_POST['id_ingresos'];
        $finalizado->datos($id_ingresos);
        $json=array();
        foreach ($finalizado->objetos as $objeto) {
            $json[]=array(
                'id'=>$objeto->id_faenados,
            );
        }
        $jsonstring=json_encode($json);
        echo $jsonstring;
        }

        if($_POST['funcion']=='codigos_qr'){
            $id_ingresos = $_POST['id_ingresos'];
            $finalizado->datos_qr($id_ingresos);
            $json=array();
            foreach ($finalizado->objetos as $objeto) {
                $json[]=array(
                    'id'=>$objeto->id_faenados,
                    'tropa'=>$objeto->tropa,
                    'garron'=>$objeto->garron,
                    'peso'=>$objeto->peso,
                    'especie'=>$objeto->especie,
                    'productor'=>$objeto->productor,
                    'estado'=>$objeto->estado,
                    'maximo'=>$objeto->maximo,
                    'nombrematarife'=>$objeto->nombrematarife,
                );
            }
            $jsonstring=json_encode($json);
            echo $jsonstring;
            }
            if($_POST['funcion']=='tipo'){
                $id_ingresos = $_POST['id_ingresos'];
                $finalizado->tipo($id_ingresos);
                $json=array();
                foreach ($finalizado->objetos as $objeto) {
                    $json[]=array(
                        'especie'=>$objeto->especie,
                    );
                }
                $jsonstring=json_encode($json[0]);
                echo $jsonstring;
                }
?>
