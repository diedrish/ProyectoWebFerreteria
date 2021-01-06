<?php

include '../conexion/database.php';

$id=$_POST["id"];
$nombre = $_POST["nombre"];

$query = "call actualizarLinea('$id','$nombre')";

$result = mysqli_query($connection, $query);

if (!$result) {
    echo "LINEA NO ACTUALIZADO";

} else {
    echo "LINEA ACTUALIZADO";

}
