<?php

include '../conexion/database.php';

$nombre = $_POST["nombre"];
$empresa = $_POST["empresa"];
$nit=$_POST["nit"];
$nrc =$_POST["nrc"];
$direccion =$_POST["direccion"];
$giro =$_POST["giro"];
$municipio =$_POST["municipio"];
$credito =$_POST["credito"];
date_default_timezone_set("AMERICA/El_Salvador");
$anio = date("Y");
$mes = date("m");
$dia = date("d");
$fecha=$anio."-".$mes."-".$dia;


        $query = "call crearCliente('$nombre','$empresa','$nit','$nrc','$direccion','$giro','$municipio','$credito')";
        
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "CLIENTE NO CREADO";

        } else {
            echo "CLIENTE CREADO";
            
       if($credito==="SI"){
        $query = "call buscarClienteNrc('{$nrc}')";
        
        $result = mysqli_query($connection, $query);
        $idCliente="";
       
        while($row = mysqli_fetch_array($result)) {
        
           $idCliente= $row['idCliente'];
           
        
        }


        include '../conexion/database.php'; 
        
        $query = "call crearCuentaporCobrar('$idCliente','$fecha')";
        $result = mysqli_query($connection, $query);


       }
        }

    

?>