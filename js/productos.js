$(document).ready(function() {

    // Global Settings
    edit = false;
    llenarSelect();
    listarProductos();
    llenarSelectProveedores();
    llenarDepartamentos();
    llenarFamilias();
    llenarlineas();
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





    //llenar select
    function llenarSelectProveedores() {
        $.ajax({
            url: '../../controller/proveedores/listarProveedor.php',
            type: 'GET',
            success: function(response) {
                if (JSON.parse(response).length < 1) {
                    let template = '';
                    template += `
                   <option value="0">NO HAY PROVEEDORES </option>
                  `
                    $('#proveedor').html(template);


                } else {
                    const lista = JSON.parse(response);
                    let template = '';
                    lista.forEach(listar => {
                        template += `
                   <option value="${listar.idProveedor}">${listar.nombre}</option>
                  `
                    });
                    $('#proveedor').html(template);

                }

            }
        });
    }

    //lineas
    function llenarlineas() {
        $.ajax({
            url: '../../controller/Lineas/listarLinea.php',
            type: 'GET',
            success: function(response) {
                if (JSON.parse(response).length < 1) {
                    let template = '';
                    template += `
                   <option value="0">NO HAY LINEAS </option>
                  `
                    $('#linea').html(template);


                } else {

                    const lista = JSON.parse(response);
                    let template = '';
                    lista.forEach(listar => {
                        template += `
                   <option value="${listar.idLinea}">${listar.nombre}</option>
                  `
                    });
                    $('#linea').html(template);

                }

            }
        });
    }

    //familias
    function llenarFamilias() {
        $.ajax({
            url: '../../controller/Familias/listarFamilia.php',
            type: 'GET',
            success: function(response) {
                if (JSON.parse(response).length < 1) {
                    let template = '';
                    template += `
                   <option value="0">NO HAY FAMILIAS </option>
                  `
                    $('#familia').html(template);


                } else {

                    const lista = JSON.parse(response);
                    let template = '';
                    lista.forEach(listar => {
                        template += `
                   <option value="${listar.idFamilia}">${listar.nombre}</option>
                  `
                    });
                    $('#familia').html(template);

                }

            }
        });
    }
    //departamentos
    function llenarDepartamentos() {
        $.ajax({
            url: '../../controller/DepartamentosProductos/listarDpt.php',
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
               <option value="${listar.idDptProducto}">${listar.nombre}</option>
              `
                    });
                    $('#departamento').html(template);

                }

            }
        });
    }


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
                        <td>
                    <section>
                    <img src="${listar.foto}" width="50" height="50" style="background-repeat: no-repeat;
                    background-position: 50%;
                    border-radius: 10%;
                    background-size: 100% auto;">
                    </section>
                    </td>
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

            edit = true;
        });

        e.preventDefault();


    });


    //btn cancelar
    $('#btnCancelar').click(function() {

        listarProductos();
        $('#productos-form').trigger('reset');
        edit = false;



    });



});