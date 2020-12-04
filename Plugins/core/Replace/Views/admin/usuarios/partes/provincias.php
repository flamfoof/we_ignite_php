<?php if (!empty($provincias)): ?>
    <label class="col-md-3">Provincia</label>
    <div class="col-md-9">
        <select class="form-control editable" name="ficha[direccion_provincia_id]">
            <option value="">-- SELECCIONA UNA PROVINCIA --</option>
            <?php foreach ($provincias as $provincia): ?>
                <?php $selected = ($provincia->_id() == $direccion->_get("provincia_id"))? "selected" : "" ?>
                <option value="<?= $provincia->_id() ?>" <?= $selected ?>><?= $provincia->_get("nombre") ?></option>
            <?php endforeach; ?>
        </select>
    </div>
<?php else: ?>
    <label class="col-md-3">Provincia</label>
    <div class="col-md-9">
        <input type="text" class="pl-1 form-control editable" name="ficha[direccion_provincia]">
    </div>
<?php endif; ?>
