<?php
use App\Entities\Zona;
?>
<div class="layout-px-spacing">
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                <div class="flex mb-2 mb-sm-0">
                    <h1 class="h2">Lista de Zonas</span></h1>
                </div>
                <a href="<?= base_url("admin/zona/nueva") ?>" class="btn btn-success ml-auto">Nueva Zona</a>
            </div>
        </div>
        <div class="card-body">
            <!-- Wrapper -->
            <div class="table-responsive" data-toggle="lists" data-lists-values='["name"]'>
                <!-- Search -->
                <?= view("templates/search") ?>
                <!-- Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Sel</th>
                            <th>Nombre</th>
                            <th  class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fichas as $ficha): ?>
                            <tr>
                                <td class="text-center p-0 pb-4 pl-2">
                                    <input type="checkbox" data-id="<?= $ficha->_id() ?>" class="form-check-input select-input">
                                </td>
                                <td><?= $ficha->_get("nombre") ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url("admin/zona/{$ficha->_id()}/editar") ?>">
                                        <i data-v-134867f8="" class="material-icons icon-40pt">edit</i>
                                    </a>
                                    <a href="<?= base_url("admin/zona/{$ficha->_id()}/borrar") ?>" class="check-link">
                                        <i data-v-134867f8="" class="material-icons icon-40pt">delete</i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex">
            <div class="w-50">
                <?= isset($pagination) ? $pagination->links() : "" ?>
            </div>
            <div class="w-50 text-right">
                <button class="btn btn-primary mr-1 open-modal">Editar Seleccionadas</button>
                <button class="btn btn-primary open-modal-all">Editar Todas</button>
            </div>
        </div>
    </div>
</div>
<?php $ficha = (count($fichas) > 0) ? $fichas[0] : new Zona() ?>
<?= view("admin/zonas/partes/modal", ["ficha" => $ficha]) ?>
<?= view("admin/zonas/partes/script", ["ficha" => $ficha]) ?>
