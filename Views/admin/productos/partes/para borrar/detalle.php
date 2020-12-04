<div class="list-group list-group-fit">
    <div class="list-group-item">
        <div role="group" class="m-0 form-group">
            <?= $ficha->loadHTML(["skubase", "skudetalle", "preciobase", "costobase", "iva"]) ?>
        </div>
        <div class="form-row mb-1">
            <label class="col-md-3 col-form-label form-label">
                Etiquetas
            </label>
            <div class="col-md-9">
                <input id="producto_familiatag_real" name="ficha[producto_familiatag]" value="<?= $ficha->_get("familiatag") ?>" type="hidden">
                <div role="group" class="input-group input-group-merge d-flex">
                    <div id="tags" class="d-flex">
                        <?php if ($ficha->_get("familiatag") != ""): ?>
                            <?php foreach (explode(", ", $ficha->_get("familiatag")) as $value): ?>
                                <tag><txt><?= $value ?></txt><span>x</span></tag>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    <input id="producto_familiatag" placeholder="Mujer, Abrigo, Cuero" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="form-row mb-1">
            <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                Tiempo de entrega
            </label>
            <div class="col-md-9">
                <div role="group" class="input-group input-group-merge">
                    <select class="form-control" name="ficha[producto_tiempoentrega_id]">
                        <option value="0">--SELECCIONA UN GRUPO--</option>
                        <?php foreach ($ficha->getTiemposEntrega() as $tiempoEntrega): ?>
                            <?php $selected = ($tiempoEntrega->_id() == $ficha->_get("tiempoentrega_id")) ? "selected" : "" ?>
                            <option value="<?= $tiempoEntrega->_id() ?>" <?= $selected ?>><?= $tiempoEntrega->_get("nombre") ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
