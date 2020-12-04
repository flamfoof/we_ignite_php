<?php

$formatoModel = new App\Models\FormatoModel();
$familiaModel = new App\Models\FamiliaModel();
$marcaModel = new App\Models\MarcaModel();
$coleccionModel = new App\Models\ColeccionModel();

$_producto = $_combinacion->getProducto();

$formatos = $formatoModel
    ->where("formato_estado", 1)
    ->findAll();
$familias = $familiaModel
    ->join("familialang", "familialang_familia_id = familia_id")
    ->where("familia_familia_id", 0)
    ->where("familia_estado", 1)
    ->orderBy("familialang_nombre", "ASC")
    ->findAll();
$marcas = $marcaModel
    ->where("marca_estado >", 0)
    ->findAll();
$colecciones = $coleccionModel
    ->where("coleccion_estado", 1)
    ->findAll();
?>
<div class="form-row mb-1">
    <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
        EAN
    </label>
    <div class="col-md-9">
        <input id="modal_ean" name="fichaCombinacion[combinacion_ean]" value="<?= isset($setEan) ? $_combinacion->_get("ean") : "" ?>" type="text" class="form-control"/>
    </div>
</div>
<div class="form-row mb-1">
    <label id="label-profilename"  for="profilename" class="col-md-3 col-form-label form-label">
        SKU
    </label>
    <div class="col-md-9">
        <input id="modal_skubase" name="ficha[producto_skubase]" value="<?= $_producto->_get("skubase") ?>" type="text" class="form-control" required/>
    </div>
</div>

<div class="form-row mb-1">
    <label id="label-profilename"  for="profilename" class="col-md-3 col-form-label form-label">
        SKU detalle
    </label>
    <div class="col-md-9">
        <input id="modal_skubase" name="ficha[producto_skudetalle]" value="<?= $_producto->_get("skudetalle") ?>" type="text" class="form-control" required/>
    </div>
</div>
<div id="grupo-skubase" class="mb-1 d-none text-center my-2">
    <p>Hemos encontrado las siguientes combinaciones para este SKU</p>
    <div id="grupo-skubase-result">

    </div>
</div>
<div id="grupo-nombre" class="form-row mb-1">
    <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
        Nombre
    </label>
    <div class="col-md-9">
        <input id="modal_nombreproducto" name="ficha[producto_nombreinterno]"  value="<?= $_producto->_get("nombreinterno") ?>" type="text" class="form-control"/>
    </div>
</div>
<div class="form-row mb-1">
    <label id="label-profilename"  for="profilename" class="col-md-3 col-form-label form-label">
        Color
    </label>
    <div class="col-md-9">
        <select class="form-control" name="ficha[producto_color_id]">
            <option value="0">-- SIN COLOR --</option>
            <?php $colorModel = new \App\Models\ColorModel(); ?>
            <?php $colores = $colorModel->where("color_estado", 1)->findAll(); ?>
            <?php foreach ($colores as $color): ?>
                <option
                    <?= ($color->_id() == $_producto->_get("color_id")) ? "selected" : "" ?>
                    value="<?= $color->_id() ?>"><?= $color->_get("nombre") ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="form-row mb-1">
    <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
        Costo
    </label>
    <div class="col-md-9">
        <input id="modal_costo" value="<?= $_combinacion->_get("costo") ?>" name="fichaCombinacion[combinacion_costo]" type="number" min="0" step="0.01" class="form-control"/>
    </div>
</div>
<div class="form-row mb-1">
    <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
        Precio
    </label>
    <div class="col-md-9">
        <input id="modal_precioproducto" value="<?= $_combinacion->_get("precio") ?>" name="fichaCombinacion[combinacion_precio]" type="number" min="0" step="0.01" class="form-control" required/>
    </div>
</div>
<div class="form-row mb-1">
    <label class="col-md-3 col-form-label form-label">Formato</label>
    <div class="col-md-9">
        <select class="form-control" id="modal_formato" name="fichaCombinacion[formato]" required>
            <option value="0">--SELECCIONA UN FORMATO--</option>
            <?php if ($formatos != null): ?>
                <?php foreach ($formatos as $formato): ?>
                    <option value="<?= $formato->_id() ?>" <?= ($_producto->getFormato()->_id() == $formato->_id()) ? "selected" : "" ?>>
                        <?= $formato->_get("nombre") ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select>
    </div>
</div>
<style media="screen">
    #atributo_nombre_edit,
    #atributo_nombre_insert{
        display: flex;
        overflow-x: auto;

    }
    #atributo_nombre_edit div,
    #atributo_nombre_insert div{
        border: 1px white solid;
        padding: 3px !important;
        border-radius: 2px;
        margin-right: 5px;
        margin-top: -0;
    }
    #atributo_nombre_edit div span,
    #atributo_nombre_insert div span{
        color: white;
    }
</style>
<div class="form-row mb-3">
    <label class="col-md-3 col-form-label form-label">
        Atributos
    </label>
    <div class="col-md-9">
        <div class="dropdown w-100">
            <input class="" id="atributo_input" type="hidden" name="fichaCombinacion[atributos]" value="<?= $_combinacion->getAtributosCSV() ?>">
            <button class="form-control dropdown-toggle d-flex" type="button" data-toggle="dropdown" style="padding: 5px;">
                <span class="caret"></span>
            </button>
            <div id="atributo_nombre_<?= isset($setEan) ? "edit" : "insert" ?>" class="atributo_group" style="margin-top: -38px; margin-left: 10px; max-width: 100%; overflow-x: auto; width: fit-content;">
                <?php foreach ($_combinacion->getAtributos() as $atributo): ?>
                    <div class="<?= isset($setEan) ? "edit" : "insert" ?>_attr_item" data-id="<?= $atributo->_id() ?>">
                        <?= $atributo->_get("nombre") ?>
                        <span>x</span>
                    </div>
                <?php endforeach; ?>
            </div>
            <ul id="modal_atributos" class="dropdown-menu w-100">
                <li>
                    <div data-id="0" class="atributo_select d-block w-100 p-2 border selected-item">
                        NO HA CARGADO NADA
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mb-1 form-row">
    <label class="col-md-3 col-form-label form-label">Familia</label>
    <div class="col-md-9">
        <select class="form-control" id="modal_familia" name="ficha[producto_subfamilia_id]" required>
            <option value="">--SELECCIONA UNA FAMILIA--</option>
            <?php foreach ($familias as $familia): ?>
                <option class="" value="<?= $familia->_id() ?>" <?= ($_producto->getSubFamilia()->_id() == $familia->_id()) ? "selected" : "" ?> disabled>
                    <?= $familia->getFamiliaLang()->_get("nombre") ?>
                </option>
                <?= $familia->printOptionsChildren($_producto, $familia->getSubFamilias(), "--") ?>

            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="mb-1 form-row">
    <label class="col-md-3 col-form-label form-label">Marca</label>
    <div class="col-md-9">
        <?php if ($_producto->getMarca()->_id() > 0): ?>
            <div class="border rounded p-2">
                <?= $_producto->getMarca()->_get("nombre") ?>
            </div>
            <input type="hidden" id="modal_marca" name="ficha[producto_marca]" value="<?= $_producto->getMarca()->_id() ?>">
        <?php else: ?>
            <select class="form-control" id="modal_marca" name="ficha[producto_marca]" required>
                <option value="">--SELECCIONA UNA MARCA--</option>
                <?php foreach ($marcas as $marca): ?>
                    <option value="<?= $marca->_id() ?>" <?= ($_producto->getMarca()->_id() == $marca->_id()) ? "selected" : "" ?>>
                        <?= $marca->_get("nombre") ?>
                    </option>
                <?php endforeach; ?>
            </select>
        <?php endif; ?>
    </div>
</div>
<?php if (empty($colecciones)): ?>
    <input id="modal_coleccion" type="hidden" name="" value="0">
<?php else: ?>
    <?php $coleccionModel = new App\Models\ColeccionModel() ?>
    <?php $colecciones = $coleccionModel->distinctPadre() ?>
    <?php foreach ($colecciones as $coleccion): ?>
        <div class="form-row mb-1">
            <label id="type-label" class="col-md-3 col-form-label form-label">
                <?= $coleccion->_get("padre") ?>
            </label>
            <?php $pColeccion  = $_producto->getColeccionByPadre($coleccion->_get("padre")); ?>
            <?php $_coleccion = $pColeccion->getColeccion() ?>
            <div class="col-md-9">
                <div role="group" class="input-group input-group-merge">
                    <select class="form-control" name="fichaColeccion[]">
                        <?php $colecciones = $coleccionModel->getByPadre($coleccion->_get("padre")) ?>
                        <?php foreach ($colecciones as $coleccion): ?>
                            <?php $productoColeccion = $_producto->getProductoColeccion($coleccion->_id()); ?>
                            <option value="<?= $coleccion->_id() ?>" <?= ($coleccion->_id() == $productoColeccion->_get("coleccion_id")) ? "selected" : "" ?>>
                                <?= $coleccion->_get("nombre") ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<script type="text/javascript">
    $(document).on("change", "#modal_skubase", function(){
        buscarCombinacion(this);
    });

    function buscarCombinacion(object) {
        var skubase = $(object).val();
        var url = "<?= base_url("admin/producto/buscar") ?>/"+skubase;
        console.log(url);
        $.get(url, function(data){
            console.log(data);
            var Json = JSON.parse(data);
            if (Json.result == "notFound") {
                console.log("notFound");
                $("#grupo-skubase").addClass("d-none");
                $("#grupo-nombre").removeClass("d-none");
                $("#modal_familia").prop("required", false);
                $("#modal_familia").prop("readonly", true);
                $("#modal_marca").prop("required", false);
                $("#modal_marca").prop("readonly", true);
            } else {
                console.log("found");
                $("#grupo-skubase").removeClass("d-none");
                $("#grupo-nombre").addClass("d-none");
                $("#grupo-skubase-result").html(Json.html);
                $("#modal_familia").prop("required", true);
                $("#modal_familia").prop("readonly", false);
                $("#modal_marca").prop("required", true);
                $("#modal_marca").prop("readonly", false);
            }
            buscarFormato();
        });
    }

    $(document).on("change", "#modal_formato", function(){
        buscarFormato();
    });
    function buscarFormato() {
        var editingMode = "<?= isset($setEan) ? "edit" : "insert" ?>";
        console.log("buscando formato");
        var url = "<?= base_url("admin/producto/atributos/formato") ?>/"+$("<?= isset($setEan) ? "#modalEditarProducto " : "" ?>#modal_formato").val();
        var type = $("#modal_atributos").attr("data-type");
        console.log(url, editingMode, $("#modal_skubase").val());
        $.post(url, {
            sku:$("#modal_skubase").val(),
            editingMode:editingMode
        },function(data){
            var result = JSON.parse(data);
            console.log(result);
            $("#modal_atributos").html(result.html);
        });
    }
    buscarFormato();
    $(document).on("click", ".<?= isset($setEan) ? "edit" : "insert" ?>_attr_item", function(e){
        console.log("removing div");
        var id = $(this).attr("data-id");
        $(this).remove();
        var values = $("<?= isset($setEan) ? "#modalEditarProducto " : "" ?>#atributo_input").val();
        console.log("VALUES1 =", values);
        values = values.replace(id+",", "");
        values = values.replace(","+id, "");
        values = values.replace(id, "");
        $("<?= isset($setEan) ? "#modalEditarProducto " : "" ?>#atributo_input").val(values);
        console.log("VALUES =", values);
        e.preventDefault();
        e.stopPropagation();
    });
    $(document).on("click", ".<?= isset($setEan) ? "edit" : "insert" ?>_atributo_select", function(e){
        var id = $(this).attr("data-id");
        var name = $(this).html();
        console.log("EDIT clicking on atribute", id);
        var html = '<div class="<?= isset($setEan) ? "edit" : "insert" ?>_attr_item" data-id="'+id+'">'+name+'<span>x</span></div>';
        var item = "#atributo_nombre_<?= isset($setEan) ? "edit" : "insert" ?>";
        $(item).append(html);
        var prev = $("<?= isset($setEan) ? "#modalEditarProducto " : "" ?>#atributo_input").val();
        if (prev == "") {
            $("<?= isset($setEan) ? "#modalEditarProducto " : "" ?>#atributo_input").val(id);
        } else {
            $("<?= isset($setEan) ? "#modalEditarProducto " : "" ?>#atributo_input").val(prev+","+id);
        }
        console.log($("<?= isset($setEan) ? "#modalEditarProducto " : "" ?>#atributo_input").val());
    });
</script>
