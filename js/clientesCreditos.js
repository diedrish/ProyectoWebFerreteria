$(document).ready(function() {

    let edit = false;
    let idCliente = "";
    listarClientes();


    //

    $('#clientes-form').submit(e => {

        e.preventDefault();

        var u = "";
        var mensaje = "";
        if (edit) {

            u = "../../controller/clientesCreditos/editarClientesCrediticios.php";
            mensaje = "SE ACTUALIZARA EL CLIENTE\nDESEA CONTINUAR ?";
        } else {
            u = "../../controller/clientesCreditos/crearClienteCredito.php";
            mensaje = "SE GUARDAR EL CLIENTE\nDESEA CONTINUAR ?";
        }
        if (confirm(mensaje)) {
            $.ajax({

                url: u,
                data: {
                    id: $('#id').val(),
                    nombre: $('#nombre').val(),
                    nit: $('#nit').val(),
                    dui: $('#dui').val(),
                    telefono: $('#telefono').val()

                },
                type: 'POST',
                success: function(response) {


                    var cadena = new String(response).valueOf().trim();
                    if (cadena !== "YA EXISTE UN CLIENTE CON ESE ID") {
                        $('#clientes-form').trigger('reset');
                    }

                    alert(cadena);

                    $('#id').prop('disabled', false);
                    listarClientes();

                }


            });


        }

    });


    //


    //para listar los clientes
    function listarClientes() {
        $.ajax({
            url: '../../controller/clientesCreditos/buscarClientesCrediticios.php',
            type: 'GET',
            success: function(response) {

                const lista = JSON.parse(response);
                let template = '';
                lista.forEach(listar => {
                    template += `
                    <tr idEditar="${listar.id}">
                    <td >${listar.id}</td>
                    <td>${listar.nombre}</td>
                    <td>${listar.dui}</td>
                    <td>${listar.nit}</td>
                    <td>${listar.telefono}</td>
                    <td> <button id="editando" class="btn btn-warning">EDITAR</button></td>
                   </tr>
                  `
                });
                $('#tbClientesCreditos').html(template);
            }
        });
    }




    // al tapiar
    $('#search').keyup(function() {
        if ($('#search').val() != "") {
            let search = $('#search').val();

            $.ajax({
                url: '../../controller/clientesCreditos/buscarClienteCrediticiobyName.php',
                data: {
                    search
                },
                type: 'POST',
                success: function(response) {

                    const lista = JSON.parse(response);
                    let template = '';
                    lista.forEach(listar => {
                        template += `
                                <tr idEditar="${listar.id}">
                                <td >${listar.id}</td>
                                <td>${listar.nombre}</td>
                                <td>${listar.dui}</td>
                                <td>${listar.nit}</td>
                                <td>${listar.telefono}</td>
                                <td> <button id="editando" class="btn btn-warning">EDITAR</button></td>
                               </tr>
                          `
                    });
                    $('#tbClientesCreditos').html(template);
                }
            });


        } else {

            listarClientes();
        }

    });

    //btn cancelar
    $('#btnCancelar').click(function() {


        location.reload();


    });

    // Get a Single Task by Id 
    $(document).on('click', '#editando', (e) => {
        if (confirm("DESEA EDITAR EL CLIENTE?")) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('idEditar');


            $.post('../../controller/clientesCreditos/buscarClienteCrediticiobyId.php', {
                id
            }, (response) => {

                $('#id').prop('disabled', true);
                const task = JSON.parse(response);

                $('#id').val(task.id);
                $('#nombre').val(task.nombre);
                $('#nit').val(task.nit);
                $('#dui').val(task.dui);
                $('#telefono').val(task.telefono);

                edit = true;
                idCliente = id;
            });

            e.preventDefault();

        }
    });



});