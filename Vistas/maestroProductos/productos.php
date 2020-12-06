
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="shortcut icon" href="#" />
    <!-- BOOTSTRAP 4  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/empresa.css">

    <title></title>
</head>

<body>

    <img class="wave" src="../../images/wave.png">
    <div class="img">

    </div>

    <!-- NAVIGATION  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Gestion de Productos</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <form class="form-inline my-2 my-lg-0">
                    <input name="search" id="search" class="form-control mr-sm-2" autocomplete="off"  placeholder="Buscar por Nombre" aria-label="Search">
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
                        <form id="productos-form" enctype="multipart/form-data">
                        <div class="form-group">
                                <label for="categoria">Seleccione una Categoria</label>
                                <select name="categoria" id="categoria" class="custom-select">

                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="id" id="id" placeholder="Codigo del Producto" maxlength="30" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre del Producto" maxlength="200" class="form-control" autocomplete="off" required>
                            </div> 
                            <div class="form-group">
                                <input type="text" name="linea" id="linea" placeholder="linea del Producto" class="form-control" autocomplete="off" required>
                            </div> <div class="form-group">
                                <input type="text" name="familia" id="familia" placeholder="Familia del producto" class="form-control" autocomplete="off" required>
                            </div> <div class="form-group">
                                <input type="text" name="departamento" id="departamento" placeholder="Departamento del Producto" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="costo" id="costo" placeholder="Costo del Producto" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="precio" id="precio" placeholder="Precio del Producto" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label>IMAGEN PRODUCTO:</label> <input type="file" id="foto" name="foto">
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
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <td>Codigo</td>
                            <td>Descripcion del Producto</td>
                            <td>Precio</td>
                        </tr>
                    </thead>
                    <tbody id="tbProductos">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Frontend Logic -->
    <script src="../../js/productos.js"></script>
</body>

</html>
