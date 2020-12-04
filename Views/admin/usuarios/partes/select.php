<?php foreach ($usuarios as $myusuario): ?>
    <li>
        <div class="usuario_select btn d-block w-100 p-2 border"
            data-id="<?= $myusuario->_id() ?>"
            data-href="<?= getCurrent(["usuario_id_cliente" => $myusuario->_id()]) ?>"
        >
            <?= $myusuario->getNombre() ?>
        </div>
    </li>
<?php endforeach; ?>
