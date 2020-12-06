<?php

include '../conexion/database.php';

date_default_timezone_set("AMERICA/El_Salvador");
$orden= $_POST["orden"];
$nombre= $_POST["nombre"];
$estado="PENDIENTE";
$sucursal= $_POST["sucursal"];
$total=$_POST["total"];
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;
$usuario="1";


include '../conexion/database.php';
$query = "call crearOrden('$orden','$nombre','$estado','$sucursal','$fecha','$total','$usuario')";

$result = mysqli_query($connection, $query);

if(!$result){
    echo "false";
}else{
    echo "true";
}
