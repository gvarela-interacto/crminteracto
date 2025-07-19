<?php
include('_loadDataToProcess.php');


$sentenciaListado  = "SELECT ".$tabla.".*";
$rowcabezal='';
$rowcuerpo='';
foreach ($setDatos as $dato) {
    $nombre     = $dato['nombre']   ?? '';
    $tipo       = $dato['tipo']     ?? '';
    $longitud   = $dato['longitud'] ?? '';
    $pkey       = $dato['pkey']     ?? '';
    $nulo       = $dato['nulo']     ?? '';
    $ol         = $dato['ol']       ?? false;
    $rl         = $dato['rl']       ?? false;
    $oc         = $dato['oc']       ?? false;
    $rc         = $dato['rc']       ?? false;
    
    /*LISTADO*/
    
    $ocultarFromTable='';
    if($ol=='false'){ $ocultarFromTable='d-none'; }
    if($rl!='false'){
        $getNameTabla = explode("_",$nombre);
        $relDes=$rl.'Des';
        $sentenciaListado .= ", (SELECT ".$rl." FROM ".$getNameTabla[0]."s WHERE id=".$tabla.".".$getNameTabla[0]."_id) as ".$relDes;
        $nombreColumna=explode("_",$nombre);
        if($ol=='true'){
            $rowcabezal.="\t\t\t\t".'<th class="interRow d-md-table-cell '.$ocultarFromTable.'">'.strtoupper($nombreColumna[0]).'</th>'."\n";
            $rowcuerpo.="\t".'<td class="zt_celda '.$ocultarFromTable.'" style="padding:6px 10px"><?php echo strtoupper($row[\''.$relDes.'\']); ?></td>'."\n";
        }
    }else{
        if($ol=='true'){
            $rowcabezal.="\t\t\t\t".'<th class="interRow d-md-table-cell '.$ocultarFromTable.'">'.strtoupper($nombre).'</th>'."\n";
            switch($nombre){
                case 'creado': case 'actualizado':
                    $rowcuerpo.="\t".'<td class="zt_celda '.$ocultarFromTable.'" style="padding:6px 10px"><?php echo convertirEpochFecha($row[\''.$nombre.'\']); ?></td>'."\n";
                    break;
                case 'id':
                    $rowcuerpo.="\t".'<td class="zt_celda '.$ocultarFromTable.'" style="padding:6px 10px"><?php echo str_pad($row[\''.$nombre.'\'],5, "0", STR_PAD_LEFT); ?></td>'."\n";
                    break;
                default:
                    $rowcuerpo.="\t".'<td class="zt_celda '.$ocultarFromTable.'" style="padding:6px 10px"><?php echo strtoupper($row[\''.$nombre.'\']); ?></td>'."\n";
                    break;
            } 
        }   
    } 
}
$palabra = strtolower(rtrim($tabla, 's'));
$rowcabezal.="\t\t\t\t".'<th class="interRow d-md-table-cell" width="10"></th>';
$rowcuerpo.="\t\t".'<td width="10" style="padding:6px 10px">
                <div>
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                        <span class="mdi mdi-dots-vertical" style="padding:0px;"></span>
                    </a>
                    <div class="dropdown-menu mnuhover">
                        <a class="dropdown-item" href="?p='.$carpeta.'&s='.$tabla.'"><span class="mdi mdi-eye"></span> Abrir registro</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="?p='.$carpeta.'&s=upd'.ucfirst(strtolower($tabla)).'&rid=<?=$row["id"]?>"><span class="mdi mdi-file-document-edit"></span> Modificar registro</a>
                        <a class="dropdown-item" href="?p='.$carpeta.'&s=del'.ucfirst(strtolower($tabla)).'"><span class="mdi mdi-trash-can-outline"></span> Eliminar</a>
                    </div>
                </div>
            </td>';


$sentenciaListado .= " FROM $tabla WHERE estado<>'ELIMINADO'";


$rutaArchivo = $rutaBase.$carpeta."/".$archivo;
$setTablaTitulo = strtoupper($palabra = rtrim($tabla, 's'));
$setTablaUpeer=ucfirst(strtolower($tabla));

$codigo = <<<PHP
<?php
\$result = mysqli_query(\$cnn, "$sentenciaListado");
?>
    <div class="row">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <h4>LISTADO DE $setTablaTitulo</h4>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-12">
                            <a href="?p=$carpeta&s=add$setTablaUpeer" class="btn btn-primary w-100" style="border-radius:5px; color:#FFF; padding:16px">NUEVO $setTablaTitulo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="padding:0px">
        <div class="row" style="margin:10px 0px">
            <div class="col-6" style="padding:0px">
                <input type="text" id="searchInput" class="form-control" placeholder="Buscar registro" onkeyup="filterTable()">
            </div>
            <div class="col-6" style="text-align:right; padding:0px;" title="Exportar listado">
                <div class="export btn-group">
                    <button style="border-radius:0px; padding:5px 6px" class="btn btn-secondary btn-sm dropdown-toggle" aria-label="Export data" data-bs-toggle="dropdown" type="button" title="Exportar listado" aria-expanded="false">
                        <i class="mdi mdi-export-variant"></i><span class="caret"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" style="">
                       <!-- <a class="dropdown-item " href="#" onclick="exportarListado('pdf')" data-type="pdf">PDF</a>-->
                        <a class="dropdown-item " href="#" onclick="exportarListado('csv')" data-type="csv">CSV</a>
                        <a class="dropdown-item " href="#" onclick="exportarListado('excel')" data-type="excel">MS-Excel</a>
                        <a class="dropdown-item " href="#" onclick="exportarListado('txt')" data-type="txt">TXT</a>
                        <a class="dropdown-item " href="#" onclick="exportarListado('json')" data-type="json">JSON</a>
                        <a class="dropdown-item " href="#" onclick="exportarListado('xml')" data-type="xml">XML</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="$tablaName" class="table table-striped zt_table" style="font-size:12px">
                <thead>
                    <tr style="background:#ddd;">
$rowcabezal
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while(\$row = mysqli_fetch_array(\$result)){
                    ?>
                        <tr style="cursor:pointer;" onclick="">
$rowcuerpo
                        </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12 d-flex justify-content-end">
            <nav>
                <ul class="pagination justify-content-right" id="pagination"></ul>
            </nav>
        </div>
    </div>
PHP;

include('_loadDataToProcessEnd.php');
?>