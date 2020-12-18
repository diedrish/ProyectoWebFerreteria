<?php

include '../conexion/database.php';
$doc=$_POST["documento"];

date_default_timezone_set("AMERICA/El_Salvador");

  $query = "call traerCorrelativos('$doc')";
  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  } 

  $json = array(); 
  
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'correlativo' => $row['idCorrelativo'],
        'documento' => $row['idDocumento'],
        'serie' => $row['serie'],
        'desde' => $row['desde'],
        'hasta' => $row['hasta']

    );
  }
  $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
  echo $jsonstring;
?>
