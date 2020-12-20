<?php

include '../conexion/database.php';
    $sucursal = "1";
    $query = "call listarEgresos('{$sucursal}')";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query Failed' . mysqli_error($connection));
    }

    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'egreso' => $row['numeroIngreso'],
            'fecha' => $row['fechaMovimiento'],
            'estado' => $row['estado'],
            'destino' => $row['destino']
        );
    }
    $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
    echo $jsonstring;


?>