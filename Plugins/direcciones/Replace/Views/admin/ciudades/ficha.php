<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" class="layout-px-spacing" enctype="multipart/form-data">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">Ficha de Ciudad</h1>
            <div class="card">
                <div class="card-body row">
                    <div class="col-12">
                        <div class="list-group list-group-fit">
                            <div class="list-group-item">
                                <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                    <?= $ficha->loadHTML([
                                        "nombre"
                                        ]) ?>
                                    </div>
                                    <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                        <div class="form-row mb-1">
                                            <label id="label-ciudad_estado" for="ciudad_estado" class="col-md-3 col-form-label form-label">
                                                Provincia
                                            </label>
                                            <div class="col-md-9">
                                                <div role="group" class="input-group input-group-merge">
                                                    <select class="form-control" name="ficha[ciudad_provincia_id]">
                                                        <option value="0">--SELECCIONA UNA PROVINCIA--</option>
                                                        <?php foreach ($provincias as $provincia): ?>
                                                            <?php $selected = ($provincia->_id() == $ficha->_get("provincia_id")) ? "selected" : "" ?>
                                                            <option value="<?= $provincia->_id() ?>" <?= $selected ?>><?= $provincia->_get("nombre") ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <?= $ficha->loadHTML([
                                            "metodoenvio", "estado"
                                            ]) ?>
                                        <?php if (class_exists("\\App\\Models\\GrupoPagoModel")): ?>
                                            <div class="form-row mb-1">
                                                <label id="label-ciudad_estado" for="ciudad_estado" class="col-md-3 col-form-label form-label">
                                                    Grupo Pago
                                                </label>
                                                <div class="col-md-9">
                                                    <div role="group" class="input-group input-group-merge">
                                                        <select class="form-control" name="ficha[ciudad_grupopago_id]">
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
                                                <label id="label-ciudad_estado" for="ciudad_estado" class="col-md-3 col-form-label form-label">
                                                    Grupo Transporte
                                                </label>
                                                <div class="col-md-9">
                                                    <div role="group" class="input-group input-group-merge">
                                                        <select class="form-control" name="ficha[ciudad_grupoenvio_id]">
                                                            <option value="0">--SELECCIONA UN GRUPO--</option>
                                                            <?php foreach ($ficha->getGruposEnvio() as $grupoEnvio): ?>
                                                                <?php $selected = ($grupoEnvio->_id() == $ficha->_get("grupoenvio_id")) ? "selected" : "" ?>
                                                                <option value="<?= $grupoEnvio->_id() ?>" <?= $selected ?>><?= $grupoEnvio->_get("nombre") ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-success">Guardar</button>
                        <a href="<?= base_url("admin/ciudades") ?>" class="btn btn-danger">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
