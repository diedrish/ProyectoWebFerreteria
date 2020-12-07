<?php

include '../conexion/database.php';

  $sucursal = "1";
  $caja="1";
  $documento=$_POST["documento"];
  $query = "call traercorrelativofactura('{$sucursal}','$caja','$documento')";
    
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'actual' => $row['actual']
        
    );
  }
 $jsonstring= json_encode($json[0]);
 echo $jsonstring;
 

