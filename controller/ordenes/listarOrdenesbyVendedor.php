<?php

include '../conexion/database.php';

session_start();
date_default_timezone_set("AMERICA/El_Salvador");
$sucursal=$_SESSION['vsSucursal'];
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;
$usuario=$_SESSION['vsCodigo'];

  $query = "call buscarOrdenesbyVendedor('$fecha','$sucursal','$usuario')";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  } 

  $json = array(); 
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'orden' => $row['idOrden'],
        'nombre' => $row['nombre'],
        'estado' => $row['estado'],
        'total' => $row['total']

    );
  }
  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
?>
