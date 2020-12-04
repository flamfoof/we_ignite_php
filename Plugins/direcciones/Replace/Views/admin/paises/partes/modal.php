<?php
use App\Entities\Pais;
?>
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalEditTitle">Editar Paises</h5>
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
                      <?php foreach (Pais::$envios as $key => $value): ?>
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
                      <?php foreach (Pais::$estados as $key => $value): ?>
                          <option value="<?= $key ?>"><?= $value ?></option>
                      <?php endforeach; ?>
                  </select>
              </div>
          </div>
          <?php if (class_exists("\\App\\Models\\GrupoPagoModel")): ?>
              <div class="form-row mb-1">
                  <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                      Grupo Pago
                  </label>
                  <div class="col-md-9">
                      <select class="form-control" id="modal_grupopagos">
                          <option value="0">--SELECCIONA UN GRUPO--</option>
                          <?php foreach ($ficha->getGruposPago() as $grupoPago): ?>
                              <option value="<?= $grupoPago->_id() ?>"><?= $grupoPago->_get("descripcion") ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
              </div>
          <?php endif; ?>
          <?php if (class_exists("\\App\\Models\\GrupoTransporteModel")): ?>
              <div class="form-row mb-1">
                  <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                      Grupo Transporte
                  </label>
                  <div class="col-md-9">
                      <select class="form-control" id="modal_grupoenvio">
                          <option value="0">--SELECCIONA UN GRUPO--</option>
                          <?php foreach ($ficha->getGruposEnvio() as $grupoEnvio): ?>
                              <option value="<?= $grupoEnvio->_id() ?>"><?= $grupoEnvio->_get("nombre") ?></option>
                          <?php endforeach; ?>
                      </select>
                  </div>
              </div>
          <?php endif; ?>
      </div>
      <div class="modal-footer">
          <div id="btn-aceptar" data-aceptar="todos" class="btn btn-info">Guardar</div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
