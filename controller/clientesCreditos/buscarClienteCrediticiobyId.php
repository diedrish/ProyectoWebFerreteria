<?php

include '../conexion/database.php';

if(isset($_POST['id'])) {
  $id =  $_POST['id'];
  $query = "call buscarCuentaporCobrarbyId('{$id}')";
    
 

  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'id' => $row['idCliente'],
      'nombre' => $row['nombre'],
      'dui' => $row['dui'],
      'nit' => $row['nit'],
      'telefono' => $row['telefono']

    );
  }
 $jsonstring= json_encode($json[0]);
 echo $jsonstring;
 
}
