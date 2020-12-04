<?php
use App\Entities\Provincia;
?>
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditTitle">Editar Provinciaes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-row mb-1">
              <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                  Método envio
              </label>
              <div class="col-md-9">
                  <select class="form-control" id="modal_metodoenvio">
                      <?php foreach (Provincia::$tiposEnvios as $key => $value): ?>
                          <option value="<?= $key ?>"><?= $value ?></option>
                      <?php endforeach; ?>
                  </select>
              </div>
          </div>
          <div class="form-row mb-1">
              <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                  Estado
              </label>
              <div class="col-md-9">
                  <select class="form-control" id="modal_estados">
                      <?php foreach (Provincia::$estados as $key => $value): ?>
                          <option value="<?= $key ?>"><?= $value ?></option>
                      <?php endforeach; ?>
                  </select>
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <div id="btn-aceptar" data-aceptar="todos" class="btn btn-info">Guardar</div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
