<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" class="layout-px-spacing" enctype="multipart/form-data">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">Ficha del Banner</h1>
            <div class="card">
                <div class="card-body row">
                    <div class="col-4">
                        <div class="banner-container <?= ($ficha->_get("ubicacion") == 1) ? "block-size" : "" ?>">
                            <img src="<?= isset($ficha) ? $ficha->getImagen() : "nohayimagen" ?>" id="img-image" class="img-image  margin-bottom-micro" />
                            <input type="file" name="file" class="form-control special-file d-none"
                                <?= ($request->uri->getSegment(4,null) == "nuevo") ? "required" : "" ?>
                                id="input-image" accept="image/*" capture="camera" />
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="list-group list-group-fit">
                            <div class="list-group-item">
                                <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                    <?php if (class_exists("\\App\\Models\\IdiomaModel")): ?>
                                        <div class="form-row mb-1">
                                            <label for="profilename" class="col-md-3 col-form-label form-label">
                                                Idioma
                                            </label>
                                            <div class="col-md-9">
                                                <div role="group" class="input-group input-group-merge">
                                                    <select name="ficha[banner_lang_id]" class="form-control" required>
                                                        <option value="">--SELECCIONA UNA IDIOMA--</option>
                                                        <?php foreach ($idiomas as $idioma): ?>
                                                            <option value="<?= $idioma->_id() ?>" <?= ($idioma->_id() == $ficha->_get("lang_id")) ? "selected" : ""?>>
                                                                <?= $idioma->_get("nombre") ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?= $ficha->loadHTML(["titulo", "ubicacion", "posicion", "video", "link", "estado"]) ?>
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
                    <a href="<?= base_url("admin/banners") ?>" class="btn btn-danger">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?= base_url("assets_admin/assets/js/uploadImage.js") ?>" ></script>
