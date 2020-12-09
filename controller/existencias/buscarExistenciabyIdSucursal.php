<?php

include '../conexion/database.php';

  $id =  $_POST['codigo'];
  $sucursal=$_POST['sucursal'];
  $query = "call buscarExistenciabyId('{$id}','$sucursal')";
    
 
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $cantidad=0;
  while($row = mysqli_fetch_array($result)) {
    $cantidad=$row['cantidad'];
  }

 echo $cantidad;
 

