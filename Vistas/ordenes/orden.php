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

       <style>
    .my-custom-scrollbar {
        position: relative;
        height: 500px;
        overflow: auto;
    }

    .my-custom-scrollbarDos {
        position: relative;
        height: 200px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }
    </style>


    <title></title>
</head>

<body>

    <img class="wave" src="../../images/wave.png">
    <div class="img">

    </div>


    <!-- NAVIGATION  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Prefacturacion</a>
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

    <div class="col-md-12">
        <div class="row lg-12" style="padding: 10px;">

            <!-- TABLE  -->
            <div class="table-wrapper-scroll-y my-custom-scrollbar col-sm-4">
                <table class="table table-bordered table-striped mb-0 col-sm-4 ">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Cliente</td>
                            <td>Estado</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody id="tbOrdenes">
                    </tbody>
                </table>
            </div>

            <div class="col-md-8">
                <form id="orden-form">

                    <div class="row" style="padding: 10px;">
                        <div class="form-group col-md-2 ">
                            <label for="orden">Num. Orden</label>

                        </div>
                        <div class="form-group col-md-2 justify-content-left d-flex ">
                            <input type="text" name="orden" readonly id="orden" class="form-control" autocomplete="off">

                        </div>
                        <div class="form-group col-md-2 ">
                            <label for="orden">Total Actual</label>

                        </div>
                        <div class="form-group col-md-2 justify-content-left d-flex ">
                            <input type="text" name="totalFinal" readonly id="totalFinal" class="form-control"
                                autocomplete="off">

                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-md-2 ">
                            <label for="nombre">A nombre de :</label>

                        </div>
                        <div class="form-group col-md-10 ">

                            <input type="text" name="nombre" required id="nombre" placeholder="Nombre de Cliente"
                                class="form-control" required autocomplete="off">
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
                                <img src="../../images/iconos/buscar.png" border="0" width="16" height="16">
                            </button>

                        </div>

                        <div class="form-group col-md-4 ">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" name="descripcion" id="descripcion" placeholder="Nombre del Producto"
                                class="form-control" required autocomplete="off" readonly>
                        </div>

                        <div class="form-group col-md-2 ">
                            <label for="precio">PRECIO</label>
                            <input type="text" name="precio" readonly id="precio" placeholder="precio"
                                class="form-control" autocomplete="off">
                        </div>

                        <div class="form-group col-md-2 ">
                            <label for="cantidad">CANTIDAD</label>
                            <input type="number" name="cantidad" id="cantidad" placeholder="cantidad"
                                class="form-control" autocomplete="off" onkeypress="comprueba(this)" min="1"
                                pattern="^[0-9]+">
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
                        <div class="table-wrapper-scroll-y my-custom-scrollbarDos col-md-12">
                            <table class="table table-bordered table-striped mb-0 ">
                                <thead>
                                    <tr>
                                        <td>Codigo</td>
                                        <td>Descripcion del Producto</td>
                                        <td>Precio</td>
                                        <td style="width:50px;">Cantidad</td>
                                        <td>Total</td>
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


        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <!-- Frontend Logic -->
        <script src="../../js/orden.js"></script>
</body>

</html>