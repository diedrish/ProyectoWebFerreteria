<?php

include '../conexion/database.php';

$sucursal=$_POST["sucursal"];
  $query = "call traerSucursales('$sucursal')";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array(); 
  
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'id' => $row['idSucursal'],
        'nombre' => $row['nombre']
    );
  }
  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
?>
