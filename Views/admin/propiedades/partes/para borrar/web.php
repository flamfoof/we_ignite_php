<div class="list-group list-group-fit">
    <div class="list-group-item">
        <div role="group" class="m-0 form-group">
            <div class="form-row mb-1">
                <label id="label-profilename"  for="profilename" class="col-md-3 col-form-label form-label">
                    ID Color
                </label>
                <div class="col-md-9">
                    <input type="text" id="modal_color" list="colores" name="ficha[producto_color_id]" value="<?= $ficha->_get("color_id") ?>" class="form-control">
                    <datalist id="colores">
                        <?php $colorModel = new \App\Models\ColorModel(); ?>
                        <?php $colores = $colorModel->where("color_estado", 1)->findAll(); ?>
                        <?php foreach ($colores as $color): ?>
                            <option value="<?= $color->_id() ?>"><?= $color->_get("nombre") ?></option>
                        <?php endforeach; ?>
                    </datalist>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <div role="group" class="m-0 form-group">
            <h4>Descripción del producto en la web</h4>
            <?php if ($ficha->_id() > 0): ?>
                <?php if (count($idiomas) > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Idioma</th>
                                <th>Nombre</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($idiomas as $idioma): ?>
                                <?php $productoTienda = $ficha->getProductoTienda($idioma->_id()) ?>
                                <?php if (!empty($productoTienda)): ?>
                                    <tr>
                                        <td><?= $idioma->_get("nombre") ?></td>
                                        <td><?= $productoTienda->_get("nombre") ?></td>
                                        <td class="text-center">
                                            <a href="<?= base_url("admin/producto/{$ficha->_id()}/lang/{$idioma->_id()}/productotienda/{$productoTienda->_id()}/editar") ?>">
                                                <i data-v-134867f8="" class="material-icons icon-40pt">edit</i>
                                            </a>
                                            <a href="<?= base_url("admin/producto/{$ficha->_id()}/lang/{$idioma->_id()}/productotienda/{$productoTienda->_id()}/borrar") ?>" class="check-link">
                                                <i data-v-134867f8="" class="material-icons icon-40pt">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <tr>
                                        <td><?= $idioma->_get("nombre") ?></td>
                                        <td></td>
                                        <td class="text-center">
                                            <a href="<?= base_url("admin/producto/{$ficha->_id()}/lang/{$idioma->_id()}/productotienda/nuevo") ?>">
                                                <i data-v-134867f8="" class="material-icons icon-40pt">add_box</i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="">
                        * No tienes ningún idioma agregado al sistema. <a href="<?= base_url("admin/idiomas") ?>">Agregar idioma</a>
                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="text-muted">
                    <i data-v-134867f8="" class="material-icons icon-40pt">info_outline</i>
                    Debes guardar el producto antes de poder crear las descripciones
                    para la web en los distintos idiomas
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
