<?php

include '../conexion/database.php';

$nombre = $_POST["nombre"];


        $query = "call crearLinea('$nombre')";
        
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "LINEA NO CREADO";

        } else {
            echo "LINEA CREADO";

        }

    

?>
