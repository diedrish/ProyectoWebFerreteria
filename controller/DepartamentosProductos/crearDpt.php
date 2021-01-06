<?php

include '../conexion/database.php';

$nombre = $_POST["nombre"];


        $query = "call crearDptProducto('$nombre')";
        
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "DEPARTAMENTO NO CREADO";

        } else {
            echo "DEPARTAMENTO CREADO";

        }

    

?>
