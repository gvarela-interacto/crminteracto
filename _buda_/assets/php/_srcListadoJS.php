<?php
header("Content-Type: application/json");

$rutaBase = __DIR__ . "/../../../includes/";

$tabla      = $_POST['setTabla'] ?? '';
if (!isset($_POST['setTabla']) || empty(trim($_POST['setTabla']))) {
    echo json_encode([
        'success' => false,
        'error' => "No se recibió un nombre válido para la tabla"
    ]);
    exit;
}

$carpeta      = $_POST['setCarpeta'] ?? '';
if (!isset($_POST['setCarpeta']) || empty(trim($_POST['setCarpeta']))) {
    echo json_encode([
        'success' => false,
        'error' => "No se recibió un nombre válido para la carpeta"
    ]);
    exit;
}

if (!isset($_POST['setArchivo']) || empty(trim($_POST['setArchivo']))) {
    echo json_encode([
        'success' => false,
        'error' => "No se recibió un nombre válido para la archivo"
    ]);
    exit;
}

$setDatos      = $_POST['setDatos'] ?? '';


foreach ($setDatos as $dato) {
    $nombre     = $dato['nombre']   ?? '';
    $tipo       = $dato['tipo']     ?? '';
    $longitud   = $dato['longitud'] ?? '';
    $pkey       = $dato['pkey']     ?? '';
    $nulo       = $dato['nulo']     ?? '';
    $ol         = $dato['ol']       ?? false;
    $rl         = $dato['rl']       ?? false;
}

$tablaNane=$tabla.'Tbl';

$getArchivo      = $_POST['setArchivo'] ?? '';
$setDatos        = explode(".",$getArchivo);
$archivo         = "/__".$setDatos[0].'.js';
$rutaArchivo = $rutaBase.$carpeta.$archivo;

$codigo = <<<PHP

let rowsPerPage = 10;
let currentPage = 1;
let \$allRows;

function filterTable() {
  const filter = $('#searchInput').val().toUpperCase();
  \$allRows.each(function () {
    const text = $(this).text().toUpperCase();
    $(this).toggle(text.indexOf(filter) > -1);
  });
  currentPage = 1;
  paginate();
}

function paginate() {
  const \$visibleRows = \$allRows.filter(':visible');
  const totalPages = Math.ceil(\$visibleRows.length / rowsPerPage);
  \$visibleRows.hide();
  const start = (currentPage - 1) * rowsPerPage;
  const end = start + rowsPerPage;
  \$visibleRows.slice(start, end).show();
  renderPagination(totalPages);
}

function renderPagination(totalPages) {
  let html = '';
  if (currentPage > 1) {
    html += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage(\${currentPage - 1}); return false;">Anterior</a></li>`;
  }
  for (let i = 1; i <= totalPages; i++) {
    html += `<li class="page-item \${i === currentPage ? 'active' : ''}">
               <a class="page-link" href="#" onclick="goToPage(\${i}); return false;">\${i}</a>
             </li>`;
  }
  if (currentPage < totalPages) {
    html += `<li class="page-item"><a class="page-link" href="#" onclick="goToPage(\${currentPage + 1}); return false;">Siguiente</a></li>`;
  }
  $('#pagination').html(html);
}

function goToPage(page) {
  currentPage = page;
  paginate();
}

$(document).ready(function () {
  \$allRows = $('#$tablaNane tbody tr');
  paginate();
});

function exportarListado(tipo){
    switch (tipo){
        case 'pdf':
            $('#$tablaNane').tableExport({type:tipo,
                        jspdf: {orientation: 'l',
                                   format: 'a3',
                                   margins: {left:10, right:10, top:20, bottom:20},
                                   autotable: {styles: {fillColor: 'inherit', 
                                                        textColor: 'inherit'},
                                               tableWidth: 'auto'}
                                  }
                          });
            break;
        default:
            $('#$tablaNane').tableExport({type:tipo});
            break;
    }
}

PHP;

include('_loadDataToProcessEnd.php');

?>