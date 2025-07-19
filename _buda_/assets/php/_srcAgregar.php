<?php
include('_loadDataToProcess.php');

$campos='';

foreach ($setDatos as $dato) {
    $nombre     = $dato['nombre']   ?? '';
    $tipo       = $dato['tipo']     ?? '';
    $longitud   = $dato['longitud'] ?? '';
    $pkey       = $dato['pkey']     ?? '';
    $nulo       = $dato['nulo']     ?? '';
    $ayudante   = $dato['ayudante']    ?? '';
    $ol         = $dato['ol']       ?? false;
    $rl         = $dato['rl']       ?? false;
    $oc         = $dato['oc']       ?? false;
    $rc         = $dato['rc']       ?? false;
    
    switch($tipo){
        case 'int':
            $setTipoCampo='number';
            break;
        case 'float':
            $setTipoCampo='number';
            break;
        case 'fecha':
            $setTipoCampo='date';
            break;
        case 'datetime':
            $setTipoCampo='date';
            break;
        case 'time':
            $setTipoCampo='time';
            break;
        case 'enum':
            $setTipoCampo='lista';
            break;
        case 'imagen':
            $setTipoCampo='imagen';
            break;
        case 'document':
            $setTipoCampo='documento';
            break;
        default:
            $setTipoCampo='text';
            break;
    }

    $ocultarFromTable='';
    if($oc=='false'){ $ocultarFromCreate='d-none'; }
    if($oc=='true'){
        if($rc!='false'){
            $getNombreCombo = explode('_',$nombre);
            $campos.='<div class="form-group row">';
            $campos.= '<label for="ctr'.$nombre.'" class="col-12 col-md-3 col-form-label">';
            if($ayudante!=''){
                $campos.= '<i data-bs-toggle="tooltip" data-bs-placement="top" title="'.$ayudante.'" class="tooltop mdi mdi-help-circle menu-icon"></i>';
            }
            $campos.= $getNombreCombo[0].'</label>';
            $campos.= '<div class="col-sm-9">';
            $campos.= '<select class="form-control " id="ctr'.$nombre.'" name="ctr'.$nombre.'">';
            $campos.= '<option value="">-- SELECCIONE --</option>';
            $campos.= '<?=loadComboData($cnn, "'.$getNombreCombo[0].'s", "id", "'.$rc.'", "estado=\'ACTIVO\'")?>';
            $campos.= '</select>';
            $campos.= '</div>';
            $campos.= '</div>';
        }else{
            switch($setTipoCampo){
                case 'lista':
                    $campos.='<div class="form-group row">';
                    $campos.= '<label for="ctr'.$nombre.'" class="col-12 col-md-3 col-form-label">';
                    if($ayudante!=''){
                        $campos.= '<i data-bs-toggle="tooltip" data-bs-placement="top" title="'.$ayudante.'" class="tooltop mdi mdi-help-circle menu-icon"></i>';
                    }
                    $campos.=$nombre.'</label>';
                    $campos.= '<div class="col-sm-9">';
                    $campos.= '<select class="form-control " id="ctr'.$nombre.'" name="ctr'.$nombre.'">';
                    $campos.= '<option value="">-- SELECCIONE --</option>';
                    
                    $setNuevoValores = explode(",",$longitud);
                    foreach ($setNuevoValores as $valor) {
                        $valor=str_replace("'", "", $valor) . PHP_EOL;
                        $valor=trim(preg_replace('/\s+/', ' ', $valor));
                        $campos.= '<option value="'.$valor.'">'.$valor.'</option>';
                    }
                    $campos.= '</select>';
                    $campos.= '</div>';
                    $campos.= '</div>';
                    break;
                case 'imagen':
                    $campos.= '<div class="form-group row">';
                    $campos.=     '<label for="ctr'.$nombre.'" class="col-12 col-md-3 col-form-label">';
                    if($ayudante!=''){
                        $campos.= '<i data-bs-toggle="tooltip" data-bs-placement="top" title="'.$ayudante.'" class="tooltop mdi mdi-help-circle menu-icon"></i>';
                    }
                    $campos.=$nombre.'</label>';
                    $campos.=         '<div class="col-sm-9">';
                    $campos.=             '<input type="file" style="display:none" id="ctr'.$nombre.'" name="ctr'.$nombre.'" accept="image/*">';
                    $campos.=                '<div class="imagenSingleUpload">';
                    $campos.=                    '<div class="row ps-3">';
                    $campos.=                        '<div class="col-2" style="padding:0px; cursor:pointer" id="imgSingle'.$nombre.'">';
                    $campos.=                            '<img id="sibleImg'.$nombre.'" src="images/previewSingle.png" class="imgPreviewSible">';
                    $campos.=                        '</div>';
                    $campos.=                       '<div class="col-10" style="padding:0px;">';
                    $campos.=                           '<div  id="lblCargar2Imagen'.$nombre.'" class="cargarImagen">Cargar Imágen</div>';
                    $campos.=                           '<div id="lblCargarImagen'.$nombre.'">PDF, JPEG o PNG inferior a 5MB</div>';
                    $campos.=                       '</div>';
                    $campos.=                   '</div>';
                    $campos.=                '</div>';
                    $campos.=            '</div>';
                    $campos.=       '</div>';
                    break;
                case 'documento':
                    $campos.= '<div class="form-group row">';
                    $campos.=     '<label for="ctr'.$nombre.'" class="col-12 col-md-3 col-form-label">';
                    if($ayudante!=''){
                        $campos.= '<i data-bs-toggle="tooltip" data-bs-placement="top" title="'.$ayudante.'" class="tooltop mdi mdi-help-circle menu-icon"></i>';
                    }
                    $campos.=$nombre.'</label>';
                    $campos.=         '<div class="col-sm-9">';
                    $campos.=             '<input type="file" style="display:none" id="ctr'.$nombre.'" name="ctr'.$nombre.'" accept="application/pdf">';
                    $campos.=                '<div class="imagenSingleUpload">';
                    $campos.=                    '<div class="row ps-3">';
                    $campos.=                        '<div class="col-2" style="padding:0px; cursor:pointer">';
                    $campos.=                            '<img id="docSingle'.$nombre.'" src="images/previewSingle.png" class="imgPreviewSible">';
                    $campos.=                        '</div>';
                    $campos.=                       '<div class="col-10" style="padding:0px;">';
                    $campos.=                           '<div id="lblCargar2Documento'.$nombre.'" class="cargarImagen">Cargar Documento PDF</div>';
                    $campos.=                           '<div id="lblCargarDocumento'.$nombre.'">PDF inferior a 5MB</div>';
                    $campos.=                       '</div>';
                    $campos.=                   '</div>';
                    $campos.=                '</div>';
                    $campos.=            '</div>';
                    $campos.=       '</div>';
                    break;
                default:
                    $campos.='<div class="form-group row">';
                    $campos.= '<label for="ctr'.$nombre.'" class="col-12 col-md-3 col-form-label">';
                    if($ayudante!=''){
                        $campos.= '<i data-bs-toggle="tooltip" data-bs-placement="top" title="'.$ayudante.'" class="tooltop mdi mdi-help-circle menu-icon"></i>';
                    }
                    $campos.=$nombre.'</label>';
                    $campos.= '<div class="col-sm-9">';
                    $campos.= '<input type="'.$setTipoCampo.'" class="form-control " id="ctr'.$nombre.'" name="ctr'.$nombre.'">';
                    $campos.= '</div>';
                    $campos.= '</div>';
                    break;
            }
        }
    } 
}

if($multimagen=='false'){
    $formFrame = '<div class="row">
                    <div class="col-12 col-md-7 offset-md-2">
                        '.$campos.'
                        <div class="form-group row" style="padding-top:20px">
                            <div class="col-3 col-sm-0"></div>
                            <div class="col-12 col-sm-9">
                                <button id="btnSave$setNombreNomUC" type="submit" class="btn btn-primary btn-lg col-12">CREAR '.$setTablaTitulo.'</button>
                            </div>
                        </div>
                    </div>
                </div>';   
}else{

    $camposImg= '<div class="form-group row">';
    $camposImg.= '<div class="col-sm-9">';
        $camposImg.= '<input type="file" style="display:none" id="ctrIma'.$tabla.'" accept="image/*" multiple>';
        $camposImg.= '<div class="col-sm-9 p-0">';
            $camposImg.= '<div id="dropArea"></div>';
            $camposImg.= '<div id="divPreviewContenedor">';
                $camposImg.= '<div id="previewArea"></div>';
                $camposImg.= '<div id="previewAreaOptions"></div>';
            $camposImg.= '</div>';
            $camposImg.= '<div id="previewContainer"></div>';
        $camposImg.= '</div>';
    $camposImg.= '</div>';
    $camposImg.= '</div>';


    $formFrame =   '<div class="row">
                        <div class="col-12 col-md-6 ps-5">
                            '.$campos.'
                        </div>
                        <div class="col-12 col-md-6 ps-5">
                            '.$camposImg.'
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 ps-5">
                            <div class="form-group row" style="padding-top:20px">
                                <div class="col-3 col-sm-0"></div>
                                <div class="col-12 col-sm-9">
                                    <button id="btnSave$setNombreNomUC" type="submit" class="btn btn-primary btn-lg col-12">CREAR '.$setTablaTitulo.'</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-5">
                            
                        </div>
                    </div>';
}

$rutaArchivo = $rutaBase.$carpeta.'/'.$archivo;
$setTablaTitulo = strtoupper($tabla);
$setNombreTitulo=strtoupper($_POST['setTabla']);
$setNombreNomUC=ucfirst(strtolower($_POST['setTabla']));
$codigo = <<<PHP
<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <h4>CREACION DE $setNombreTitulo</h4>
                    </li>
                </ul>
                <div>
                    <div class="btn-wrapper">
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="padding-top:20px">
    <form id="frm$setNombreNomUC">
        $formFrame
    </form>
</div>
PHP;

include('_loadDataToProcessEnd.php');
?>