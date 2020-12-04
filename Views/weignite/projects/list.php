<div class="layout-px-spacing">
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                <div class="flex mb-2 mb-sm-0">
                    <h1 class="h2">Project List</span></h1>
                </div>
            </div>
        </div>
        <div class="card-body">
            <!-- Wrapper -->
            <div class="table-responsive" data-toggle="lists" data-lists-values='["name"]'>
                <!-- Search -->
                <?= view("templates/search", ["placeHolder" => "search..."]) ?>
                <!-- Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th  class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($fichas as $ficha): ?>
                            <tr>
                                <td><?= $ficha->_id() ?></td>
                                <td><?= $ficha->_get("name") ?></td>

                                <td class="text-center">
                                    <a href="<?= base_url("project/{$ficha->_id()}/view") ?>">
                                        <i data-v-134867f8="" class="material-icons icon-40pt">remove_red_eyes</i>
                                    </a>

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
