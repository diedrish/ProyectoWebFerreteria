<?php

include '../conexion/database.php';

if(isset($_POST['id'])) {
  $id =  $_POST['id'];
  $query = "call buscarProductobyId('{$id}')";
    
 

  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
        'idProducto' => $row['idProducto'],
        'nombre' => $row['descripcion'],
        'precio' => $row['precio'],
        'costo' => $row['costo'],
        'categoria'=>$row['idCategoria'],
        'linea' => $row['linea'], 
        'familia' => $row['familia'],
        'departamento' => $row['departamento'],
        'foto' => $row['imagen']
    );
  }
 $jsonstring= json_encode($json[0]);
 echo $jsonstring;
 
}
