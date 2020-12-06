<?php


$id=$_POST["id"];
$nuevosaldo = $_POST["saldo"];

include '../conexion/database.php';
$query = "call buscarProveedorbyId('$id')";
$result = mysqli_query($connection, $query);
$fila =  mysqli_fetch_array( $result );
        $saldoactual=$fila['saldo'];
        $saldonuevo=$saldoactual+$nuevosaldo;

      
        
include '../conexion/database.php';
$query = "call actualizarSaldo('$id','$saldonuevo')";
$result = mysqli_query($connection, $query);

if (!$result) {
    echo "false";

} else {
    echo "true";

}