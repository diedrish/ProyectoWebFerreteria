<?php

include '../conexion/database.php';

$nombre = $_POST["nombre"];
$empresa = $_POST["empresa"];
$nit=$_POST["nit"];
$nrc =$_POST["nrc"];
$direccion =$_POST["direccion"];
$giro =$_POST["giro"];
$municipio =$_POST["municipio"];


        $query = "call crearCliente('$nombre','$empresa','$nit','$nrc','$direccion','$giro','$municipio')";
        
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "CLIENTE NO CREADO";

        } else {
            echo "CLIENTE CREADO";

        }

    

?>
