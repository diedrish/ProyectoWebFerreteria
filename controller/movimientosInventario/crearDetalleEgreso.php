<?php

include '../conexion/database.php';

$id = $_POST["id"];
$movimiento = $_POST["movimiento"];
$numero = $_POST["numero"];
$producto = $_POST["producto"];
$precio = $_POST["precio"];
$cantidad = $_POST["cantidad"];
$total = $_POST["total"];
$sucursal = $_POST["sucursal"];

include '../conexion/database.php';
$query = "call crearDetalleSalida('$id','$movimiento','$numero','$producto','$precio','$cantidad','$total','$sucursal')";

$result = mysqli_query($connection, $query);

if(!$result){
    echo "false";
}else{
    echo "true";
}

?>