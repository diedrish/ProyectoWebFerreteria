<?php

include '../conexion/database.php';
date_default_timezone_set("AMERICA/El_Salvador");
$sucursal=$_SESSION['vsSucursal'];
$orden=$_POST['orden'];
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;

  $query = "call traerOrdenFactura('$orden','$fecha','$sucursal')";

  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array(); 
  
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'orden' => $row['idOrden'],
        'producto' => $row['idProducto'],
        'precio' => $row['precio'],
        'cantidad' => $row['cantidad'],
        'total' => $row['total'],
        'descripcion' => $row['descripcion'],
        'cliente' => $row['nombre']
    );
  }
  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
?>
