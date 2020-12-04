<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<?= view("admin/paginas/partes/css") ?>
<div class="so-editor d-flex pointer">
    <span class="text-white">Herramientas</span>
    <div class="wrap">
        <button id="guardar" class="btn btn-success">Guardar</button>
        <a href="<?= base_url("admin/pagina/{$pagina->_id()}/editar") ?>" class="btn btn-danger">Regresar</a>
    </div>
</div>
<div id="my-content" class="">
    <?= $ficha ?>
</div>
<?= view("admin/paginas/partes/modal_edit") ?>
<?= view("admin/paginas/partes/modal_image") ?>
<?= view("admin/paginas/partes/script") ?>
