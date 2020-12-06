$(document).ready(function() {



    //para listar los listarExistencias
    function listarExistencias() {

        const id = $('#id').val();

        $.post('../../controller/existencias/buscarExistenciasSucursal.php', {
            id
        }, (response) => {
            const lista = JSON.parse(response);
            let template = '';
            lista.forEach(listar => {
                $('#nombre').val(listar.descripcion);
                template += `
                   <tr idEditar="${listar.idProducto}">
                    <td >${listar.idProducto}</td>
                    <td>${listar.nombre}</td>
                    <td>${listar.cantidad}</td>
                   </tr>
                  `
            });
            $('#tbExistencias').html(template);

        });


    }


    //
    //btn cancelar
    $('#btnBuscar').click(function() {

        const id = $('#id').val();

        $.post('../../controller/Productos/listarProductobyId.php', {
            id
        }, (response) => {

            try {
                const task = JSON.parse(response);
                listarExistencias();
            } catch (error) {
                alert("NO EXISTE UN PRODUCTO CON ESE CODIGO");
                $('#nombre').val("");
            }


        });

    });


    //btn cancelar
    $('#btnCancelar').click(function() {

        location.reload();

    });



});