<style media="screen">
    .draggin-over-this-item{
        background: blue;
    }
</style>

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
                                                                data-id="<?= $menuGrupo->_id() ?>"
                                                                class="openEditionModal">
                                                                Editar
                                                            </div>
                                                        </a>
                                                        <a class="dropdown-item list-edit" href="javascript:void(0);">
                                                            <div data-title="¿Deseas borrar el Grupo?"
                                                                data-body="Pulsa continuar para aceptar"
                                                                data-post="{'redirect':'admin/menus'}"
                                                                data-href="<?= base_url("admin/grupomenu/{$menuGrupo->_id()}/borrar") ?>"
                                                                class="ask-before-reload">
                                                                Borrar
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $dragulas [] = "$('dragula-{$menuGrupo->_id()}')" ?>
                                            <div id='dragula-<?= $menuGrupo->_id() ?>' class='dragula'>
                                                <?php $posicion = 0; ?>
                                                <?php foreach ($menuGrupo->getMenus() as $menu): ?>
                                                    <?php if ($menu->_get("posicion") != $posicion): ?>
                                                        <?php
                                                            $menu->_set("posicion", $posicion);
                                                            $menu->update();
                                                         ?>
                                                    <?php endif; ?>
                                                    <div class="border rounded p-2 mt-2 draging-element" draggable="true">
                                                        <div class="media-body">
                                                            <div class="d-xl-flex d-block justify-content-between">
                                                                <div class="">
                                                                    <h6 class=""><?= $menu->_get("name") ?></h6>
                                                                </div>
                                                                <div class="d-flex">
                                                                    <div
                                                                        data-get="<?= base_url("admin/menu/{$menu->_id()}/load") ?>"
                                                                        data-action="<?= base_url("admin/menu/{$menu->_id()}/editar") ?>"
                                                                        data-title="Editar menu"
                                                                        class="openEditionModal">
                                                                        <i data-v-134867f8="" class="material-icons icon-40pt">edit</i>
                                                                    </div>
                                                                    <div data-title="¿Deseas borrar el Grupo?"
                                                                        data-body="Pulsa continuar para aceptar"
                                                                        data-post="{'redirect':'admin/menus'}"
                                                                        data-href="<?= base_url("admin/menu/{$menu->_id()}/borrar") ?>"
                                                                        class="ask-before-reload">
                                                                        <i data-v-134867f8="" class="material-icons icon-40pt">delete</i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <div class="">
                                                <hr>
                                                <div
                                                    data-get="<?= base_url("admin/menu/0/load") ?>"
                                                    data-action="<?= base_url("admin/menu/nuevo") ?>"
                                                    data-title="Insertar menu"
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


<?= view("templates/modal_edition") ?>

<script type="text/javascript">
    $(document).on("dragstart", ".draging-element", function(){
         $(this).addClass("draggin-this-item");
        console.log("start dragging");
    });
    $(document).on("dragover", ".draging-element", function(){
        $(this).addClass("draggin-over-this-item");
        console.log("start dragging");
    });
    $(document).on("dragleave", ".draging-element", function(){
        $(this).removeClass("draggin-over-this-item");
        console.log("start dragging");
    });
</script>
