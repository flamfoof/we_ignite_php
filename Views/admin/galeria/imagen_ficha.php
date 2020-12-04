<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" enctype="multipart/form-data" class="layout-px-spacing">
    <div class="row m-0">
        <div class="col-12">
            <h1 class="h2">Ficha de Imágen</h1>
        </div>
        <div class="col-md-4 container-fluid page__container">
            <div class="card">
                <div class="banner-container <?= ($ficha->_get("ubicacion") == 1) ? "block-size" : "" ?>">
                    <img src="<?= isset($ficha) ? $ficha->getHRef() : "nohayimagen" ?>" id="img-image" class="img-image  margin-bottom-micro" />
                    <input type="file" name="file" class="form-control special-file d-none"
                        <?= ($request->uri->getSegment(4,null) == "nuevo") ? "required" : "" ?>
                        id="input-image" accept="image/*" capture="camera" />
                </div>
            </div>
        </div>
        <div class="col-md-8 container-fluid page__container">
            <div class="card">
                <?php if (!($ficha->_id() > 0)): ?>
                    <p class="p-4">Para crear una nueva imagen haz click sobre la imagen de la izquierda</p>
                <?php endif; ?>
                <div class="list-group list-group-fit">
                    <div class="list-group-item">
                        <div class="form-row mb-1">
                            <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                Nombre
                            </label>
                            <div class="col-md-9">
                                <div role="group" class="input-group input-group-merge">
                                    <input type="text" class="form-control" value="<?= $ficha->_get("nombre") ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                Nombre Original
                            </label>
                            <div class="col-md-9">
                                <div role="group" class="input-group input-group-merge">
                                    <input type="text" class="form-control" value="<?= $ficha->_get("nombreoriginal") ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                Path
                            </label>
                            <div class="col-md-9">
                                <div role="group" class="input-group input-group-merge">
                                    <input type="text" class="form-control" value="<?= $ficha->_get("path") ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                ALT
                            </label>
                            <div class="col-md-9">
                                <div role="group" class="input-group input-group-merge">
                                    <input type="text" class="form-control" name="ficha[archivo_alt]" value="<?= $ficha->_get("alt") ?>" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success">Guardar</button>
                    <a href="<?= base_url("admin/galeria/imagenes") ?>" class="btn btn-danger">Regresar</a>
                    <?php if ($ficha->_id() > 0): ?>
                        <a href="<?= base_url("admin/galeria/imagen/nueva") ?>" class="btn btn-primary">Nuevo</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?= base_url("assets_admin/assets/js/uploadMultiImage.js") ?>" ></script>
<?= view("templates/tab_js",[]) ?>
