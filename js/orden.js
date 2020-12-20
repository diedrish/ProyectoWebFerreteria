$(document).ready(function() {

    // Global Settings
    edit = false;
    traerOrdenActual();
    totalizar();
    traerOrdenes();

    //


    function traerOrdenes() {
        $.ajax({
            url: '../../controller/ordenes/listarOrdenesbyVendedor.php',
            type: 'GET',
            success: function(response) {
                try {
                    const lista = JSON.parse(response);


                    let template = '';
                    lista.forEach(listar => {
                        template += `
                           <tr idEditarOrden="${listar.orden}">
                           <td >${listar.orden}</td>
                            <td >${listar.nombre}</td>
                            <td>${listar.estado}</td>
                            <td>${listar.total}</td>
                          </tr>
                          `
                    });
                    $('#tbOrdenes').html(template);
                } catch (error) {

                }
            }

        });

    }

    function agregarFilas() {
        var codigo = $('#idProducto').val();
        var descripcion = $('#descripcion').val();
        var precio = $('#precio').val();
        var cantidad = $('#cantidad').val();
        var total = (precio * cantidad).toFixed(2);
        var nombre = $('#nombre').val();


        if (nombre === "") {
            alert("VERFIQUE NOMBRE DE CLIENTE");
        } else if (descripcion === "") {
            alert("VERIFIQUE EL PRODUCTO")
        } else if (precio < 0) {
            alert("VERIFIQUE EL PRECIO");
        } else if (cantidad < 1) {
            alert("VERIFIQUE LA CANTIDAD");
        } else {
            var fila = '<tr idFila=' +
                codigo + '><td class="codigo">' + codigo + '</td><td class="descripcion">' +
                descripcion + '</td><td class="precio">' +
                precio + '</td><td style="width:50px;" class="cantidad" >' +
                cantidad + '</td> <td class="total">' +
                total + '</td><td> <button id="eliminando" class="btn btn-danger"><img src="../../images/iconos/delete-package.png" border="0"  width="16" height="16"></button></td></tr>';
            $('#tbDetalle').append(fila);
            $('#idProducto').val("");
            $('#descripcion').val("");
            $('#precio').val("");
            $('#cantidad').val("");
            totalizar();

        }



    } //


    //


    //para traer ingreso
    function traerOrdenActual() {
        $.post('../../controller/ordenes/listarOrden.php', {

        }, (response) => {

            try {
                const task = JSON.parse(response);
                let orden = task.orden;
                let nuevo = parseInt(orden, 10) + 1;

                $('#orden').val(nuevo);
            } catch (error) {
                $('#orden').val("1");
            }


        });

    }

    //btn guardar
    $('#btnGuardar').click(function() {

        var nombre = $('#nombre').val();

        if (nombre === "") {
            alert("VERFIQUE NOMBRE DE CLIENTE");
        } else {
            var totalFilas = document.getElementById('tbDetalle').rows.length;
            if (totalFilas < 1) {
                alert("DEBE AGREGAR PRODUCTOS A LA ORDEN");

            } else {

                var u = "../../controller/ordenes/crearOrden.php";
                traerOrdenActual();

                $.ajax({
                    url: u,
                    data: {
                        orden: $('#orden').val(),
                        nombre: $('#nombre').val(),
                        sucursal: "1",
                        total: $('#totalFinal').val()
                    },
                    type: 'POST',
                    success: function(response) {
                        var msj = new String(response).valueOf().trim();

                        if (msj === "true") {
                            var filas = document.getElementById('tbDetalle').rows.length;

                            //se creo el encabezado asi que guardo el detalle
                            for (var i = 0; i < filas; i++) {
                                var u = "../../controller/ordenes/crearDetalleOrden.php";

                                $.ajax({
                                    url: u,
                                    data: {
                                        orden: $('#orden').val(),
                                        producto: document.getElementById('tbDetalle').rows[i].cells[0].innerHTML,
                                        precio: document.getElementById('tbDetalle').rows[i].cells[2].innerHTML,
                                        cantidad: document.getElementById('tbDetalle').rows[i].cells[3].innerHTML,
                                        total: document.getElementById('tbDetalle').rows[i].cells[4].innerHTML,
                                        sucursal: "1"
                                    },
                                    type: 'POST',
                                    success: function(response) {



                                    }

                                });
                            }


                            location.reload();
                        } else {



                        }

                    }
                });


            }


        }






    });


    function totalizar() {
        try {
            var filas = document.getElementById('tbDetalle').rows.length;
            var total = 0.00;
            for (var i = 0; i < filas; i++) {
                var totalfila = (document.getElementById('tbDetalle').rows[i].cells[4].innerHTML);
                total = ((Number(totalfila)) + (Number(total))).toFixed(2);

            }
            if (total > 0) {
                $('#totalFinal').val(total);
            } else {

                $('#totalFinal').val(total);

            }
        } catch (error) {
            $('#totalFinal').val("0.00");
        }


    }
    $(document).on('click', '#eliminando', function(event) {
        event.preventDefault();

        $(this).closest('tr').remove();


    });

    //btn cancelar
    $('#btnCancelar').click(function() {
        $('#orden-form').trigger('reset');
        edit = false;



    });


    //btn agregar
    $('#btnAdd').click(function() {
        var codigo = $('#idProducto').val();
        var existe = false;

        for (var i = 0; i < document.getElementById('tbDetalle').rows.length; i++) {
            if (codigo === document.getElementById('tbDetalle').rows[i].cells[0].innerHTML) {
                existe = true;
            }
        }
        if (existe) {
            alert("EL PRODUCTO YA FUE CARGADO");
            $('#idProducto').val("");
            $('#descripcion').val("");
            $('#precio').val("");
            $('#cantidad').val("");
        } else {
            agregarFilas();
        }


    });

    //btn buscar producto

    $('#btnBuscar').click(function() {

        const id = $('#idProducto').val();

        $.post('../../controller/Productos/listarProductobyId.php', {
            id
        }, (response) => {

            try {
                const task = JSON.parse(response);

                $('#descripcion').val(task.nombre);
                $('#precio').val(task.precio);
            } catch (error) {
                alert("NO EXISTE UN PRODUCTO CON ESE CODIGO");
                $('#descripcion').val("");
                $('#precio').val("");
            }


        });


    });


});