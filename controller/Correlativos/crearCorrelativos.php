<?php

$sucursal=$_SESSION['vsSucursal'];
$doc=$_POST["documento"];
$serie=$_POST["serie"];
$desde=$_POST["desde"];
$hasta=$_POST["hasta"];
$resolucion=$_POST["resolucion"];
$actual=$desde-1;
$fecha=$_POST["fecha"];

            include '../conexion/database.php';

            $query = "call validarSerie('$serie','$doc')";
        
            $result = mysqli_query($connection, $query);
            $filas = mysqli_num_rows($result);
        
            if ($filas > 0) {
              echo "ESTA SERIE YA FUE AGREGADA ANTERIORMENTE";
        
            } else {
                  
                    include '../conexion/database.php';
    
                    $query = "call crearCorrelativos('$doc','$serie','$desde','$hasta','$resolucion','$fecha')";
                    
            
                    $result = mysqli_query($connection, $query);
            
                    if (!$result) {
                        echo "CORRELATIVOS NO AGREGADOS";
            
                    } else {
                        echo "CORRELATIVOS AGREGADOS";
            
                    }
     
            }
        

       

    

?>