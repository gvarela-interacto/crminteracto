<div class="row mb-2" style="padding-bottom:10px; border-bottom:1px solid #CCC">
    <div class="col-4">
        <?php
            $sql = "SHOW TABLES";
            $result = $cnn->query($sql);
            if ($result->num_rows > 0) {
                echo "<select id='tablas' class='form-control'>";
                echo "<option value=''>--- Selecione tabla ---</option>";
                while ($row = $result->fetch_array()) {
                    echo "<option value='".$row[0]."'>".$row[0]."</option>";  
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
</div>