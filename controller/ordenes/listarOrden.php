<?php

include '../conexion/database.php';

date_default_timezone_set("AMERICA/El_Salvador");
$sucursal=$_SESSION['vsSucursal'];
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;
  
    $query = "call buscarOrdenActual('$fecha','$sucursal')";
   

    $json = array();
    $result = mysqli_query($connection, $query);
 

        while($row = mysqli_fetch_array($result)) {
            $json[] = array(
              'orden' => $row['idOrden']
            );
          }

       $jsonstring= json_encode($json[0]);
        echo $jsonstring;

    