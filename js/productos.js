$(document).ready(function() {

    // Global Settings
    edit = false;
    llenarSelect();
    listarProductos();
    $('#productos-form').submit(e => {
        $('#id').prop('disabled', false);
        e.preventDefault();

        var datos = new FormData($("#productos-form")[0])
        var u = "";
        var mensaje = "";
        if (edit) {

            u = "../../controller/productos/editarProducto.php";
            mensaje = "SE ACTUALIZARA EL PRODUCTO\nDESEA CONTINUAR ?";
        } else {
            u = "../../controller/productos/crearProducto.php";
            mensaje = "SE GUARDAR EL PRODUCTO\nDESEA CONTINUAR ?";
        }
        if (confirm(mensaje)) {
            $.ajax({

                url: u,
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                success: function(response) {

                    var cadena = new String(response).valueOf().trim();
                    if (cadena === "Seleccione una imagen valida .jpg") {


                    } else {
                        listarProductos();
                        $('#productos-form').trigger('reset');
                    }
                    alert(response);



                }


            });


        }

    });

    //para listar los productos
    function listarProductos() {
        $.ajax({
            url: '../../controller/productos/listarProducto.php',
            type: 'GET',
            success: function(response) {
                const lista = JSON.parse(response);


                let template = '';
                lista.forEach(listar => {
                    template += `
                       <tr idEditar="${listar.idProducto}">
                        <td >${listar.idProducto}</td>
                        <td>${listar.nombre}</td>
                        <td>${listar.precio}</td>
                        <td> <button id="editando" class="btn btn-warning">EDITAR</button></td>
                       </tr>
                      `
                });
                $('#tbProductos').html(template);
            }
        });
    }

    //llenar select
    function llenarSelect() {
        $.ajax({
            url: '../../controller/categorias/listarCategoria.php',
            type: 'GET',
            success: function(response) {
                if (JSON.parse(response).length < 1) {
                    let template = '';
                    template += `
                   <option value="0">NO HAY CATEGORIAS </option>
                  `
                    $('#proveedor').html(template);


                } else {
                    const lista = JSON.parse(response);
                    let template = '';
                    lista.forEach(listar => {
                        template += `
                   <option value="${listar.idCategoria}">${listar.nombre}</option>
                  `
                    });
                    $('#categoria').html(template);

                }

            }
        });
    }
    //


    // al tapiar
    $('#search').keyup(function() {
        if ($('#search').val() != "") {
            let search = $('#search').val();

            $.ajax({
                url: '../../controller/Productos/listarProductobyName.php',
                data: {
                    search
                },
                type: 'POST',
                success: function(response) {

                    const lista = JSON.parse(response);
                    let template = '';
                    lista.forEach(listar => {
                        template += `
                                    <tr idEditar="${listar.idProducto}">
                                    <td >${listar.idProducto}</td>
                                    <td>${listar.nombre}</td>
                                    <td>${listar.precio}</td>
                                    <td> <button id="editando" class="btn btn-warning">EDITAR</button></td>
                                   </tr>
                              `
                    });
                    $('#tbProductos').html(template);




                }
            });


        } else {

            listarProductos();
        }

    });



    // Get a Single Task by Id 
    $(document).on('click', '#editando', (e) => {
        if (confirm("DESEA EDITAR EL PRODUCTO")) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('idEditar');

            $.post('../../controller/Productos/listarProductobyId.php', {
                id
            }, (response) => {
                $('#id').prop('disabled', true);
                const task = JSON.parse(response);
                $('#id').val(task.idProducto);
                $('#nombre').val(task.nombre);
                $('#precio').val(task.precio);
                $('#categoria').val(task.categoria);
                $('#costo').val(task.costo);
                $('#familia').val(task.familia);
                $('#linea').val(task.linea);
                $('#departamento').val(task.departamento);
                $('#foto').val(task.departamento);
                edit = true;
            });

            e.preventDefault();

        }
    });


    //btn cancelar
    $('#btnCancelar').click(function() {
        if (confirm("LOS DATOS ACTUALES NO SE GUARDARAN\nDESEA CONTINUAR?")) {
            listarProductos();
            $('#productos-form').trigger('reset');
            edit = false;


        }
    });



});