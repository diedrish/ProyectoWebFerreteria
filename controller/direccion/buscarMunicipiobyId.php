<?php

include '../conexion/database.php';

  $id =  $_POST['id'];
  $query = "call buscarMunicipiobyId('{$id}')";
    
 

  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'municipio' => $row['idMunicipio'],
        'nombre' => $row['nombre']
    );
  }
  
  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
 
?>
