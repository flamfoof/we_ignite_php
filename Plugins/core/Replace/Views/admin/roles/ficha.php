<form method="post" class="layout-px-spacing">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">Ficha de Rol</h1>
            <div class="card">
                <div class="list-group list-group-fit">
                    <div class="list-group-item">
                        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                            <?= $ficha->loadHTML(["nombre"]) ?>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($ficha->_id() > 0): ?>
                <?php $ficha->getRolePerms() ?>
                <div class="card">
                    <div class="list-group list-group-fit">
                        <div class="list-group-item">
                            <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                <div class="form-row mb-1">
                                    <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                                        Permisos
                                    </label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <?php foreach ($permissionModel->findAll() as $permiso): ?>
                                                <div class="custom-control custom-checkbox">
                                                    <input id="customCheck<?= $permiso->_get("nombre") ?>" name="fichaPermission[<?= $permiso->_get("nombre") ?>]" type="checkbox" class="custom-control-input" <?= isset($ficha->permissions[$permiso->_get("nombre")]) ? "checked" : "" ?>>
                                                    <label for="customCheck<?= $permiso->_get("nombre") ?>" class="custom-control-label"><?= $permiso->_get("description") ?></label>
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
                    <a href="<?= base_url("admin/roles") ?>" class="btn btn-danger">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</form>
