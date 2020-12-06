<?php

include '../conexion/database.php';

date_default_timezone_set("AMERICA/El_Salvador");
$orden= $_POST["orden"];
$producto= $_POST["producto"];
$precio=$_POST["precio"];
$cantidad=$_POST["cantidad"];
$total=$_POST["total"];
$sucursal= $_POST["sucursal"];
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;


include '../conexion/database.php';
$query = "call crearDetalleOrden('$orden','$producto','$precio','$cantidad','$total','$fecha','$sucursal')";
echo $query;
$result = mysqli_query($connection, $query);

if(!$result){
    echo "false";
}else{
    echo "true";
}
