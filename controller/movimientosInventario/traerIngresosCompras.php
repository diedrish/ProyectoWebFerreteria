<?php

include '../conexion/database.php';
    $sucursal = "1";
    $query = "call listarIngresoCompras('{$sucursal}')";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query Failed' . mysqli_error($connection));
    }

    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'ingreso' => $row['numeroIngreso'],
            'fecha' => $row['fechaCreacion'],
            'proveedor' => $row['proveedor'],
            'documento' => $row['tipoDocumento'],
            'documentoNumero' => $row['numeroDocumento'],
            'total' => $row['totalFactura'],
        );
    }
    $jsonstring=json_encode($json,JSON_UNESCAPED_UNICODE);
    echo $jsonstring;


?>