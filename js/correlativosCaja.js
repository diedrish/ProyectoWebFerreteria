$(document).ready(function() {
    llenarDocumentos();
    llenarCajas();

    ///boton type submit para gaurdar
    $('#correlativosCajas-form').submit(e => {
        e.preventDefault();

        var datos = new FormData($("#correlativosCajas-form")[0])
        var u = "";
        var mensaje = "";

        u = "../../controller/Correlativos/crearCorrelativosCajas.php";
        mensaje = "SE GUARDAR EL CORRELATIVO\nDESEA CONTINUAR ?";

        if (confirm(mensaje)) {
            $.ajax({

                url: u,
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response);

                    var cadena = new String(response).valueOf().trim();
                    if (cadena === "CORRELATIVOS AGREGADOS") {
                        $('#correlativosCajas-form').trigger('reset');

                    } else {


                    }
                    alert(response);



                }


            });


        }

    });



    //


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

                }

            }
        });
    }
    //llenar select
    function llenarCajas() {
        $.ajax({
            url: '../../controller/documentos/traerCajasSucursal.php',
            data: {
                sucursal: "1"
            },
            type: 'POST',
            success: function(response) {
                if (JSON.parse(response).length < 1) {
                    let template = '';
                    template += `
               <option value="0">NO HAY CAJAS </option>
              `
                    $('#caja').html(template);


                } else {
                    const lista = JSON.parse(response);
                    let template = '';
                    lista.forEach(listar => {
                        template += `
               <option value="${listar.caja}">${listar.caja}</option>
              `
                    });
                    $('#caja').html(template);
                    listarCorrelativosCajas();
                }

            }
        });
    }
    //
    //para traer correlativo
    $(document).on('change', '#caja', function(event) {
            listarCorrelativosCajas();
        })
        //para listar los correlativos por caja
    function listarCorrelativosCajas() {
        const sucursal = "1";

        const caja = $("#caja option:selected").val();

        $.post('../../controller/documentos/traerCorrelativosbyCajas.php', {
            sucursal,
            caja
        }, (response) => {
            const lista = JSON.parse(response);
            let template = '';
            lista.forEach(listar => {

                template += `
                       <tr idEditar="${listar.caja}">
                       <td >${listar.caja}</td>
                        <td >${listar.documento}</td>
                        <td>${listar.serie}</td>
                        <td>${listar.desde}</td>
                        <td>${listar.hasta}</td>
                        <td>${listar.actual}</td>
                       </tr>
                      `
            });
            $('#tbCorrelativos').html(template);

        });


    }




});