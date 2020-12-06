<?php

include '../conexion/database.php';

$id = $_POST["id"];
$nombre = $_POST["nombre"];


    $query = "call buscarCategoriabyId('{$id}')";

    $result = mysqli_query($connection, $query);
    $filas = mysqli_num_rows($result);

    if ($filas > 0) {
        echo "YA EXISTE UNA CATEGORIA CON ESE CODIGO";

    } else {

        include '../conexion/database.php';
        $query = "call crearCategoria('$id','$nombre')";
        
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "CATEGORIA NO CREADA";

        } else {
            echo "CATEGORIA CREADA";

        }

    }

?>