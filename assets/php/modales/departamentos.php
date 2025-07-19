<div class="modal fade" id="mdlDepartamentos" tabindex="-1" aria-labelledby="Administración de Departamentos" >
  <div class="modal-dialog">
    <div class="modal-content">

      <input type="hidden" id="getcampomdlDepartamentos" value="">
      <input type="hidden" id="getaccionmdlDepartamentos" value="">
      <input type="hidden" id="setLoadIdtbl_mst_paises_departamentos" value="">  
      <input type="hidden" id="setLoadNametbl_mst_paises_departamentos" value="">  
      <input type="hidden" id="campoRefencia_mdlDepartamentos" value="">
      <input type="hidden" id="idRefencia_mdlDepartamentos" value="">

      <div class="modal-header modal-titulo">
            <h5 class="modal-title" id="miModalLabel">Gestión de Departamentos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" onclick="cerrarModal('modalDepartamentos')"></button>
      </div>
      
      <div class="modal-body modal-contenido">
           <div class="row" style="padding:4px; margin:0px">
                <div class="col-10 g-0">
                    <input type="text"  id="searInp-tbl_mst_paises_departamentos" class="form-control textFilro" placeholder="Buscar o agregar registro" onkeyup="filterTable('tbl_mst_paises_departamentos')">
                </div>
                <div class="col-2 g-0" style="padding-left:6px">
                    <button type="button" id="btnAM_tbl_mst_paises_departamentos" onclick="guardarRegistroMaestro('mst_paises_departamentos', 'searInp-tbl_mst_paises_departamentos', 'mst_paises__id', $('#idRefencia_mdlDepartamentos').val(), 'mdlDepartamentos',  $('#getcampomdlDepartamentos').val(), $('#getaccionmdlDepartamentos').val())" disabled class="btn btn-secundary" style="padding:4px; width:100%; height:32px" >Agregar</button>
                </div>
            </div>
            
           <div class="table-responsive" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC; height:350px; overflow-y:hidden;">
                <table id="tbl_mst_paises_departamentos" data-rows-per-page="10" class="table tblfiltro table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="interRow throwtr d-md-table-cell" width="30"></th>
                            <th class="interRow throwtr d-md-table-cell">NOMBRE DEL PAIS</th>
                            <th class="interRow throwtr d-md-table-cell" width="10"></th>
                        </tr>
                    </thead>
                    <tbody class="zt-tblcuerpo" id="body-mst_paises_departamentos">
                        
                    </tbody>    
                </table>
           </div>
           <div class="row" style="padding:4px 0px; margin:0px; height:38px;">
                <div class="col-7">
                    <nav>
                        <ul id="pagination_tbl_mst_paises_departamentos" class="pagination justify-content-right ml-4"></ul>
                    </nav>
                </div>
                <div class="col-5" style="padding:4px 10px 0px 0px; text-align:right;">
                    <div id="cabtreg_tbl_mst_paises_departamentos" class="cabtreg"></div>
                </div>
            </div>
      </div>
      
      <div class="modal-footer modal-pie">
        <button type="button" id="btmModalAceptar_Departamentos" class="btn btn-primary btmModalAceptar" onclick="seleccionarOpcion($('#setLoadNametbl_mst_paises_departamentos').val().toUpperCase    (), $('#setLoadIdtbl_mst_paises_departamentos').val(), $('#getcampomdlDepartamentos').val(), 'loadDepartamentos'); modal.hide();">Seleccionar y Continuar</button>
      </div>
      
    </div>
  </div>
</div>
