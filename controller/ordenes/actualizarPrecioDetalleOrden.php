<?php

include '../conexion/database.php';

date_default_timezone_set("AMERICA/El_Salvador");
$orden= $_POST["orden"];
$producto= $_POST["id"];
$precio=$_POST["precio"];
$cantidad=$_POST["cantidad"];
$total=$_POST["total"];
$sucursal= "1";
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;


include '../conexion/database.php';
$query = "call actualizarPrecioOrden('$producto','$orden','$fecha','$sucursal','$precio','$cantidad','$total')";
echo $query;
$result = mysqli_query($connection, $query);

if(!$result){
    echo "false";
}else{
    echo "true";
}
