<?php

include '../conexion/database.php';

$search = $_POST["search"];
$query = "call buscarDptProductobyName('%$search%')";

$result = mysqli_query( $connection, $query );

include '../conexion/database.php';
$json = array(); 
  
while($row = mysqli_fetch_array($result)) {
  $json[] = array(
    'nombre' => $row['nombreDptProducto'],
    'idDptProducto' => $row['idDptProducto']
  );
}
$jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
echo $jsonstring;

 
?>
