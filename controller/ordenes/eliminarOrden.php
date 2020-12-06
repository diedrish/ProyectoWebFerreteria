<?php


date_default_timezone_set("AMERICA/El_Salvador");
$orden= $_POST["orden"];
$sucursal= "1";
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;


include '../conexion/database.php';
$query = "call eliminarDetalleOrden('$orden','$fecha','$sucursal')";


$result = mysqli_query($connection, $query);

if(!$result){
    echo "false";
}else{
    include '../conexion/database.php';
    
$query = "call eliminarOrden('$orden','$fecha','$sucursal')";

    $result = mysqli_query($connection, $query);
    echo "true";
}