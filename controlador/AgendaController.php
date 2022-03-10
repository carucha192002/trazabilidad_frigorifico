<?php
include_once '../modelo/Agenda.php';
$agendaprofesional = new AgendaProfesional();
session_start();

if($_POST['funcion']=='agregar_agenda'){
    $usuario =$_SESSION['usuario'];
    $titulo=$_POST['titulo'];
    $color=$_POST['color'];
    $textcolor=$_POST['textcolor'];
    $start=$_POST['start'];
    $end=$_POST['end'];
    $fecha=$_POST['fecha'];
    $semana=$_POST['semana'];
    $agendaprofesional->agregar_agenda($usuario,$titulo,$color,$textcolor,$start,$end,$fecha,$semana);
}
if($_POST['funcion']=='consultar'){
    $usuario =$_SESSION['usuario'];
    $agendaprofesional->consultar($usuario);
    $json=array();
    foreach ($agendaprofesional->objetos as $objeto) {
        $json[]=array(
            'id'=>$objeto->id,
            'titulo'=>$objeto->titulo,
            'dia'=>$objeto->dia,
            'entre'=>$objeto->entre,
            'hasta'=>$objeto->hasta,
            'intervalo'=>$objeto->intervalo,
            'id_prof'=>$objeto->id_profesional,
            'horario'=>$objeto->horario,
            'color'=>$objeto->color
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='editar_agenda'){
    $id =$_POST['id'];
    $titulo=$_POST['titulo'];
    $color=$_POST['color'];
    $textcolor=$_POST['textcolor'];
    $start=$_POST['start'];
    $end=$_POST['end'];
    $fecha=$_POST['fecha'];
    $agendaprofesional->editar_agenda($id,$titulo,$color,$textcolor,$start,$end,$fecha);
}
if($_POST['funcion']=='borrar_agenda'){
    $id =$_POST['id'];
    $agendaprofesional->borrar_agenda($id);
}
if($_POST['funcion']=='editar_drop'){
    $id=$_POST['id'];
    $start=$_POST['start'];
    $end=$_POST['end'];
    $agendaprofesional->editar_drop($id,$start,$end);
    
 }
 if($_POST['funcion']=='confirmar_asistencia'){
    $id=$_POST['id'];
    $agendaprofesional->confirmar_asistencia($id);
}
if($_POST['funcion']=='confirmar_noasistencia'){
    $id=$_POST['id'];
    $agendaprofesional->confirmar_noasistencia($id);
}