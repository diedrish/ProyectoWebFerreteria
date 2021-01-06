<?php
session_start();
include '../conexion/database.php';

$usr = $_POST['usuario'];
$pwd = $_POST['clave'];

$query = "call validarUsuario('$usr','$pwd')";
$result = mysqli_query($connection, $query);

if (!$result) {
  die('Query Failed' . mysqli_error($connection));
   
  
} else {

  $usuario = mysqli_fetch_array($result);

  $_SESSION['vsCodigo'] = $usuario['idEmpleado'];
  $_SESSION['vsNombre'] = $usuario['nombre'];
  $_SESSION['vsNivel'] = $usuario['nivel'];
  $_SESSION['vsEstado'] = $usuario['estado']; 
  $_SESSION['vsSucursal'] = $usuario['idSucursal']; 
  $_SESSION['menu']="";

  if($usuario['nivel']!=null){

    if ($usuario['nivel'] == 'ADMIN') {
      echo "<script> window.location='../../Vistas/menuSupervisor/menuAdmin.php'; </script>";
      $_SESSION['menu']=' ../menuSupervisor/menuAdmin.php';
    } else if ($usuario['nivel'] == 'VENDEDOR') {
      echo "<script> window.location='../../Vistas/menuVendedor/vendedor.php'; </script>";
      $_SESSION['menu']='../menuVendedor/vendedor.php';
     
    }else if ($usuario['nivel'] == 'BODEGUERO') {
      echo "<script> window.location='../../Vistas/menuBodeguero/bodeguero.php'; </script>";
       $_SESSION['menu']='../menuBodeguero/bodeguero.php';
    }else if ($usuario['nivel'] == 'CAJERA') {
      echo "<script> window.location='../../Vistas/menuCajera/cajera.php'; </script>";
        $_SESSION['menu']='../menuCajera/cajera.php';
    }

  }else{  echo "<script> window.location='../../Vistas/login.php'; </script>";

  }

  mysqli_free_result($result);
  mysqli_close($connection);
}
?>