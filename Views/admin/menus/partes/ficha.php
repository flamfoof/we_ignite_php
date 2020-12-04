<div class="list-group list-group-fit">
    <div class="list-group-item">
        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
            <?= $ficha->loadHTML(["name", "url", "enlace"]) ?>
        </div>
        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
            <div class="form-row mb-1">
                <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                    Página
                </label>
                <div class="col-md-9">
                    <div role="group" class="input-group input-group-merge">
                        <?php $paginaModel = new App\Models\PaginaModel()?>
                        <select class="form-control" name="ficha[menu_pagina_id]">
                            <option value="0">-- SELECCIONA UNA PAGINA --</option>
                            <option value="-1">-- PAGINA NUEVA --</option>
                            <?php foreach ($paginaModel->where("pagina_estado", 1)->findAll() as $pagina): ?>
                                <option value="<?= $pagina->_id() ?>" <?= ($pagina->_id() == $ficha->_get("pagina_id")) ? "selected" : "" ?>><?= $pagina->_get("name") ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

        </div>
        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
            <div class="form-row mb-1">
                <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                    Menu Grupo
                </label>
                <div class="col-md-9">
                    <div role="group" class="input-group input-group-merge">
                        <?php $menugrupoModel = new App\Models\MenuGrupoModel()?>
                        <select class="form-control" name="ficha[menu_menugrupo_id]">
                            <option value="0">-- SELECCIONA UN GRUPO --</option>
                            <?php foreach ($menugrupoModel->where("menugrupo_estado", 1)->findAll() as $menuGrupo): ?>
                                <option value="<?= $menuGrupo->_id() ?>" <?= ($menuGrupo->_id() == $ficha->_get("menugrupo_id")) ? "selected" : "" ?>><?= $menuGrupo->_get("name") ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="ficha[redirect]" value="admin/menus">
    </div>
</div>
