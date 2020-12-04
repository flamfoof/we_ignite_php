<?php foreach ($ficha->getRelacionados() as $relacionado): ?>
    <tr>
        <td class="text-center p-0 pb-4">
            <input type="checkbox" data-id="<?= $relacionado->_id() ?>" class="form-check-input fci-formatos">
        </td>
        <td>
            <?= $relacionado->_get("nombreinterno") ?>
        </td>
        <td class="text-center">
            <a href="<?= base_url("admin/producto/{$ficha->_id()}/relcion/borrar/{$relacionado->_id()}") ?>" class="check-link">
                <i data-v-134867f8="" class="material-icons icon-40pt">delete</i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
