<?php

include '../conexion/database.php';

$id=$_POST["id"];
$nombre = $_POST["nombre"];

$query = "call actualizarDptProducto('$id','$nombre')";

$result = mysqli_query($connection, $query);

if (!$result) {
    echo "DEPARTAMENTO NO ACTUALIZADO";

} else {
    echo "DEPARTAMENTO ACTUALIZADO";

}
