let $allRows;
let filterText = '';
let rowsPerPage = 13;
let currentPage = 1;
var modal = '';

function filterTable() {
    filterText = $('.textFilro').val().toUpperCase();
    paginate();
}

function paginate() {
    
    const $visibleRows = $allRows.filter(function () {
        const text = $(this).text().toUpperCase();
        const matches = text.indexOf(filterText) > -1;
        $(this).toggle(matches);
        return matches;
    });

    const totalRecords   = $visibleRows.length;    
    const totalPages     = Math.ceil(totalRecords / rowsPerPage);
    const startIndex     = (currentPage - 1) * rowsPerPage;
    const endIndex       = Math.min(startIndex + rowsPerPage, totalRecords);

    $visibleRows.hide().slice(startIndex, startIndex + rowsPerPage).show();

    let displayText;
    if (totalRecords === 0) {
        displayText = 'No hay registros para mostrar';
    } else {
        displayText = `${startIndex + 1} a ${endIndex} de ${totalRecords} Registros`;
    }
    $('.cabtreg').text(displayText);
    renderPagination(totalPages);

    if(totalRecords==0){
        $("#btnAddMaster").removeClass('btn-secundary').addClass('btn-primary');
        $("#btnAddMaster").prop('disabled', false);
        $('.btmModalAceptar').prop('disabled', true).removeClass('btn-primary').addClass('btn-secundary');
    }else{
        $("#btnAddMaster").removeClass('btn-primary').addClass('btn-secundary');
        $("#btnAddMaster").prop('disabled', true);
        $('.btmModalAceptar').prop('disabled', false).removeClass('btn-secundary').addClass('btn-primary');
    }

}

function clearFilter() {
    $('.textFilro').val('');          // Vaciar el campo de texto
    filterText = '';
    rowsPerPage = 13;
    currentPage = 1;
    paginate();                       // Volver a ejecutar el paginador sin filtro
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


function renderPagination(totalPages) {
    let html = '';
    if (totalPages > 1) {
        $('.row.mt-2').removeClass('d-none');
    }else{
        $('.row.mt-2').addClass('d-none');
    }
    if (currentPage > 1) { html += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage(${currentPage - 1}); return false;">Anterior</a></li>`; }
    for (let i = 1; i <= totalPages; i++) {
        html += `<li class="page-item ${i === currentPage ? 'active' : ''}">
                  <a class="page-link" href="#" onclick="goToPage(${i}); return false;">${i}</a>
                </li>`;
    }
    if (currentPage < totalPages) { html += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage(${currentPage + 1}); return false;">Siguiente</a></li>`;}
    $('.pagination').html(html);
}

function goToPage(page) {
    currentPage = page;
    paginate();
}

$(document).ready(function () {
    /*INICIA EL PROCESO DE FILTRADO*/
    $allRows = $('.tblfiltro tbody tr');
    paginate();
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
            cargarDatosSelect('id', 'nombre', 'mst_paises_departamentos_ciudades', 'mst_paises_departamentos__id=' + id, 'mst_paises_departamentos_ciudades__id', '', 'mdlCiudades');
            break;
          case 'loadDepartamentos':
            cargarDatosSelect('id', 'nombre', 'mst_paises_departamentos', 'mst_paises__id=' + id, 'mst_paises_departamentos__id', 'loadCiudades', 'mdlDepartamentos');
            $("#btnmst_paises_departamentos_ciudades__id").prop('disabled', true);
            $("#mst_paises_departamentos_ciudades__id_lst").html('');
            $("#desmst_paises_departamentos_ciudades__id").html('-- Seleccione --');
            $('mst_paises_departamentos_ciudades__id').val('');
            break;
          default:
            return false;
            break;
      }
    }
}

function abrirModal(getmodal, tabla, prnid, prncampo, consultaWhere, control, call_funcion) {
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
            clearFilter();
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

function cargarDatosSelect(prnid, prncampo, tabla, consultaWhere, setcontrol , call_funcion='', modal='') {
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
            $('#'+campo+'_lst').children().eq(0).after('<a class="dropdown-item" href="#" onclick="seleccionarOpcion(\''+setNombre.toUpperCase()+'\', \''+respuesta.new_id+'\', \''+campo+'\', \''+accion+'\')">'+setNombre.toUpperCase()+'</a>');
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