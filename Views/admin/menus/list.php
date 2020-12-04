<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?= base_url("assets_admin/plugins/drag-and-drop/dragula/dragula.css") ?>" rel="stylesheet" type="text/css" />
<link href="<?= base_url("assets_admin/plugins/drag-and-drop/dragula/example.css") ?>" rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->


<!--  BEGIN CONTENT AREA  -->
<div class="main-content">
    <div class="layout-px-spacing">

        <div class="row" id="cancel-row">
            <div class="col-lg-12 layout-spacing layout-top-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center w-100">
                                <div class="flex mb-2 mb-sm-0">
                                    <h1 class="h2">Menu</span></h1>
                                </div>
                                <div
                                    data-get="<?= base_url("admin/grupomenu/0/load") ?>"
                                    data-action="<?= base_url("admin/grupomenu/nuevo") ?>"
                                    data-title="Insertar nuevo Grupo Menu"
                                    data-redirect="admin/menus"
                                    class="btn btn-success ml-auto openEditionModal">
                                    Nuevo grupo
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $dragulas = [] ?>
                    <div class="widget-content widget-content-area">
                        <div class='parent ex-1'>
                            <div class="row">
                                <?php foreach ($fichas as $menuGrupo): ?>
                                    <div class="col-sm-6">
                                        <div class="border rounded p-2 mb-2">
                                            <div class="d-flex px-0 pb-1" style="border-bottom: 1px darkgray solid;">
                                                <h5 class="text-dark"><?=  $menuGrupo->_get("name") ?></h5>
                                                <div class="dropdown ml-auto">
                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink-1">
                                                        <a class="dropdown-item list-edit" href="javascript:void(0);">
                                                            <div
                                                                data-get="<?= base_url("admin/grupomenu/{$menuGrupo->_id()}/load") ?>"
                                                                data-action="<?= base_url("admin/grupomenu/{$menuGrupo->_id()}/editar") ?>"
                                                                data-title="Editar Grupo Menu"
                                                                data-redirect="admin/menus"
                                                                data-id="<?= $menuGrupo->_id() ?>"
                                                                class="openEditionModal">
                                                                Editar
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item list-edit" href="javascript:void(0);">
                                                            <div data-title="¿Deseas borrar el Grupo?"
                                                                data-body="Pulsa continuar para aceptar"
                                                                data-redirect="admin/menus"
                                                                data-href="<?= base_url("admin/grupomenu/{$menuGrupo->_id()}/borrar") ?>"
                                                                class="ask-before-reload">
                                                                Borrar
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $dragulas [] = "document.getElementById('dragula-{$menuGrupo->_id()}')" ?>
                                            <div id='dragula-<?= $menuGrupo->_id() ?>' data-id="<?= $menuGrupo->_id() ?>" class='dragula'>
                                                <?php $posicion = 0; ?>
                                                <?php foreach ($menuGrupo->getMenus() as $menu): ?>
                                                    <?php if ($menu->_get("posicion") != $posicion): ?>
                                                        <?php
                                                            $menu->_set("posicion", $posicion);
                                                            $menu->update();
                                                         ?>
                                                    <?php endif; ?>
                                                    <div
                                                        data-posicion="<?= $posicion ?>"
                                                        data-id="<?= $menu->_id() ?>"
                                                        data-parent="<?= $menuGrupo->_id() ?>"
                                                        class="media  d-md-flex d-block text-sm-left text-center dragula-item">
                                                        <div class="media-body">
                                                            <div class="d-xl-flex d-block justify-content-between">
                                                                <div class="">
                                                                    <h6 class=""><?= $menu->_get("name") ?></h6>
                                                                </div>
                                                                <div class="dropdown ml-auto">
                                                                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink-1">
                                                                        <?php if ($menu->_get("pagina_id") > 0): ?>
                                                                            <?php $pagina = $menu->getPagina() ?>
                                                                            <?php if ($pagina->_get("slug") != ""): ?>
                                                                                <div class="dropdown-item list-edit">
                                                                                    <a  href="<?= base_url("admin/pagina/{$pagina->_id()}/editar-pagina") ?>">
                                                                                        Diseñar página
                                                                                    </a>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                            <div
                                                                                data-get="<?= base_url("admin/pagina/{$menu->_get("pagina_id")}/load") ?>"
                                                                                data-action="<?= base_url("admin/pagina/{$menu->_get("pagina_id")}/editar") ?>"
                                                                                data-title="Editar página"
                                                                                data-redirect="admin/menus"
                                                                                class="openEditionModal dropdown-item list-edit">
                                                                                Editar página
                                                                            </div>
                                                                        <?php endif; ?>
                                                                        <div
                                                                            data-get="<?= base_url("admin/menu/{$menu->_id()}/load") ?>"
                                                                            data-action="<?= base_url("admin/menu/{$menu->_id()}/editar") ?>"
                                                                            data-redirect="admin/menus"
                                                                            data-title="Editar menu"
                                                                            class="openEditionModal dropdown-item list-edit">
                                                                            Editar menu
                                                                        </div>
                                                                        <div data-title="¿Deseas borrar el Grupo?"
                                                                            data-body="Pulsa continuar para aceptar"
                                                                            data-redirect="admin/menus"
                                                                            data-href="<?= base_url("admin/menu/{$menu->_id()}/borrar") ?>"
                                                                            class="ask-before-reload dropdown-item list-edit">
                                                                            Borrar menu
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php $posicion ++; ?>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="">
                                                <hr>
                                                <div
                                                    data-get="<?= base_url("admin/menu/0/load") ?>"
                                                    data-action="<?= base_url("admin/menu/nuevo") ?>"
                                                    data-title="Insertar menu"
                                                    data-redirect="admin/menus"
                                                    class="btn btn-success openEditionModal w-100">
                                                    <i data-v-134867f8="" class="material-icons icon-40pt">add_circle_outline</i>
                                                    Nuevo menu
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  END CONTENT AREA  -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?= base_url("assets_admin/plugins/drag-and-drop/dragula/dragula.min.js") ?>"></script>
<script src="<?= base_url("assets_admin/plugins/drag-and-drop/dragula/custom-dragula.js") ?>"></script>
<!-- END PAGE LEVEL SCRIPTS -->

<?= view("templates/modal_edition") ?>

<script type="text/javascript">
    dragula([<?= implode(", ", $dragulas) ?>])
    .on('drag', function (el) {
        console.log("dragging", el);
        el.className += ' el-drag-ex-1';
    }).on('drop', function (el) {
        console.log("dropping", $(el).attr("data-id"));
        el.className = el.className.replace('el-drag-ex-1', '');
        var container = $(el).parent();
        var container_id = $(container).attr("id");
        var id = $(container).attr("data-id");
        console.log("parent id", id);
        var childs = "#"+container_id+" .dragula-item";
        var serialize = [];
        var posicion = 0;
        $(childs).each(function(){
            var obj = new Object();
            obj.id = $(this).attr("data-id");
            obj.source = $(this).attr("data-posicion");
            obj.destination = posicion;
            obj.parent =  $(this).attr("data-parent");
            posicion ++;
            serialize.push(obj);
        });
        var myJSON = JSON.stringify(serialize);
        console.log(myJSON);
        var url = "<?= base_url("admin/menu") ?>/"+id+"/sort";
        $.post(url, {myJSON:myJSON}, function(data){
            location.reload();
        });
    }).on('cancel', function (el) {
        console.log("canceling", el);
        el.className = el.className.replace('el-drag-ex-1', '');
    }).on('over', function (el, container) {
        console.log("over", el, container);
        container.className += ' ex-over';
    });
</script>
