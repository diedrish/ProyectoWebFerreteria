<?php

$sucursal="1";
$caja=$_POST["caja"];
$doc=$_POST["documento"];
$correlativo="";
$serie=$_POST["serie"];
$desde=$_POST["desde"];
$hasta=$_POST["hasta"];
$actual="0";

date_default_timezone_set("AMERICA/El_Salvador");

            include '../conexion/database.php';

            $query = "call validarSerie('$serie','$doc')";
        
            $result = mysqli_query($connection, $query);
            $filas = mysqli_num_rows($result);
        
            if ($filas > 0) {
                //
                             while($row = mysqli_fetch_array($result)) {
                             $correlativo= $row['idCorrelativo'];
                           }


               //si hay una serie asi que comprobamos que no se halla agregado
               include '../conexion/database.php';

               $queryD = "call validarDocumentoCaja('$doc','$correlativo','$caja','$sucursal')";
               

               $resultD = mysqli_query($connection, $queryD);
               $filasD = mysqli_num_rows($resultD);
           
               if ($filasD > 0) {
                    //YA SE REGISTRO ESE DOCUEMNTO Y ESA SERIE EN LA CAJA Y LA SUCURSAL
                    
                      echo "YA SE INGRESO ANTERIORMENTE ESA SERIE DE FACTURAS Y ESE DOCUMENTO A LA CAJA SELECCIONADA";

               }else{

                include '../conexion/database.php';

                $query = "call crearCorrelativosCajas('$correlativo','$caja','$desde','$hasta','$actual','ACTIVO','$doc','$sucursal')";
                echo 
        
                $result = mysqli_query($connection, $query);
        echo $query;
                if (!$result) {
                    echo "CORRELATIVOS NO AGREGADOS";
        
                } else {
                    echo "CORRELATIVOS AGREGADOS";
        
                }



               }



        
            } else {
        
        echo "LA SERIE INGRESADA NO EXISTE EN LA EMPRESA";
            }
        

       

    

?>