
<div class="row">
    <div class="col-12">
        <table class="table table-bordered table-striped zt_table" style="font-size:12px">
            <tr style="background:#CCC;">
                <td style="padding:4px; text-align: center; border-top:1px solid #FFF; border-right:1px solid #FFF; border-left:1px solid #FFF; background:#FFF; vertical-align: middle;" colspan="6"><b></b></td>
                <td style="padding:4px; background:#F6F6C0; border-top:1px solid #FFF; border-left:1px solid #FFF; background:#FFF; text-align:center" colspan="2">
                  
                </td>
                <td style="padding:4px; background:#F1F1F1; text-align:center" colspan="4">
                     <table class="table zt_table" style="font-size:12px; border:none">
                        <tr>
                            <td style="background:#F1F1F1; border:1px solid #F1F1F1; padding:0px">
                              <?php
                                   $sql = "SHOW TABLES LIKE '".$_GET['t']."_imagenes'";
                                   $result = $cnn->query($sql); 
                                   if ($result->num_rows > 0) {
                                    ?>
                                       <div class="custom-control custom-checkbox" width="54" style="padding-left:26px">
                                            <div class="row">
                                                <div class="col-2" style="padding:0px">
                                                    <select class="form-control" id="multimagen"  class="multimagen" style="padding:1px; font-size:12px; height:22px">
                                                        <?php
                                                            for ($i = 0; $i <= 10; $i++) {
                                                                echo "<option value='".$i."'>".$i."</option>";
                                                            }
                                                        ?>
                                                        <option value="99" selected>N</option>
                                                    </select>
                                                </div>
                                                <div class="col-10" style="padding:2px 0px 0px 6px">
                                                    <b>COMPONENTE MULTI IMAGENES</b></label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                   }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="background:#F1F1F1; border:1px solid #F1F1F1; padding:0px">

                            </td>
                        </tr>
                    </table>
                </td>
                <td style="padding:4px; background:#F1F1F1; text-align:center" colspan="2">
                     <table class="table zt_table" style="font-size:12px; border:none">
                        <tr>
                            <td style="background:#F1F1F1; border:1px solid #F1F1F1; padding:0px">
                                <div class="custom-control custom-checkbox" width="54" style="padding-left:26px">
                                    <input type="checkbox" class="custom-control-input" id="frmCreate2" checked>
                                    <label style="padding-top:3px"  class="custom-control-label" for="frmCreate2"><b>CREATE</b></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="background:#F1F1F1; border:1px solid #F1F1F1; padding:0px">

                            </td>
                        </tr>
                    </table>
                </td>
                <td style="padding:4px; background:#FFFFFF; border:1px solid #FFF; text-align:center" colspan="1">
                     
                </td>
            </tr>
            
        
            <tr style="background:#CCC;">
                <td style="padding:4px; text-align: center; vertical-align: middle;" colspan="6" rowspan="2"><b>INFORMACIÓN DE CAMPOS</b></td>
                <td style="padding:4px; background:#F6F6C0; text-align:center" colspan="2">
                    <div class="custom-control custom-checkbox" width="54">
                        <input type="checkbox" class="custom-control-input" id="frmListado" checked>
                        <label style="padding-top:3px" class="custom-control-label" for="frmListado"><b>LISTADO</b></label>
                    </div>
                </td>
                <td style="padding:4px; background:#D7F7CC; text-align:center" colspan="2">
                    <div class="custom-control custom-checkbox" width="54">
                        <input type="checkbox" class="custom-control-input" id="frmCreate" checked>
                        <label style="padding-top:3px"  class="custom-control-label" for="frmCreate"><b>CREATE</b></label>
                    </div>
                </td>
                <td style="padding:4px; background:#F9E9D9; text-align:center" colspan="2">
                    <div class="custom-control custom-checkbox" width="54">
                        <input type="checkbox" class="custom-control-input" id="frmUpdate" checked>
                        <label style="padding-top:3px"  class="custom-control-label" for="frmUpdate"><b>UPDATE</b></label>
                    </div>
                </td>
                <td style="padding:4px; background:#F0F6FD; text-align:center" colspan="2">
                    <div class="custom-control custom-checkbox" width="54">
                        <input type="checkbox" class="custom-control-input" id="frmDetalle" checked>
                        <label style="padding-top:3px"  class="custom-control-label" for="frmDetalle"><b>DETALLE</b></label>
                    </div>
                </td>
                <td style="padding:4px; background:#FFFFFF; border:1px solid #FFF; text-align:center" colspan="1">

                </td>
            </tr>
            
            <tr style="background:#CCC;">
                <td style="padding:4px; background:#F6F6C0; text-align:center" class="AFFDF7F" colspan="2"><input type="text" class="form-control ol_" id="setFileListado" name="setFileListado" style="font-size:12px;height:22px" placeholder="Archivo" value="listado.php"></td>
                <td style="padding:4px; background:#D7F7CC; text-align:center" class="BB6EC7F" colspan="2"><input type="text" class="form-control oc_" id="setFileCreate" name="setFileCreate" style="font-size:12px;height:22px" placeholder="Archivo" value="add<?=ucfirst($_GET['t'])?>.php"></td>
                <td style="padding:4px; background:#F9E9D9; text-align:center" class="CFFBF7F" colspan="2"><input type="text" class="form-control ou_" id="setFileUpdate" name="setFileUpdate" style="font-size:12px;height:22px" placeholder="Archivo" value="upd<?=ucfirst($_GET['t'])?>.php"></td>
                <td style="padding:4px; background:#F0F6FD; text-align:center" class="VF5F9FD" colspan="2"><input type="text" class="form-control ou_" id="setFileView" name="setFileView" style="font-size:12px;height:22px" placeholder="Archivo" value="vie<?=ucfirst($_GET['t'])?>.php"></td>
                <td style="padding:4px; background:#FFFFFF; text-align:center; border-right:1px solid #FFF;" class="GFFD6FF" colspan="1"></td>
            </tr>
            <tr style="background:#CCC;">
                <td style="padding:4px" width="300">Campo</td>
                <td style="padding:4px" width="60">Tipo</td>
                <td style="padding:4px; text-align:center" width="40">Long</td>
                <td style="padding:4px; text-align:center" width="40">PKey</td>
                <td style="padding:4px; text-align:center" width="40">Null</td>
                <td style="padding:4px">Comentario</td>
                <td style="padding:4px; background:#F6F6C0; text-align:center" class="AFFDF7F" width="34">Ocu</td>
                <td style="padding:4px; background:#F6F6C0; text-align:center" class="AFFDF7F" width="100">Relacionar</td>
                <td style="padding:4px; background:#D7F7CC; text-align:center" class="BB6EC7F" width="34">Ocu</td>
                <td style="padding:4px; background:#D7F7CC; text-align:center" class="BB6EC7F" width="100">Relacionar</td>
                <td style="padding:4px; background:#F9E9D9; text-align:center" class="CFFBF7F" width="34">Ocu</td>
                <td style="padding:4px; background:#F9E9D9; text-align:center" class="CFFBF7F" width="100">Relacionar</td>
                <td style="padding:4px; background:#F0F6FD; text-align:center" class="VF5F9FD" width="34">Ocu</td>
                <td style="padding:4px; background:#F0F6FD; text-align:center" class="VF5F9FD" width="100">Relacionar</td>
                <td style="padding:4px; background:#CCC; text-align:center" width="250">Ayuda</td>
            </tr>
            <?php
                
                $tabla=$_GET['t'];
                $sql = "
                    SELECT 
                        cols.COLUMN_NAME,
                        cols.COLUMN_TYPE,
                        cols.CHARACTER_MAXIMUM_LENGTH,
                        cols.IS_NULLABLE,
                        cols.COLUMN_KEY,
                        cols.COLUMN_COMMENT
                    FROM INFORMATION_SCHEMA.COLUMNS cols
                    WHERE cols.TABLE_SCHEMA = '".$DBNAME."'
                    AND cols.TABLE_NAME = '".$tabla."'
                    ORDER BY cols.ORDINAL_POSITION
                    ";
                $result = $cnn->query($sql);
                if ($result && $result->num_rows > 0) {
                    $campo="<div class='row'>";
                    $campo.="<div class='col-12'>";
                    while ($row = $result->fetch_assoc()) {
                        $tipo = explode('(', $row['COLUMN_TYPE']);
                        $campo_tipo=$tipo[0];
                        $campo_long='';
                        if(isset($tipo[1])){
                            $campo_long= str_replace(')','',$tipo[1]);
                        }
                        $campo_nombre=$row['COLUMN_NAME'];
                        $campo_null=$row['IS_NULLABLE'];//YES or NO
                        $campo_primario=($row['COLUMN_KEY'] === 'PRI' ? 'YES' : 'NO');
                        $comentario=$row['COLUMN_COMMENT'];
                        $allCampos="";
                        
                        $getNombre= explode("_",$campo_nombre);

                        if($campo_tipo=='int' && isset($getNombre[1]) && $getNombre[1]=='id' ){
                            $tablaR=$getNombre[0].'s';
                            $sqlR = "
                                SELECT 
                                    cols.COLUMN_NAME,
                                    cols.COLUMN_TYPE,
                                    cols.CHARACTER_MAXIMUM_LENGTH,
                                    cols.IS_NULLABLE,
                                    cols.COLUMN_KEY,
                                    cols.COLUMN_COMMENT
                                FROM INFORMATION_SCHEMA.COLUMNS cols
                                WHERE cols.TABLE_SCHEMA = '".$DBNAME."'
                                AND cols.TABLE_NAME = '".$tablaR."'
                                ORDER BY cols.ORDINAL_POSITION
                                ";
                            $resultR = $cnn->query($sqlR);
                            $allCampos='';
                            if ($resultR && $resultR->num_rows > 0) {
                                $allCampos.= '<select class="form-control" style="padding:1px; font-size:12px; height:22px">';
                                while ($rowR = $resultR->fetch_assoc()) {
                                    $allCampos.= '<option value="'.$rowR['COLUMN_NAME'].'" ';
                                    if($rowR['COLUMN_NAME']==$getNombre[0]){
                                        $allCampos.= 'selected';
                                    }
                                    $allCampos.= '>'.$rowR['COLUMN_NAME'].'</option>';
                                }
                                $allCampos.= '</select>';
                            }else{
                                $allCampos= '<h6 style="font-size:14px"><span class="badge badge-danger">SIN RELACION</span></h6>';
                            }  
                        }
                        echo '<tr style="border-bottom:1px solid #CCC" class="filaCampo">';
                        echo '<td style="padding:4px" class="infoCampoNombre">'.$campo_nombre.'</td>';
                        echo '<td style="padding:4px" class="infoCampoTipo">';
                            $clearComentario='';
                            switch($comentario){
                                case 'SETIMG':
                                    echo $clearComentario='<span style="color:#FF0000">imagen</span>';
                                    break;
                                case 'SETDOC':
                                    echo $clearComentario='<span style="color:#FF0000">document</span>';
                                    break;
                                case 'SETDATE':
                                    echo $clearComentario='<span style="color:#FF0000">fecha</span>';
                                    break;
                                default:
                                    echo $campo_tipo;
                            }
                        echo '</td>';
                        echo '<td style="padding:4px; text-align:center" class="infoCampoLongitud">';
                                //LONGITUD
                                if($campo_tipo=='enum'){
                                    echo '<span data-toggle="tooltip" data-placement="right" title="'.$campo_long.'">';
                                    echo '<b style="color:#ff0000">LST</b>';
                                    echo '</span>';
                                }else{
                                    echo $campo_long;
                                }
                        echo'</td>';
                        echo '<td style="padding:4px; text-align:center" class="infoCampoPKey">'.$campo_primario.'</td>';
                        echo '<td style="padding:4px; text-align:center" class="infoCampoNull">'.$campo_null.'</td>';
                        echo '<td style="padding:4px">';
                            if($clearComentario==''){
                                echo $comentario;
                            }
                        echo '</td>';
                        echo '<td style="padding:4px; background:#F6F6C0; text-align:center" class="AFFDF7F infoCampoOL" >';
                        echo '<div class="custom-control custom-checkbox" width="34" style="padding:4px 6px; text-align:center">
                                <input type="checkbox" class="input-group-text ol_" id="ol_'.$row['COLUMN_NAME'].'"';
                                //OCULTAR LISTADO
                                if (!in_array($campo_nombre ?? '', ['id', 'creado', 'actualizado', 'estado'])) {
                                    echo ' checked ';
                                }
                                echo '>
                              </div>';
                        echo '</td>';
                        echo '<td class="rl AFFDF7F infoCampoRL" style="padding:4px; text-align:center; background:#F6F6C0">';
                                if($allCampos!=''){ echo $allCampos; }
                        echo '</td>';
                        echo '<td style="padding:4px; background:#D7F7CC; text-align:center" class="BB6EC7F infoCampoOC" >';
                        //OCULTAR CREATE
                        echo '<div class="custom-control custom-checkbox" width="34" style="padding:4px 6px; text-align:center">
                                <input type="checkbox" class="input-group-text oc_" id="oc_'.$row['COLUMN_NAME'].'"';
                                if (!in_array($campo_nombre ?? '', ['id', 'creado', 'actualizado', 'estado'])) {
                                    echo ' checked ';
                                }
                                echo '>
                              </div>';
                        echo '</td>';
                        echo '<td class="rc BB6EC7F infoCampoRC" style="padding:4px; text-align:center; background:#D7F7CC" >';
                                if($allCampos!=''){ echo $allCampos; }
                        echo '</td>';
                        echo '<td style="padding:4px; background:#F9E9D9; text-align:center" class="CFFBF7F infoCampoOU">';
                        echo '<div class="custom-control custom-checkbox"  width="34" style="padding:4px 6px; text-align:center">
                                <input type="checkbox" class="input-group-text ou_" id="ou_'.$row['COLUMN_NAME'].'"';
                                if (!in_array($campo_nombre ?? '', ['id', 'creado', 'actualizado'])) {
                                    echo ' checked ';
                                }
                                echo '>
                            </div>';
                        echo'</td>';
                        echo '<td class="ru CFFBF7F infoCampoRU" style="padding:4px; text-align:center; background:#F9E9D9">';
                                if($allCampos!=''){ echo $allCampos; }
                            '</td>';

                        echo '<td style="padding:4px; background:#F0F6FD; text-align:center;" class="VF5F9FD">';
                        echo '<div class="custom-control custom-checkbox" width="34" style="padding:4px 6px; text-align:center">';
                            if($allCampos!='' && $allCampos!='<h6 style="font-size:14px"><span class="badge badge-danger">SIN RELACION</span></h6>'){ 
                                echo '<input type="checkbox" class="input-group-text ov_"  id="ov_'.$row['COLUMN_NAME'].'" checked>';
                            }
                        echo '</div>';
                        echo '</td>';
                        echo '<td class="rv VF5F9FD" style="padding:4px; text-align:center; background:#F0F6FD">';
                                if($allCampos!=''){ echo $allCampos; }
                            '</td>';
                        echo '<td class="infoAyudaCtrl VF5F9FD" style="padding:4px; text-align:center; background:#FFFFFF">';
                            echo '<input type="text" class="form-control infoAyuda " id="ayuda_'.$row['COLUMN_NAME'].'" name="ayuda_'.$row['COLUMN_NAME'].'" style="padding:1px; font-size:12px; height:22px">';
                        echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo "No se encontraron columnas o error en la consulta.";
                }
            ?>
            
        </table>
    </div>
</div>