<?php

include '../conexion/database.php';
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$nit=$_POST["nit"];
$telefono =$_POST["telefono"];
$dui =$_POST["dui"];
date_default_timezone_set("AMERICA/El_Salvador");
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;


        $query = "call actualizarCuentaPorCobrar('$id','$nombre','$dui','$nit','$telefono')";
        
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "CLIENTE NO ACTUALIZADO";

        } else {
            echo "CLIENTE ACTUALIZADO";
            

        }

    

?>
