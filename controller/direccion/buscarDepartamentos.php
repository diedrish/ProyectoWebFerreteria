<?php

include '../conexion/database.php';

  $query = "call buscarDepartamentos();";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array(); 
  
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'departamento' => $row['idDepartamento'],
        'nombre' => $row['nombre']
    );
  }

  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
?>
