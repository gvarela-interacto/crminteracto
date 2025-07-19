$(document).ready(function() {

    var savedTab = localStorage.getItem('activeTab') || '1';
    
    // Activar el tab y contenido guardado
    $('.tab[data-tab="' + savedTab + '"]').addClass('active');
    $('.tab-content[data-content="' + savedTab + '"]').addClass('active');
    $('.bototnes').hide();
    $('.bototnes[data-tab="' + savedTab + '"]').show();
    // Al hacer clic en un tab
    $('.tab').click(function() {
      var tabId = $(this).data('tab');
      if(tabId==1){
        $('#iniciarScript').show();
        $('#iniciarScript2').hide();
      }
      if(tabId==2){
        $('#iniciarScript').hide();
        $('#iniciarScript2').show();
      }
      localStorage.setItem('activeTab', tabId);
      $('.tab').removeClass('active');
      $(this).addClass('active');
      $('.tab-content').removeClass('active');
      $('.tab-content[data-content="' + tabId + '"]').addClass('active');
    });

    $('#tablaSend').click(function() {
        location.href='index.php?m=estructura&t='+$('#tablas').val();
    });

    $('#iniciarScript').click(function() {
        $('#terminal').html('');
        if($('#setFolder').val()!=''){
            terminal('OK','Iniciando ...');
            terminal('OK','Geneando configuración ...');
            $ouput="";
            ejecutarCreacionArchivos();
        }else{
            Swal.fire({
                title: "eRRoR al iniciar el script",
                text: "No ha seleccionado una carepta de destino. Seleccione una carpeta para continuar",
                icon: "error"
            });
        }
    });


    async function ejecutarCreacionArchivos() {
        try {
            await createFile('_srcListado.php');
            await createFile('_srcListadoJS.php');

            await createFile('_srcAgregar.php');
            await createFile('_srcAgregarProcesar.php');
            await createFile('_srcAgregarJS.php');

            await createFile('_srcEditar.php');
            await createFile('_srcEditarProcesar.php');
            await createFile('_srcEditarJS.php');

            terminal('OK','Se ha creado el CRUD de listado exitosamente');
        } catch (error) {
            terminal('NOT','Se produjo un error y no se completo la tarea');;
        }
    }
    

    $('#tablas').change(function() {
        $tabla = $(this).val();
        if($tabla==''){
            $('#tablaSend').prop("disabled",true);
        }else{
            $('#tablaSend').prop("disabled",false);
        }
    });

    $('#frmListado').change(function() {
        let isChecked = $(this).prop("checked");
        if(!isChecked){
            $(".ol_").attr("disabled",true);
            $(".AFFDF7F").css("opacity", "0.1")
            $(".rl select").attr("disabled",true);
            
        }else{
            $(".ol_").attr("disabled",false);
            $(".AFFDF7F").css("opacity", "1");
            $(".rl select").attr("disabled",false);
        }
    });  
    $('#frmCreate').change(function() {
        let isChecked = $(this).prop("checked");
        if(!isChecked){
            $(".oc_").attr("disabled",true);
            $(".BB6EC7F").css("opacity", "0.1");
            $(".rc select").attr("disabled",true);
        }else{
            $(".oc_").attr("disabled",false);
            $(".BB6EC7F").css("opacity", "1");
            $(".rc select").attr("disabled",false);
        }
    }); 
    $('#frmUpdate').change(function() {
        let isChecked = $(this).prop("checked");
        if(!isChecked){
            $(".ou_").attr("disabled",true);
            $(".CFFBF7F").css("opacity", "0.1");
            $(".ru select").attr("disabled",true);
        }else{
            $(".ou_").attr("disabled",false);
            $(".CFFBF7F").css("opacity", "1");
            $(".ru select").attr("disabled",false);
        }
    });   

    $('#btnAddCarpeta').click(function() {
        Swal.fire({
            title: "Que nombre desea para la carpeta?",
            input: "text",
            inputAttributes: {
              autocapitalize: "off"
            },
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: "Crear Carpeta",
            allowOutsideClick: 'false',
          }).then((result) => {
            if (result.isConfirmed) {
              if(result.value!=''){
                const setName=result.value;
                $.ajax({
                    url: "assets/php/_createFolder.php",
                    type: "POST",
                    data: { carpeta: setName },
                    dataType: "json",
                    success: function(respuesta) {
                        if (respuesta.success) {
                            Swal.fire({
                                title: "Carpeta creada",
                                text: "Carpeta "+setName+" creada satisfactoriamente",
                                icon: "success"
                            });
                            $("#setFolder").html(respuesta.optiones); 
                        }else{
                            Swal.fire({
                                title: "eRRoR de respuesta",
                                text: "Errors: " + respuesta.error,
                                icon: "error"
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: "eRRoR en el script",
                            text: "Error en la solicitud: " + status + " - " + error,
                            icon: "error"
                        });
                    }
                });
              }
            }
          });
    });   
});


function terminal($tipo,$valor){
    switch ($tipo){
        case 'OK':
            $settipo='#000000';
            break;
        case 'NOT':
            $settipo='#FF0000';
            break;
    }
    $('#terminal').append("<div style='color:"+$settipo+"'>>> "+$valor+"</div>");
}

function createFile(getfile) {
    return new Promise((resolve, reject) => {
        const tabla = $('#tablas').val();
        const carpeta = $('#setFolder').val();
        const getUrl = "assets/php/" + getfile;

        var getMultimagen=false;
        if ($('#multimagen').val() && $('#multimagen').val() != '0') {
            getMultimagen = $('#multimagen').val();
        }else{
            getMultimagen = false;
        }

        let datos = [];

        $(".filaCampo").each(function() {
            let checkbox = $(this).find(".infoCampoOL input[type='checkbox']");
            let olValue = checkbox.length > 0 ? checkbox.prop("checked") : false;

            let checkboxC = $(this).find(".infoCampoOC input[type='checkbox']");
            let ocValue = checkboxC.length > 0 ? checkboxC.prop("checked") : false;

            let checkboxU = $(this).find(".infoCampoOU input[type='checkbox']");
            let ouValue = checkboxU.length > 0 ? checkboxU.prop("checked") : false;
        
            let select = $(this).find(".infoCampoRL select");
            let rlValue = select.length > 0 ? select.val() : false;

            let selectC = $(this).find(".infoCampoRC select");
            let rcValue = selectC.length > 0 ? selectC.val() : false;

            let selectU = $(this).find(".infoCampoRU select");
            let ruValue = selectU.length > 0 ? selectU.val() : false;
        
            if($(this).find(".infoCampoTipo").text().trim()=='enum'){
                setlongitud = $(this).find(".infoCampoLongitud span").attr('title').trim();
            }else{
                setlongitud = $(this).find(".infoCampoLongitud").text().trim();
            }
            let fila = {
                nombre: $(this).find(".infoCampoNombre").text().trim(),
                tipo: $(this).find(".infoCampoTipo").text().trim(),
                longitud: setlongitud,
                pkey: $(this).find(".infoCampoPKey").text().trim(),
                nulo: $(this).find(".infoCampoNull").text().trim(),
                ayudante: $(this).find(".infoAyudaCtrl input[type='text']").val().trim(),
                ol: olValue,
                rl: rlValue,
                oc: ocValue,
                rc: rcValue,
                ou: ouValue,
                ru: ruValue
            };
            datos.push(fila);
        });

        let archivo = "";
        switch (getfile) {
            case '_srcListado.php': case '_srcListadoJS.php':
                archivo = $('#setFileListado').val();
                break;
            case '_srcAgregar.php': case '_srcAgregarJS.php':
                archivo = $('#setFileCreate').val();
                break;
            case '_srcAgregarProcesar.php':
                archivo = $('#setFileCreate').val();
                break;
            case '_srcEditar.php': case '_srcEditarJS.php':
                archivo = $('#setFileUpdate').val();
                break;
            case '_srcEditarProcesar.php':
                archivo = $('#setFileUpdate').val();
                break;
        }
        $.ajax({
            url: getUrl,
            type: "POST",
            data: {
                setTabla: tabla,
                setCarpeta: carpeta,
                setArchivo: archivo,
                setMultimagen: getMultimagen,
                setDatos: datos,
            },
            dataType: "json",
            success: function(respuesta) {
                if (respuesta.success) {
                    terminal('OK', 'El archivo ' + respuesta.message );
                    resolve(respuesta);
                } else {
                    terminal('NOT', "Errors: " + respuesta.error);
                    reject(respuesta.error);
                }
            },
            error: function(xhr, status, error) {
                terminal('NOT', "Error en la solicitud: " + status + " - " + error);
                reject(error);
            }
        });
    });
}
