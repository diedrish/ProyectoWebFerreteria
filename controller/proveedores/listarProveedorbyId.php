<?php

include '../conexion/database.php';

if(isset($_POST['id'])) {
  $id =  $_POST['id'];
  $query = "call buscarProveedorbyId('{$id}')";
    
 

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
      'direccion' => $row['direccion'],
      'idProveedor' => $row['idProveedor'],
      'saldo' => $row['saldo']


    );
  }
 $jsonstring= json_encode($json[0]);
 echo $jsonstring;
 
}
