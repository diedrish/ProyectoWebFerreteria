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

    //function crear Ingreso
    function crearIngresoSucursalRecibidor(suc) {

        const id = "2";
        const sucursal = suc;

        $.post('../../controller/movimientosInventario/traerMovimientoActual.php', {
            id,
            sucursal
        }, (response) => {

            const task = JSON.parse(response);



            var ingreso = task.actual;
            var u = "../../controller/movimientosInventario/crearEgreso.php";
            $.ajax({
                url: u,
                data: {
                    id: ingreso,
                    movimiento: "2",
                    numero: ingreso,
                    estadoEgreso: "PENDIENTE",
                    salida: "1",
                    destino: $('#sucursal').val(),
                    copia: "SI",
                    sucursal: $('#sucursal').val()
                },
                type: 'POST',
                success: function(response) {

                    var msj = new String(response).valueOf().trim();
                    if (msj === "true") {
                        var filas = document.getElementById('tbDetalle').rows.length;

                        //se creo el encabezado asi que guardo el detalle
                        for (var i = 0; i < filas; i++) {
                            var u = "../../controller/movimientosInventario/crearDetalleEgreso.php";
                            let productoi = document.getElementById('tbDetalle').rows[i].cells[0].innerHTML;
                            let cantidadi = document.getElementById('tbDetalle').rows[i].cells[3].innerHTML;

                            $.ajax({
                                url: u,
                                data: {
                                    id: ingreso,
                                    movimiento: "2",
                                    numero: ingreso,
                                    producto: document.getElementById('tbDetalle').rows[i].cells[0].innerHTML,
                                    precio: 0.00,
                                    cantidad: document.getElementById('tbDetalle').rows[i].cells[2].innerHTML,
                                    total: 0.00,
                                    sucursal: $('#sucursal').val()
                                },
                                type: 'POST',
                                success: function(response) {

                                }

                            });
                        }
                        actualizarActual("2", ingreso, $('#sucursal').val());
                    } else {



                    }

                }
            });


        });






    }

    ///

    function agregarFilas() {
        var codigo = $('#idProducto').val();
        var descripcion = $('#descripcion').val();
        var cantidad = $('#cantidad').val();
        if (descripcion === "") {
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
                        cantidad + '</td> <td> <button  id="deleteItem" class="btn btn-danger"><img src="../../images/iconos/delete-package.png" border="0"  width="16" height="16"></button></td></tr>';
                    $('#tbDetalle').append(fila);
                    $('#idProducto').val("");
                    $('#descripcion').val("");
                    $('#cantidad').val("");

                }

            });

        }


    }

    //boorar fila
    $(document).on('click', '#deleteItem', function(event) {
        event.preventDefault();
        if (confirm("SE QUITARA EL PRODUCTO\nDESEA CONTINUAR?")) {

            $(this).closest('tr').remove();

        }
    });
    //para traer ingreso
    function traerIngresoActual() {

        const id = "5";
        const sucursal = "1";

        $.post('../../controller/movimientosInventario/traerMovimientoActual.php', {
            id,
            sucursal
        }, (response) => {
            const task = JSON.parse(response);
            $('#egreso').val(task.actual);

        });




    }



    //btn cancelar
    $('#btnGuardar').click(function() {

        if (confirm("AL CREAR EL EGRESO ESTE SE DESCARGARA DE SU EXISTENCIA\nDESEA CONTINUAR?")) {
            var u = "../../controller/movimientosInventario/crearEgreso.php";
            $.ajax({
                url: u,
                data: {
                    id: $('#egreso').val(),
                    movimiento: "5",
                    numero: $('#egreso').val(),
                    estadoEgreso: "CERRADO",
                    salida: "1",
                    destino: $('#sucursal').val(),
                    copia: "NO",
                    sucursal: "1"
                },
                type: 'POST',
                success: function(response) {

                    var msj = new String(response).valueOf().trim();
                    if (msj === "true") {
                        var filas = document.getElementById('tbDetalle').rows.length;

                        //se creo el encabezado asi que guardo el detalle
                        for (var i = 0; i < filas; i++) {
                            var u = "../../controller/movimientosInventario/crearDetalleEgreso.php";
                            let productoi = document.getElementById('tbDetalle').rows[i].cells[0].innerHTML;
                            let cantidadi = document.getElementById('tbDetalle').rows[i].cells[2].innerHTML;

                            $.ajax({
                                url: u,
                                data: {
                                    id: $('#egreso').val(),
                                    movimiento: "5",
                                    numero: $('#egreso').val(),
                                    producto: document.getElementById('tbDetalle').rows[i].cells[0].innerHTML,
                                    precio: 0.00,
                                    cantidad: document.getElementById('tbDetalle').rows[i].cells[2].innerHTML,
                                    total: 0.00,
                                    sucursal: "1"
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
                        actualizarActual("5", $('#egreso').val(), "1");
                        crearIngresoSucursalRecibidor($('#sucursal').val());
                        traerIngresoActual();
                        alert("EGRESO EXITOSO");
                        location.reload();
                    } else {
                        alert("NO SE PUDO CREAR EL EGRESO")


                    }

                }
            });
        }





    });


    //

    function existencia(pro, can) {

        var u = "../../controller/existencias/restarExistenciaSucursal.php";

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
    function actualizarActual(id, actual, suc) {
        var u = "../../controller/movimientosInventario/actualizarMovimientoActual.php";

        $.ajax({
            url: u,
            data: {
                id: id,
                actual: actual,
                sucursal: suc
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