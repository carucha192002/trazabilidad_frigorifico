<?php
include_once '../modelo/Venta.php';
include_once '../modelo/conexion.php';
include_once '../modelo/Historial.php';
$historial = new Historial();
$venta= new Venta();
session_start();

$vendedor=$_SESSION['usuario'];
if($_POST['funcion']=='registrar_compra'){
    $total=$_POST['total'];
    $nombre=$_POST['nombre'];
    $dni=$_POST['dni'];
    $destino=$_POST['destino'];
    $estado=$_POST['estado'];
    $productos=json_decode($_POST['json']);
  
    
    date_default_timezone_set('America/Argentina/Mendoza');
    $fecha = date('Y-m-d H:i:s');
    $venta->crear($fecha,$nombre,$dni,$total,$vendedor,$destino,$estado);
    $venta->ultima_venta();
        $id_venta = $venta->objetos[0]->ultima_venta;
        echo $id_venta;
   try {
       
        $db= new conexion();
        $conexion = $db->pdo;
        $conexion->beginTransaction();
        foreach ($productos as $prod) {
            $cantidad = $prod->cantidad;
            while ($cantidad!=0) {
                $sql="SELECT id_faenados,tropa,faenados.especie as especie,despieces.despiece as despieces,camara,garron,faenados.productor as productor,faenados.fecha,ingresos.conservacion as conservacion,conservacion.nombre as nomconservacion,conservacion.vida as vidautil,DATE_ADD(faenados.fecha, INTERVAL conservacion.vida DAY) as vencimiento, count(garron) as stock FROM `faenados`
                join ingresos on tropa=numtropas
                join conservacion on ingresos.conservacion = id_conservacion
               join despieces on faenados.despiece= despieces.codigo
               where faenados.salio='NO' and id_faenados=:id ORDER BY faenados.tropa asc ";
                $query = $conexion->prepare($sql);
                $query->execute(array(':id'=>$prod->id)); 
                $lote=$query->fetchall();
                foreach ($lote as $lote) {
                    if($cantidad==$lote->stock){
                       
                        $sql="INSERT INTO detalle_venta(det_cantidad,det_vencimiento,garron,id_faena,tropa,id_det_venta,camara,especie,despiece)values('$cantidad','$lote->vencimiento',
                        '$lote->garron','$prod->id','$lote->tropa','$id_venta','$lote->camara','$lote->especie','$lote->despieces')";
                         $conexion->exec($sql);
                        $cantidad=0;
                    }
                  
                }
            }
           
        }
        foreach ($productos as $produ) {
          
            $venta->despachos($produ->id);
            $id_ingresos=$venta->objetos[0]->id_ingreso;
            $garron=$venta->objetos[0]->garron;
            $descripcion='Se realizo la entrega N°: '.$id_venta.' del garron: '.$garron.' con destino: '.$destino. ' retira: '.$nombre;
            $historial->crear_historial($descripcion,8,5,$id_ingresos);
        }
    
        $conexion->commit();
    } catch (Exception $error) {        
        $conexion->rollBack();
        echo $error->getMessage();
    }

}

