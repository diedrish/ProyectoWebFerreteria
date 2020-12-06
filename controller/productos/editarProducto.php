<?php

$id = $_POST["id"];
$nombre = $_POST["nombre"];
$costo = $_POST["costo"];
$precio=$_POST["precio"];
$categoria =$_POST["categoria"];
$linea=$_POST["linea"];
$familia=$_POST["familia"];
$departamento=$_POST["departamento"];
$imagen = $_FILES["foto"];

    
        if ($imagen["type"] == "image/jpg" or $imagen["type"] == "image/jpeg") {
            $destino = "../../images/productos/" . md5($imagen["tmp_name"]) . ".jpg";
        
            $ruta = "../../images/productos/" . md5($imagen["tmp_name"]) . ".jpg";
            move_uploaded_file($imagen["tmp_name"], $destino);
        
           
                include '../conexion/database.php';
                $query = "call crearProducto('$categoria','$id','$nombre','$linea','$familia',
                '$departamento','$costo','$precio','$ruta')";
        
                $result = mysqli_query($connection, $query);
        
                if (!$result) {
                    echo "PRODUCTO NO ACTUALIZADO";
        
                } else {
                    echo "PRODUCTO ACTUALIZADO";
        
                }
        
            
        } else {
            echo "Seleccione una imagen valida .jpg";
        }

       

    

?>