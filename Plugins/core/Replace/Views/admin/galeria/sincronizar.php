<div class="layout-px-spacing">
    <div class="row">
        <div class="col-12 mt-5">
            <divclass="card">
                <div class="card-header">
                    <h2>Proceso de Importación</h2>
                </div>
                <div class="card-body">
                    <div class="form-row mb-1">
                        <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                            Posicion acutal
                        </label>
                        <div class="col-md-9">
                            <input id="posicion" class="form-control" type="text" name="" value="0">
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                            Total de registros
                        </label>
                        <div  class="col-md-9">
                            <input id="registros" class="form-control" type="text" name="" value="<?= count($data) ?>">
                        </div>
                    </div>
                    <div class="">
                        <div class="progress rounded-0">
                            <div id="myprogress" class="progress-bar progress-bar-striped bg-primary"
                                role="progressbar"
                                style="width: 0%"
                                aria-valuenow="0"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div id="result">

                    </div>
                </div>
                <div class="card-footer">
                    <button id="empezar" class="btn btn-primary">Empezar</button>
                    <button class="btn btn-danger">Detener</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#empezar").click(function(){
        procesoRecursivo();
        posicionActual = $("#posicion").val();
        posicionActual = parseInt(posicionActual);
        registros = $("#registros").val();
        registros = parseInt(registros);
    });
    var posicionActual = $("#posicion").val();
    posicionActual = parseInt(posicionActual);
    var cantidad = 1;
    var registros = $("#registros").val();
    registros = parseInt(registros);
    var url = "<?= base_url($url) ?>";
    function procesoRecursivo() {
        console.log(url, posicionActual, registros);
        if (posicionActual < registros) {
            $.post(url,{
                posicionActual:posicionActual,
                cantidad:cantidad
            }, function(data){
                posicionActual ++;
                $("#posicion").val(posicionActual);
                $("#result").html(data);

                perc = (posicionActual/registros) * 100;
                $("#myprogress").attr("aria-valuenow", perc);
                $("#myprogress").css("width", perc+"%");

                procesoRecursivo();
            });
        }
    }
</script>
