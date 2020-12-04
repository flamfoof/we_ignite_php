<div class="list-group list-group-fit">
    <div class="list-group-item">
        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
            <?= $ficha->loadHTML(["nombre", "apellidos", "dni", "email", "emailpass", "telefono"]) ?>
            <div class="form-row mb-1">
                <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                    Puntos
                </label>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-10">
                            <div role="group" class="input-group input-group-merge">
                                <input id="profilename" name="ficha[usuario_puntos]" value="<?= $ficha->_get("puntos") ?>" type="number" min="0" placeholder="Puntos del usuario" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-2">
                            <a href="<?= site_url("admin/usuario/{$request->uri->getSegment(3)}/enviar/puntos") ?>" class="btn btn-primary w-100">Enviar</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row mb-1">
                <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                    Estados
                </label>
                <div class="col-md-9">
                    <div role="group" class="input-group input-group-merge">
                        <select class="form-control" name="ficha[usuario_estado]">
                            <?= $ficha->_getOptions("estado") ?>
                        </select>
                    </div>
                </div>
            </div>
            <?php if (!empty($tiendas)): ?>
                <div class="form-row mb-1">
                    <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                        Tienda
                    </label>
                    <div class="col-md-9">
                        <div role="group" class="input-group input-group-merge">
                            <select class="form-control" name="ficha[usuario_tienda_id]">
                                <option value="">--SELECCIONA UNA TIENDA--</option>
                                <?php foreach ($tiendas as $tienda): ?>
                                    <option value="<?= $tienda->_id() ?>" <?=  ($tienda->_id() == $ficha->_get("tienda_id")) ? "selected" : "" ?>>
                                        <?= $tienda->_get("nombrecomercial") ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="list-group-item">
        <div role="group" aria-labelledby="label-about" class="m-0 form-group">
            <div class="form-row mb-1">
                <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                    Cuenta Password
                </label>
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-10">
                            <div role="group" class="input-group input-group-merge">
                                <input id="profilename" name="ficha[password]" value="" type="text" placeholder="Password" class="form-control" aria-describedby="description-profilename">
                            </div>
                            <small>Dejar vacío a menos que desees reestablecer el password</small>
                        </div>
                        <div class="col-2">
                            <a href="<?= site_url("admin/usuario/{$request->uri->getSegment(3)}/recuperar") ?>" class="btn btn-primary w-100">Email</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
