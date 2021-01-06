<?php
session_start();

if (!isset($_SESSION['vsNivel'])) {
    echo "<script> window.location='../../Vistas/login.php'; </script>";
} elseif ($_SESSION['vsEstado'] == "INACTIVO") {
    echo "<script> window.location='../../Vistas/login.php'; </script>";
} else {
}
?><!DOCTYPE html>
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
        <a class="navbar-brand" href="#">Ingreso por Compra</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <form class="form-inline my-2 my-lg-0">
                    <a href="<?php echo $_SESSION['menu'];?>" style="color:#FFFFFF;">
                        <img src="../../images/home.jpg" border="0" title="HOME" width="50" height="50">
                    </a>
                </form>
            </ul>
        </div>
    </nav>

    <div class="container">
        <form id="ingresos-form">
            <div class="row">
                <div class="form-group col-md-2  ">
                    <label for="ingreso">N. Ingreso </label>
                    <input type="text" name="ingreso" id="ingreso" class="form-control" style="width:50%"
                        autocomplete="off" readonly>
                </div>
            </div>

            <div class="row">


                <div class="form-group col-md-3 ">
                    <label for="proveedor">Seleccione un Proveedor</label>
                    <select name="proveedor" id="proveedor" class="custom-select">

                    </select>
                </div>

                <div class="form-group col-md-1 ">
                    <label for="doc">Tipo Doc</label>
                    <select name="tipodoc" id="tipodoc" class="custom-select">
                        <option value="CF">CF</option>
                        <option value="CCF">CCF</option>
                    </select>
                </div>

                <div class="form-group col-md-2 ">
                    <label for="ndoc">N. DOC </label>
                    <input type="text" name="numerodoc" id="numerodoc" placeholder="Numero de Documento"
                        class="form-control" autocomplete="off">
                </div>
                <div class="form-group col-md-2">
                    <label for="fechadoc">FECHA Doc. </label>
                    <input class="form-control" required type="date" value="2020-12-10" id="fechadoc">
                </div>

                <div class="form-group col-md-2 ">
                    <label for="estado">ESTADO</label>
                    <select name="estado" id="estadodoc" class="custom-select">
                        <option value="PAGADA">PAGADA</option>
                        <option value="SIN PAGAR">SIN PAGAR</option>
                    </select>
                </div>
                <div class="form-group col-md-2  ">
                    <label for="totaldoc">Total Doc. </label>
                    <input type="text" name="totaldoc" id="totaldoc" class="form-control" style="width:50%"
                        autocomplete="off">
                </div>

            </div>

            
            <div class="row">

                <div class="form-group col-md-2 ">
                    <label for="importacion">IMPORTACION</label>
                    <input type="text" name="importacion" id="importacion" 
                        class="form-control" autocomplete="off">
                </div>
                <div class="form-group col-md-2">
                    <label for="seguro">SEGUROS</label>
                    <input type="text" name="seguro" id="seguro" 
                        class="form-control" autocomplete="off">
                </div>

                <div class="form-group col-md-2 ">
                    <label for="transporte">TRANSPORTE</label>
                    <input type="text" name="transporte" id="transporte" 
                        class="form-control" autocomplete="off">
                </div>
                <div class="form-group col-md-2  ">
                    <label for="gastos">OTROS GASTOS</label>
                    <input type="text" name="gastos" id="gastos" class="form-control" 
                        autocomplete="off">
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
                    <label for="precio">PRECIO</label>
                    <input type="text" name="precio" id="precio" placeholder="precio" class="form-control"
                        autocomplete="off">
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
                                <td>Precio</td>
                                <td>Cantidad</td>
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

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Frontend Logic -->
    <script src="../../js/ingresobyProveedor.js"></script>
</body>

</html>