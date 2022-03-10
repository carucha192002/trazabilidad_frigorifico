<?php
include 'conexion.php';
class Camara{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function crear($nombre,$avatar,$numero){
        $sql="SELECT id_camara FROM camara where nombre=:nombre";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':nombre'=>$nombre)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
        $sql="INSERT INTO camara(nombre,avatar,numero) values (:nombre,:avatar,:numero);";
          $query = $this->acceso->prepare($sql);
          $query->execute(array(':nombre'=>$nombre,':avatar'=>$avatar,':numero'=>$numero));
          echo 'add';
        }
    }
    function buscar(){
        if(!empty($_POST['consulta'])){
           $consulta=$_POST['consulta'];
           $sql="SELECT * FROM camara where nombre LIKE :consulta";
           $query = $this->acceso->prepare($sql);
           $query->execute(array(':consulta'=>"%$consulta%")); 
           $this->objetos=$query->fetchall();
           return $this->objetos;
        }
        else{
          $sql="SELECT * FROM camara where nombre NOT LIKE '' ORDER BY id_camara LIMIT 25";
          $query = $this->acceso->prepare($sql);
          $query->execute(); 
          $this->objetos=$query->fetchall();
          return $this->objetos;
        }
    }
   
    function editar($nombre,$id_editado,$numero){
        $sql="UPDATE camara SET nombre=:nombre,numero=:numero where id_camara=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id_editado,':nombre'=>$nombre,':numero'=>$numero));
        echo 'edit';
    }
    function cambiar_logo($id,$nombre){
        $sql="SELECT avatar FROM camara where id_camara=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objetos = $query->fetchall();
      
            $sql="UPDATE camara SET avatar=:nombre where id_camara=:id";
            $query=$this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':nombre'=>$nombre));
        return $this->objetos;
        }
 function borrar($id){
        $sql="DELETE FROM camara where id_camara=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }
        else{
            echo 'no borrado';
        }
    }
function rellenar_camaraes(){
        $sql="SELECT * FROM camara order by nombre asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function buscarmov(){
        if(!empty($_POST['consulta'])){
            $consulta=$_POST['consulta'];
            $sql="SELECT id_faenados,tropa,especie,despieces.despiece as despieces,camara.nombre as camara,garron,id_ingreso FROM `faenados`
            join despieces on faenados.despiece= despieces.codigo
            join camara on camara=id_camara
            where tropa LIKE :consulta and faenados.salio='NO'";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':consulta'=>"%$consulta%")); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
         }
         else{
        $sql="SELECT id_faenados,tropa,especie,despieces.despiece as despieces,camara.nombre as camara,garron,id_ingreso FROM `faenados`
        join despieces on faenados.despiece= despieces.codigo
        join camara on camara=id_camara
        where tropa  not LIKE ' ' and faenados.salio='NO' ORDER BY  id_faenados  asc";
        $query = $this->acceso->prepare($sql);
        $query->execute(); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    }
    function movergarroncamara($ano,$fecha,$tropa,$garron,$camaraorigen,$camaradestino,$despiece,$especie){
        $sql="SELECT id_movimiento FROM movimientocamara where tropa=:tropa and estado='A' and garron=:garron";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':tropa'=>$tropa,':garron'=>$garron)); 
        $this->objetos=$query->fetchall();
        if(!empty($this->objetos)){
            echo 'noadd';
        }
        else{
          echo 'add';
        }
        }
        function movergarroncamara1($ano,$fecha,$tropa,$camaraorigen,$camaradestino,$despiece,$especie,$cantidad){
            $sql="SELECT id_movimiento FROM movimientocamara where tropa=:tropa and estado='A' and garron=:garron";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa,':garron'=>$cantidad)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'noadd';
            }
            else{
              echo ' ';
            }
            }
        function movergarroncamaratoda($ano,$fecha,$tropa,$camaraorigen,$camaradestino,$despiece,$especie){
            $sql="SELECT id_movimiento FROM movcamaratropa where tropa=:tropa and estado='A'";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa)); 
            $this->objetos=$query->fetchall();
            if(!empty($this->objetos)){
                echo 'noadd';
            }
            else{
              echo 'add';
            }
            }
            function datos($id){
                $sql="SELECT camara.nombre as camara,id_ingreso FROM `faenados`
                JOIN camara on camara=id_camara
                WHERE id_faenados=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$id));
                $this->objetos=$query->fetchall();
                return $this->objetos;
               
            }
            function datos_camara($camaradestino){
                $sql="SELECT nombre FROM `camara` WHERE id_camara=:id";
                $query = $this->acceso->prepare($sql);
                $query->execute(array(':id'=>$camaradestino));
                $this->objetos=$query->fetchall();
                return $this->objetos;
               
            }
        function modificarcamara($id,$camaradestino){
            $sql="UPDATE faenados SET camara=:camara where id_faenados=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':camara'=>$camaradestino));
            echo 'edit';
        }
        function mover($ano,$fecha,$tropa,$garron,$camaraorigen,$camaradestino,$despiece,$especie,$id){
            $sql="INSERT INTO movimientocamara(tropa,garron,camaraorigen,camaradestino,despiece,especie,estado,fecha,ano,id_faenados) values (:tropa,:garron,:camaraorigen,:camaradestino,:despiece,:especie,:estado,:fecha,:ano,:id_faenados);";
              $query = $this->acceso->prepare($sql);
              $query->execute(array(':tropa'=>$tropa,':garron'=>$garron,':camaraorigen'=>$camaraorigen,':camaradestino'=>$camaradestino,':despiece'=>$despiece,':especie'=>$especie,':estado'=>'A',':fecha'=>$fecha,':ano'=>$ano,':id_faenados'=>$id));
              echo 'agregado';
        }
        function buscarultimoid($id){
            $sql="SELECT id_movimiento FROM movimientocamara  where id_faenados=:id and estado=:estado";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id,':estado'=>'A'));
            $this->objetos=$query->fetchall();
            return $this->objetos;
           
        }
       
        function cambiarestado($ultimo){
            $sql="UPDATE movimientocamara SET estado=:estado where id_movimiento=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$ultimo,':estado'=>'I'));
            echo 'modificado';
        }
        function verificartropas($tropa){
            $sql="SELECT id_faenados,tropa,especie,despieces.despiece as despieces,camara,garron,peso FROM `faenados`
            join despieces on faenados.despiece= despieces.codigo
            where tropa=:tropa and faenados.salio='NO' ORDER BY garron asc
                     LIMIT 100";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function modificarcamaratoda($cantidad,$camaradestino){
            $sql="UPDATE faenados SET camara=:camara where id_faenados=:id_faenados and salio='NO'";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':camara'=>$camaradestino,':id_faenados'=>$cantidad));
            echo 'edit';
        }
        function movertoda($ano,$fecha,$tropa,$cantidad,$camaraorigen,$camaradestino,$despiece,$especie){
            $sql="INSERT INTO movimientocamara(tropa,garron,camaraorigen,camaradestino,despiece,especie,estado,fecha,ano,id_faenados) values (:tropa,:garron,:camaraorigen,:camaradestino,:despiece,:especie,:estado,:fecha,:ano,:id_faenados);";
              $query = $this->acceso->prepare($sql);
              $query->execute(array(':tropa'=>$tropa,':garron'=>$cantidad,':camaraorigen'=>$camaraorigen,':camaradestino'=>$camaradestino,':despiece'=>$despiece,':especie'=>$especie,':estado'=>'A',':fecha'=>$fecha,':ano'=>$ano,':id_faenados'=>$cantidad));
              echo 'agregado';
        }
        function buscarultimoidtoda($tropa){
            $sql="SELECT max(id_movimiento) as id_movimiento FROM movcamaratropa  where tropa=:tropa and estado=:estado";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':tropa'=>$tropa,':estado'=>'A'));
            $this->objetos=$query->fetchall();
            return $this->objetos;
           
        }
        function cambiarestadotoda($ultimo){
            $sql="UPDATE movcamaratropa SET estado=:estado where id_movimiento=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$ultimo,':estado'=>'I'));
            echo 'modificado';
        }
        function listarcamaras(){
            $sql="SELECT movimientocamara.fecha as fecha,movimientocamara.tropa as tropa,movimientocamara.garron as garron,movimientocamara.camaraorigen as camaraorigen,movimientocamara.camaradestino as camaradestino,movimientocamara.estado as estado,movimientocamara.especie as especie,faenados.fechaetiqueta as vencimiento,curdate() as fechaactual,DATEDIFF(STR_TO_DATE(fechaetiqueta,'%d-%m-%Y'),CURDATE()) as quedan FROM movimientocamara
            JOIN faenados on movimientocamara.id_faenados=faenados.id_faenados
            where faenados.salio='NO' and faenados.ano=year(curdate()) ORDER by movimientocamara.fecha asc";
            $query = $this->acceso->prepare($sql);
            $query->execute(); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function datoscamara_rellenar($id){
            $sql="SELECT nombre FROM camara where id_camara=:id order by nombre asc";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$id)); 
            $this->objetos=$query->fetchall();
            return $this->objetos;
        }
        function bucaridcamaratoda($cantidad){
            $sql="UPDATE movimientocamara SET estado=:estado where id_faenados=:id";
            $query = $this->acceso->prepare($sql);
            $query->execute(array(':id'=>$cantidad,':estado'=>'I'));
            echo 'modificado';
        }
        function crearcamaratoda($cantidad,$garron,$tropa,$camaraorigen,$camaradestino,$despiece,$especie,$fecha,$ano){
            $sql="INSERT INTO movimientocamara(tropa,garron,camaraorigen,camaradestino,despiece,especie,estado,fecha,ano,id_faenados) values (:tropa,:garron,:camaraorigen,:camaradestino,:despiece,:especie,:estado,:fecha,:ano,:id_faenados);";
              $query = $this->acceso->prepare($sql);
              $query->execute(array(':tropa'=>$tropa,':garron'=>$garron,':camaraorigen'=>$camaraorigen,':camaradestino'=>$camaradestino,':despiece'=>$despiece,':especie'=>$especie,':estado'=>'A',':fecha'=>$fecha,':ano'=>$ano,':id_faenados'=>$cantidad));
              echo 'add';
            }
        
}
?>