<?php

include '../conexion/database.php';

date_default_timezone_set("AMERICA/El_Salvador");
$id= $_POST["id"];
$movimiento = $_POST["movimiento"];
$numero = $_POST["numero"];
$estadoEgreso = $_POST["estadoEgreso"];
$salida = $_POST["salida"];
$destino = $_POST["destino"];
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;
$sucursal = $_POST["sucursal"];
$copia = $_POST["copia"];

include '../conexion/database.php';
$query = "call crearMovimientoSalida('$id','$movimiento','$numero','$fecha',
'$salida','$destino','$copia','$estadoEgreso','$sucursal')";

$result = mysqli_query($connection, $query);

if(!$result){
    echo "false";
}else{
    echo "true";
}
