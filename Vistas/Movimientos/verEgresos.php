
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title></title>
    <link rel="stylesheet" type="text/css" href="../../css/empresa.css">
</head>

<body>
    <img class="wave" src="../../images/wave.png">
    <div class="img">

    </div>
    <!-- NAVIGATION  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#"></a>
        <a class="navbar-brand" href="#">EGRESOS POR NOTAS DE REMISION</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <form class="form-inline my-2 my-lg-0">
                <input name="search" id="search" class="form-control mr-sm-2" autocomplete="off"  placeholder="Buscar por sucursal" aria-label="Search">
                    <a href="../menuSupervisor/menuAdmin.php" style="color:#FFFFFF;">
                        <img src="../../images/home.jpg" border="0" title="HOME" width="50" height="50">
                    </a>
                </form>
            </ul>
        </div>
    </nav>
    <center>
       <div class="container">
       
       <div class="col-md-10">
            <table class="table">
                <thead>
                    <tr>
                        <td>EGRESO #</td>
                        <td>FECHA</td>
                        <td>DESTINO</td>
                        <td>ESTADO</td>
                    </tr>
                </thead>
                <tbody id="tbEgresos">
                </tbody>
            </table>
        </div>
       </div>
    </center>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<!-- Frontend Logic -->
<script src="../../js/verEgresos.js"></script>

</html>
