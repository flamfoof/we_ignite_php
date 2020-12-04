<div class="layout-px-spacing">
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                <div class="flex mb-2 mb-sm-0">
                    <h1 class="h2">Lista de Páginas</span></h1>
                </div>
                <a href="<?= base_url("admin/pagina/nueva") ?>" class="btn btn-success ml-auto">Nueva página</a>
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
                            <th>Nombre</th>
                            <th>Slug</th>
                            <th  class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fichas as $ficha): ?>
                            <tr>
                                <td><?= $ficha->_get("name") ?></td>
                                <td><?= $ficha->_get("slug") ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url("admin/pagina/{$ficha->_id()}/editar-pagina") ?>" title="Editar pagina">
                                        <i data-v-134867f8="" class="material-icons icon-40pt">class</i>
                                    </a>
                                    <a href="<?= base_url("admin/pagina/{$ficha->_id()}/editar") ?>" title="Editar pagina">
                                        <i data-v-134867f8="" class="material-icons icon-40pt">edit</i>
                                    </a>
                                    <a href="<?= base_url("admin/pagina/{$ficha->_id()}/borrar") ?>" class="check-link" title="Borrar pagina">
                                        <i data-v-134867f8="" class="material-icons icon-40pt">delete</i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <?= isset($pagination) ? $pagination->links() : "" ?>
        </div>
    </div>
</div>
