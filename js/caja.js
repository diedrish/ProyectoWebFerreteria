$(document).ready(function() {

    // Global Settings
    edit = false;
    traerOrdenes();
    llenarDocumentos();


    //
    function traerDetalleOrden(ord) {

        var orden = ord;

        $.post('../../controller/ordenes/listarDetalleOrden.php', {
            orden
        }, (response) => {

            const lista = JSON.parse(response);
            let template = '';
            lista.forEach(listar => {
                $('#cliente').val(listar.cliente);
                template += `
                <tr idFila="${listar.producto}">
                <td>${listar.producto}</td>
                <td >${listar.descripcion}</td>
                <td >${listar.precio}</td>
                <td ><input type="number" style="width:50px;" value=${listar.cantidad}></td>
                <td>${listar.total}</td>
                <td> <button id="eliminandoDetalle" class="btn btn-danger"><img src="../../images/iconos/delete-package.png" border="0"  width="16" height="16"></button></td>
                </tr> 
                  `
            });
            $('#tbDetalle').html(template);

        });


    }

    function traerOrdenes() {
        $.ajax({
            url: '../../controller/ordenes/listarOrdenesPendientes.php',
            type: 'GET',
            success: function(response) {
                try {
                    const lista = JSON.parse(response);


                    let template = '';
                    lista.forEach(listar => {
                        template += `
                           <tr idEditarOrden="${listar.orden}">
                            <td style="width=300px;">${listar.nombre}</td>
                            <td style="width=100px;">${listar.total}</td>
                            <td> <button id="facturando" class="btn btn-warning"><img src="../../images/iconos/facturar-package.png" border="0"  width="16" height="16"></button></td>
                            <td> <button id="eliminando" class="btn btn-danger"><img src="../../images/iconos/delete-package.png" border="0"  width="16" height="16"></button></td>
                           </tr>
                          `
                    });
                    $('#tbOrdenes').html(template);
                } catch (error) {

                }
            }

        });

    }


    //btn guardar
    $('#btnGuardar').click(function() {




    });


    function totalizar() {
        try {
            var filas = document.getElementById('tbDetalle').rows.length;
            let total = 0.00;
            let sumas = 0.00;
            let iva = 0.00;
            let subtotal = 0.00;
            let retencion = 0.00;
            for (var i = 0; i < filas; i++) {
                var totalfila = (document.getElementById('tbDetalle').rows[i].cells[4].innerHTML);
                total = ((Number(totalfila)) + (Number(total))).toFixed(2);
                //para traer  precio

                const documento = $('#documento').val();
                if (documento === "CCF") {

                    const id = (document.getElementById('tbDetalle').rows[i].cells[0].innerHTML);

                    $.post('../../controller/Productos/listarProductobyId.php', {
                        id
                    }, (response) => {
                        console.log(response);
                        const task = JSON.parse(response);
                        var precioconiva = Number(task.precio);
                        var preciosiniva = (Number(task.precio) / 1.13).toFixed(2);
                        console.log(preciosiniva);
                        console.log(precioconiva);
                        var cantidad = 1;
                        iva = Number(((precioconiva - preciosiniva) * cantidad).toFixed(2)) + Number(iva);
                        sumas = Number(((preciosiniva) * cantidad) + sumas);
                        subtotal = Number(sumas) + Number(iva);

                        $('#sumas').val(sumas);
                        $('#iva').val(iva);
                        $('#subtotal').val(subtotal);
                        $('#retencion').val(retencion);
                        $('#totalfinal').val(Number(subtotal) - Number(retencion));
                    });
                } else {

                }



                //fin 
            }


            $('#totalFinal').val(total);
        } catch (error) {
            $('#totalFinal').val("0.00");
        }


    }


    //btn cancelar
    $('#btnCancelar').click(function() {
        if (confirm("LOS DATOS ACTUALES NO SE GUARDARAN\nDESEA CONTINUAR?")) {
            $('#orden-form').trigger('reset');
            edit = false;


        }
    });

    //para facturar

    $(document).on('click', '#facturando', (e) => {

        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('idEditarOrden');

        $('#orden').val(id);
        traerDetalleOrden(id);
        totalizar();

    });
    //


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
                codigo + '><td class="codigo" style="width:25px;">' + codigo + '</td><td class="descripcion"style="width:300px;">' +
                descripcion + '</td><td class="precio"style="width:100px;">' +
                precio + '</td><td class="cantidad"  style="width:50px;"><input type="number" value="' +
                cantidad + '" style="width:50px;"></td> <td class="total" style="width:100px;">' +
                total + '</td> <td> <button id="elimandoItem" class="btn btn-danger"><img src="../../images/iconos/delete-package.png" border="0"  width="16" height="16"></button></td></tr> ';
            $('#tbDetalle').append(fila);
            $('#idProducto').val("");
            $('#descripcion').val("");
            $('#precio').val("");
            $('#cantidad').val("");
            totalizar();

        }

    }

    setInterval(function() {
        traerOrdenes();
    }, 1000 * 1);

    //
    //para eliminar item de orden
    $(document).on('click', '#eliminandoDetalle', (e) => {
        if (confirm("SE QUITARA EL PRODUCTO\nDESEA CONTINUAR?")) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('idFila');

            var producto = id;
            var orden = $('#orden').val();

            $.post('../../controller/ordenes/eliminarItemOrden.php', {
                producto,
                orden
            }, (response) => {

                try {
                    traerDetalleOrden();
                } catch (error) {

                }


            });
        }
    });
    //para borrar orden
    $(document).on('click', '#eliminando', (e) => {
        if (confirm("SE ELIMINARA LA ORDEN COMPLETAMENTE\nDESEA CONTINUAR?")) {


            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('idEditarOrden');

            var orden = id;

            $.post('../../controller/ordenes/eliminarOrden.php', {
                orden
            }, (response) => {

                traerOrdenes();


            });
        }
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
                var precioconiva = Number(task.precio);
                const documento = $('#documento').val();

                if (documento === "CCF") {
                    var preciosiniva = (Number(task.precio) / 1.13).toFixed(2);

                    $('#precio').val(preciosiniva);
                } else {
                    $('#precio').val(task.precio);

                }

            } catch (error) {
                alert("NO EXISTE UN PRODUCTO CON ESE CODIGO");
                $('#descripcion').val("");
                $('#precio').val("");
            }


        });


    });

    $('#buscarNrc').click(function() {

        const id = $('#nrc').val();

        $.post('../../controller/clientes/buscarClientebyNrc.php', {
            id
        }, (response) => {
            try {
                const task = JSON.parse(response);
                $('#cliente').val(task.nombre);
                $('#nit').val(task.nit);
                $('#nrc').val(task.nrc);
                $('#giro').val(task.giro);
            } catch (error) {
                alert("NO EXISTE UN CLIENTE CON ESE NRC");

            }


        });


    });


    function correlativo() {

        var documento = $("#documento option:selected").val();
        $.post('../../controller/documentos/traerCorrelativoFactura.php', {
            documento
        }, (response) => {

            try {
                const task = JSON.parse(response);

                $('#numDoc').val(task.actual);

            } catch (error) {

                $('#numDoc').val("");
            }


        });
    }

    //para traer correlativo
    $(document).on('change', '#documento', function(event) {
        correlativo();
    });


    //llenar select documentps
    function llenarDocumentos() {
        $.ajax({
            url: '../../controller/documentos/buscarDocumentosNombre.php',
            type: 'GET',
            success: function(response) {

                if (JSON.parse(response).length < 1) {
                    let template = '';
                    template += `
                   <option value="0">NO HAY DOCUEMENTOS </option>
                  `
                    $('#documento').html(template);


                } else {
                    const lista = JSON.parse(response);
                    let template = '';
                    lista.forEach(listar => {
                        template += `
                   <option value="${listar.documento}">${listar.nombre}</option>
                  `
                    });
                    $('#documento').html(template);
                    correlativo();
                }

            }
        });
    }



});