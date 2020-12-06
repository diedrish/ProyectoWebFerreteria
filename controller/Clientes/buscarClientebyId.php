<?php

include '../conexion/database.php';

if(isset($_POST['id'])) {
  $id =  $_POST['id'];
  $query = "call buscarClientebyId('{$id}')";
    
 

  $result = mysqli_query($connection, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($connection));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'nombre' => $row['nombreempresa'],
      'empresa' => $row['tipoEmpresa'],
      'nit' => $row['nit'],
      'nrc' => $row['nrc'],
      'direccion' => $row['direccion'],
      'giro' => $row['giro'],
      'departamento' => $row['idDepartamento'],
      'municipio' => $row['idMunicipio']


    );
  }
 $jsonstring= json_encode($json[0]);
 echo $jsonstring;
 
}
