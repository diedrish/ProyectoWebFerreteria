

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <!-- BOOTSTRAP 4  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> <link rel="stylesheet" type="text/css" href="../../css/empresa.css">

  
</head>

<body>
   
<img class="wave" src="../../images/wave.png">
    <div class="img">

    </div>

   
    <!-- NAVIGATION  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Gestion de Proveedores</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <form class="form-inline my-2 my-lg-0">
                    <input name="search" id="search" class="form-control mr-sm-2" autocomplete="off" type="search"
                        placeholder="Buscar por nombre" aria-label="Search">
                     <a href="../Admin/menuAdmin.php" style="color:#FFFFFF;">
                      <img src="../../images/home.jpg" border="0" title="HOME" width="50" height="50">
                     </a>
                </form>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row p-4">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <!-- FORM TO ADD TASKS -->
                        <form id="proveedores-form">
                        <div class="form-group">
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre del Proveedor" maxlength="200" class="form-control" autocomplete="off" required>
                            </div> 
                            <div class="form-group">
                                <input type="email" name="correo" id="correo" placeholder="Correo del Proveedor" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <input type="text" name="telefono" id="telefono" placeholder="Telefono del Proveedor" class="form-control" autocomplete="off" maxlength="15" required>
                            </div>
                            <div class="form-group">
                            ​<textarea id="direccion" name="direccion" rows="10" cols="50" placeholder="Direccion del Proveedor" autocomplete="off" maxlength="300" required ></textarea>
                            </div>
                           
                            <center>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg active text-center" >
                                        Guardar
                                    </button>
                                    <button type="button" id="btnCancelar" class="btn btn-danger btn-lg active text-center" value="Cancelar">
                                        Cancelar
                                    </button>
                                </div>
                            </center>
                        </form>
                    </div>
                </div>
            </div>

            <!-- TABLE  -->
            <div class="col-md-7">


                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <td>Id</td>
                            <td>Nombre Proveedor</td>
                            <td>Correo</td>
                            <td>Telefono</td>
                        </tr>
                    </thead>
                    <tbody id="tbProveedores">
                      

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Frontend Logic -->
    <script src="../../js/proveedores.js"></script>
</body>

</html>