<?php

include '../conexion/database.php';

date_default_timezone_set("AMERICA/El_Salvador");
$correlativo= $_POST["correlativo"];
$documento= $_POST["documento"];
$numerodoc= $_POST["numerodoc"];
$cliente= $_POST["cliente"];
$nrc= $_POST["nrc"];
$nit= $_POST["nit"];
$giro= $_POST["giro"];
$tipofactura= $_POST["tipoFactura"];
$sumas= $_POST["sumas"];
$iva= $_POST["iva"];
$subtotal= $_POST["subtotal"];
$retencion= $_POST["retencion"];
$totalfinal= $_POST["totalFinal"];
$orden= $_POST["orden"];
$estado= "FACTURADO";
$sucursal="1";
$usuario="1";
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;


include '../conexion/database.php';
$query = "call crearFactura('$correlativo','$documento','$numerodoc','$cliente','$nrc','$nit','$giro','$tipofactura','$sumas','$iva','$subtotal','$retencion','$totalfinal','$orden','$fecha','$estado','$usuario','$sucursal')";

$result = mysqli_query($connection, $query);

if(!$result){
    echo "false";
}else{
    echo "true";

    
include '../conexion/database.php';
$query = "call FacturarOrdenEstado('$orden','$fecha','$sucursal')";

$result = mysqli_query($connection, $query);

if(!$result){
    echo "false";
}else{
    echo "true";
}

}