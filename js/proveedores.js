$(document).ready(function() {

    // Global Settings
    edit = false;
    var idProveedor = "-";
    listarProveedores();
    $('#proveedores-form').submit(e => {

        e.preventDefault();

        var datos = new FormData($("#proveedores-form")[0]);


        var u = "";
        var mensaje = "";
        if (edit) {

            u = "../../controller/proveedores/editarProveedor.php";
            mensaje = "SE ACTUALIZARA EL PROVEEDOR\nDESEA CONTINUAR ?";
        } else {
            u = "../../controller/proveedores/crearProveedor.php";
            mensaje = "SE GUARDAR EL PROVEEDOR\nDESEA CONTINUAR ?";
        }
        if (confirm(mensaje)) {
            $.ajax({

                url: u,
                data: {
                    id: idProveedor,
                    nombre: $('#nombre').val(),
                    correo: $('#correo').val(),
                    telefono: $('#telefono').val(),
                    direccion: $('#direccion').val()


                },
                type: 'POST',
                success: function(response) {

                    var cadena = new String(response).valueOf().trim();

                    listarProveedores();
                    $('#proveedores-form').trigger('reset');
                    alert(cadena);



                }


            });


        }

    });

    //para listar los proveedores
    function listarProveedores() {
        $.ajax({
            url: '../../controller/proveedores/listarProveedor.php',
            type: 'GET',
            success: function(response) {
                const lista = JSON.parse(response);


                let template = '';
                lista.forEach(listar => {
                    template += `
                       <tr idEditar="${listar.idProveedor}">
                       <td >${listar.idProveedor}</td>
                        <td >${listar.nombre}</td>
                        <td>${listar.telefono}</td>
                        <td>${listar.correo}</td>
                        <td> <button id="editando" class="btn btn-warning">EDITAR</button></td>
                       </tr>
                      `
                });
                $('#tbProveedores').html(template);
            }
        });
    }

    //


    // al tapiar
    $('#search').keyup(function() {
        if ($('#search').val() != "") {
            let search = $('#search').val();


            $.ajax({
                url: '../../controller/proveedores/listarProveedorbyName.php',
                data: {
                    search
                },
                type: 'POST',
                success: function(response) {

                    const lista = JSON.parse(response);

                    let template = '';
                    lista.forEach(listar => {
                        template += `
                            <tr idEditar="${listar.idProveedor}">
                            <td >${listar.idProveedor}</td>
                            <td >${listar.nombre}</td>
                            <td>${listar.telefono}</td>
                            <td>${listar.correo}</td>
                            <td> <button id="editando" class="btn btn-warning">EDITAR</button></td>
                           </tr>
                              `
                    });
                    $('#tbProveedores').html(template);



                }
            });


        } else {
            listarProveedores();
        }

    });



    // Get a Single Task by Id 
    $(document).on('click', '#editando', (e) => {
        if (confirm("DESEA EDITAR EL PROVEEDOR?")) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('idEditar');
            idProveedor = id;

            $.post('../../controller/proveedores/listarProveedorbyId.php', {
                id
            }, (response) => {

                const task = JSON.parse(response);

                $('#nombre').val(task.nombre);
                $('#correo').val(task.correo);
                $('#telefono').val(task.telefono);
                $('#direccion').val(task.direccion);
                edit = true;
            });

            e.preventDefault();

        }
    });


    //btn cancelar
    $('#btnCancelar').click(function() {
        if (confirm("LOS DATOS ACTUALES NO SE GUARDARAN\nDESEA CONTINUAR?")) {
            listarProveedores();
            $('#proveedores-form').trigger('reset');
            edit = false;


        }
    });



});