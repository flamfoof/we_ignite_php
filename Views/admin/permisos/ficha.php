<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" class="layout-px-spacing">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">Ficha de Permiso</h1>
            <div class="card">
                <div class="list-group list-group-fit">
                    <div class="list-group-item">
                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                            <?= $ficha->loadHTML(["nombre", "description"]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success">Guardar</button>
                    <a href="<?= base_url("admin/permisos") ?>" class="btn btn-danger">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?= base_url("assets_admin/assets/js/uploadMultiImage.js") ?>" ></script>
<?= view("templates/tab_js",[]) ?>
