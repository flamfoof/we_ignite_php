<div class="layout-px-spacing">
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                <div class="flex mb-2 mb-sm-0">
                    <h1 class="h2">Lista de Plugins Instalados</span></h1>
                </div>
                <a href="<?= base_url("admin/plugins/install") ?>" class="btn btn-success ml-auto">Instalar</a>
            </div>
        </div>
        <div class="card-body">
            <!-- Wrapper -->
            <div class="table-responsive" data-toggle="lists" data-lists-values='["name"]'>
                <!-- Search -->
                <?= view("templates/search") ?>
                <!-- Table -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th >Nombre</th>
                            <th  class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fichas as $ficha): ?>
                            <tr>
                                <td>
                                    <?= $ficha->_get("name") ?>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary" href="<?= base_url("admin/plugin/{$ficha->_id()}/update") ?>">
                                        Actualizar
                                    </a>
                                    <a class="btn btn-primary" href="<?= base_url("admin/plugin/{$ficha->_id()}/deactivate") ?>">
                                        desactivar
                                    </a>
                                    <a class="btn btn-primary check-link" href="<?= base_url("admin/plugin/{$ficha->_id()}/uninstall") ?>">
                                        Desinstalar
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
