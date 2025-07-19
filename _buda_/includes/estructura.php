
<div class="row" style="">
    <div class="tabs" style=" z-index:100; width:100%">        
        <div class="" style="padding:2px 20px; width:60%" >
            <div class="row">
                <div class="col-4">
                    <?php
                        $sql = "SHOW TABLES";
                        $result = $cnn->query($sql);
                        if ($result->num_rows > 0) {
                            echo "<select id='tablas' class='form-control'>";
                            echo "<option value=''>--- Selecione tabla ---</option>";
                            while ($row = $result->fetch_array()) {
                                echo "<option value='".$row[0]."'";
                                    if($row[0]==$_GET['t']){
                                        echo ' selected ';
                                    }
                                echo">".$row[0]."</option>";  
                            }
                            echo "</select>";
                        } else {
                            echo "No se encontraron tablas.";
                        }
                    ?>
                </div>
                <div class="col-1" style="padding-left:0px">
                    <input type="button" class="btn btn-primary" disabled id="tablaSend" value="Leer Tabla">
                </div>
                <div class="col-1"></div>
                <div class="col-4" style="padding-left:0px">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary" type="button" id="btnAddCarpeta">+</button>
                        </div>
                        <select class="form-control" id="setFolder" name="setFolder">
                            <?php
                                $directorio = '../includes/';

                                $carpetas = array_filter(scandir($directorio), function($item) use ($directorio) {
                                    return is_dir($directorio . DIRECTORY_SEPARATOR . $item) && !in_array($item, ['.', '..']);
                                });

                                echo "<option value=''>-- Seleccione --</option>";
                                foreach ($carpetas as $carpeta) {
                                    echo "<option value='$carpeta'>$carpeta</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-1" style="padding-left:0px">
                    <input type="button" data-tab="1" class="btn btn-success bototnes" id="iniciarScript" value="INICIAR SCRIPT">
                    <input type="button" data-tab="2" class="btn btn-warning bototnes" style="display:none" id="iniciarScript2" value="INICIAR SCRIPT">
                </div>
            </div>
        </div>
        <div class="tab" data-tab="1">CRUD</div>
        <div class="tab" data-tab="2">Vistas</div>
        <div class="tab" data-tab="3">Scripts</div>
    </div>
</div>
<div class="row w-100" style="padding:10px; margin-top:-1px; z-index:1; border:1px solid #CCC">
    <div class="tab-content" data-content="1">
        <?php include('_crud.php'); ?>
    </div>
    <div class="tab-content" data-content="2">
        <?php include('_vistas.php'); ?>
    </div>
    <div class="tab-content" data-content="3">

    </div>
</div>
<div style="clear:both"></div>
<div class="row" style="width:100%;">
    <div class="col-12" style="font-size:11px" id="terminal">
    </div>
</div>