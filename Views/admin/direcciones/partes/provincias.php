<label class="col-md-3">Provincia</label>
<div class="col-md-7">
    <select class="form-control setProvincia" name="ficha[direccion_provincia_id]">
        <option value="">-- SELECCIONA UNA PROVINCIA --</option>
        <?php foreach ($provincias as $provincia): ?>
            <?php $selected = ($provincia->_id() == $direccion->_get("provincia_id"))? "selected" : "" ?>
            <option value="<?= $provincia->_id() ?>" <?= $selected ?>><?= $provincia->_get("nombre") ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="btn btn-info col-md-2 openEditionModal"
    data-get="<?= base_url("admin/direccion/{$curusuario->_id()}/provincia/0/modal") ?>"
    data-action="<?= base_url("admin/direccion/{$curusuario->_id()}/provincia/0/modal") ?>"
    data-title="Datos del proveedor"
    data-redirect="">
    <i data-v-134867f8="" class="material-icons icon-40pt">add</i>
</div>
