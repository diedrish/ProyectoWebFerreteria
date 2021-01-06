<?php

include '../conexion/database.php';

  $query = "call buscarProducto()";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array(); 
  
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'idProducto' => $row['idProducto'],
        'nombre' => $row['descripcion'],
        'precio' => $row['precio'],
        'categoria'=>$row['idCategoria'],
        'foto'=>$row['imagen'] 
    );
  }
  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
?>
