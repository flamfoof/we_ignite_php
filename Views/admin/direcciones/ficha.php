<div class="p-2">
    <div class="form-row mb-1">
        <label class="col-md-3 col-form-label form-label d-flex">
            Pais
        </label>
        <div class="col-md-9">
            <div role="group" class="input-group input-group-merge">
                <select id="direccion_pais_id" class="form-control" name="ficha[direccion_pais_id]">
                </select>
            </div>
        </div>
    </div>
    <div class="form-row mb-1">
        <label class="col-md-3 col-form-label form-label d-flex">
            Provincia
        </label>
        <div class="col-md-9">
            <div role="group" class="input-group input-group-merge">
                <select id="direccion_provincia_id" class="form-control" name="ficha[direccion_provincia_id]">
                </select>
            </div>
        </div>
    </div>
    <div class="form-row mb-1">
        <label class="col-md-3 col-form-label form-label d-flex">
            Ciudad
        </label>
        <div class="col-md-9">
            <div role="group" class="input-group input-group-merge">
                <select id="direccion_ciudad_id" class="form-control" name="ficha[direccion_ciudad_id]">

                </select>
            </div>
        </div>
    </div>
    <div class="form-row mb-1">
        <label class="col-md-3 col-form-label form-label d-flex">
            Zona
        </label>
        <div class="col-md-9">
            <div role="group" class="input-group input-group-merge">
                <select id="direccion_zona_id" class="form-control" name="ficha[direccion_zona_id]">

                </select>
            </div>
        </div>
    </div>
    <div class="form-row mb-1">
        <label class="col-md-3 col-form-label form-label d-flex">
            Direccion
        </label>
        <div class="col-md-9">
            <div role="group" class="input-group input-group-merge">
                <input type="text" name="ficha[direccion_direccion]" class="form-control" value="<?= $ficha->direccion_direccion ?>">
            </div>
        </div>
    </div>
    <div class="form-row mb-1">
        <label class="col-md-3 col-form-label form-label d-flex">
            Piso
        </label>
        <div class="col-md-9">
            <div role="group" class="input-group input-group-merge">
                <input type="text" name="ficha[direccion_piso]" class="form-control" value="<?= $ficha->direccion_piso ?>">
            </div>
        </div>
    </div>
    <div class="form-row mb-1">
        <label class="col-md-3 col-form-label form-label d-flex">
            Número
        </label>
        <div class="col-md-9">
            <div role="group" class="input-group input-group-merge">
                <input type="text" name="ficha[direccion_numero]" class="form-control" value="<?= $ficha->direccion_numero ?>">
            </div>
        </div>
    </div>
    <div class="form-row mb-1">
        <label class="col-md-3 col-form-label form-label d-flex">
            CP
        </label>
        <div class="col-md-9">
            <div role="group" class="input-group input-group-merge">
                <input type="text" name="ficha[direccion_codigopostal]" class="form-control" value="<?= $ficha->direccion_codigopostal ?>">
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function findPaises() {
        var urlPais = "<?= base_url("admin/paises/options/".intval($ficha->direccion_pais_id)) ?>";
        console.log(urlPais);
        $.get(urlPais, function(data){
            $("#direccion_pais_id").html(data);
        });
    }
    function findProvincias(pais_id, provincia_id) {
        var urlProvincia = "<?= base_url("admin/provincia/options") ?>/"+pais_id+"/"+provincia_id;
        console.log(urlProvincia);
        $.get(urlProvincia, function(data){
            $("#direccion_provincia_id").html(data);
        });
    }
    function findCiudades(provincia_id, ciudad_id) {
        var urlCiudad = "<?= base_url("admin/ciudad/options") ?>/"+provincia_id+"/"+ciudad_id;
        console.log(urlCiudad);
        $.get(urlCiudad, function(data){
            $("#direccion_ciudad_id").html(data);
        });
    }
    function findZonas(ciudad_id, zona_id) {
        var urlCiudad = "<?= base_url("admin/zona/options") ?>/"+ciudad_id+"/"+zona_id;
        console.log(urlCiudad);
        $.get(urlCiudad, function(data){
            $("#direccion_zona_id").html(data);
        });
    }
    findPaises();
    $("#direccion_pais_id").on("change", function(){
        var pais_id = $(this).val();
        findProvincias(pais_id, '<?= intval($ficha->direccion_provincia_id) ?>');
    });
    $("#direccion_provincia_id").on("change", function(){
        var provincia_id = $(this).val();
        findCiudades(provincia_id, '<?= intval($ficha->direccion_ciudad_id) ?>');
    });
    $("#direccion_ciudad_id").on("change", function(){
        var ciudad_id = $(this).val()
        findZonas(ciudad_id, '<?= intval($ficha->direccion_zona_id) ?>');
    });
    <?php if($ficha->direccion_provincia_id > 0): ?>
        findProvincias('<?= $ficha->direccion_ciudad_id ?>', '<?= $ficha->direccion_provincia_id ?>');
    <?php endif; ?>
    <?php if($ficha->direccion_ciudad_id > 0): ?>
        findCiudades('<?= $ficha->direccion_provincia_id ?>', '<?= $ficha->direccion_ciudad_id ?>');
    <?php endif; ?>
    <?php if($ficha->direccion_zona_id > 0): ?>
        findZonas('<?= $ficha->direccion_ciudad_id ?>', '<?= $ficha->direccion_zona_id ?>');
    <?php endif; ?>
</script>
