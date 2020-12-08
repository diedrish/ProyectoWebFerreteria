<?php

include '../conexion/database.php';
$id=$_POST["id"];
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


        $query = "call actualizarCliente('$id','$nombre','$empresa','$nit','$nrc','$direccion','$giro','$municipio','$credito')";
        
        $result = mysqli_query($connection, $query);

        if (!$result) {
            echo "CLIENTE NO ACTUALIZADO";

        } else {
            echo "CLIENTE ACTUALIZADO";
            if($credito==="SI"){

                include '../conexion/database.php';

                $query = "call buscarClienteCuentaporCobrar('{$id}')";
            
                $result = mysqli_query($connection, $query);
                $filas = mysqli_num_rows($result);
            
                if ($filas > 0) {
                    
            
                } else {
                   
                    include '../conexion/database.php'; 
                    
                    $query = "call crearCuentaporCobrar('$id','$fecha')";
                    $result = mysqli_query($connection, $query);
            
            


                }

               }

        }

    

?>
