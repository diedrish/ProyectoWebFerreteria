<?php

include '../conexion/database.php';

$id=$_POST["id"];
$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$direccion = $_POST["direccion"];

$query = "call actualizarProveedor('$id','$nombre','$correo','$telefono','$direccion')";
echo $query;

$result = mysqli_query($connection, $query);

if (!$result) {
    echo "PROVEEDOR NO ACTUALIZADO";

} else {
    echo "PROVEEDOR ACTUALIZADO";

}
