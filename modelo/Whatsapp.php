<?php
include_once 'conexion.php';
class Whatsapp{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
    function datos_extras_mail($id){
        $sql="SELECT matarife FROM `ingresos` WHERE id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function datos_extras_mail_correo($id){
        $sql="SELECT matarife FROM `ingresos` WHERE id_ingresos=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function datos_extras($id){
        $sql="SELECT usuario.email_us as email, concat(usuario.nombre_us,' ',apellidos_us)as nombre,usuario.avatar as avatar,direccion.nombre as direccion,secretaria.nombre as secretaria FROM `venta` 
        JOIN usuario on vendedor=id_usuario
        JOIN direccion on usuario.direccion_dir=id_direccion
        JOIN secretaria on usuario.secretariaus=id_secretaria
        WHERE id_venta=:id_venta";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id_venta'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }
    function datoswhatsapp($id){
        $sql="SELECT @ROW := @ROW + 1 as ID,especies.nombre as especie, subespeces.nombre as subespecies, concat(matarife.nombre,'__',submatarife.nombre) as matarife,guia,numtropas,ingresos.cantidad as cantidad, usuario.telefono_us as telefono FROM ingresos
        JOIN especies on especie=id_especies_sub
        JOIN subespeces on subespecie=id_subespecies
        JOIN matarife on ingresos.matarife=matarife.id_matarife
        JOIN usuario on matarife=usuario.id_matarife
        JOIN submatarife on matarifesub_item=id_submatarife
        join (SELECT @ROW := 0) t2
        WHERE ingresos.etapa='FINALIZADO' and id_ingresos=:id GROUP by(ingresos.id_ingresos)";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        $this->objetos=$query->fetchall();
        return $this->objetos;
    }

  
}