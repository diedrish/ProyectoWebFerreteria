<?php

include '../conexion/database.php';

if(isset($_POST['id'])) {
  $id =  $_POST['id'];
  $query = "call buscarLineabyId('{$id}')";
    
 

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
 $jsonstring= json_encode($json[0]);
 echo $jsonstring;
 
}
