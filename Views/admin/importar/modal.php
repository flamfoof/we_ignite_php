<div class="modal fade" id="modalMetodo" tabindex="-1" role="dialog" aria-labelledby="modalMetodoTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalMetodoTitle">Importando archivos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-row mb-1">
              <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                  Posicion acutal
              </label>
              <div id="posicion" class="col-md-9">
                  0
              </div>
          </div>
          <div class="form-row mb-1">
              <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                  Total de registros
              </label>
              <div id="registros" class="col-md-9">
                  <?= count($data) ?>
              </div>
          </div>
          <div class="">
              <div class="progress rounded-0">
                  <div id="myprogress" class="progress-bar progress-bar-striped bg-primary"
                      role="progressbar"
                      style="width: 0%"
                      aria-valuenow="0"
                      aria-valuemin="0" aria-valuemax="100"></div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <button id="stopProcess">Cerrar</button>
      </div>
    </div>
  </div>
</div>
