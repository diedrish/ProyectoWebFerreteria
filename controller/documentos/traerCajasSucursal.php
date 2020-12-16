<?php

include '../conexion/database.php';
$sucursal=$_POST['sucursal'];

date_default_timezone_set("AMERICA/El_Salvador");

  $query = "call traerCajasSucursales('$sucursal')";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  } 

  $json = array(); 
  
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'caja' => $row['idNumCaja'],
    );
  }
  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
?>
