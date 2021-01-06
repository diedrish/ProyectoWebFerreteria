<?php

include '../conexion/database.php';

$id=$_POST["id"];
$nombre = $_POST["nombre"];

$query = "call actualizarFamilia('$id','$nombre')";

$result = mysqli_query($connection, $query);

if (!$result) {
    echo "FAMILIA NO ACTUALIZADO";

} else {
    echo "FAMILIA ACTUALIZADO";

}
