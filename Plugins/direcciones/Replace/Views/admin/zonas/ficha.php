<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" class="layout-px-spacing" enctype="multipart/form-data">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">Ficha de Zona</h1>
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
                                            <label id="label-zona_estado" for="zona_estado" class="col-md-3 col-form-label form-label">
                                                Ciudades
                                            </label>
                                            <div class="col-md-9">
                                                <div role="group" class="input-group input-group-merge">
                                                    <select class="form-control" name="ficha[zona_ciudad_id]">
                                                        <option value="0">--SELECCIONA UN CIUDAD--</option>
                                                        <?php foreach ($ciudades as $ciudad): ?>
                                                            <?php $selected = ($ciudad->_id() == $ficha->_get("ciudad_id")) ? "selected" : "" ?>
                                                            <option value="<?= $ciudad->_id() ?>" <?= $selected ?>><?= $ciudad->_get("nombre") ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?= $ficha->loadHTML([
                                        "estado"
                                        ]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-success">Guardar</button>
                        <a href="<?= base_url("admin/zonas") ?>" class="btn btn-danger">Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
