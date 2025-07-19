<div class="modal fade" id="mdlCiudades" tabindex="-1" aria-labelledby="Administración de Departamentos" >
  <div class="modal-dialog">
    <div class="modal-content">

      <input type="hidden" id="getcampomdlCiudades" value="">
      <input type="hidden" id="getaccionmdlCiudades" value="">
      <input type="hidden" id="setLoadIdtbl_mst_paises_departamentos_ciudades" value="">  
      <input type="hidden" id="setLoadNametbl_mst_paises_departamentos_ciudades" value="">  
      <input type="hidden" id="campoRefencia_mdlCiudades" value="">
      <input type="hidden" id="idRefencia_mdlCiudades" value="">

      <div class="modal-header modal-titulo">
            <h5 class="modal-title" id="miModalLabel">Gestión de Departamentos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" onclick="cerrarModal('modalDepartamentos')"></button>
      </div>
      
      <div class="modal-body modal-contenido">
           <div class="row" style="padding:4px; margin:0px">
                <div class="col-10 g-0">
                    <input type="text"  id="searInp-tbl_mst_paises_departamentos_ciudades" class="form-control textFilro" placeholder="Buscar o agregar registro" onkeyup="filterTable('tbl_mst_paises_departamentos_ciudades')">
                </div>
                <div class="col-2 g-0" style="padding-left:6px">
                    <button type="button" id="btnAM_tbl_mst_paises_departamentos_ciudades" onclick="guardarRegistroMaestro('mst_paises_departamentos_ciudades', 'searInp-tbl_mst_paises_departamentos_ciudades', 'mst_paises_departamentos__id', $('#idRefencia_mdlCiudades').val(), 'mdlCiudades',  $('#getcampomdlCiudades').val(), $('#getaccionmdlCiudades').val())" disabled class="btn btn-secundary" style="padding:4px; width:100%; height:32px" >Agregar</button>
                </div>
            </div>
            
           <div class="table-responsive" style="border-top:1px solid #CCC; border-bottom:1px solid #CCC; height:350px; overflow-y:hidden;">
                <table id="tbl_mst_paises_departamentos_ciudades" data-rows-per-page="10" class="table tblfiltro table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="interRow throwtr d-md-table-cell" width="30"></th>
                            <th class="interRow throwtr d-md-table-cell">NOMBRE DEL PAIS</th>
                            <th class="interRow throwtr d-md-table-cell" width="10"></th>
                        </tr>
                    </thead>
                    <tbody class="zt-tblcuerpo" id="body-mst_paises_departamentos_ciudades">
                        
                    </tbody>    
                </table>
           </div>
           <div class="row" style="padding:4px 0px; margin:0px; height:38px;">
                <div class="col-7">
                    <nav>
                        <ul id="pagination_tbl_mst_paises_departamentos_ciudades" class="pagination justify-content-right ml-4"></ul>
                    </nav>
                </div>
                <div class="col-5" style="padding:4px 10px 0px 0px; text-align:right;">
                    <div id="cabtreg_tbl_mst_paises_departamentos_ciudades" class="cabtreg"></div>
                </div>
            </div>
      </div>
      
      <div class="modal-footer modal-pie">
        <button type="button" id="btmModalAceptar_Departamentos" class="btn btn-primary btmModalAceptar" onclick="seleccionarOpcion($('#setLoadNametbl_mst_paises_departamentos_ciudades').val().toUpperCase    (), $('#setLoadIdtbl_mst_paises_departamentos_ciudades').val(), $('#getcampomdlCiudades').val(), 'loadDepartamentos'); modal.hide();">Seleccionar y Continuar</button>
      </div>
      
    </div>
  </div>
</div>
