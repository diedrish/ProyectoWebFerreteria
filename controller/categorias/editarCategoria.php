<?php

include '../conexion/database.php';

$id = $_POST["id"];
$nombre = $_POST["nombre"];


    
include '../conexion/database.php';
        $query = "call actualizarCategoria('$id','$nombre')";
       
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "CATEGORIA NO ACTUALIZADA";

        } else {
            echo "CATEGORIA  ACTUALIZADA";

        }

    

?>