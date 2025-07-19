<!--TITULO Y OPCIONES-->
<div class="row align-items-center border-bottom rowtitulo">
    <div class="col-6 d-flex align-items-center">
        <button onclick="window.history.back()" class="btn btn-outline-primary btn-sm me-1 bkviewbtn">
            <span class="mdi mdi-arrow-expand-left"></span>
        </button>
        <h5 class="mb-1">LISTADO DE CUENTAS</h5>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-9">
                <input type="text" id="searInp-tblCuentas" class="form-control textFilro" placeholder="Filtrar registro" onkeyup="filterTable('tblCuentas')">
            </div>
            <div class="col-3 d-flex gap-1 justify-content-end pr-10">
                <a href="?p=cuentas&s=add" class="btn btn-primary btn-sm d-flex align-items-center gap-1 justify-content-center pr-3 inputalto" style="height:32px">
                    <i class="mdi mdi-plus" style="margin-left:0px"></i> Cuenta
                </a>
                <div class="btn-group">
                    <button class="btn btn-sm btn-secondary dropdown-toggle inputalto" data-bs-toggle="dropdown" type="button" title="Exportar">
                        <i class="mdi mdi-export-variant"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="#" onclick="exportarListado('csv','tblCuentas')">CSV</a>
                        <a class="dropdown-item" href="#" onclick="exportarListado('excel','tblCuentas')">MS-Excel</a>
                        <a class="dropdown-item" href="#" onclick="exportarListado('txt','tblCuentas')">TXT</a>
                        <a class="dropdown-item" href="#" onclick="exportarListado('json','tblCuentas')">JSON</a>
                        <a class="dropdown-item" href="#" onclick="exportarListado('xml','tblCuentas')">XML</a>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

<div class="container p-0">
    <div class="table-responsive">
        <table id="tblCuentas" data-rows-per-page="13" class="table tblfiltro table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th class="interRow throwtr d-md-table-cell" width="24"></th>
                    <th class="interRow throwtr d-md-table-cell">NOMBRE / RAZON SOCIAL</th>
                    <th class="interRow throwtr d-md-table-cell">CIUDAD</th>
                    <th class="interRow throwtr d-md-table-cell">PAIS</th>
                    <th class="interRow throwtr d-md-table-cell">TIPO CUENTA</th>
                    <th class="interRow throwtr d-md-table-cell">SECTOR</th>
                    <th class="interRow throwtr d-md-table-cell">USUARIO</th>
                    <th class="interRow throwtr d-md-table-cell">ESTADO</th>
                    <th class="interRow throwtr d-md-table-cell" width="10"></th>
                </tr>
            </thead>
            <tbody class="zt-tblcuerpo">
                <?php
                    $sql    = "SELECT * FROM cuentas WHERE estado<>'ELIMINADO'";
                    $result = mysqli_query($cnn, $sql);
                    while($row = mysqli_fetch_array($result)){
                ?>
                    <tr style="cursor:pointer;">
                        <td class="zt_celda"></td>
                        <td class="zt_celda"><?= $row['nombre'] ?></td>
                        <td class="zt_celda">
                            <?php 
                                if($row['mst_paises_departamentos_ciudades__id']!=null){
                                   echo loadCampoDescriptivo($cnn, 'mst_paises_departamentos_ciudades', 'nombre', 'nombre', 'id='.$row['mst_paises_departamentos_ciudades__id']);
                                }else{
                                   echo '--';
                                }
                            ?>
                        </td>
                        <td class="zt_celda">
                                <?php 
                                if($row['mst_paises__id']!=null){
                                   echo loadCampoDescriptivo($cnn, 'mst_paises', 'nombre', 'nombre', 'id='.$row['mst_paises__id']);
                                }else{
                                    echo '--';
                                }
                            ?>
                        </td>
                        <td class="zt_celda">
                                <?php 
                                if($row['mst_cuentaTipo__id']!=null){
                                   echo loadCampoDescriptivo($cnn, 'mst_cuentaTipo', 'nombre', 'nombre', 'id='.$row['mst_cuentaTipo__id']);
                                }else{
                                    echo '--';
                                }
                            ?>
                        </td>
                        <td class="zt_celda">
                                <?php 
                                if($row['mst_sector__id']!=null){
                                   echo loadCampoDescriptivo($cnn, 'mst_sector', 'nombre', 'nombre', 'id='.$row['mst_sector__id']);
                                }else{
                                    echo '--';
                                }
                            ?>
                        </td>
                        <td class="zt_celda"><?= loadCampoDescriptivo($cnn, 'usuarios', 'CONCAT(nombres," ",apellidos) as nombrecompleto', 'nombrecompleto', 'id='.$row['usuario__id']) ?></td>
                        <td class="zt_celda"><?= $row['estado'] ?></td>
                        <td class="zt_celda pr-10">
                            <div class="btn-group dropleft">
                                <button class="btn btn-small btn-secondary dropdown-toggle" style="padding:0px 4px 0px 0px" type="button" data-toggle="dropdown" aria-expanded="false">
                                    <span class="mdi mdi-dots-vertical" style="padding:0px;"></span>
                                </button>
                                <div class="dropdown-menu">
                                    <div class="dropdown-title">---- REGISTRAR ACCIÓN ----</div>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-calendar-clock"></i> Agendar reunión</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-phone-plus"></i> Llamada</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-check-network"></i> Tarea</a>
                                    <a class="dropdown-item" href="#"><i class="mdi mdi-note-plus-outline"></i> Nota</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="cabtreg"></div>
    </div>
</div>

<div class="footBoton"> 
    <div class="row mt-2">
        <div class="col-12 d-flex justify-content-start">
            <nav>
                <ul class="pagination justify-content-right ml-4 pagination"></ul>
            </nav>
        </div>
    </div>
</div>