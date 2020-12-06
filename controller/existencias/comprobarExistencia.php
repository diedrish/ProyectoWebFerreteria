<?php

include '../conexion/database.php';

    $producto = $_POST['producto'];
    $sucursal = $_POST['sucursal'];
    $cantidad = $_POST['cantidad'];
    $query = "call buscarExistenciabyId('{$producto}','{$sucursal}')";
    

    $result = mysqli_query($connection, $query);

    $contar = mysqli_num_rows( $result);

    if($contar>0){
        $fila =  mysqli_fetch_array( $result );
        $cantidadActual=$fila['cantidad'];
        $cantidadNueva=$cantidadActual+$cantidad;
        
        include '../conexion/database.php';
        
        $query = "call actualizarExistencia('$producto','$cantidadNueva','$sucursal')";

        $result = mysqli_query($connection, $query);

        if(!$result){

            echo "false";

        }else{
            echo "true";
        }



    }else{
        
        include '../conexion/database.php';
        
        $query = "call crearExistencia('$producto','$cantidad','$sucursal')";

        $result = mysqli_query($connection, $query);

        if(!$result){

            echo "false";

        }else{
            echo "true";
        }


    }

    

