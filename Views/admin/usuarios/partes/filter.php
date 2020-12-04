<?php foreach ($usuarios as $myusuario): ?>
    <li>
        <div class="<?= isset($class) ? $class : "usuario_select_nosel" ?> btn d-block w-100 p-2 border" data-id="<?= $myusuario->_id() ?>">
            <?= $myusuario->getNombre() ?>
        </div>
    </li>
<?php endforeach; ?>
