<?php

    $producto = $_POST['producto'];
    $sucursal = $_POST['sucursal'];
    $cantidad = $_POST['cantidad'];
    

    
    include '../conexion/database.php';
    
    $query = "call buscarExistenciabyId('{$producto}','{$sucursal}')";
    

    $result = mysqli_query($connection, $query);


      

        $fila =  mysqli_fetch_array( $result);
        $cantidadActual=$fila['cantidad'];
        $cantidadNueva=$cantidadActual-$cantidad;
        
    include '../conexion/database.php';
        $query = "call actualizarExistencia('$producto','$cantidadNueva','$sucursal')";

        $result = mysqli_query($connection, $query);

        if(!$result){

            echo "false";

        }else{
            echo "true";
        }
       



    

    

