$(document).ready(function() {

    listarOrdenes();

    function listarOrdenes() {
        $.ajax({
            url: '../../controller/movimientosInventario/traerIngresosCompras.php',
            type: 'GET',
            success: function(response) {
                const lista = JSON.parse(response);
                let template = '';
                lista.forEach(listar => {
                    template += `
                          <tr idEditar="${listar.ingreso}"> <td style="font-weight:bold;font-size:13px;" >${listar.ingreso}</td>
                        <td style="font-weight:bold;font-size:13px;" >${listar.fecha}</td>
                        <td style="font-weight:bold;font-size:13px;"> ${listar.proveedor}</td>
                        <td style="font-weight:bold;font-size:13px;">${listar.documento}</td>
                        <td style="font-weight:bold;font-size:13px;">${listar.documentoNumero}</td><td style="font-weight:bold;font-size:13px;">${listar.total}</td>
                        <td> <button id="imprimiendo" class="btn btn-info">IMPRIMIR</button></td>
                        <td> 
                       </tr>
    	               `
                });
                $('#tbIngresos').html(template);
            }
        });
    }



});