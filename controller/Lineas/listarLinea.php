<?php

include '../conexion/database.php';

  $query = "call buscarLinea()";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array(); 
  
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'nombre' => $row['nombreLinea'],
        'idLinea' => $row['idLinea']
    );
  }
  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
?>
