<?php

include '../conexion/database.php';
$id=$_POST["id"];

  $query = "call buscarCategoriabyId('$id')";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array(); 
  
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'idCategoria' => $row['idCategoria'],
        'nombre' => $row['nombre']
    );
  }
  
 $jsonstring= json_encode($json[0]);
 echo $jsonstring;
?>
