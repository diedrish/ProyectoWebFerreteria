<?php

include '../conexion/database.php';

$search = $_POST["search"];
$query = "call buscarProductobyName('%$search%')";

$result = mysqli_query( $connection, $query );

include '../conexion/database.php';
$json = array(); 
  
while($row = mysqli_fetch_array($result)) {
  $json[] = array(
      'idProducto' => $row['idProducto'],
      'nombre' => $row['descripcion'],
      'precio' => $row['precio'],
      'categoria'=>$row['idCategoria'] 
  );
}
$jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
echo $jsonstring;

 
?>
