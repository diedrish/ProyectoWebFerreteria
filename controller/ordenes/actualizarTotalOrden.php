<?php

include '../conexion/database.php';

date_default_timezone_set("AMERICA/El_Salvador");
$orden= $_POST["orden"];
$total=$_POST["totalOrden"];
$sucursal= "1";
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;


include '../conexion/database.php';
$query = "call actualizartotalorden($orden','$fecha','$sucursal','$total')";

$result = mysqli_query($connection, $query);

if(!$result){
    echo "false";
}else{
    echo "true";
}
