<?php
    use App\Entities\Producto;

    $formatoModel = new App\Models\FormatoModel();
    $familiaModel = new App\Models\FamiliaModel();
    $marcaModel = new App\Models\MarcaModel();
    $formatos = $formatoModel
        ->where("formato_estado", 1)
        ->findAll();
    $familias = $familiaModel
        ->join("familialang", "familialang_familia_id = familia_id")
        ->where("familia_familia_id", 0)
        ->where("familia_estado", 1)
        ->orderBy("familialang_nombre", "ASC")
        ->findAll();
    $marcas = $marcaModel
        ->where("marca_estado >", 0)
        ->findAll();
?>
<div class="modal fade" id="modalFilter" tabindex="-1" role="dialog" aria-labelledby="modalFilterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFilterTitle">Editar Metodo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body pb-0">
          <div class="row mt-5">
              <div class="col-12">
                  <?php $coleccionModel = new App\Models\ColeccionModel() ?>
                  <?php $colecciones = $coleccionModel->getByPadre("Genero") ?>
                  <div class="form-row mb-1">
                      <label id="type-label" class="col-md-3 col-form-label form-label">
                          Género
                      </label>
                      <div class="col-md-9">
                          <div role="group" class="input-group input-group-merge">
                              <select class="form-control colecciones" name="fichaColeccion[]">
                                  <?php foreach ($colecciones as $coleccion): ?>
                                      <option value="<?= $coleccion->_id() ?>">
                                          <?= $coleccion->_get("nombre") ?>
                                      </option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-12">
                  <div class="mb-1 form-row">
                      <?php $baseProducto = new \App\Entities\Producto() ?>
                      <label class="col-md-3 col-form-label form-label">Familias</label>
                      <div class="col-md-9">
                          <select class="form-control" id="subfamilia_input" multiple>
                              <option value="">--TODAS LAS FAMILIAS--</option>
                              <?php foreach ($familias as $familia): ?>
                                  <option class="" value="<?= $familia->_id() ?>" disabled>
                                      <?= $familia->getFamiliaLang()->_get("nombre") ?>
                                  </option>
                                  <?= $familia->printOptionsChildren($baseProducto, $familia->getSubFamilias(), "--") ?>
                              <?php endforeach; ?>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="col-12 mb-1">
                  <div class="form-row">
                      <label class="col-md-3 col-form-label form-label">Marca</label>
                      <div class="col-md-9">
                          <select class="form-control" id="marca_input" name="marca_input" required>
                              <option value="">--TODAS LAS MARCAS--</option>
                              <?php foreach ($marcas as $marca): ?>
                                  <option value="<?= $marca->_id() ?>" class="editable-product">
                                      <?= $marca->_get("nombre") ?>
                                  </option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="col-12">
                  <?php $colecciones = $coleccionModel->getByPadre("Temporada") ?>
                  <div class="form-row mb-1">
                      <label id="type-label" class="col-md-3 col-form-label form-label">
                          Temporada
                      </label>
                      <div class="col-md-9">
                          <div role="group" class="input-group input-group-merge">
                              <select class="form-control colecciones" name="fichaColeccion[]">
                                  <option value="0">--TODAS LAS TEMPORADAS--</option>
                                  <?php foreach ($colecciones as $coleccion): ?>
                                      <option value="<?= $coleccion->_id() ?>">
                                          <?= $coleccion->_get("nombre") ?>
                                      </option>
                                  <?php endforeach; ?>
                              </select>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-12 mb-1">
                  <div class="form-row">
                      <label class="col-md-3 col-form-label form-label">Tienda</label>
                      <div class="col-md-9">
                          <select class="form-control" id="tienda_input" name="tienda_input" required>
                              <option value="">--TODAS LAS TIENDAS--</option>
                              <?php $tiendas = $configuracion->getTiendas() ?>
                              <?php foreach ($tiendas as $tienda): ?>
                                  <option value="<?= $tienda->_id() ?>" class="editable-product">
                                      <?= $tienda->_get("nombrecomercial") ?>
                                  </option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="col-12 mt-3">
                  <div class="form-row mb-1">
                      <label id="type-label" class="col-md-3 col-form-label form-label">
                          <label class="switch s-icons s-outline  s-outline-primary mr-2">
                              <input type="checkbox" checked="" id="ocultar_productos">
                              <span class="slider round"></span>
                          </label>
                      </label>
                      <div class="col-md-9">
                          Ocultar productos sin inventario
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
