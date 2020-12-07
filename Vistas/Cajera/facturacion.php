<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="shortcut icon" href="#" />
    <!-- BOOTSTRAP 4  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/empresa.css">
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
        <a class="navbar-brand" href="#">Facturacion</a>
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
        <label for="#">ORDENES EN ESPERA DE FACTURACION</label>
        <div class="row lg-12" style="padding: 10px;">

            <!-- TABLE  -->
            <div class="table-wrapper-scroll-y my-custom-scrollbar col-sm-4">
                <table class="table table-bordered table-striped mb-0 col-sm-12 ">
                    <thead>
                        <tr>
                            
                            <td style="width=300px;">Cliente</td>
                            <td>Total</td>
                        </tr>
                    </thead>
                    <tbody id="tbOrdenes">
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                <form id="orden-form-sm">
                    <div class="row">
                        <div class="form-group col-md-1 ">
                            <label for="orden">ID</label>
                            <input type="text" name="orden" id="orden" class="form-control form-control-sm" readonly autocomplete="off">

                        </div>

                        <div class="form-group col-md-2 ">
                            <label for="documento">DOC</label>
                            <select name="documento" id="documento" class="form-control form-control-sm">

                            </select>
                        </div>

                        <div class="form-group col-md-2 ">
                            <label for="numDoc"># DOC</label>
                            <input type="text" name="numDoc" id="numDoc" class="form-control form-control-sm" autocomplete="off">

                        </div>

                        <div class="form-group col-md-2 ">
                            <label for="nrc">NRC</label>

                            <input type="text" name="nrc" id="nrc" class="form-control form-control-sm" autocomplete="off">


                        </div>
                        <div class="form-group col-md-1 ">
                            <label for="buscarNrc">Buscar</label>
                            <button type="button" id="buscarNrc" class="btn btn-warning btn-md-1 ">
                                <img src="../../images/iconos/buscar.png" width="16" height="16">
                            </button>
                        </div>

                        <div class="form-group col-md-3 ">
                            <label for="nit">Nit</label>

                            <input type="text" name="nit" id="nit" class="form-control form-control-sm" readonly autocomplete="off">

                        </div>




                    </div>
                    <div class="row">
                        <div class="form-group col-md-3 ">
                            <label for="tipoFactura">Tipo Factura</label>
                            <select name="tipoFactura" id="tipoFactura" class="form-control form-control-sm">
                                <option value="0">SELECCIONE</option>
                                <option value="CONTADO">VENTA AL CONTADO</option>
                                <option value="CREDITO">VENTA AL CREDITO</option>

                            </select>
                        </div>
                        <div class="form-group col-md-9 ">
                            <label for="cliente">CLIENTE</label>

                            <input type="text" name="cliente" id="cliente" readonly class="form-control form-control-sm"
                                autocomplete="off">

                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="giro">Giro</label>


                            <input type="text" name="giro" id="giro" class="form-control form-control-sm"readonly autocomplete="off">

                        </div>
                    </div>



                    <div class="row">

                        <div class="form-group col-md-2 ">
                            <label for="codigo">CODIGO</label>
                            <input type="text" name="idProducto" id="idProducto" placeholder="Codigo  Producto"
                            class="form-control form-control-sm" autocomplete="off">
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
                            class="form-control form-control-sm" required autocomplete="off" readonly>
                        </div>

                        <div class="form-group col-md-2 ">
                            <label for="precio">PRECIO</label>
                            <input type="text" name="precio" readonly id="precio" placeholder="precio"
                            class="form-control form-control-sm" autocomplete="off">
                        </div>

                        <div class="form-group col-md-2 ">
                            <label for="cantidad">CANTIDAD</label>
                            <input type="number" name="cantidad" id="cantidad" placeholder="cantidad"
                            class="form-control form-control-sm" autocomplete="off"  min="1"
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
                        <div class="table-wrapper-scroll-y my-custom-scrollbarDos col-md-10">
                            <table class="table table-bordered table-striped mb-0 col-md-10 ">

                                <thead>
                                    <tr>
                                        <td>Codigo</td>
                                        <td>Descripcion </td>
                                        <td>Precio</td>
                                        <td style="width:50px;">Cantidad</td>
                                        <td>Total</td>
                                    </tr>
                                </thead>
                                <tbody id="tbDetalle">
                                </tbody>
                            </table>
                        </div>

                        <div class="form-group col-md-2 ">
                            <label  for="sumas">SUMAS</label>
                            <input type="text" name="sumas" id="sumas" class="form-control form-control-sm" autocomplete="off" readonly>
                            <label for="iva">IVA</label>
                            <input type="text" name="iva" id="iva" class="form-control form-control-sm" autocomplete="off" readonly>
                            <label for="subtotal">SUBTOTAL</label>
                            <input type="text" name="subtotal" id="subtotal" class="form-control form-control-sm" autocomplete="off"
                                readonly> <label for="retencion">Retencion</label>
                            <input type="text" name="retencion" id="retencion" class="form-control form-control-sm" autocomplete="off" readonly>
                            <label for="totalfinal">TOTAL FINAL</label>
                            <input type="text" name="totalfinal" id="totalfinal"
                                class="form-control form-control-sm" autocomplete="off"  readonly></div>



                    </div>

                    <div class="row" >
                        <div class="col-md-12 justify-content-center d-flex">
                            <button type="button" id="btnGuardar" class="btn btn-primary btn-lg active text-center">
                                Generar Factura
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




    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Frontend Logic -->
    <script src="../../js/caja.js"></script>
</body>

</html>