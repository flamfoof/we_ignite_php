<div class="layout-px-spacing">
    <div class="row">
        <div class="col-12">
            <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                <div class="flex mb-2 mb-sm-0">
                    <h1 class="h2">Lista de Plugins para instalar</span></h1>
                </div>
                <a href="<?= base_url("admin/plugins") ?>" class="btn btn-success ml-auto">Instalados</a>
            </div>
        </div>
        <?php foreach ($plugin->getFolders() as $folder): ?>
            <?php $slug = slug($folder) ?>
            <?php $found = false; ?>
            <?php foreach ($plugins as $plugin): ?>
                <?php if ($plugin->_get("name") == $folder): ?>
                    <?php if ($plugin->_get("estado") == 1): ?>
                        <?php $found = true; ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php if (!$found): ?>
                <div class="col-3 layout-spacing">
                    <div class="card">
                        <div class="card-header">
                            <?= $folder ?>
                        </div>
                        <div class="card-body">
                            <img src="<?= $plugin->getImage($folder) ?>" alt="" class="img-fluid">
                            <div class="mt-3">
                                <?= $plugin->getConfigValue($folder, "description") ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-primary w-100" href="<?= base_url("admin/plugin/$slug/install") ?>">
                                Instalar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <?= isset($pagination) ? $pagination->links() : "" ?>
</div>
