<?php
include('_loadDataToProcess.php');

$campos='';
$uploadRutaImagenes     = "uploads/".$tabla."/imagenes/";
$uploadRutaDocumentos   = "uploads/".$tabla."/documentos/";

foreach ($setDatos as $dato) {
    $nombre     = $dato['nombre']   ?? '';
    $tipo       = $dato['tipo']     ?? '';
    $longitud   = $dato['longitud'] ?? '';
    $pkey       = $dato['pkey']     ?? '';
    $nulo       = $dato['nulo']     ?? '';
    $ayudante   = $dato['ayudante'] ?? '';
    $ou         = $dato['ou']       ?? false;
    $ru         = $dato['ru']       ?? false;
    
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

    $ouultarFromTable='';
    if($ou=='false'){ $ouultarFromCreate='d-none'; }
    if($ou=='true'){
        if($ru!='false'){
            $getNombreCombo = explode('_',$nombre);
            $campos.='<div class="form-group row">'."\n";;
            $campos.= "\t".'<label for="ctr'.$nombre.'" class="col-12 col-md-3 col-form-label">';
            if($ayudante!=''){
                $campos.= '<i data-bs-toggle="tooltip" data-bs-placement="top" title="'.$ayudante.'" class="tooltop mdi mdi-help-circle menu-icon"></i>';
            }
            $campos.= $getNombreCombo[0].'</label>'."\n";
            $campos.= "\t".'<div class="col-sm-9">'."\n";
            $campos.= "\t\t".'<select class="form-control " id="ctr'.$nombre.'" name="ctr'.$nombre.'">'."\n";
            $campos.= "\t\t\t".'<option value="">-- SELECCIONE --</option>'."\n";
            $campos.= "\t\t\t".'<?=loadComboData($cnn, "'.$getNombreCombo[0].'s", "id", "'.$ru.'", "estado=\'ACTIVO\'", $row[\''.$nombre.'\'])?>'."\n";
            $campos.= "\t\t".'</select>'."\n";
            $campos.= "\t".'</div>'."\n";
            $campos.= '</div>'."\n";
        }else{
            switch($setTipoCampo){
                case 'lista':
                    $campos.='<div class="form-group row">'."\n";
                    $campos.= "\t".'<label for="ctr'.$nombre.'" class="col-12 col-md-3 col-form-label">'."\n";
                    if($ayudante!=''){
                        $campos.= "\t".'<i data-bs-toggle="tooltip" data-bs-placement="top" title="'.$ayudante.'" class="tooltop mdi mdi-help-circle menu-icon"></i>'."\n";
                    }
                    $campos.=$nombre.'</label>'."\n";
                    $campos.= '<div class="col-sm-9">'."\n";
                    $campos.= '<select class="form-control " id="ctr'.$nombre.'" name="ctr'.$nombre.'">'."\n";
                    $campos.= "\t".'<option value="">-- SELECCIONE --</option>'."\n";
                    
                    $setNuevoValores = explode(",",$longitud);
                    foreach ($setNuevoValores as $valor) {
                        $valor=str_replace("'", "", $valor) . PHP_EOL;
                        $valor=trim(preg_replace('/\s+/', ' ', $valor));
                        $campos.= "\t".'<option value="'.$valor.'"';
                        $campos.= '<?php ';
                        $campos.= 'if($row["'.$nombre.'"]=="'.$valor.'"){';
                            $campos.='echo " selected";';
                        $campos.= '}';
                        $campos.= '?>';
                        $campos.= '>'.$valor.'</option>'."\n";
                    }
                    $campos.= '</select>'."\n";
                    $campos.= '</div>'."\n";
                    $campos.= '</div>'."\n";
                    break;
                case 'imagen':
                    $campos.= '<div class="form-group row">'."\n";
                    $campos.=     '<label for="ctr'.$nombre.'" class="col-12 col-md-3 col-form-label">'."\n";
                    $campos.=     '<input type="hidden" name="ctrTmp'.$nombre.'" id="ctrTmp'.$nombre.'" value="<?=$row[\''.$nombre.'\']?>" >'."\n";
                    if($ayudante!=''){
                        $campos.= '<i data-bs-toggle="tooltip" data-bs-placement="top" title="'.$ayudante.'" class="tooltop mdi mdi-help-circle menu-icon"></i>';
                    }
                    $campos.= $nombre.'</label>'."\n";
                    $campos.=         "\t".'<div class="col-sm-9">'."\n";
                    $campos.=             "\t\t".'<div class="imagenSingleUpload">'."\n";
                    $campos.=                    "\t\t".'<div class="row ps-3">'."\n";
                    $campos.=                       "\t\t\t".'<div class="col-2" style="padding:0px; cursor:pointer" id="imgSingle'.$nombre.'">'."\n";
                    $campos.=                           '<input type="file" style="display:none" id="ctr'.$nombre.'" name="ctr'.$nombre.'" accept="image/*">'."\n";
                    $campos.=                            '<?php if(file_exists("'.$uploadRutaImagenes.'".$row[\''.$nombre.'\'])){ $imgShowLbl="Imágen registrada"; $imgShow="'.$uploadRutaImagenes.'".$row[\''.$nombre.'\']; }else{ $imgShowLbl="Cargar Imágen"; $imgShow="images/previewSingle.png"; } ?>'."\n";
                    $campos.=                            '<img id="sibleImg'.$nombre.'" src="<?=$imgShow?>" class="imgPreviewSible">'."\n";
                    $campos.=                        '</div>'."\n";
                    $campos.=                       '<div class="col-10" style="padding:0px 10px 0px 0px;">'."\n";
                    $campos.=                           '<div  id="lblCargar2Imagen'.$nombre.'" class="cargarImagen"><?=$imgShowLbl?></div>'."\n";
                    $campos.=                           '<div id="lblCargarImagen'.$nombre.'">PDF, JPEG o PNG inferior a 5MB</div>'."\n";
                    $campos.=                       '</div>'."\n";
                    $campos.=                   '</div>'."\n";
                    $campos.=                '</div>'."\n";
                    $campos.=            '</div>'."\n";
                    $campos.=       '</div>'."\n";
                    break;
                case 'documento':
                    $campos.= '<div class="form-group row">';
                    $campos.=     '<label for="ctr'.$nombre.'" class="col-12 col-md-3 col-form-label">';
                    $campos.=     '<input type="hidden" name="ctrTmp'.$nombre.'" id="ctrTmp'.$nombre.'" value="<?=$row[\''.$nombre.'\']?>" >'."\n";
                    if($ayudante!=''){
                        $campos.= '<i data-bs-toggle="tooltip" data-bs-placement="top" title="'.$ayudante.'" class="tooltop mdi mdi-help-circle menu-icon"></i>';
                    }
                    $campos.=$nombre.'</label>';
                    $campos.=         '<div class="col-sm-9">';
                    $campos.=             '<input type="file" style="display:none" id="ctr'.$nombre.'" name="ctr'.$nombre.'" accept="application/pdf">';
                    $campos.=                '<div class="imagenSingleUpload">';
                    $campos.=                    '<div class="row ps-3">';
                    $campos.=                        '<div class="col-2" style="padding:0px; cursor:pointer">';
                    $campos.=                            '<?php if(file_exists("'.$uploadRutaDocumentos.'".$row[\''.$nombre.'\'])){ $docShowLbl="Documento registrado"; $imgShow="images/previewSinglepdf.png"; }else{ $docShowLbl="Cargar Documento PDF"; $imgShow="images/previewSingle.png"; } ?>';
                    $campos.=                            '<img id="docSingle'.$nombre.'" src="<?=$imgShow?>" class="imgPreviewSible">';
                    $campos.=                        '</div>';
                    $campos.=                       '<div class="col-10" style="padding:0px 10px 0px 0px;">';
                    $campos.=                           '<div id="lblCargar2Documento'.$nombre.'" class="cargarImagen"><?=$docShowLbl?></div>';
                    $campos.=                           '<div id="lblCargarDocumento'.$nombre.'">PDF inferior a 5MB</div>';
                    $campos.=                       '</div>';
                    $campos.=                   '</div>';
                    $campos.=                '</div>';
                    $campos.=            '</div>';
                    $campos.=       '</div>';
                    break;
                default:
                    $campos.='<div class="form-group row">'."\n";
                    $campos.= '<label for="ctr'.$nombre.'" class="col-12 col-md-3 col-form-label">'."\n";
                    if($ayudante!=''){
                        $campos.= "\t".'<i data-bs-toggle="tooltip" data-bs-placement="top" title="'.$ayudante.'" class="tooltop mdi mdi-help-circle menu-icon"></i>';
                    }
                    $campos.=$nombre."\n";
                    $campos.='</label>'."\n";
                    $campos.= "\t\t\t".'<div class="col-sm-9">'."\n";
                    $campos.= "\t\t\t\t".'<input type="'.$setTipoCampo.'" class="form-control " id="ctr'.$nombre.'" name="ctr'.$nombre.'" value="<?=$row[\''.$nombre.'\']; ?>">'."\n";
                    $campos.= "\t\t\t".'</div>'."\n";
                    $campos.= '</div>'."\n";
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
                                <button id="btnSave$setNombreNomUC" type="submit" class="btn btn-primary btn-lg col-12">ACTUALIZAR '.$setTablaTitulo.'</button>
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
            $camposImg.= '<div id="previewContainer">';
            $palabra = rtrim($tabla, 's');
            $camposImg.= '<?php ';
            $camposImg.= '$sqImagenes="SELECT * FROM '.$tabla.'_imagenes WHERE '.$palabra.'_id=".$_GET[\'rid\']; ';
            $camposImg.= '$rsImagenes=mysqli_query($cnn,$sqImagenes); ';
            $camposImg.= 'echo \'<img src="images/btnAddImagen.png" data-portada="TRUE" class="preview-img-add">\';';
            $camposImg.= 'while($rwImagenes=mysqli_fetch_array($rsImagenes)){ ';

            $rutaImagen = 'ruta/a/tu/imagen.jpg';

            // Verifica si el archivo existe
            if (file_exists($rutaImagen)) {
                // Obtiene el contenido binario de la imagen
                $imagenBinaria = file_get_contents($rutaImagen);
            
                // Codifica el contenido en base64
                $imagenBase64 = base64_encode($imagenBinaria);
            
                // Si quieres usarla como fuente en un <img>, necesitas el tipo MIME
                $tipoMime = mime_content_type($rutaImagen);
                $src = 'data:' . $tipoMime . ';base64,' . $imagenBase64;
            
                echo '<img src="' . $src . '" alt="Imagen base64">';
            }


            $camposImg.=  'echo \'<input type="hidden" value="true" id="multimagen-\'.$rwImagenes[\'id\'].\'" name="multimagen-\'.$rwImagenes[\'id\'].\'" data-imagenid="\'.$rwImagenes[\'id\'].\'" data-imagenurl="\'.$rwImagenes[\'imagen\'].\'")>\';';
            $camposImg.=  'echo \'<img src="'.$uploadRutaImagenes.'\'.$rwImagenes[\'imagen\'].\'" data-setid="multimagen-\'.$rwImagenes[\'id\'].\'" id="Imgmultimagen-\'.$rwImagenes[\'id\'].\'" data-portada="\'.$rwImagenes[\'portada\'].\'" data-index="\'.$rwImagenes[\'imagen\'].\'" class="preview-img preview-img-loaded">\';';
            $camposImg.= '}';
            $camposImg.='?>';
            $camposImg.= '</div>';
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
                                    <button id="btnSave$setNombreNomUC" type="submit" class="btn btn-primary btn-lg col-12">ACTUALIZAR '.$setTablaTitulo.'</button>
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

<?php
\$sql="SELECT * FROM $tabla WHERE id=".\$_GET['rid'];
\$result=mysqli_query(\$cnn,\$sql);
if(\$row=mysqli_fetch_array(\$result)){
?>

<div class="row">
    <div class="col-sm-12">
        <div class="home-tab">
            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <h4><?=\$row['id']?></h4>
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
        <input type="hidden" name="ctrid" id="ctrid" value="<?=\$row['id']?>">
        $formFrame
    </form>
</div>
<?php
}else{
    header('location: $tabla');
}
?>
PHP;

include('_loadDataToProcessEnd.php');
?>