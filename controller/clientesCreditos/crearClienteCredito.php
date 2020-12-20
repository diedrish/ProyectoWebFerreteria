<?php


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


include '../conexion/database.php';

$query = "call buscarCuentaporCobrarbyId('{$id}')";

$result = mysqli_query($connection, $query);
$filas = mysqli_num_rows($result);

if ($filas > 0) {
    echo "YA EXISTE UN CLIENTE CON ESE ID";

} else {

    include '../conexion/database.php';
        $query = "call crearCuentaporCobrar('$id','$nombre','$dui','$nit','$telefono','$fecha')";
       
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "CLIENTE NO CREADO";

        } else {
            echo "CLIENTE CREADO";
            
      
        }
    }
    

?>