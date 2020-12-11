<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="shortcut icon" href="#" />
    <!-- BOOTSTRAP 4  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/empresa.css">

    <script>
    var numero = document.getElementById('numero');

    function comprueba(valor) {
        if (valor.value < 0) {
            valor.value = 1;
        }
    }
    </script>

    <title></title>
</head>

<body>

    <img class="wave" src="../../images/wave.png">
    <div class="img">

    </div>

   
    <!-- NAVIGATION  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Egresos de Mercaderia</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <form class="form-inline my-2 my-lg-0">
                    <a href="../Admin/menuAdmin.php" style="color:#FFFFFF;">
                        <img src="../../images/home.jpg" border="0" title="HOME" width="50" height="50">
                    </a>
                </form>
            </ul>
        </div>
    </nav>

    <div class="container">
        <form id="egresos-form">
            <div class="row">
                <div class="form-group col-md-2  ">
                    <label for="egreso">N. Egreso </label>
                    <input type="text" name="egreso" id="egreso" class="form-control" style="width:50%"
                        autocomplete="off" readonly>
                </div>
            </div>

            <div class="row">


                <div class="form-group col-md-3 ">
                    <label for="sucursal">Seleccione una Destino</label>
                    <select name="sucursal" id="sucursal" class="custom-select">

                    </select>
                </div>

            </div>

            <div class="row">

                <div class="form-group col-md-2 ">
                    <label for="codigo">CODIGO</label>
                    <input type="text" name="idProducto" id="idProducto" placeholder="Codigo  Producto"
                        class="form-control" autocomplete="off">
                </div>

                <div class=" form-group col-md-1">
                    <label for="add">Buscar</label>
                    <button type="button" id="btnBuscar" class="btn btn-info btn-md ">
                        Buscar
                    </button>

                </div>

                <div class="form-group col-md-4 ">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" name="descripcion" id="descripcion" placeholder="Nombre del Producto"
                        class="form-control" required autocomplete="off" readonly>
                </div>

                

                <div class="form-group col-md-2 ">
                    <label for="cantidad">CANTIDAD</label>
                    <input type="number" name="cantidad" id="cantidad" placeholder="cantidad" class="form-control"
                        autocomplete="off"  onkeypress="comprueba(this)" min="1" pattern="^[0-9]+">
                </div>

                <div class=" form-group col-md-1">
                    <label for="add">ADD</label>
                    <button type="button" id="btnAdd" class="btn btn-success btn-md ">
                        +
                    </button>

                </div>

            </div>

            <div class="row">
                <!-- TABLE  -->
                <div class="col-md-12">
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <td>Codigo</td>
                                <td>Descripcion del Producto</td>
                                <td>Cantidad</td>
                            </tr>
                        </thead>
                        <tbody id="tbDetalle">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 justify-content-center d-flex">
                    <button type="button" id="btnGuardar" class="btn btn-primary btn-lg active text-center">
                        Guardar
                    </button>
                    &nbsp;
                    <button type="button" id="btnCancelar" class="btn btn-danger btn-lg active text-center"
                        value="Cancelar">
                        Cancelar
                    </button>
                </div>

            </div>


        </form>


    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Frontend Logic -->
    <script src="../../js/movimientosInventario.js"></script>
</body>

</html>