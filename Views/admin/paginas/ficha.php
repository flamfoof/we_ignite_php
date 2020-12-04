<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" class="layout-px-spacing">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">Ficha de Menu</h1>
            <div class="card">
                <div class="list-group list-group-fit">
                    <div class="list-group-item">
                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                            <?= $ficha->loadHTML(["name", "slug", "estado"]) ?>
                        </div>
                    </div>
                </div>
                <div class="list-group list-group-fit">
                    <div class="list-group-item">
                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                            <?= $ficha->loadHTML([
                                "meta_index", "meta_title", "meta_description",
                                "meta_keywords", "facebook_type"
                            ]) ?>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                            <div class="form-row mb-1">
                                <label class="col-md-3 col-form-label form-label">
                                    Meta Facebook Imagen
                                </label>
                                <div class="col-md-9">
                                    <div class="banner-container">
                                        <img id="img-image" src="<?= isset($ficha) ? $ficha->getImagen() : "nohayimagen" ?>"
                                            class="btn-archivos  margin-bottom-micro"
                                            data-destination = "<?= FCPATH."assets/archivos/paginas" ?>" />
                                        <input type="text" class="form-control special-file d-none"
                                            name="ficha[pagina_facebook_image]"
                                            value="<?= $ficha->_get("facebook_image") ?>"
                                            id="input-image" />
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
                    <a href="<?= base_url("admin/pagina/{$ficha->_id()}/editar-pagina") ?>" class="btn btn-primary">Editar página</a>
                    <a href="<?= base_url("admin/paginas") ?>" class="btn btn-danger">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?= base_url("assets_admin/assets/js/uploadMultiImage.js") ?>" ></script>
<?= view("templates/tab_js",[]) ?>
