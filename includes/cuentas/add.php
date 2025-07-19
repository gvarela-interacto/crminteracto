<div class="row align-items-center border-bottom rowtitulo">
    <div class="col-6 d-flex align-items-center">
        <button onclick="window.history.back()" class="btn btn-outline-primary btn-sm me-1 bkviewbtn">
            <span class="mdi mdi-arrow-expand-left"></span>
        </button>
        <h5 class="mb-1">CREAR NUEVA CUENTA</h5>
    </div>
    <div class="col-6">
        
    </div>
</div>

<form id="frmCuenta">
    <div class="row" style="padding-top:20px">
        <div class="col-12 col-md-6" style="padding:0px 50px">
            <h5 class="subtitle"><span>Información Básica</span></h5>
    
            <div class="form-group row align-items-center">
                <label for="ctrtipo" class="col-12 col-md-3 col-form-label">Tipo de Persona</label>
                <div class="col-sm-9">
                    <?= controlSelect('VLRMANUAL', 'NATURAL,JURIDICA', '', '','', '', '', 'ctrtipo','','chTextoNombre') ?>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="ctrnombre" class="col-12 col-md-3  d-flex align-items-md-center justify-content-md-end col-form-label">
                    <i data-bs-toggle="tooltip" title="" class="tooltop mdi mdi-help-circle menu-icon me-2" data-original-title="Nombre con el que se identificará el asistente"></i>
                    <span id="setTituloNombre">Nombre</span>
                </label>
                <div class="col-sm-9"><input type="text" class="form-control customfield" id="ctrnombre" name="ctrnombre"></div>
            </div>
            <div class="form-group row align-items-center">
                <label for="ctrmst_cuentaTipo__id" class="col-12 col-md-3 col-form-label">Tipo de Cuenta</label>
                <div class="col-sm-9 mt-n4">
                    <?= controlSelect('DBBASICO', $cnn, 'mst_cuentatipo', 'id, nombre','nombre', 'id', 'estado="ACTIVO"', 'ctrmst_cuentaTipo__id') ?>
                </div>
            </div>

            <h5 class="subtitle" style="margin-top:30px"><span>Información de Domicilio</span></h5>
            <div class="form-group row align-items-center">
                <label for="mst_paises__id" class="col-12 col-md-3 col-form-label">País</label>
                <div class="col-sm-9 mt-n4">
                    <?= controlSelect('DBBASICO', $cnn, 'mst_paises', 'id, nombre','nombre', 'id', 'estado="ACTIVO"', 'mst_paises__id', '', 'loadDepartamentos', 'mdlPaises') ?>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="mst_paises_departamentos__id" class="col-12 col-md-3 col-form-label">Departamento</label>
                <div class="col-sm-9 mt-n4">
                    <?= controlSelect('VACIO', '', '', '','', '', '', 'mst_paises_departamentos__id', 'disabled','loadCiudades', 'mdlDepartamentos') ?>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="mst_paises_departamentos_ciudades__id" class="col-12 col-md-3 col-form-label">Ciudad / Municipio</label>
                <div class="col-sm-9 mt-n4">
                    <?= controlSelect('VACIO', '', '', '','', '', '', 'mst_paises_departamentos_ciudades__id', 'disabled', '', 'mdlCiudades') ?>
                </div>
            </div>
            <div class="form-group row align-items-center">
                <label for="ctrdireccion" class="col-12 col-md-3 col-form-label">Dirección</label>
                <div class="col-sm-9"><input type="text" class="form-control customfield" id="ctrdireccion" name="ctrdireccion"></div>
            </div>
        </div>
        <div class="col-12 col-md-6" style="padding:0px 50px">
            <h5 class="subtitle"><span>Información Complementaria</span></h5>
        </div>
    </div>

    <div class="row" style="padding:0px 35px; margin-top:50px">
        <div class="col-12">
            <div class="row">
                <h5 class="subtitle"><span>Otra Informacón</span></h5>
            </div>
        </div>
    </div>

    <div class="footBoton"> 
        <div class="form-group row" style="padding-left:20px">
            <div class="col-12">
                <button id="btnSave" type="submit" class="btn btn-primary col-12 col-md-2">CREAR CUENTA</button>
            </div>
        </div>
    </div>
</form>

<?php include("assets/php/modales/paises.php"); ?>
<?php include("assets/php/modales/departamentos.php"); ?>
<?php include("assets/php/modales/ciudades.php"); ?>