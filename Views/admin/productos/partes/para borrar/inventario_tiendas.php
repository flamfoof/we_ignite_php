<h4><?= $tienda->_get("nombrecomercial") ?></h4>
<div class="d-flex">
    <?php foreach ($combinacionesTienda as $combinaciont): ?>
        <?php $combinacion = $combinaciont->getCombinacion() ?>
        <div class="p-2 border rounded mr-2">
            <div class="">
                <?= $combinacion->getcombinacion() ?>
            </div>
            <hr>
            <div class="">
                <?= intval($combinaciont->_get("cantidad")) ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
