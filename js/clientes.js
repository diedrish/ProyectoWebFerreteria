$(document).ready(function() {

    let edit = false;
    let idCliente = "";
    llenarDepartamentos();
    listarClientes();


    //

    $('#clientes-form').submit(e => {

        e.preventDefault();

        var u = "";
        var mensaje = "";
        if (edit) {

            u = "../../controller/clientes/editarClientes.php";
            mensaje = "SE ACTUALIZARA EL CLIENTE\nDESEA CONTINUAR ?";
        } else {
            u = "../../controller/clientes/crearClientes.php";
            mensaje = "SE GUARDAR EL CLIENTE\nDESEA CONTINUAR ?";
        }
        if (confirm(mensaje)) {
            $.ajax({

                url: u,
                data: {
                    id: idCliente,
                    nombre: $('#nombre').val(),
                    empresa: $('#empresa').val(),
                    nit: $('#nit').val(),
                    nrc: $('#nrc').val(),
                    direccion: $('#direccion').val(),
                    giro: $('#giro').val(),
                    municipio: $('#municipio').val(),
                    credito: $('#credito').val()

                },
                type: 'POST',
                success: function(response) {

                    var cadena = new String(response).valueOf().trim();
                    $('#clientes-form').trigger('reset');
                    alert(cadena);


                    listarClientes();

                }


            });


        }

    });


    //

    //llenar select departamentos
    function llenarDepartamentos() {
        $.ajax({
            url: '../../controller/direccion/buscarDepartamentos.php',
            type: 'GET',
            success: function(response) {

                if (JSON.parse(response).length < 1) {
                    let template = '';
                    template += `
                   <option value="0">NO HAY DEPARTAMENTOS </option>
                  `
                    $('#departamento').html(template);


                } else {
                    const lista = JSON.parse(response);
                    let template = '';
                    lista.forEach(listar => {
                        template += `
                   <option value="${listar.departamento}">${listar.nombre}</option>
                  `
                    });
                    $('#departamento').html(template);
                    llenarMunicipios("1");

                }

            }
        });
    }
    //
    //llenar select municipios
    function llenarMunicipios(municipio) {
        var id = municipio;
        $.ajax({
            url: '../../controller/direccion/buscarMunicipiobyId.php',
            type: 'POST',
            data: {
                id
            },
            type: 'POST',
            success: function(response) {
                if (JSON.parse(response).length < 1) {
                    let template = '';
                    template += `
               <option value="0">NO HAY MUNICIPIOS </option>
              `
                    $('#municipio').html(template);


                } else {
                    const lista = JSON.parse(response);
                    let template = '';
                    lista.forEach(listar => {
                        template += `
               <option value="${listar.municipio}">${listar.nombre}</option>
              `
                    });
                    $('#municipio').html(template);

                }

            }
        });
    }

    //para listar los clientes
    function listarClientes() {
        $.ajax({
            url: '../../controller/clientes/listarCliente.php',
            type: 'GET',
            success: function(response) {

                const lista = JSON.parse(response);
                let template = '';
                lista.forEach(listar => {
                    template += `
                    <tr idEditar="${listar.id}">
                    <td >${listar.id}</td>
                    <td>${listar.nombre}</td>
                    <td>${listar.nit}</td>
                    <td>${listar.nrc}</td>
                    <td> <button id="editando" class="btn btn-warning">EDITAR</button></td>
                   </tr>
                  `
                });
                $('#tbClientes').html(template);
            }
        });
    }

    $(document).on('change', '#departamento', function(event) {
        var dpt = $("#departamento option:selected").val();
        llenarMunicipios(dpt);
    });


    // al tapiar
    $('#search').keyup(function() {
        if ($('#search').val() != "") {
            let search = $('#search').val();

            $.ajax({
                url: '../../controller/clientes/buscarClientebyName.php',
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
                                <td>${listar.nit}</td>
                                <td>${listar.nrc}</td>
                                <td> <button id="editando" class="btn btn-warning">EDITAR</button></td>
                               </tr>
                          `
                    });
                    $('#tbClientes').html(template);
                }
            });


        } else {

            listarClientes();
        }

    });

    // Get a Single Task by Id 
    $(document).on('click', '#editando', (e) => {
        if (confirm("DESEA EDITAR EL CLIENTE?")) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('idEditar');
            idProveedor = id;

            $.post('../../controller/clientes/buscarClientebyId.php', {
                id
            }, (response) => {

                const task = JSON.parse(response);

                $('#nombre').val(task.nombre);
                $('#empresa').val(task.empresa);
                $('#nit').val(task.nit);
                $('#nrc').val(task.nrc);
                $('#direccion').val(task.direccion);
                $('#giro').val(task.giro);
                $('#departamento').val(task.departamento);
                $('#municipio').val(task.municipio);
                $('#credito').val(task.credito);


                edit = true;
                idCliente = id;
            });

            e.preventDefault();

        }
    });



});