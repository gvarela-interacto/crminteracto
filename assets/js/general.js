let $allRows;
let filterText = '';
let rowsPerPage = 13;
let currentPage = 1;
var modal = '';

function parpadearBorde(selector) {
  const duracionTotal = 2000; // 10 segundos
  const intervaloParpadeo = 500; // tiempo entre cambios (medio segundo)
  let parpadeoActivo = true;
  let colorAzul = '1px solid #c1c1c1';
  let colorGris = 'none';

  let toggle = false;
  const boton = $(selector);

  // Asegurarse que tenga borde inicial gris
  boton.css('border', colorGris);

  const intervalId = setInterval(() => {
    toggle = !toggle;
    boton.css('border', toggle ? colorAzul : colorGris);
  }, intervaloParpadeo);

  // Después de 10 segundos, detener parpadeo y dejar borde gris
  setTimeout(() => {
    clearInterval(intervalId);
    boton.css('border', colorGris);
  }, duracionTotal);
}




function filterTable(tablaId) {
    const $tabla = $('#' + tablaId);
    const filterText = $('#searInp-'+tablaId).val().toUpperCase();
    $tabla.data('filterText', filterText);
    $tabla.data('currentPage', 1);

    paginate(tablaId);
}

function paginate(tablaId) {
    const $tabla = $('#' + tablaId);
    const filterText = $tabla.data('filterText') || '';
    const currentPage = $tabla.data('currentPage') || 1;
    const rowsPerPage = $tabla.data('rowsPerPage') || 13;
    const $allRows = $tabla.find('tbody tr');

    const $visibleRows = $allRows.filter(function () {
        const text = $(this).text().toUpperCase();
        const matches = text.indexOf(filterText) > -1;
        $(this).toggle(matches);
        return matches;
    });

    const totalRecords = $visibleRows.length;
    const totalPages = Math.ceil(totalRecords / rowsPerPage);
    const startIndex = (currentPage - 1) * rowsPerPage;
    const endIndex = Math.min(startIndex + rowsPerPage, totalRecords);

    $visibleRows.hide().slice(startIndex, startIndex + rowsPerPage).show();

    let displayText = totalRecords === 0
        ? 'No hay registros para mostrar'
        : `${startIndex + 1} a ${endIndex} de ${totalRecords} Registros`;
   
    $('#cabtreg_'+tablaId).text(displayText);
    renderPagination(tablaId, totalPages); // También debe adaptarse

    if (totalRecords === 0) {
        $("#btnAM_"+tablaId).removeClass('btn-secundary').addClass('btn-primary').prop('disabled', false);
        $(".btmModalAceptar").prop('disabled', true).removeClass('btn-primary').addClass('btn-secundary');
    } else {
        $("#btnAM_"+tablaId).removeClass('btn-primary').addClass('btn-secundary').prop('disabled', true);
        $(".btmModalAceptar").prop('disabled', false).removeClass('btn-secundary').addClass('btn-primary');
    }
}

function clearFilter(tablaId) {
    const $tabla = $('#' + tablaId);
    $tabla.find('.textFilro').val('');
    $tabla.data('filterText', '');
    $tabla.data('currentPage', 1);
    paginate(tablaId);
}

function seleccionarFila(fila, gid, gnom) {
  const tabla = fila.closest('table');
  if (!tabla) return;
  const filas = tabla.querySelectorAll('tbody tr');
  filas.forEach(tr => {
    const celda = tr.querySelector('td:first-child');
    if (celda) celda.innerHTML = '';
  });
  const celdaSeleccionada = fila.querySelector('td:first-child');
  if (celdaSeleccionada) {
    celdaSeleccionada.innerHTML = '<div class="rwseleccionado"></div>';
    $('#setLoadId'+tabla.id).val(gid);
    $('#setLoadName'+tabla.id).val(gnom);
  }
}


function renderPagination(tablaId, totalPages) {
    let html = '';
    if (totalPages > 1) {
        $('.row.mt-2').removeClass('d-none');
    }else{
        $('.row.mt-2').addClass('d-none');
    }
    if (currentPage > 1) { html += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage('`+tablaId+`', ${currentPage - 1}); return false;">Anterior</a></li>`; }
    for (let i = 1; i <= totalPages; i++) {
        html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                  <a class="page-link" href="#" onclick="goToPage('`+tablaId+`', ${i}); return false;">${i}</a>
                </li>`;
    }
    if (currentPage < totalPages) { html += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage('`+tablaId+`', ${currentPage + 1}); return false;">Siguiente</a></li>`;}
    $('#pagination_'+tablaId).html(html);
}

function goToPage(tablaId, pageNumber) {
    const $tabla = $('#' + tablaId);
    $tabla.data('currentPage', pageNumber);
    paginate(tablaId);
}

$(document).ready(function () {
    /*INICIA EL PROCESO DE FILTRADO*/
    //$allRows = $('.tblfiltro tbody tr');
    //paginate();
});

function seleccionarOpcion(nombre, id, campo, accion) {
    $('#des' + campo).text(nombre);
    $('#' + campo).val(id);
    if(accion!=''){
      switch(accion){
          case 'chTextoNombre':
            if(nombre=='JURIDICA'){
                $('#setTituloNombre').text('Razón Social');
            }else{
                $('#setTituloNombre').text('Nombre');
            }
            break;
          case 'loadCiudades':
            if(id!=''){
                cargarDatosSelect('id', 'nombre', 'mst_paises_departamentos_ciudades', 'mst_paises_departamentos__id=' + id, 'mst_paises_departamentos_ciudades__id', 'mst_paises_departamentos__id', id,  '', 'mdlCiudades');
            }else{
                $("#btnmst_paises_departamentos_ciudades__id").prop('disabled', true);
                $("#mst_paises_departamentos_ciudades__id_lst").html('');
                $("#desmst_paises_departamentos_ciudades__id").html('-- Seleccione --');
                $('mst_paises_departamentos_ciudades__id').val('');
            }
            break;
          case 'loadDepartamentos':
            if(id!=''){
                cargarDatosSelect('id', 'nombre', 'mst_paises_departamentos', 'mst_paises__id=' + id, 'mst_paises_departamentos__id', 'mst_paises__id', id ,'loadCiudades', 'mdlDepartamentos');
                $("#btnmst_paises_departamentos_ciudades__id").prop('disabled', true);
                $("#mst_paises_departamentos_ciudades__id_lst").html('');
                $("#desmst_paises_departamentos_ciudades__id").html('-- Seleccione --');
                $('mst_paises_departamentos_ciudades__id').val('');
            }else{               
                $("#btnmst_paises_departamentos__id").prop('disabled', true);
                $("#mst_paises_departamentos__id_lst").html('');
                $("#desmst_paises_departamentos__id").html('-- Seleccione --');
                $('mst_paises_departamentos__id').val('');
                $("#btnmst_paises_departamentos_ciudades__id").prop('disabled', true);
                $("#mst_paises_departamentos_ciudades__id_lst").html('');
                $("#desmst_paises_departamentos_ciudades__id").html('-- Seleccione --');
                $('mst_paises_departamentos_ciudades__id').val('');
            }
            break;
          default:
            return false;
            break;
      }
    }
}

function abrirModal(getmodal, tabla, prnid, prncampo, consultaWhere, camporeferencia, idreferencia, control, call_funcion) {
    modal = new bootstrap.Modal(document.getElementById(getmodal));
    $.ajax({
        url: 'assets/php/loadDatosSelectModal.php',
        type: 'POST',
        data: { 
                prnid           : prnid,
                prncampo        : prncampo,
                tabla           : tabla,
                consultaWhere   : consultaWhere,
                seleccionado    : $('#des'+control).text(),
            },
        dataType: 'html',
        success: function (respuesta) {
            $('#body-'+tabla).html(respuesta);
            $allRows = $('.tblfiltro tbody tr');
            $('#searchInput_'+tabla).val('').focus();
            clearFilter('tbl_'+tabla);
            $('#campoRefencia_'+tabla).val(camporeferencia);
            $('#idRefencia_'+tabla).val(idreferencia);
            modal.show();
            $('#getcampo'+getmodal).val(control);
            $('#getaccion'+getmodal).val(call_funcion);
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo cargar la información'
            });
        }
    });
}

function cargarDatosSelect(prnid, prncampo, tabla, consultaWhere, setcontrol , camporeferencia='', idreferencia='', call_funcion='', modal='') {   
    $('#'+setcontrol+'_lst').html("");
    $('#des'+setcontrol).html("-- Seleccione --");
    $.ajax({
        url: 'assets/php/loadDatosSelect.php',
        type: 'POST',
        data: { 
                prnid           : prnid,
                prncampo        : prncampo,
                tabla           : tabla,
                consultaWhere   : consultaWhere,
                setcontrol      : setcontrol,
                camporeferencia : camporeferencia,
                idreferencia    : idreferencia,
                call_funcion    : call_funcion,
                modal           : modal
            },
        dataType: 'html',
        success: function (respuesta) {
            $('#'+setcontrol+'_lst').html(respuesta);
            $('#btn'+setcontrol).prop('disabled', false);
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo cargar la información'
            });
        }
    });
}

function cerrarModal(idModal) { 
  modal.hide();
}

function guardarRegistroMaestro(tabla, valor, relacionNombre, relacion, getmodal, campo, accion){
    const setNombre= $('#'+valor).val();
    $.ajax({
      url: "assets/php/agregarDatoMaestro.php",
      type: "POST",
      data: {
          tabla: tabla,
          setNombre: setNombre,
          relacionNombre:relacionNombre,
          relacion: relacion
      },
      dataType: "json",
      success: function(respuesta) {
          if (respuesta.success === true) { 
            seleccionarOpcion(setNombre.toUpperCase(), respuesta.new_id, campo, accion);
            let $nuevo = $('<a class="dropdown-item" href="#" onclick="seleccionarOpcion(\''+setNombre.toUpperCase()+'\', \''+respuesta.new_id+'\', \''+campo+'\', \''+accion+'\')">'+setNombre.toUpperCase()+'</a>');

                // Insertar antes del botón "Agregar nuevo"
                $('#' + campo + '_lst div').last().before($nuevo);

                // Ahora reordenar alfabéticamente
                let $contenedor = $('#' + campo + '_lst');
                let $primero = $contenedor.find('a.dropdown-item').first(); // "-- Seleccione --"
                let $ultimo = $contenedor.find('div').last(); // Botón "Agregar nuevo"

                // Seleccionar todos los <a> intermedios (sin el primero ni el último)
                let $items = $contenedor.find('a.dropdown-item').not($primero).not($ultimo.find('a'));

                // Ordenar por texto
                $items.sort(function(a, b) {
                return $(a).text().localeCompare($(b).text());
                });

                // Reinsertar en orden
                $items.detach();
                $.each($items, function(index, item) {
                $primero.after(item);
                $primero = $(item); // Para que el siguiente se inserte después del actual
                });
                
            socket.emit('updSelect', setNombre.toUpperCase(), respuesta.new_id, campo, accion);
            modal.hide();
          }else{
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: respuesta.message
            });
          }
      },
      error: function(jqXHR, textStatus, errorThrown) {
          Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Error el ejecutar la petición"
          });
      }
   });
}






/**SALIR DEL SISTEMA */
function logout(){
  $.ajax({
      url: "includes/_userlogin/logout.php",
      type: "POST",
      contentType: false,
      processData: false,
      dataType: "json",
          success: function(respuesta) {
          if (respuesta.success === true) {          
              localStorage.removeItem("logged");
              localStorage.removeItem("uid");
              localStorage.removeItem("nombres");
              localStorage.removeItem("apellidos");
              localStorage.removeItem("correoelectronico");
              localStorage.removeItem("whatsapp");
              localStorage.removeItem("rol");
              location.href="login.php";       
          }
      },
      error: function(jqXHR, textStatus, errorThrown) {
          Swal.fire({
              icon: "error",
              title: "Oops...",
              text: "Error el ejecutar la petición"
          });
      }
  });
};