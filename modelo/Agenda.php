<?php
include 'conexion.php';
class AgendaProfesional{
    var $objetos;
    public function __construct(){
        $db= new Conexion();
        $this->acceso=$db->pdo;
    }
function consultar($usuario){
    $sql="SELECT * FROM `dia` WHERE id_profesional=:id";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':id'=>$usuario)); 
    $this->objetos=$query->fetchAll();
    return $this->objetos;
}
function agregar_agenda($usuario,$titulo,$color,$textcolor,$start,$end,$fecha,$semana){
    $sql="INSERT INTO agenda(title,Descripcion,color,textcolor,start,end,id_usuario,dia)VALUES (:title,:descripcion,:color,:textcolor,:start,:end,:id_usuario,:dia)";
    $query = $this->acceso->prepare($sql);
    $query->execute(array(':title'=>$titulo,':descripcion'=>$fecha,':color'=>$color,':textcolor'=>$textcolor,':start'=>$fecha.' '.$start,':end'=>$fecha.' '.$end,':id_usuario'=>$usuario,':dia'=>$semana)); 
    echo 'guardado';
   
}
function editar_agenda($id,$titulo,$color,$textcolor,$start,$end,$fecha){
    $sql="UPDATE agenda SET title=:title, descripcion=:descripcion,color=:color,textcolor=:textcolor,start=:start,end=:end where id=:id";
        $query = $this->acceso->prepare($sql);
        $variables=array(
            ':id'=>$id,':descripcion'=>$fecha,':color'=>$color,':textcolor'=>$textcolor,':start'=>$fecha.' '.$start,':end'=>$fecha.' '.$end,':title'=>$titulo
        );
        $query->execute($variables); 
        echo 'editado';
    }
    function borrar_agenda($id){
        $sql="DELETE FROM agenda where id=:id";
        $query = $this->acceso->prepare($sql);
        $query->execute(array(':id'=>$id)); 
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'borrado';
        }
        else{
            echo 'no borrado';
        }
       
    }
    function editar_drop($id,$start,$end){
        $sql="UPDATE agenda SET start=:start, end=:end where id=:id";
            $query = $this->acceso->prepare($sql);
            $variables=array(
                ':id'=>$id,':start'=>$start,':end'=>$end
            );
            $query->execute($variables); 
            echo 'editado';
        }
        function confirmar_asistencia($id){
            $sql="UPDATE datosturnos SET asistencia=:asistencia,concurrio=:concurrio,color=:color  where id=:id";
                $query = $this->acceso->prepare($sql);
                $variables=array(
                    ':id'=>$id,':asistencia'=>'ASISTIO',':concurrio'=>-1,':color'=>"4FF383"
                );
                $query->execute($variables); 
                echo 'editado';
            }
            function confirmar_noasistencia($id){
                $sql="UPDATE datosturnos SET asistencia=:asistencia,concurrio=:concurrio,color=:color where id=:id";
                    $query = $this->acceso->prepare($sql);
                    $variables=array(
                        ':id'=>$id,':asistencia'=>'NO ASISTIO',':concurrio'=>-2,':color'=> "#F04DB5"
                    );
                    $query->execute($variables); 
                    echo 'editado';
                }
}
