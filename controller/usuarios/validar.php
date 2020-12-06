<?php
session_start();
include '../conexion/database.php';

$usr = $_POST['usuario'];
$pwd = $_POST['clave'];
echo $usr;
echo $pwd;

$query = "call validarUsuario('$usr','$pwd')";
$result = mysqli_query($connection, $query);

if (!$result) {
  die('Query Failed' . mysqli_error($connection));
    header("location:../../Vistas/error.html");
  
} else {

  $usuario = mysqli_fetch_array($result);

  $_SESSION['vsCodigo'] = $usuario['idUsuario'];
  $_SESSION['vsNombre'] = $usuario['nombreUsuario'];
  $_SESSION['vsNivel'] = $usuario['nivelUsuario'];
  $_SESSION['vsEstado'] = $usuario['estadoUsuario'];

  if ($usuario['nivelUsuario'] == 'A') {
    header("location:../../Vistas/Admin/menuAdmin.php");
  } else {
    header("location:../../Vistas/clientes/menuCliente.php");
  }
  mysqli_free_result($result);
  mysqli_close($connection);
}
?>