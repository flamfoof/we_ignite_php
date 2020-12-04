<div class="layout-px-spacing">
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                <div class="flex mb-2 mb-sm-0">
                    <h1 class="h2">Documentos</span></h1>
                </div>
                <a href="<?= base_url("admin/galeria/documentos/sincronizar") ?>" class="btn btn-success mr-1">Sincronizar Archivos -> Documentos</a>
                <a href="<?= base_url("admin/galeria/documento/nuevo") ?>" class="btn btn-success ml-auto">
                    Nuevo documento
                </a>
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
                    <a href="<?= base_url("admin/galeria/imagen/{$ficha->_id()}/editar") ?>" class="col-md-1">
                        <svg style="width: 100%; height: auto;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 32"><g fill="#626262"><path d="M1.5 32h21c.827 0 1.5-.673 1.5-1.5v-21c0-.017-.008-.031-.009-.047c-.002-.023-.008-.043-.013-.065a.488.488 0 0 0-.09-.191c-.007-.009-.006-.02-.013-.029l-8-9c-.003-.003-.007-.003-.01-.006a.494.494 0 0 0-.223-.134c-.019-.006-.036-.008-.056-.011C15.557.012 15.53 0 15.5 0h-14C.673 0 0 .673 0 1.5v29c0 .827.673 1.5 1.5 1.5zM16 1.815L22.387 9H16.5c-.22 0-.5-.42-.5-.75V1.815zM1 1.5a.5.5 0 0 1 .5-.5H15v7.25c0 .809.655 1.75 1.5 1.75H23v20.5a.5.5 0 0 1-.5.5h-21c-.28 0-.5-.22-.5-.5v-29z"/><path d="M5.5 14h13a.5.5 0 0 0 0-1h-13a.5.5 0 0 0 0 1z"/><path d="M5.5 18h13a.5.5 0 0 0 0-1h-13a.5.5 0 0 0 0 1z"/><path d="M5.5 10h6a.5.5 0 0 0 0-1h-6a.5.5 0 0 0 0 1z"/><path d="M5.5 22h13a.5.5 0 0 0 0-1h-13a.5.5 0 0 0 0 1z"/><path d="M5.5 26h13a.5.5 0 0 0 0-1h-13a.5.5 0 0 0 0 1z"/></g></svg>
                        <?= $ficha->_get("nombre") ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
