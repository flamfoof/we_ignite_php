<?php $i = 0 ?>
<?php foreach ($impresion["productos"] as $skubase => $producto): ?>
    <?php $i ++ ?>
    <tr class="page-brake">
        <td>
            <?= $i ?> | <?= $producto["producto"]->_id() ?>
        </td>
        <td>
            <img src="<?= $producto["producto"]->getImagen() ?>" alt="" style="height: 40px; width: 40px; object-fit:cover;">
        </td>
        <td>
            <a target="_blank" href="<?= base_url("admin/producto/{$producto["producto"]->_id()}/editar") ?>">
                <div class="">
                    <?= $skubase ?>
                </div>
                <div class="">
                    <?= $producto["producto"]->_get("nombreinterno") ?>
                </div>
                <div class="">
                    <?= $producto["producto"]->getColor()->_get("nombre") ?>
                </div>
            </a>
        </td>
        <td>
            <div class="">
                <?php $marca = $producto["producto"]->getMarca(); ?>
                <?php if (!empty($marca)): ?>
                    <?= $marca->_get("nombre") ?>
                <?php else: ?>
                    Sin Marca
                <?php endif; ?>
            </div>
            <div class="">
                <?php $famNombre = $producto["producto"]->getSubFamilia()->getFamiliaLang()->_get("nombre") ?>
                <?= ($famNombre != "") ? $famNombre : "Sin Familia" ?>
            </div>
            <div class="">
                <?php $coleccion = $producto["producto"]->getColeccionByPadre("Genero")->getColeccion()->_get("nombre") ?>
                <?= ($coleccion != "") ? $coleccion : "" ?>
            </div>
            <div class="">
                <?php $coleccion = $producto["producto"]->getColeccionByPadre("Temporada")->getColeccion()->_get("nombre") ?>
                <?= ($coleccion != "") ? $coleccion : "" ?>
            </div>
        </td>
        <td class="d-flex">
            <?php $grupos = $producto["grupo"]; ?>
            <?php foreach ($grupos as $grupo): ?>
                <?php $combinacionCantidad = intval($grupo["combinacion"]->getCantidadades($tienda)) ?>
                <?php if (
                    ($ocultar == "false") ||
                    ($combinacionCantidad > 0)
                    ): ?>
                    <div class="p-2 border m-1 openEditionModal" style="cursor:pointer;"
                        data-get="<?= base_url("admin/producto/{$producto["producto"]->_id()}/combinacion/{$grupo["combinacion"]->_id()}/tiendas") ?>"
                        data-action="none"
                        data-title="Cantidades en tienda"
                        data-redirect="none">
                        <div class="">
                            <span class=""><?= $grupo["combinacion"]->getcombinacion() ?></span>
                        </div>
                        <div class="">
                            <?= $combinacionCantidad ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </td>
        <td>
            <?= $configuracion->moneda($producto["sumaPrecios"] / count($grupos)) ?>
        </td>
    </tr>
<?php endforeach; ?>
