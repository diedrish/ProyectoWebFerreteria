<?php

include '../conexion/database.php';

$search = $_POST["search"];
$query = "call buscarCategoriabyName('%$search%')";

$result = mysqli_query( $connection, $query );

include '../conexion/database.php';
$json = array(); 
  
while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'idCategoria' => $row['idCategoria'],
        'nombre' => $row['nombre']
    );
}
$jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
echo $jsonstring;

?>
