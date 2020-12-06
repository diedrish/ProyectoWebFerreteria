$(document).ready(function() {
    let edit = false;
    listarCategorias();

    //para listar los listarExistencias
    function listarCategorias() {

        $.post('../../controller/categorias/listarCategoria.php', {

        }, (response) => {
            const lista = JSON.parse(response);

            let template = '';
            lista.forEach(listar => {
                template += `
                   <tr idEditar="${listar.idCategoria}">
                   <td>${listar.idCategoria}</td>
                    <td>${listar.nombre}</td>
                    <td> <button id="editando" class="btn btn-warning">EDITAR</button></td>
                   </tr>
                  `
            });
            $('#tbCategorias').html(template);

        });


    }

    // al tapiar
    $('#search').keyup(function() {
        if ($('#search').val()) {
            let search = $('#search').val();

            $.ajax({
                url: '../../controller/categorias/listarCategoriabyName.php',
                data: {
                    search
                },
                type: 'POST',
                success: function(response) {
                    const lista = JSON.parse(response);
                    let template = '';
                    lista.forEach(listar => {
                        template += `
                            <tr idEditar="${listar.idCategoria}">
                            <td >${listar.idCategoria}</td>
                            <td>${listar.nombre}</td>
                            <td> <button id="editando" class="btn btn-warning">EDITAR</button></td>
                           </tr>
                      `
                    });
                    $('#tbCategorias').html(template);



                }
            });


        }

    });

    //
    //btn guardar
    $('#btnGuardar').click(function() {
        const id = $('#id').val();
        const nombre = $('#nombre').val();
        var u = "";
        var mensaje = "";
        if (edit) {

            u = "../../controller/categorias/editarCategoria.php";
            mensaje = "SE ACTUALIZARA LA CATEGORIA\nDESEA CONTINUAR ?";
        } else {
            u = "../../controller/categorias/crearCategoria.php";
            mensaje = "SE GUARDAR LA CATEGORIA\nDESEA CONTINUAR ?";
        }
        if (confirm(mensaje)) {
            $.post(u, {
                id,
                nombre
            }, (response) => {
                alert(response);
                listarCategorias();

            });


        }
    });


    // Get a Single Task by Id 
    $(document).on('click', '#editando', (e) => {
        if (confirm("DESEA EDITAR LA CATEGORIA")) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('idEditar');

            $.post('../../controller/categorias/listarCategoriabyId.php', {
                id
            }, (response) => {

                $('#id').prop('disabled', true);
                const task = JSON.parse(response);
                $('#id').val(task.idCategoria);
                $('#nombre').val(task.nombre);
                edit = true;
            });

            e.preventDefault();

        }
    });




    //btn cancelar
    $('#btnCancelar').click(function() {

        location.reload();

    });



});