<div class="layout-px-spacing">
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                <div class="flex mb-2 mb-sm-0">
                    <h1 class="h2">Imágenes</span></h1>
                </div>
                <a href="<?= base_url("admin/galeria/imagenes/sincronizar") ?>" class="btn btn-success mr-1">Sincronizar Archivos -> Imágenes</a>
                <a href="<?= base_url("admin/galeria/imagen/nueva") ?>" class="btn btn-success ml-auto">Nueva Imágen</a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 mb-2">
                    <?= view("templates/search") ?>
                </div>
            </div>
            <div class="row">
                <?php foreach ($fichas as $ficha): ?>
                    <a href="<?= base_url("admin/galeria/imagen/{$ficha->_id()}/editar") ?>" class="col-md-3 mb-1">
                        <img src="<?= $ficha->getHRef() ?>" alt="" style="width: 100%; height: 30vh; object-fit:cover;">
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="card-footer d-flex">
            <?= isset($pagination) ? $pagination->links() : "" ?>
        </div>
    </div>
</div>
