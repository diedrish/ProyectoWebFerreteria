<?php

include '../conexion/database.php';

  $query = "call buscarFamilia()";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array(); 
  
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'nombre' => $row['nombreFamilia'],
        'idFamilia' => $row['idFamilia']
    );
  }
  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
?>
