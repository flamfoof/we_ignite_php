<?php if ($ficha->_id() > 0): ?>
    <a class="btn btn-primary" href="<?= base_url("admin/usuario/{$ficha->_id()}/direccion/nueva") ?>">
        Nueva dirección
    </a>
    <div class="table-responsive" data-toggle="lists" data-lists-values='["name"]'>
        <!-- Table -->
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pais</th>
                    <th>Provincia</th>
                    <th>Ciudad</th>
                    <th>Direccion</th>
                    <th  class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ficha->getDirecciones() as $direccion): ?>
                    <tr>
                        <td >
                            <?= $direccion->_id() ?>
                        </td>
                        <td><?= $direccion->getPais()->_get("nombre") ?></td>
                        <td><?= $direccion->getProvinciaName() ?></td>
                        <td><?= $direccion->getCiudadName() ?></td>
                        <td><?= $direccion->_get("direccion") ?></td>
                        <td class="text-center">
                            <a href="<?= base_url("admin/usuario/{$ficha->_id()}/direccion/{$direccion->_id()}/editar") ?>">
                                <i data-v-134867f8="" class="material-icons icon-40pt">edit</i>
                            </a>
                            <a href="<?= base_url("admin/usuario/{$ficha->_id()}/direccion/{$direccion->_id()}/borrar") ?>" class="check-link">
                                <i data-v-134867f8="" class="material-icons icon-40pt">delete</i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= isset($pagination) ? $pagination->links() : "" ?>
<?php endif; ?>
