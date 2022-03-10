<?php
include_once 'conexion.php';
class Devolucion{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
 
    function buscar(){
          $sql="SELECT id_faenados,tropa,faenados.especie as especie,despieces.despiece as despieces,camara,garron,faenados.productor as productor,faenados.fecha,ingresos.conservacion as conservacion,conservacion.nombre as nomconservacion,conservacion.vida as vidautil,DATE_ADD(faenados.fecha, INTERVAL conservacion.vida DAY) as vencimiento FROM `faenados`
          join ingresos on tropa=numtropas
          join conservacion on ingresos.conservacion = id_conservacion
         join despieces on faenados.despiece= despieces.codigo
         where faenados.salio='NO' ORDER BY faenados.tropa asc limit 25";
          $query = $this->acceso->prepare($sql);
          $query->execute(); 
          $this->objetos=$query->fetchall();
          return $this->objetos;
        
    }
    function buscardespacho(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT id_faenados,tropa,especie,despieces.despiece as despieces,camara,garron FROM `faenados`
            join despieces on faenados.despiece= despieces.codigo
            where tropa LIKE :consulta and faenados.salio='NO'";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%")); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
         }
         else{
        $sql="SELECT id_faenados,tropa,especie,despieces.despiece as despieces,camara,garron FROM `faenados`
        join despieces on faenados.despiece= despieces.codigo
        where tropa  not LIKE ' ' and faenados.salio='NO' ORDER BY garron asc
                 LIMIT 100";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    }
    function buscardespachobarras($valor){
        $sql="SELECT id_faenados,tropa,faenados.especie as especie,despieces.despiece as despieces,camara,garron,peso,faenados.productor as productor,matarife.nombre as nombre,ingresos.guia as dte FROM `faenados`
        join despieces on faenados.despiece= despieces.codigo
        join ingresos on tropa=numtropas
        join matarife on ingresos.matarife=id_matarife
        where id_faenados=:consulta and faenados.salio='SI' and ingresos.ano=faenados.ano";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':consulta'=>$valor)); 
        $this->objetos=$query->fetchall(); 
        return $this->objetos;
       
   

    }
    function editar($id,$stock){
         $sql="UPDATE lote SET stock=:stock where id_lote=:id";
         $query = $this->acceso->prepare($sql);
         $query->execute(array(':id'=>$id,':stock'=>$stock)); 
         echo 'edit';
    }
    function borrar($id){
        $sql="DELETE FROM lote where id_lote=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }
        else{
            echo 'no borrado';
        }
    }
    function devolver($id_lote,$cantidad,$vencimiento,$producto,$proveedor){
          $sql="SELECT * FROM lote WHERE id_lote=:id_lote";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':id_lote'=>$id_lote)); 
          $lote=$query->fetchall();
          if(!empty($lote)){
             $sql="UPDATE lote SET stock=stock+:cantidad WHERE id_lote=:id_lote";
             $query = $this->acceso->prepare($sql);
             $query->execute(array(':cantidad'=>$cantidad,':id_lote'=>$id_lote));
          }
          else{
            $sql="SELECT * FROM lote WHERE vencimiento=:vencimiento and lote_id_prod=:producto and lote_id_prov=:proveedor";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':vencimiento'=>$vencimiento,':producto'=>$producto,':proveedor'=>$proveedor)); 
            $lote_nuevo=$query->fetchall();
            foreach ($lote_nuevo as $objeto) {
                $id_lote_nuevo = $objeto->id_lote;
            }
            if(!empty($lote_nuevo)){
                $sql="UPDATE lote SET stock=stock+:cantidad WHERE id_lote=:id_lote";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':cantidad'=>$cantidad,':id_lote'=>$id_lote_nuevo));
            }
            else{
                $sql="INSERT INTO lote(id_lote,stock,vencimiento,lote_id_prod,lote_id_prov) values(:id_lote,:stock,:vencimiento,:producto,:proveedor)";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id_lote'=>$id_lote,':stock'=>$cantidad,':vencimiento'=>$vencimiento,':producto'=>$producto,':proveedor'=>$proveedor));
            }

          }          
    }
    function buscar_id($id){
        $sql="SELECT id_faenados,tropa,faenados.especie as especie,despieces.despiece as despieces,camara,garron,faenados.productor as productor,faenados.fecha,ingresos.conservacion as conservacion,conservacion.nombre as nomconservacion,conservacion.vida as vidautil,DATE_ADD(faenados.fecha, INTERVAL conservacion.vida DAY) as vencimiento,peso,matarife.nombre as matarife FROM `faenados`
        join ingresos on tropa=numtropas
        join conservacion on ingresos.conservacion = id_conservacion
       join despieces on faenados.despiece= despieces.codigo
       join matarife on ingresos.matarife=id_matarife
       where faenados.salio='SI' and id_faenados=:id ORDER BY faenados.tropa asc limit 25";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;      
    }
    function obtener_stock($id,$garron){
        $sql="SELECT COUNT(id_faenados) as total FROM `faenados` WHERE salio='NO' and tropa=:id and garron=:garron";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':garron'=>$garron));
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscardespachoexiste($valor){
        $sql="SELECT id_faenados,tropa,especie,despieces.despiece as despieces,camara,garron,peso FROM `faenados`
        join despieces on faenados.despiece= despieces.codigo
        where id_faenados=:consulta and faenados.salio='SI'";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':consulta'=>$valor)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'add';
        }
        else{
          echo 'noadd';
        }
    }
    function cargardevolucion($id){
        $sql="UPDATE faenados SET salio=:salio where id_faenados=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id,':salio'=>'NO')); 
        echo 'add';
         
    }
    function recuperardatos($id){
        $sql="SELECT faenados.tropa as tropas,faenados.productor as productor,faenados.garron as garron,faenados.especie as especie,faenados.peso as peso,faenados.estado as estado,faenas.cantidad as maximo,faenas.id_matarife as nombrematarife FROM `faenados` 
        join faenas on faenados.tropa=faenas.tropa
        WHERE id_faenados=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
}