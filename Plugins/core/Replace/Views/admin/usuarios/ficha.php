<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" class="layout-px-spacing">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">Ficha de Usuario</h1>
            <div class="card">
                <ul class="nav nav-tabs nav-tabs-card">
                    <li class="nav-item">
                        <a class="nav-link active" href="#detalles" data-toggle="tab">Detalles</a>
                    </li>
                    <?php if (class_exists("\\App\\Models\\PedidoModel")): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#pedidos" data-toggle="tab">Pedidos</a>
                        </li>
                    <?php endif; ?>
                    <?php if (class_exists("\\App\\Models\\DireccionModel")): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#direcciones" data-toggle="tab">Direcciones</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#sesiones" data-toggle="tab">Sesiones</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="detalles">
                        <?= view("admin/usuarios/partes/detalle", [
                            "ficha" => $ficha,
                        ]) ?>
                    </div>
                    <?php if (class_exists("\\App\\Models\\PedidoModel")): ?>
                        <div class="tab-pane" id="pedidos">
                            <?= view("admin/usuarios/partes/pedidos", [
                                "ficha" => $ficha,
                            ]) ?>
                        </div>
                    <?php endif; ?>
                    <?php if (class_exists("\\App\\Models\\DireccionModel")): ?>
                        <div class="tab-pane" id="direcciones">
                            <?= view("admin/usuarios/partes/direcciones", [
                                "ficha" => $ficha,
                            ]) ?>
                        </div>
                    <?php endif; ?>
                    <div class="tab-pane" id="sesiones">
                        <?= view("admin/usuarios/partes/sesiones", [
                            "ficha" => $ficha,
                        ]) ?>
                    </div>
                </div>
            </div>

            <?php if ($ficha->_id() > 0): ?>
                <?php $ficha->getRoles() ?>
                <div class="card">
                    <div class="list-group list-group-fit">
                        <div class="list-group-item">
                            <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                <div class="form-row mb-1">
                                    <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                                        Roles
                                    </label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <?php foreach ($roleModel->findAll() as $role): ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input id="customCheck<?= $role->_id() ?>" name="ficharol[<?= $role->_id() ?>]" type="checkbox" class="custom-control-input" <?= isset($ficha->myroles[$role->_get("nombre")]) ? "checked" : "" ?>>
                                                    <label for="customCheck<?= $role->_id() ?>" class="custom-control-label"><?= $role->_get("nombre") ?></label>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success">Guardar</button>
                    <a href="<?= base_url("admin/usuarios") ?>" class="btn btn-danger">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?= base_url("assets_admin/assets/js/uploadMultiImage.js") ?>" ></script>
<?= view("templates/tab_js",[]) ?>
