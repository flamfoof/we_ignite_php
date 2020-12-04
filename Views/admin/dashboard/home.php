<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?=  base_url("assets_admin/assets/css/scrollspyNav.css") ?>" rel="stylesheet" type="text/css" />
<link href="<?=  base_url("assets_admin/plugins/jvector/jquery-jvectormap-2.0.3.css") ?>" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
<style>
.jvectormap-container {
    border-radius: 14px;
    padding: 20px 0;
}
.jvectormap-zoomin, .jvectormap-zoomout, .jvectormap-goback {
    left: 20px;
    border-radius: 50%;
    background: #ffffff;
    padding: 6px 6px;
    color: #3b3f5c;
    border: 2px solid #3b3f5c;
    font-size: 19px;
    font-weight: 700;
    top: 20px;
}
.jvectormap-zoomout {
    top: 20px;
    left: 50px;
}
</style>
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <?php if (class_exists("\\App\\Models\\PedidoModel")): ?>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>Pedidos Online</h2>
                    </div>
                    <div class="card-body">

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <?php
                        $migrations = new \App\Models\MigrationsModel();
                        $migrate = $migrations->orderBy("id", "desc")->first();
                        ?>
                        Version: <?= $migrate->_get("class", true) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div class="col-12 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <h1 class="h2">Mapa de pedidos</span></h1>
                                <div id="world-map" style="width: 100%; height: 300px"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h2>Ventas</h2>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md-8">
            <?php if (class_exists("\\App\\Models\\ContactoModel")): ?>
                <div class="card">
                    <div class="card-header">
                        <h2>Mensajes sin leer</h2>
                    </div>
                    <div class="card-body">
                        <?php $contactoModel = new \App\Models\ContactoModel(); ?>
                        <?php $contactos = $contactoModel->where("contacto_estado", 1)->findAll(5) ?>
                        <?php foreach ($contactos as $contacto): ?>
                            <?php $data = json_decode($contacto->_get("data"), true) ?>
                            <div class="row mb-1 border-bottom">
                                <div class="col">
                                    <?= fecha($contacto->_get("fecha")) ?>
                                </div>
                                <?php $i = 0 ?>
                                <?php foreach ($data as $key => $value): ?>
                                    <?php if ($i < 3): ?>
                                        <div class="col">
                                            <?= $value["data"] ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php $i++ ?>
                                <?php endforeach; ?>
                                <div class="col-2">
                                    <div class="mb-1">
                                        <a href="<?= base_url("admin/contacto/{$contacto->_id()}/editar") ?>" class="btn btn-primary w-100 text-center">Ver</a>
                                    </div>
                                    <div class="">
                                        <a href="<?= base_url("admin/contacto/{$contacto->_id()}/borrar") ?>" class="btn btn-primary w-100 text-center">Eliminar</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" href="<?= base_url("admin/contactos") ?>">Ver todos</a>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (class_exists("\\App\\Models\\InmoCRMModel")): ?>
                <div class="card">
                    <div class="card-header">
                        <h2>Citas CRM</h2>
                    </div>
                    <div class="card-body">
                        <?php $crmModel = new \App\Models\InmoCRMModel(); ?>
                        <?php $crms = $crmModel
                            ->join("propiedad", "propiedad_id = inmocrm_propiedad_id")
                            ->where("inmocrm_fecha >=", date("Y-m-d"))
                            ->orderBy("inmocrm_fecha", "ASC")
                            ->findAll(5) ?>
                        <?php foreach ($crms as $crm): ?>
                            <div class="row mb-1 border-bottom">
                                <div class="col-2">
                                    <?= fecha($crm->_get("fecha")) ?>
                                </div>
                                <div class="col-4">
                                    <?= $crm->propiedad_nombre ?>
                                </div>
                                <div class="col-4">
                                    <?= word_limiter($crm->_get("observacion"), 4) ?>
                                </div>
                                <div class="col-2">
                                    <a href="<?= base_url("admin/propiedad/{$crm->propiedad_id}/editar#crm") ?>" class="btn btn-primary w-100 text-center">Ver</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Apps instaladas</h4>
                </div>
                <div class="card-body">
                    <?php $data = json_decode($configuracion->_get("data"), true) ?>
                    <?php $total = 0 ?>
                    <?php if (isset($data["plugins"])): ?>
                        <?php foreach ($data["plugins"] as $key => $value): ?>
                            <div class="row border-bottom">
                                <div class="col">
                                    <?= $key ?>
                                </div>
                                <div class="col text-right">
                                    <?= $configuracion->moneda($value) ?>
                                    <?php $total += $value ?>
                                </div>
                                <div class="col text-right">
                                    <i data-v-134867f8="" class="material-icons icon-40pt">chrome_reader_mode</i>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="card-footer text-right">
                    <b>TOTAL</b> <?= $configuracion->moneda($total) ?>/mes
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=  base_url("assets_admin/plugins/jvector/jquery-jvectormap-2.0.3.min.js") ?>"></script>
<script src="<?=  base_url("assets_admin/plugins/jvector/africa/jquery-jvectormap-africa-en.js") ?>"></script>
<script src="<?=  base_url("assets_admin/plugins/jvector/asia/jquery-jvectormap-asia-en.js") ?>"></script>
<script src="<?=  base_url("assets_admin/plugins/jvector/continents/jquery-jvectormap-continents-en.js") ?>"></script>
<script src="<?=  base_url("assets_admin/plugins/jvector/europe/jquery-jvectormap-europe-en.js") ?>"></script>
<script src="<?=  base_url("assets_admin/plugins/jvector/north_america/jquery-jvectormap-north-america-en.js") ?>"></script>
<script src="<?=  base_url("assets_admin/plugins/jvector/oceania/jquery-jvectormap-oceanina-en.js") ?>"></script>
<script src="<?=  base_url("assets_admin/plugins/jvector/south-america/jquery-jvectormap-south-america-en.js") ?>"></script>
<script src="<?=  base_url("assets_admin/plugins/jvector/worldmap_script/jquery-jvectormap-world-mill-en.js") ?>"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!--  BEGIN CUSTOM SCRIPTS FILE  -->
<script src="<?=  base_url("assets_admin/plugins/jvector/jvector_script.js") ?>"></script>
<!--  END CUSTOM SCRIPTS FILE  -->

<script type="text/javascript">
$('#world-map').vectorMap({
    map: 'europe_mill',
    backgroundColor: '#5c1ac3',
    borderColor: '#818181',
    borderOpacity: 0.25,
    borderWidth: 1,
    color: '#f4f3f0',
    regionStyle: {
        initial: {
            fill: '#fff'
        }
    },
    markerStyle: {
        initial: {
            r: 9,
            'fill': '#fff',
            'fill-opacity': 1,
            'stroke': '#000',
            'stroke-width': 5,
            'stroke-opacity': 0.4
        },
    },
    enableZoom: true,
    hoverColor: '#060818',
    hoverOpacity: null,
    normalizeFunction: 'linear',
    scaleColors: ['#b6d6ff', '#005ace'],
    selectedColor: '#c9dfaf',
    selectedRegions: [],
    showTooltip: true,
});
</script>
