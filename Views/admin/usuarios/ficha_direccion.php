<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" class="layout-px-spacing">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">Ficha de Direccion</h1>
            <div class="card">
                <div class="card-body">
                    <div class="list-group list-group-fit">
                        <div class="list-group-item">
                            <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                <div class="form-row mb-1">
                                    <label class="col-md-3">Pais</label>
                                    <div class="col-md-9">
                                        <div class="dropdown w-100">
                                            <input class="item_input" type="hidden" name="ficha[direccion_pais_id]" value="<?= $ficha->_get("pais_id") ?>">
                                            <button class="form-control dropdown-toggle d-flex" type="button" data-toggle="dropdown">
                                                <span class="w-100 text-left item_nombre">
                                                    <?php if ($ficha->_get("pais_id") > 0): ?>
                                                        <?= $ficha->getPais()->_get("nombre") ?>
                                                    <?php else: ?>
                                                        Selecciona un país
                                                    <?php endif; ?>
                                                </span>
                                                <span class="caret"></span>
                                            </button>
                                            <ul id="menu-pais" class="dropdown-menu w-100">
                                                <input class="form-control myInput" type="text" placeholder="Search..">
                                                <?php foreach ($paises as $pais): ?>
                                                    <li>
                                                        <div data-id="<?= $pais->_id() ?>" class="item_select d-block w-100 bg-light p-2 border">
                                                            <?= $pais->_get("nombre") ?>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mb-1 setProvincia">
                                    <?= view("admin/usuarios/partes/provincias", ["provincias" => $ficha->getPais()->getProvincias(), "direccion" => $ficha]) ?>
                                </div>
                                <?= $ficha->loadHTML(["ciudad_texto", "codigopostal"]) ?>
                                <hr>
                                <?= $ficha->loadHTML(["via", "direccion", "numero", "piso" ]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success">Guardar</button>
                    <a href="<?= base_url("admin/usuario/{$usuario->_id()}/editar") ?>" class="btn btn-danger">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?= base_url("assets_admin/assets/js/uploadMultiImage.js") ?>" ></script>
<?= view("templates/tab_js",[]) ?>
<script type="text/javascript">
    $(document).on("click", ".item_select", function(){
        console.log("item clicked");
        var id = $(this).attr("data-id");
        var value = $(this).html();
        var parent = $(this).parent().parent().parent();
        $(parent).find(".item_nombre").html(value);
        $(parent).find(".item_input").val(id);
        console.log(parent);
        loadProvincias(id);
    });
    $(".myInput").on("input", function() {
        var myInput = $(this).val();
        var url = "<?= base_url("es/ajax/direcciones/filter/pais") ?>";
        console.log(url);
        $.post(url, {valor:myInput},function(data){
            $("#menu-pais li").each(function(){
                $(this).remove();
            });
            $("#menu-pais").append(data);
        });
    });
    function loadProvincias(pais){
        var url = "<?= base_url("es/micuenta/direccion/{$ficha->_id()}/pais/") ?>"+pais+"/provincias";
        console.log(url);
        $.get(url,function(data){
            $(".setProvincia").html(data);
        });
    }
    <?php if ($ficha->_get("pais_id") > 0): ?>
        loadProvincias(<?= $ficha->_get("pais_id") ?>);
    <?php endif; ?>
</script>
