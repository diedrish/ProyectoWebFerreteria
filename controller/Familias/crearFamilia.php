<?php

include '../conexion/database.php';

$nombre = $_POST["nombre"];


        $query = "call crearFamilia('$nombre')";
        
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "FAMILIA NO CREADO";

        } else {
            echo "FAMILIA CREADO";

        }

    

?>
