<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" class="layout-px-spacing" enctype="multipart/form-data">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">Ficha del Contacto</h1>
            <div class="card">
                <div class="card-body row">
                    <div class="col-12">
                        <div class="list-group list-group-fit">
                            <div class="list-group-item">
                                <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                    <?php foreach (json_decode($ficha->_get("data"), true) as $data): ?>
                                        <div class="form-row mb-1">
                                            <label for="profilename" class="col-md-3 col-form-label form-label">
                                                <?= $data["titulo"] ?>
                                            </label>
                                            <div class="col-md-9 p-2 border rounded">
                                                <div role="group" class="input-group input-group-merge">
                                                    <?= $data["data"] ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <?= $ficha->loadHTML(["fecha", "estado"]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="list-group list-group-fit">
                        <div class="list-group-item">
                            <?= $ficha->loadHTML(["ancho", "alto"]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success">Guardar</button>
                    <a href="<?= base_url("admin/contactos") ?>" class="btn btn-danger">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?= base_url("assets_admin/js/uploadImage.js") ?>" ></script>
