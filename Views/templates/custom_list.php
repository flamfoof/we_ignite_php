<div class="layout-px-spacing">
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                <div class="flex mb-2 mb-sm-0">
                    <h1 class="h2">Lista de <span class="text-primary"><?= $list_title ?></span></h1>
                </div>
                <?php if (isset($list_btn_nuevo_link)): ?>
                    <a href="<?= $list_btn_nuevo_link ?>" class="btn btn-success ml-auto"><?= $list_btn_nuevo ?></a>
                <?php endif; ?>
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
                            <?php foreach ($list_table as $field): ?>
                                <?php $FullName = $entity->_getFullName($field) ?>
                                <?php if (isset($entity->fields[$FullName])): ?>
                                    <?php $_field = $entity->fields[$FullName] ?>
                                    <?php if (isset($_field["html"])): ?>
                                        <?php $html = $_field["html"] ?>
                                        <th><?= $html["label"] ?></th>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <th  class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fichas as $ficha): ?>
                            <tr>
                                <?php foreach ($list_table as $field): ?>
                                    <?php $FullName = $entity->_getFullName($field) ?>
                                    <?php if (isset($entity->fields[$FullName])): ?>
                                        <?php $_field = $entity->fields[$FullName] ?>
                                        <?php if (isset($_field["html"])): ?>
                                            <?php $html = $_field["html"] ?>
                                            <td><?= $ficha->_get($field) ?></td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td class="text-center">
                                    <a href="<?= "$list_base_link/{$ficha->_id()}/editar" ?>">
                                        <i data-v-134867f8="" class="material-icons icon-40pt">edit</i>
                                    </a>
                                    <a href="<?= "$list_base_link/{$ficha->_id()}/borrar" ?>" class="check-link">
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
