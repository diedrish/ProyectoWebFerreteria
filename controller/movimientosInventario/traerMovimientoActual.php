<?php

include '../conexion/database.php';
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sucursal = $_POST['sucursal'];
    $query = "call buscarActual('{$id}','{$sucursal}')";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Query Failed' . mysqli_error($connection));
    }

    $json = array();
    while ($row = mysqli_fetch_array($result)) {
        $json[] = array(
            'actual' => $row['actual'],
        );
    }
    $jsonstring = json_encode($json[0]);
    echo $jsonstring;

}
