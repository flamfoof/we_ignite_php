<div class="layout-px-spacing">
    <div class="row">
        <?php foreach ($files as $file): ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                            <div class="mb-2 mb-sm-0 w-100">
                                <h1 class="h2 d-flex">
                                    <span class="w-100"><?= $file ?></span>
                                    <?php if ($configuracion->getCarpeta() == $file): ?>
                                        <span class="badge badge-primary">Activo</span>
                                    <?php endif; ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <img src="<?= $configuracion->getImageTema($file) ?>" alt="" class="img-fluid">
                    </div>
                    <div class="card-footer">
                        <?php $slug = slug($file) ?>
                        <a class="btn btn-primary" href="<?= base_url("admin/configuracion/{$slug}/activar") ?>">Activar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
