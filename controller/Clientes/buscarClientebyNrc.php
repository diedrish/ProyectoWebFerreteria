<?php

include '../conexion/database.php';

if(isset($_POST['id'])) {
  $id =  $_POST['id'];
  $query = "call buscarClienteNrc('{$id}')";
    
 

  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'nombre' => $row['nombre'],
      'nit' => $row['nit'],
      'nrc' => $row['nrc'],
      'giro' => $row['giro']


    );
  }
 $jsonstring= json_encode($json[0]);
 echo $jsonstring;
 
}
