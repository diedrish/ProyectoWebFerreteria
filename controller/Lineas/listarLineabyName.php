<?php

include '../conexion/database.php';

$search = $_POST["search"];
$query = "call buscarLineabyName('%$search%')";

$result = mysqli_query( $connection, $query );

include '../conexion/database.php';
$json = array(); 
  
while($row = mysqli_fetch_array($result)) {
  $json[] = array(
    'nombre' => $row['nombreLinea'],
    'idLinea' => $row['idLinea']
  );
}
$jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
echo $jsonstring;

 
?>
