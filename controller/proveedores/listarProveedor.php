<?php

include '../conexion/database.php';

  $query = "call buscarProveedor()";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array(); 
  
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'nombre' => $row['nombre'],
        'telefono' => $row['telefono'],
        'correo' => $row['correo'],
        'idProveedor' => $row['idProveedor']
    );
  }
  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
?>
