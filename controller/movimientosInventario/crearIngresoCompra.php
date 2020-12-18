<?php

include '../conexion/database.php';

$id= $_POST["id"];
$movimiento = $_POST["movimiento"];
$numero = $_POST["numero"];
$proveedor = $_POST["proveedor"];
$tipodoc = $_POST["tipodoc"];
$numerodoc = $_POST["numerodoc"];
$fechadoc = $_POST["fechadoc"];
$estadodoc = $_POST["estadodoc"];
$estadoingreso = $_POST["estadoingreso"];
date_default_timezone_set("AMERICA/El_Salvador");
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;
$total = $_POST["total"];
$sucursal = $_POST["idSucursal"];

include '../conexion/database.php';
$query = "call crearIngresoCompra('$id','$movimiento','$numero','$proveedor',
'$tipodoc','$numerodoc','$fechadoc','$estadodoc','$estadoingreso','$fecha','$total','$sucursal')";

$result = mysqli_query($connection, $query);

if(!$result){
    echo "false";
}else{
    echo "true";
}
