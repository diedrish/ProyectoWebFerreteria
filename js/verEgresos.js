$(document).ready(function() {

    listarOrdenes();

    function listarOrdenes() {
        $.ajax({
            url: '../../controller/movimientosInventario/traerEgresos.php',
            type: 'GET',
            success: function(response) {
                const lista = JSON.parse(response);
                let template = '';
                lista.forEach(listar => {
                    template += `
                          <tr idEditar="${listar.egreso}"> <td style="font-weight:bold;font-size:13px;" >${listar.egreso}</td>
                        <td style="font-weight:bold;font-size:13px;" >${listar.fecha}</td>
                        <td style="font-weight:bold;font-size:13px;"> ${listar.destino}</td>
                        <td style="font-weight:bold;font-size:13px;">${listar.estado}</td>
                        <td> <button id="imprimiendo" class="btn btn-info">IMPRIMIR</button></td>
                        <td> 
                       </tr>
    	               `
                });
                $('#tbEgresos').html(template);
            }
        });
    }



});