<?php

include '../conexion/database.php';

$search = $_POST["search"];
$query = "call buscarCuentabyName('%$search%')";

$result = mysqli_query( $connection, $query );

include '../conexion/database.php';
$json = array(); 
  
while($row = mysqli_fetch_array($result)) {
  $json[] = array(
 'id' => $row['idCliente'],
  'nombre' => $row['nombre'],
  'nit' => $row['nit'],
  'dui' => $row['dui'],
  'telefono' => $row['telefono']
  );
}
$jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
echo $jsonstring;

 
?>