<div class="col-12">
    <div class="list-group list-group-fit">
        <div class="list-group-item">
            <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                <?= $ficha->loadHTML([
                    "nombre"
                    ]) ?>
            </div>
            <div class="form-row mb-1">
                <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                    Pais
                </label>
                <div class="col-md-9">
                    <div role="group" class="input-group input-group-merge">
                        <select class="form-control" name="ficha[provincia_pais_id]">
                            <option value="0">--SELECCIONA UN PAIS--</option>
                            <?php foreach ($paises as $pais): ?>
                                <?php $selected = ($pais->_id() == $ficha->_get("pais_id")) ? "selected" : "" ?>
                                <option value="<?= $pais->_id() ?>" <?= $selected ?>><?= $pais->_get("nombre") ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <?= $ficha->loadHTML([
                "metodoenvio", "estado"
                ]) ?>
            <?php if (class_exists("\\App\\Models\\GrupoPagoModel")): ?>
                <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                    <div class="form-row mb-1">
                        <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                            Grupo Pago
                        </label>
                        <div class="col-md-9">
                            <div role="group" class="input-group input-group-merge">
                                <select class="form-control" name="ficha[provincia_grupopago_id]">
                                    <option value="0">--SELECCIONA UN GRUPO--</option>
                                    <?php foreach ($ficha->getGruposPago() as $grupoPago): ?>
                                        <?php $selected = ($grupoPago->_id() == $ficha->_get("grupopago_id")) ? "selected" : "" ?>
                                        <option value="<?= $grupoPago->_id() ?>" <?= $selected ?>><?= $grupoPago->_get("descripcion") ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                            Grupo Transporte
                        </label>
                        <div class="col-md-9">
                            <div role="group" class="input-group input-group-merge">
                                <select class="form-control" name="ficha[provincia_grupoenvio_id]">
                                    <option value="0">--SELECCIONA UN GRUPO--</option>
                                    <?php foreach ($ficha->getGruposEnvio() as $grupoEnvio): ?>
                                        <?php $selected = ($grupoEnvio->_id() == $ficha->_get("grupoenvio_id")) ? "selected" : "" ?>
                                        <option value="<?= $grupoEnvio->_id() ?>" <?= $selected ?>><?= $grupoEnvio->_get("nombre") ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
