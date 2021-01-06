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
    <!-- BOOTSTRAP 4  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../css/empresa.css">


</head>

<body>

    <img class="wave" src="../../images/wave.png">
    <div class="img">

    </div>


    <!-- NAVIGATION  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Correlativos</a>
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
        <div class="row p-4">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <!-- FORM TO ADD TASKS -->
                        <form id="correlativosCajas-form">

                            <div class="form-group ">
                                <label for="documento">DOCUMENTO</label>
                                <select name="documento" id="documento" class="form-control form-control-sm">

                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" name="serie" id="serie" placeholder="Serie de Factura"
                                    maxlength="200" class="form-control" autocomplete="off" required>
                            </div>

                            <div class="form-group">
                                <input type="number" name="desde" id="desde" placeholder="Desde" class="form-control"
                                    autocomplete="off" maxlength="15" required>
                            </div>
                            <div class="form-group">
                                <input type="number" name="hasta" id="hasta" placeholder="Hasta" class="form-control"
                                    autocomplete="off" maxlength="15" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="resolucion" id="resolucion" placeholder="Numero de Resolucion"
                                    class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group ">
                                <label for="fecha">FECHA RESOLUCION </label>
                                <input class="form-control" required type="date" value="2020-12-10" name="fecha" id="fecha">
                            </div>
                            <center>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-lg active text-center">
                                        Guardar
                                    </button>
                                    <button type="button" id="btnCancelar"
                                        class="btn btn-danger btn-lg active text-center" value="Cancelar">
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

                            <td>DOCUMENTO</td>
                            <td>SERIE</td>
                            <td>DESDE</td>
                            <td>HASTA</td>

                        </tr>
                    </thead>
                    <tbody id="tbCorrelativos">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Frontend Logic -->
    <script src="../../js/correlativos.js"></script>
</body>

</html>