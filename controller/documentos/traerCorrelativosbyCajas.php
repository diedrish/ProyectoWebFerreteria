<?php

include '../conexion/database.php';
$sucursal=$_POST["sucursal"];
$caja=$_POST["caja"];

date_default_timezone_set("AMERICA/El_Salvador");

  $query = "call traerCorrelativoscaja('$sucursal','$caja')";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  } 

  $json = array(); 
  
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'correlativo' => $row['idCorrelativo'],
        'documento' => $row['idDocumento'],
        'serie' => $row['serie'],
        'desde' => $row['desdecaja'],
        'hasta' => $row['hastacaja'],
        'actual' => $row['actualcaja'],
        'caja' => $row['idNumCaja']

    );
  }
  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
?>
