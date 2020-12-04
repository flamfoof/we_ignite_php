<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" class="layout-px-spacing" enctype="multipart/form-data">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">Ficha del Blog</h1>
            <div class="card">
                <div class="card-body row">
                    <div class="col-4">
                        <div class="banner-container">
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
                                    <?= $ficha->loadHTML(["titulo", "tema", "url", "fecha", "estado"]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="list-group list-group-fit">
                            <div class="list-group-item">
                                <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                    <?= $ficha->loadHTML(["descripcion", "contenido"], "ficha", false) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success">Guardar</button>
                    <a href="<?= base_url("admin/blogs") ?>" class="btn btn-danger">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?= base_url("assets_admin/assets/js/uploadImage.js") ?>" ></script>
