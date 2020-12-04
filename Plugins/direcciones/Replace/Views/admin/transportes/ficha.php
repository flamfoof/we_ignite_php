<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" class="layout-px-spacing" enctype="multipart/form-data">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">Ficha de Transporte</h1>
            <div class="card">
                <div class="card-body row">
                    <div class="col-12">
                        <div class="list-group list-group-fit">
                            <div class="list-group-item">
                                <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                    <?= $ficha->loadHTML([
                                        "nombre", "peso_maximo", "volumen_maximo", "precio", "estado"
                                    ]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="list-group list-group-fit">
                            <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                <div class="form-row mb-1">
                                    <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                        Grupo Transporte
                                    </label>
                                    <div class="col-md-9">
                                        <div role="group" class="input-group input-group-merge">
                                            <select class="form-control" name="ficha[transporte_grupotransporte_id]">
                                                <option value="0">--SELECCIONA UN GRUPO TRANSPORTE--</option>
                                                <?php foreach ($transportes as $transporte): ?>
                                                    <?php $selected = ($transporte->_id() == $ficha->_get("grupotransporte_id")) ? "selected" : "" ?>
                                                    <option value="<?= $transporte->_id() ?>" <?= $selected ?>><?= $transporte->_get("nombre") ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success">Guardar</button>
                    <a href="<?= base_url("admin/transportes") ?>" class="btn btn-danger">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</form>
