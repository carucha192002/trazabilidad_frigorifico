<?php
session_start();
header('Content-Type: application/json');
$atributos=[PDO::ATTR_CASE=>PDO::CASE_LOWER,PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_ORACLE_NULLS=>PDO::NULL_EMPTY_STRING,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ];
$pdo=new PDO("mysql:dbname=matadero;host=localhost","root","",$atributos);
$sql = $pdo->prepare("SELECT * FROM `agenda` order by start asc");

$sql->execute();
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($result);
?>