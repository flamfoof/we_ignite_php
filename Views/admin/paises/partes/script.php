<script type="text/javascript">
    $(".open-modal").click(function(){
        console.log("editar grupo");
        $('#modalEdit').appendTo("body").modal('show');
        $('#modalEditTitle').html("Editar Paises seleccionados");
        $("#btn-aceptar").attr("data-aceptar", "seleccionados");
        $("#btn-aceptar").html("Guarda Grupo");
    });
    $(".open-modal-all").click(function(){
        console.log("editar TODOS");
        $('#modalEdit').appendTo("body").modal('show');
        $('#modalEditTitle').html("Editar todos los Paises");
        $("#btn-aceptar").attr("data-aceptar", "todos");
        $("#btn-aceptar").html("Guarda Todos");
    });
    $(document).on("click", "#btn-aceptar", function(){
        $("#modalEdit").modal('toggle');
        var metodo = $("#modal_metodoenvio").val();
        var estado = $("#modal_estados").val();
        var grupopago = $("#modal_grupopagos").val();
        var grupoenvio = $("#modal_grupoenvio").val();

        if ($(this).attr("data-aceptar") == "todos") {
            console.log("estado = "+estado);
            var url = "<?= base_url("admin/paises/editar/todos") ?>";
            console.log(url);
            $.post(url, {
                metodo:metodo,
                estado:estado,
                grupopago:grupopago,
                grupoenvio:grupoenvio,
            }, function(data){
                console.log(data);
                location.reload();
            });
        } else {
            var formatos = new Array();
            $('.select-input:checkbox:checked').each(function(){
                formatos.push($(this).attr("data-id"));
            });
            var formatoJSON = JSON.stringify(formatos);
            var url = "<?= base_url("admin/paises/editar/seleccionados") ?>";
            console.log(url);
            $.post(url, {
                metodo:metodo,
                estado:estado,
                grupopago:grupopago,
                grupoenvio:grupoenvio,
                formatos:formatoJSON
            }, function(data){
                console.log(data);
                location.reload();
            });
        }

    });
</script>
