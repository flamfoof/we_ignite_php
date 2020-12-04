<div class="list-group list-group-fit">
    <div class="list-group-item">
        <div role="group" class="m-0 form-group">
            <?php $coleccionModel = new App\Models\ColeccionModel() ?>
            <?php $colecciones = $coleccionModel->distinctPadre() ?>
            <?php foreach ($colecciones as $coleccion): ?>
                <div class="form-row mb-1">
                    <label id="type-label" class="col-md-3 col-form-label form-label" title="<?= $ficha->getColeccionByPadre($coleccion->_get("padre"))->_get("productocoleccion_coleccion_id"); ?>">
                        <?= $coleccion->_get("padre") ?>
                    </label>
                    <div class="col-md-9">
                        <div role="group" class="input-group input-group-merge">
                            <select class="form-control" name="fichaColeccion[]">
                                <?php $colecciones = $coleccionModel->getByPadre($coleccion->_get("padre")) ?>
                                <?php foreach ($colecciones as $coleccion): ?>
                                    <?php $productoColeccion = $ficha->getProductoColeccion($coleccion->_id()); ?>
                                    <option value="<?= $coleccion->_id() ?>" <?= ($coleccion->_id() == $productoColeccion->_get("coleccion_id")) ? "selected" : "" ?>>
                                        <?= $coleccion->_get("nombre") ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
