$(document).ready(function() {

    // Global Settings
    edit = false;
    traerIngresoActual();
    llenarSelect();

    //llenar select
    function llenarSelect() {
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
    //

    function agregarFilas() {
        var codigo = $('#idProducto').val();
        var descripcion = $('#descripcion').val();
        var precio = $('#precio').val();
        var cantidad = $('#cantidad').val();
        var total = (precio * cantidad).toFixed(2);
        var numerodoc = $('#numerodoc').val();
        var totaldoc = $('#totaldoc').val();


        if (numerodoc === "" || totaldoc === "") {
            alert("VERFIQUE NUMERO DOCUMENTO U TOTAL DOCUMENTO");
        } else
        if (descripcion === "") {
            alert("VERIFIQUE EL PRODUCTO")
        } else if (precio < 0) {
            alert("VERIFIQUE EL PRECIO");
        } else if (cantidad < 1) {
            alert("VERIFIQUE LA CANTIDAD");
        } else {
            var fila = '<tr idFila=' +
                codigo + '><td class="codigo">' + codigo + '</td><td class="descripcion">' +
                descripcion + '</td><td class="precio">' +
                precio + '</td><td class="cantidad">' +
                cantidad + '</td> <td class="total">' +
                total + '</td></tr>';
            $('#tbDetalle').append(fila);
            $('#idProducto').val("");
            $('#descripcion').val("");
            $('#precio').val("");
            $('#cantidad').val("");

        }


    }



    //para traer ingreso
    function traerIngresoActual() {

        const id = "1";
        const sucursal = "1";

        $.post('../../controller/movimientosInventario/traerMovimientoActual.php', {
            id,
            sucursal
        }, (response) => {
            const task = JSON.parse(response);
            $('#ingreso').val(task.actual);

        });




    }

    //btn guardar
    $('#btnGuardar').click(function() {
        var numerodoc = $('#numerodoc').val();
        var totaldoc = $('#totaldoc').val();


        if (numerodoc === "" || totaldoc === "") {
            alert("VERFIQUE NUMERO DOCUMENTO U TOTAL DOCUMENTO");
        } else {
            if (confirm("AL CREAR EL INGRESO ESTE SE CARGARA A SU EXISTENCIA\nDESEA CONTINUAR?")) {
                var u = "../../controller/movimientosInventario/crearIngresoCompra.php";
                $.ajax({
                    url: u,
                    data: {
                        id: $('#ingreso').val(),
                        movimiento: "1",
                        numero: $('#ingreso').val(),
                        proveedor: $('#proveedor').val(),
                        tipodoc: $('#tipodoc').val(),
                        numerodoc: $('#numerodoc').val(),
                        fechadoc: $('#fechadoc').val(),
                        estadodoc: $("#estadodoc").val(),
                        estadoingreso: "APROBADO",
                        total: $('#totaldoc').val(),
                        importacion = $('#importacion').val(),
                        seguro = $('#seguro').val(),
                        transporte = $('#transporte').val(),
                        gastos = $('#gastos').val(),
                        idSucursal: "1"
                    },
                    type: 'POST',
                    success: function(response) {
                        var msj = new String(response).valueOf().trim();
                        if (msj === "true") {

                            if ($("#estadodoc").val() === "SIN PAGAR") {
                                saldoProveedor($('#proveedor').val(), $('#totaldoc').val());

                            }


                            var filas = document.getElementById('tbDetalle').rows.length;

                            //se creo el encabezado asi que guardo el detalle
                            for (var i = 0; i < filas; i++) {
                                var u = "../../controller/movimientosInventario/crearDetalleIngreso.php";
                                let productoi = document.getElementById('tbDetalle').rows[i].cells[0].innerHTML;
                                let cantidadi = document.getElementById('tbDetalle').rows[i].cells[3].innerHTML;

                                $.ajax({
                                    url: u,
                                    data: {
                                        movimiento: "1",
                                        numero: $('#ingreso').val(),
                                        producto: document.getElementById('tbDetalle').rows[i].cells[0].innerHTML,
                                        precio: document.getElementById('tbDetalle').rows[i].cells[2].innerHTML,
                                        cantidad: document.getElementById('tbDetalle').rows[i].cells[3].innerHTML,
                                        total: document.getElementById('tbDetalle').rows[i].cells[4].innerHTML,
                                        idSucursal: "1"
                                    },
                                    type: 'POST',
                                    success: function(response) {
                                        let msj = new String(response).valueOf().trim();
                                        if (msj === "true") {
                                            existencia(productoi, cantidadi);
                                        }
                                    }

                                });
                            }
                            actualizarActual("1", $('#ingreso').val());
                            traerIngresoActual();
                            alert("INGRESO EXITOSO");
                            location.reload();
                        } else {
                            alert("NO SE PUDO CREAR EL INGRESO")


                        }

                    }
                });
            }

        }



    });


    //

    function existencia(pro, can) {

        var u = "../../controller/existencias/comprobarExistencia.php";

        $.ajax({
            url: u,
            data: {
                producto: pro,
                cantidad: can,
                sucursal: "1"
            },
            type: 'POST',
            success: function(response) {
                let exito = new String(response).valueOf().trim();

                if (exito === "true") {


                }


            }
        });



    }

    //para actualizar actual
    function actualizarActual(id, actual) {
        var u = "../../controller/movimientosInventario/actualizarMovimientoActual.php";

        $.ajax({
            url: u,
            data: {
                id: id,
                actual: actual,
                sucursal: "1"
            },
            type: 'POST',
            success: function(response) {
                let exito = new String(response).valueOf().trim();

                if (exito === "true") {


                }


            }
        });


    }

    //para proveedor saldo
    function saldoProveedor(proveedor, saldo) {
        var u = "../../controller/proveedores/actualizarSaldoProveedor.php";

        $.ajax({
            url: u,
            data: {
                id: proveedor,
                saldo: saldo
            },
            type: 'POST',
            success: function(response) {

                let exito = new String(response).valueOf().trim();

                if (exito === "true") {


                }


            }
        });


    }


    //btn cancelar
    $('#btnCancelar').click(function() {
        location.reload();
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
            } catch (error) {
                alert("NO EXISTE UN PRODUCTO CON ESE CODIGO");
                $('#descripcion').val("");
            }


        });


    });






});