<?php


$id = $_POST["id"];
$sucursal = $_POST["sucursal"];
$actual = $_POST["actual"];


    
include '../conexion/database.php';
        $query = "call actualizarActual('$id','$sucursal','$actual')";
       
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "false";

        } else {
            echo "true";

        }

    

?>