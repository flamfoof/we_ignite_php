<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" class="layout-px-spacing" enctype="multipart/form-data">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">Ficha de la Configuracion</h1>
            <div class="card">
                <ul class="nav nav-tabs nav-tabs-card">
                    <li class="nav-item">
                        <a class="nav-link active" href="#detalles" data-toggle="tab">Datos Básicos</a>
                    </li>
                    <?php if (class_exists("\\App\\Models\\CarritoModel")): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#ventas" data-toggle="tab">Ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#pagos" data-toggle="tab">Pagos</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#envios" data-toggle="tab">Envíos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#moneda" data-toggle="tab">Moneda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#conexiones" data-toggle="tab">Conexiones</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="detalles">
                        <div class="list-group list-group-fit">
                            <div class="list-group-item">
                                <div role="group" class="m-0 form-group">
                                    <?= $ficha->loadHTML(["razonsocial", "nombretienda", "slogan", "email",
                                        "telefono", "direccion", "cif"
                                    ]) ?>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div role="group" class="m-0 form-group">
                                    <?= $ficha->loadHTML(["enmantenimiento", "tipotienda", "verprecios",
                                        "linkinfluencer", "porcentajepuntos"
                                    ]) ?>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div role="group" class="m-0 form-group">
                                    <?= $ficha->loadHTML(["suscripciones", "contenidoonline"]) ?>
                                    <?php
                                    /* COMENTADO TEMPORALMENTE
                                    <div class="form-row mb-1">
                                        <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                            Tienda Online
                                        </label>
                                        <div class="col-md-9">
                                            <div role="group" class="input-group input-group-merge">
                                                <select class="form-control" name="ficha[configuracion_tienda_id_online]">
                                                    <option value="0">--SELECCIONA UNA TIENDA--</option>
                                                    <?php foreach ($ficha->getTiendas() as $tienda): ?>
                                                        <?php $selected = ($tienda->_id() == $ficha->_get("tienda_id_online")) ? "selected" : "" ?>
                                                        <option value="<?= $tienda->_id() ?>" <?= $selected ?>><?= $tienda->_get("nombrecomercial") ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    */
                                     ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if (class_exists("\\App\\Models\\CarritoModel")): ?>
                        <div class="tab-pane" id="ventas">
                            <div class="list-group list-group-fit">
                                <div class="list-group-item">
                                    <?= $ficha->loadHTML(["gastosenviodefecto", "ivageneral", "iva", "irpf"]) ?>

                                    <?php

                                    /*COMENTADO TEMPORALMENTE


                                    <div class="form-row mb-1">
                                        <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                            Tiempo de entrega
                                        </label>
                                        <div class="col-md-9">
                                            <div role="group" class="input-group input-group-merge">
                                                <select class="form-control" name="ficha[configuracion_tiempoentrega_id]">
                                                    <option value="0">--SELECCIONA UN GRUPO--</option>
                                                    <?php foreach ($ficha->getTiemposEntrega() as $tiempoEntrega): ?>
                                                        <?php $selected = ($tiempoEntrega->_id() == $ficha->_get("tiempoentrega_id")) ? "selected" : "" ?>
                                                        <option value="<?= $tiempoEntrega->_id() ?>" <?= $selected ?>><?= $tiempoEntrega->_get("nombre") ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    */

                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="pagos">
                            <div class="list-group list-group-fit">
                                <div class="list-group-item">
                                    <?php
                                        /*COMENTADO TEMPORALMENTE

                                        <div class="form-row mb-1">
                                            <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                                Pago Efectivo
                                            </label>
                                            <div class="col-md-9">
                                                <div role="group" class="input-group input-group-merge">
                                                    <select class="form-control" name="ficha[configuracion_metodopago_id_efectivo]">
                                                        <option value="0">--SELECCIONA UNA FORMA DE PAGO--</option>
                                                        <?php foreach ($ficha->getMetodosPago() as $metodoPago): ?>
                                                            <?php $selected = ($metodoPago->_id() == $ficha->_get("metodopago_id_efectivo")) ? "selected" : "" ?>
                                                            <option value="<?= $metodoPago->_id() ?>" <?= $selected ?>><?= $metodoPago->_get("nombre") ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mb-1">
                                            <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                                Pago Tarjeta
                                            </label>
                                            <div class="col-md-9">
                                                <div role="group" class="input-group input-group-merge">
                                                    <select class="form-control" name="ficha[configuracion_metodopago_id_tarjeta]">
                                                        <option value="0">--SELECCIONA UNA FORMA DE PAGO--</option>
                                                        <?php foreach ($ficha->getMetodosPago() as $metodoPago): ?>
                                                            <?php $selected = ($metodoPago->_id() == $ficha->_get("metodopago_id_tarjeta")) ? "selected" : "" ?>
                                                            <option value="<?= $metodoPago->_id() ?>" <?= $selected ?>><?= $metodoPago->_get("nombre") ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row mb-1">
                                            <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                                Pago GiftCard
                                            </label>
                                            <div class="col-md-9">
                                                <div role="group" class="input-group input-group-merge">
                                                    <select class="form-control" name="ficha[configuracion_metodopago_id_giftcard]">
                                                        <option value="0">--SELECCIONA UNA FORMA DE PAGO--</option>
                                                        <?php foreach ($ficha->getMetodosPago() as $metodoPago): ?>
                                                            <?php $selected = ($metodoPago->_id() == $ficha->_get("metodopago_id_giftcard")) ? "selected" : "" ?>
                                                            <option value="<?= $metodoPago->_id() ?>" <?= $selected ?>><?= $metodoPago->_get("nombre") ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        */

                                     ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="tab-pane" id="envios">
                        <div class="list-group list-group-fit">
                            <div class="list-group-item">
                                <h5>Envíos de email</h5>
                                <?= $ficha->loadHTML(["emailtype","emailhost", "emailport", "emailuser",
                                    "emailpass"
                                ]) ?>
                            </div>
                            <div class="list-group-item">
                                <h5>¿Cuando enviarlos?</h5>
                                <h6>Cliente</h6>
                                <div class="form-row mb-1">
                                    <label class="col-md-3 col-form-label form-label">
                                        Enviar email al
                                    </label>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input id="customCheck_emailusuariopedir" name="ficha[emailusuariopedir]" type="checkbox"
                                                    class="custom-control-input" <?= ($ficha->_get("emailusuariopedir")>0) ? "checked" : "" ?>>
                                                <label for="customCheck_emailusuariopedir" class="custom-control-label">Al relizar pedido</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input id="customCheck_emailusuariopagar" name="ficha[emailusuariopagar]" type="checkbox"
                                                    class="custom-control-input" <?= ($ficha->_get("emailusuariopagar")>0) ? "checked" : "" ?>>
                                                <label for="customCheck_emailusuariopagar" class="custom-control-label">Al pagar</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input id="customCheck_emailusuarioenviar" name="ficha[emailusuarioenviar]" type="checkbox"
                                                    class="custom-control-input" <?= ($ficha->_get("emailusuarioenviar")>0) ? "checked" : "" ?>>
                                                <label for="customCheck_emailusuarioenviar" class="custom-control-label">Al enviar</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h6>Tienda</h6>
                                <div class="form-row mb-1">
                                        <label class="col-md-3 col-form-label form-label">
                                            Recibir email al
                                        </label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input id="customCheck_emailtiendapedir" name="ficha[emailtiendapedir]" type="checkbox"
                                                        class="custom-control-input" <?= ($ficha->_get("emailtiendapedir")>0) ? "checked" : "" ?>>
                                                    <label for="customCheck_emailtiendapedir" class="custom-control-label">Al relizar pedido</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input id="customCheck_emailtiendapagar" name="ficha[emailtiendapagar]" type="checkbox"
                                                        class="custom-control-input" <?= ($ficha->_get("emailtiendapagar")>0) ? "checked" : "" ?>>
                                                    <label for="customCheck_emailtiendapagar" class="custom-control-label">Al pagar</label>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input id="customCheck_emailtiendaenviar" name="ficha[emailtiendaenviar]" type="checkbox"
                                                        class="custom-control-input" <?= ($ficha->_get("emailtiendaenviar")>0) ? "checked" : "" ?>>
                                                    <label for="customCheck_emailtiendaenviar" class="custom-control-label">Al enviar</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="moneda">
                        <div class="list-group list-group-fit">
                            <div class="list-group-item">
                                <h5>Envíos de email</h5>
                                <?= $ficha->loadHTML(["moneda", "alphamoneda", "ubicacion",
                                    "miles", "decimales"
                                ]) ?>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="conexiones">
                        <div class="list-group list-group-fit">
                            <div class="list-group-item">
                                <?= $ficha->loadHTML(["googleanalytics", "facebookpixel"]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success">Guardar</button>
                    <a href="<?= base_url("admin/empresas") ?>" class="btn btn-danger">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?= base_url("assets_admin/assets/js/uploadMultiImage.js") ?>" ></script>
