$(document).ready(function() {
    llenarDocumentos();

    ///boton type submit para gaurdar
    $('#correlativosCajas-form').submit(e => {
        e.preventDefault();

        var datos = new FormData($("#correlativosCajas-form")[0])
        var u = "";
        var mensaje = "";

        u = "../../controller/Correlativos/crearCorrelativos.php";
        mensaje = "SE GUARDAR EL CORRELATIVO\nDESEA CONTINUAR ?";

        if (confirm(mensaje)) {
            $.ajax({

                url: u,
                type: 'POST',
                data: datos,
                contentType: false,
                processData: false,
                success: function(response) {

                    var cadena = new String(response).valueOf().trim();
                    alert(response);
                    if (cadena === "CORRELATIVOS AGREGADOS") {
                        location.reload();
                    } else {


                    }




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
                    listarCorrelativos();

                }

            }
        });
    }
    //para traer correlativo
    $(document).on('change', '#documento', function(event) {
            listarCorrelativos();
        })
        //para listar los correlativos por caja
    function listarCorrelativos() {
        const documento = $("#documento option:selected").val();
        $.post('../../controller/correlativos/traerCorrelativos.php', {
            documento
        }, (response) => {
            const lista = JSON.parse(response);
            let template = '';
            lista.forEach(listar => {

                template += `
                       <tr idEditar="${listar.documento}">
                        <td >${listar.documento}</td>
                        <td>${listar.serie}</td>
                        <td>${listar.desde}</td>
                        <td>${listar.hasta}</td>
                       </tr>
                      `
            });
            $('#tbCorrelativos').html(template);

        });


    }




});