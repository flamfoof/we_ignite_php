<?php foreach ($combinaciones as $combinacion): ?>
    <tr>
        <td class="text-center p-0 pb-4">
            <input type="checkbox" data-id="<?= $combinacion->_id() ?>" class="form-check-input fci-formatos">
        </td>
        <td>
            <?= $combinacion->getcombinacion() ?>
        </td>
        <td class="groupable">
            <div class="value">
                <?= ($combinacion->_get("sku") == "") ? "Asignar SKU" : $combinacion->_get("sku") ?>
            </div>
            <div class="editable d-none">
                <input type="text" data-cell="sku" data-id="<?= $combinacion->_id() ?>" class="form-control editable-cell" value="<?= $combinacion->_get("sku") ?>">
            </div>
        </td>
        <td class="groupable">
            <div class="value">
                <?= ($combinacion->_get("ean") == "") ? "Asignar EAN13" : $combinacion->_get("ean") ?>
            </div>
            <div class="editable d-none">
                <input type="text" data-cell="ean" data-id="<?= $combinacion->_id() ?>" class="form-control editable-cell" value="<?= $combinacion->_get("ean") ?>">
            </div>
        </td>
        <td class="groupable">
            <div class="value">
                <?= intval($combinacion->_get("precio")) ?>
            </div>
            <div class="editable d-none">
                <input type="text" data-cell="precio" data-id="<?= $combinacion->_id() ?>" class="form-control editable-cell" value="<?= $combinacion->_get("precio") ?>">
            </div>
        </td>
        <td class="groupable">
            <div class="value">
                <?= intval($combinacion->_get("oferta")) ?>
            </div>
            <div class="editable d-none">
                <input type="text" data-cell="oferta" data-id="<?= $combinacion->_id() ?>" class="form-control editable-cell" value="<?= $combinacion->_get("oferta") ?>">
            </div>
        </td>
        <td class="groupable">
            <div class="value">
                <?= intval($combinacion->_get("costo")) ?>
            </div>
            <div class="editable d-none">
                <input type="text" data-cell="costo" data-id="<?= $combinacion->_id() ?>" class="form-control editable-cell" value="<?= $combinacion->_get("costo") ?>">
            </div>
        </td>
        <td class="groupable">
            <div class="value">
                <?= intval($combinacion->getCantidadades()) ?>
            </div>
            <div class="editable d-none">
                <input type="text" data-cell="costo" data-id="<?= $combinacion->_id() ?>" class="form-control editable-cell" value="<?= $combinacion->_get("costo") ?>">
            </div>
        </td>
        <td class="text-center">
            <a href="<?= base_url("admin/producto/{$ficha->_id()}/combinacion/{$combinacion->_id()}/imprimir/ean") ?>">
                <i data-v-134867f8="" class="material-icons icon-40pt">printer</i>
            </a>
            <a href="<?= base_url("admin/producto/{$ficha->_id()}/combinacion/{$combinacion->_id()}/editar") ?>">
                <i data-v-134867f8="" class="material-icons icon-40pt">edit</i>
            </a>
            <a href="<?= base_url("admin/producto/{$ficha->_id()}/combinacion/{$combinacion->_id()}/borrar") ?>" class="check-link">
                <i data-v-134867f8="" class="material-icons icon-40pt">delete</i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
