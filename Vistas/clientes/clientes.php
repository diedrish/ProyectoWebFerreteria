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
    <title></title>
    <meta charset="UTF-8">
</head>

<body>

    <img class="wave" src="../../images/wave.png">
    <div class="img">

    </div>

    <!-- NAVIGATION  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Gestion de Clientes</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <form class="form-inline my-2 my-lg-0">
                    <input name="search" id="search" class="form-control mr-sm-2" autocomplete="off"
                        placeholder="Buscar por Nombre" aria-label="Search">
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
                        <form id="clientes-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="empresa">Seleccione Tipo Empresa</label>
                                <select name="empresa" id="empresa" class="custom-select">
                                    <option value="GRANDE">GRANDE</option>
                                    <option value="MEDIANA">MEDIANA</option>
                                    <option value="PEQUEÑA">PEQUEÑA</option>
                                    <option value="MICRO">MICRO</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre Empresa"
                                    maxlength="200" class="form-control" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="nit" id="nit" placeholder="Nit" class="form-control"
                                    autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <input type="text" name="nrc" id="nrc" placeholder="Nrc" class="form-control"
                                    autocomplete="off" required>
                            </div>

                            <div class="form-group">
                                <label for="departamento">Seleccione Departamento</label>
                                <select name="departamento"  id="departamento" class="custom-select">

                                </select>
                                <label for="municipio">Seleccione Munipio</label>
                                <select name="municipio" id="municipio" class="custom-select">

                                </select>

                            </div>
                            <div class="form-group">
                                ​<textarea id="direccion" name="direccion" rows="5" cols="50"
                                    placeholder="Direccion del Cliente" autocomplete="off" maxlength="1500"
                                    required></textarea>
                            </div>
                            <div class="form-group">
                                <input type="text" name="giro" id="giro" placeholder="Giro" class="form-control"
                                    autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="credito">Permitir Credito</label>
                                <select name="credito"  id="credito" class="custom-select">
                                    <option value="SI">PERMITIR</option>
                                    <option value="NO" selected>DENEGAR</option>
                                </select>
                            </div>
                            <center>
                                <div class="col-md-12">
                                    <button type="submit" 
                                        class="btn btn-primary btn-lg active text-center">
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
                            <td>Id</td>
                            <td>Nombre</td>
                            <td>Nit</td>
                            <td>Nrc</td>
                        </tr>
                    </thead>
                    <tbody id="tbClientes">
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Frontend Logic -->
    <script src="../../js/clientes.js"></script>
</body>

</html>