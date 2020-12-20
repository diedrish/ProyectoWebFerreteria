<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#" />
    <!-- BOOTSTRAP 4  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/menu.css">

    <style>
    .my-custom-scrollbar {
        height: 500px;
        overflow: auto;
        margin: 5% 1%;
        border-radius: 20px;
        border: solid #FFFFFF;
        padding: 10px;
        border-collapse: separate;
        border-spacing: 10px 5px;
    }

    .table-wrapper-scroll-y {
        display: block;
    }
    </style>

    <title></title>
</head>

<body>


    <!-- NAVIGATION  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Menu Principal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <form class="form-inline my-2 my-lg-0">

                    <a href="../salir.php" style="color:#FFFFFF;">
                        SALIR</a>
                </form>
            </ul>
        </div>
    </nav>
    <div class="table-wrapper-scroll-y my-custom-scrollbar col-md-6">
        <table class="table table-bordered table-striped mb-0 col-md-6">


            <tr>
                <td>
                    <center>
                        <section style="border:solid;
    padding: 10px;">
                            <center> <img class="img" src="../../images/iconos/existencia.png" width="50"
                                    height="50"><br><br></center>
                            <center> <input type="button" name="perfil" width="50" value="    Existencias     "
                                    class="boton btn btn-info" onclick="location.href='../existencias/existencias.php'">
                            </center>
                        </section>
                    </center>
                </td>
                <td>
                    <section style="border:solid;
    padding: 10px;">
                        <center><img class="img" src="../../images/iconos/prefactura.png" width="50"
                                height="50"><br><br></center>
                        <center> <input type="button" name="perfil" width="50" value="       Ordenes      "
                                class="boton btn btn-info" onclick="location.href='../ordenes/orden.php'"></center>
                    </section>
                </td>
                <td>
                    <section style="border:solid;
    padding: 10px;">
                        <center><img class="img" src="../../images/iconos/factura.png" width="50" height="50"><br><br>
                        </center>
                        <center> <input type="button" name="perfil" width="50" value="     Facturacion    "
                                class="boton btn btn-info" onclick="location.href='../Cajera/facturacion.php'"></center>
                    </section>
                </td>

            </tr>
            <tr>

                <td>
                    <section style="border:solid;
padding: 10px;">
                        <center><img class="img" src="../../images/iconos/users.png" width="50" height="50"><br><br>
                        </center>
                        <center> <input type="button" name="perfil" width="50" value="  Gestion Clientes  "
                                class="boton btn btn-info" onclick="location.href='../clientes/clientes.php'"></center>
                    </section>
                </td>

            </tr>
        </table>

    </div>
</body>

</html>