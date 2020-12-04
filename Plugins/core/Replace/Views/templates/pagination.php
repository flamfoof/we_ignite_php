<?php $queryInicio = $this->input->getURLGets(["pagina" => 0, "bloque" => $block]) ?>
<?php $queryPrev = $this->input->getURLGets(["pagina" => $prev, "bloque" => $block]) ?>
<?php $queryCurrent = $this->input->getURLGets(["pagina" => $object["pagina"], "bloque" => $block]) ?>
<?php $queryNext = $this->input->getURLGets(["pagina" => $next, "bloque" => $block]) ?>
<?php $queryEnd = $this->input->getURLGets(["pagina" => $object["total"] , "bloque" => $block]) ?>
<ul class="pagination justify-content-center pagination-sm">
    <li class="page-item" >
        <a href="<?= site_url($object["link"]."$queryInicio") ?>" class="page-link">
            <span aria-hidden="true" class="material-icons">chevron_left</span>
            <span aria-hidden="true" class="material-icons">chevron_left</span>
        </a>
    </li>

    <li class="page-item" >
        <a href="<?= site_url($object["link"]."$queryPrev") ?>" class="page-link">
            <span aria-hidden="true" class="material-icons">chevron_left</span>
        </a>
    </li>

    <?php
        $prev_ini = $object["pagina"] - 3;
        $prev_ini = ($prev_ini < 0) ? 0 : $prev_ini; ?>
    <?php for ($i=$prev_ini; $i < $object["pagina"]; $i++): ?>
        <?php $pagina = $i + 1; ?>
        <?php $queryFor = $this->input->getURLGets(["pagina" => $i, "bloque" => $block]) ?>
            <li class=" page-item ">
                <a href="<?= site_url($object["link"])."$queryFor" ?>" class="page-link">
                    <span><?= $pagina ?></span>
                </a>
            </li>
    <?php endfor; ?>

    <li class=" page-item active">
        <a href="<?= site_url($object["link"])."$queryCurrent" ?>" class="page-link">
            <span><?= ($object["pagina"] + 1) ?></span>
        </a>
    </li>

    <?php $last_pagina = (($object["pagina"] + 4) >= $paginas) ? $paginas : ($object["pagina"] + 4); ?>
    <?php for ($i=$object["pagina"]+1; $i < $last_pagina; $i++): ?>
        <?php $pagina = $i + 1; ?>
        <?php $queryFor = $this->input->getURLGets(["pagina" => $i, "bloque" => $block]) ?>
        <li class=" page-item ">
            <a href="<?= site_url($object["link"])."$queryFor" ?>" class="page-link">
                <span><?= $pagina ?></span>
            </a>
        </li>
    <?php endfor; ?>

    <li class=" page-item next" id="DataTables_Table_0_next">
        <a href="<?= site_url($object["link"])."$queryNext" ?>"class="page-link">
            <span aria-hidden="true" class="material-icons">chevron_right</span>
        </a>
    </li>

    <li class=" page-item next" id="DataTables_Table_0_next">
        <a href="<?= site_url($object["link"])."?$queryEnd" ?>"class="page-link">
            <span aria-hidden="true" class="material-icons">chevron_right</span>
            <span aria-hidden="true" class="material-icons">chevron_right</span>
        </a>
    </li>
</ul>
<span class="pt-5 pb-5 ml-2 text-muted">
    Mostrando <?= (($block*$object["pagina"]) + 1) ?>–<?= ($block*$next) ?> de <?= $object["total"] ?> resultados
</span>
