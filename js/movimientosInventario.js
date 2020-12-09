$(document).ready(function() {

    // Global Settings
    edit = false;
    traerIngresoActual();
    llenarSelect();

    //llenar select
    function llenarSelect() {
        $.ajax({
            url: '../../controller/sucursales/buscarSucursales.php',
            data: {
                sucursal: "1"
            },
            type: 'POST',
            success: function(response) {
                if (JSON.parse(response).length < 1) {
                    let template = '';
                    template += `
                   <option value="0">NO HAY SUCURSALES </option>
                  `
                    $('#sucursal').html(template);


                } else {
                    const lista = JSON.parse(response);
                    let template = '';
                    lista.forEach(listar => {
                        template += `
                   <option value="${listar.id}">${listar.nombre}</option>
                  `
                    });
                    $('#sucursal').html(template);

                }

            }
        });
    }
    //

    function agregarFilas() {
        var codigo = $('#idProducto').val();
        var descripcion = $('#descripcion').val();
        var cantidad = $('#cantidad').val();
        var numerodoc = $('#numerodoc').val();
        var totaldoc = $('#totaldoc').val();

        if (numerodoc === "" || totaldoc === "") {
            alert("VERFIQUE NUMERO DOCUMENTO U TOTAL DOCUMENTO");
        } else if (descripcion === "") {
            alert("VERIFIQUE EL PRODUCTO")
        } else if (cantidad < 1) {
            alert("VERIFIQUE LA CANTIDAD");
        } else {

            const sucursal = "1";

            $.post('../../controller/existencias/buscarExistenciabyIdSucursal.php', {
                codigo,
                sucursal
            }, (response) => {
                let res = new String(response).valueOf().trim();

                if (cantidad > parseInt(res)) {
                    alert("LA CANTIDAD SOBREPASA SU EXISTENCIA")

                } else {
                    var fila = '<tr idFila=' +
                        codigo + '><td class="codigo">' + codigo + '</td><td class="descripcion">' +
                        descripcion + '</td><td class="cantidad">' +
                        cantidad + '</td></tr>';
                    $('#tbDetalle').append(fila);
                    $('#idProducto').val("");
                    $('#descripcion').val("");
                    $('#cantidad').val("");

                }




            });






        }


    }



    //para traer ingreso
    function traerIngresoActual() {

        const id = "5";
        const sucursal = "1";

        $.post('../../controller/movimientosInventario/traerMovimientoActual.php', {
            id,
            sucursal
        }, (response) => {
            const task = JSON.parse(response);
            $('#ingreso').val(task.actual);

        });




    }

    //btn cancelar
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




    //btn cancelar
    $('#btnCancelar').click(function() {
        if (confirm("LOS DATOS ACTUALES NO SE GUARDARAN\nDESEA CONTINUAR?")) {
            $('#egresos-form').trigger('reset');
            edit = false;


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