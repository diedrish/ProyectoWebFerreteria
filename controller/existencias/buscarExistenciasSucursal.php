<?php

include '../conexion/database.php';

$producto=$_POST["id"];

  $query = "call buscarExistenciaSucursales('$producto')";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array(); 
  
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'idProducto' => $row['idProducto'],
        'nombre' => $row['nombre'],
        'cantidad' => $row['cantidad'],
        'descripcion' => $row['descripcion']
    );
  }
  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
?>
