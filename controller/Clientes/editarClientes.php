<?php

include '../conexion/database.php';
$id=$_POST["id"];
$nombre = $_POST["nombre"];
$empresa = $_POST["empresa"];
$nit=$_POST["nit"];
$nrc =$_POST["nrc"];
$direccion =$_POST["direccion"];
$giro =$_POST["giro"];
$municipio =$_POST["municipio"];


        $query = "call actualizarCliente('$id','$nombre','$empresa','$nit','$nrc','$direccion','$giro','$municipio')";
        
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "CLIENTE NO ACTUALIZADO";

        } else {
            echo "CLIENTE ACTUALIZADO";

        }

    

?>
