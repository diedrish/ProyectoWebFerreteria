<?php

include '../conexion/database.php';

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono=$_POST["telefono"];
$direccion =$_POST["direccion"];


        $query = "call crearProveedor('$nombre','$correo','$telefono','$direccion')";
        
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "PROVEEDOR NO CREADO";

        } else {
            echo "PROVEEDOR CREADO";

        }

    

?>
