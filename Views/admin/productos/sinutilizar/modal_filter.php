<div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="modalFilterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFilterTitle">Filtrar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pb-0">
          <div class="row mt-5">
              <?php $baseProducto = new \App\Entities\Producto() ?>
              <?= $baseProducto->loadHTML(["temporada", "genero", "subfamilia_id", "marca_id", "trama_id"]) ?>
              <div class="col-12 mb-1">
                  <div class="form-row">
                      <label class="col-md-3 col-form-label form-label">Tienda</label>
                      <div class="col-md-9">
                          <select class="form-control" id="tienda_input" name="tienda_input" required>
                              <option value="">--TODAS LAS TIENDAS--</option>
                              <?php $tiendaModel = new \App\Models\TiendaModel() ?>
                              <?php $tiendas = $tiendaModel->where("tienda_estado", 1)->findAll() ?>
                              <?php foreach ($tiendas as $tienda): ?>
                                  <option value="<?= $tienda->_id() ?>" class="editable-product">
                                      <?= $tienda->_get("nombrecomercial") ?>
                                  </option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <div class="btn btn-filter">Filtrar</div>
      </div>
    </div>
  </div>
</div>
