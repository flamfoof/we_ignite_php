<script type="text/javascript">
    var type = "formato";
    $(function(){
        $("#agregarFormato").click(function(){
            var formatos = new Array();
            $("#ajax_selected .ajax_selected").each(function(){
                formatos_valor = $(this).attr("data-value");
                if (formatos_valor > 0) {
                    formatos.push(formatos_valor);
                }
            });
            var ajaxFormato = "<?= base_url("admin/producto/{$ficha->_id()}/formatos/nuevos") ?>";
            var formatoJSON = JSON.stringify(formatos);
            console.log(formatoJSON);
            $.post(ajaxFormato, {
                formatos:formatoJSON,
                type:type
            },function(data){
                location.reload();
            });
        });
        $(document).on('click', '.ajax_selectme', function() {
            console.log("ajax clicked");
            var value = $(this).attr("data-value");
            $("#ajax_selected .ajax_selected").each(function(){
                if (
                    ($(this).attr("data-value") == value) &&
                    ($(this).attr("data-value") != 0)
                ) {
                    $(this).remove();
                }
            });
            var newElement = $(this).clone();
            $(newElement).removeClass("ajax_selectme");
            $(newElement).addClass("ajax_selected");
            $(newElement).appendTo( "#ajax_selected" );
            checkBoton();
        });
        $(document).on('click', '.ajax_selected', function() {
            $(this).remove();
            checkBoton();
        });
        $("#ajax_formato").on("input", function(){
            console.log(type);
            var myInput = $(this).val();
            var url = "<?= base_url("admin/producto/ajax/filter/formato") ?>";
            if (type == "atributo") {
                url = "<?= base_url("admin/producto/ajax/filter/atributo") ?>";
            }
            console.log(url);
            $.post(url, {valor:myInput},function(data){
                $("#ajax_result").html("");
                $("#ajax_result").append(data);
            });
            checkBoton();
        });
        //--------------------------------------------------------------------------
        $("#ajax_producto").on("input", function(){
            var myInput = $(this).val();
            $.post("<?= base_url("admin/producto/ajax/filter/producto/{$ficha->_id()}") ?>", {valor:myInput},function(data){
                console.log("result",data);
                $("#ajax_result_producto").html("");
                $("#ajax_result_producto").append(data);
            });
            checkBotonProducto();
        });
        $(document).on('click', '.producto_selectme', function() {
            console.log("ajax clicked");
            var value = $(this).attr("data-value");
            $("#ajax_selected_producto .ajax_selected_producto").each(function(){
                if (
                    ($(this).attr("data-value") == value) &&
                    ($(this).attr("data-value") != 0)
                ) {
                    $(this).remove();
                }
            });
            var newElement = $(this).clone();
            $(newElement).removeClass("producto_selectme");
            $(newElement).addClass("ajax_selected_producto");
            $(newElement).appendTo( "#ajax_selected_producto" );
            checkBotonProducto();
        });
        function checkBotonProducto(){
            if ($("#ajax_selected_producto > div").length > 0) {
                $("#agregar-block-producto").removeClass("d-none");
            } else {
                $("#agregar-block-producto").addClass("d-none");
            }
        }
        $("#agregarProducto").click(function(){
            var productos = new Array();
            $("#ajax_selected_producto .ajax_selected_producto").each(function(){
                var producto_valor = $(this).attr("data-value");
                if (producto_valor > 0) {
                    productos.push(producto_valor);
                }
            });
            var ajaxProducto = "<?= base_url("admin/producto/{$ficha->_id()}/productos/nuevos") ?>";
            var productoJSON = JSON.stringify(productos);
            console.log(productoJSON);
            $.post(ajaxProducto, {
                productos:productoJSON
            },function(data){
                location.reload();
            });
        });
        //--------------------------------------------------------------------------
        $("#ajax_familia").on("input", function(){
            var myInput = $(this).val();
            var url = "<?= base_url("admin/producto/ajax/filter/familia") ?>";
            console.log(url);
            $.post(url, {valor:myInput},function(data){
                console.log(data);
                $("#ajax_familia_result li").each(function(){
                    $(this).remove();
                });
                $("#ajax_familia_result").append(data);
            });
            checkBoton();
        });
        function checkBoton(){
            if ($("#ajax_selected > div").length > 0) {
                $("#agregar-block").removeClass("d-none");
            } else {
                $("#agregar-block").addClass("d-none");
            }
        }
        /**************************************/
    });
    //-----------------------------------------------------------------------------
    $(document).on("click", ".groupable", function(){
        console.log("click on groupable");
        $(this).find(".value").addClass("d-none");
        $(this).find(".editable").removeClass("d-none");
    });
    $(document).on("change", ".editable-cell", function(){
        var valueElement = $(this).parent().prev();
        $(valueElement).removeClass("d-none");
        $(this).parent().addClass("d-none");
        var url = "<?= site_url("admin/producto/{$ficha->_id()}/") ?>"+$(this).attr("data-cell")+"/"+$(this).attr("data-id");
        console.log(url);
        $.post(url, {value:$(this).val()}, function(data){
            console.log(data);
            loadFormatos();
        });
    });
    $(".open-modal-all").click(function(){
        $('#modalFormatos').appendTo("body").modal('show');
        $('#modalFormatosTitle').html("Editar todos los formatos");
        $("#btn-aceptar").attr("data-aceptar", "todos");
    });
    $(".open-modal").click(function(){
        $('#modalFormatos').appendTo("body").modal('show');
        $('#modalFormatosTitle').html("Editar formatos seleccionados");
        $("#btn-aceptar").attr("data-aceptar", "seleccionados");
    });
    $(document).on("click", "#btn-aceptar", function(){
        console.log("btn-aceptar");
        $("#modalFormatos").modal('toggle');
        if ($(this).attr("data-aceptar") == "todos") {
            var url = "<?= base_url("admin/producto/{$ficha->_id()}/formatos/editar/todos") ?>";
            $.post(url, {
                precio:$("#modal_precio").val(),
                oferta:$("#modal_oferta").val(),
                costo:$("#modal_costo").val(),
                producto:$("#modal_producto").val(),
            }, function(data){
                console.log(data);
                loadFormatos();
            });
        } else {
            var formatos = new Array();
            $('.fci-formatos:checkbox:checked').each(function(){
                formatos.push($(this).attr("data-id"));
            });
            var formatoJSON = JSON.stringify(formatos);
            var url = "<?= base_url("admin/producto/{$ficha->_id()}/formatos/editar/seleccionados") ?>";
            console.log($("#modal_precio").val());
            console.log(url);
            $.post(url, {
                precio:$("#modal_precio").val(),
                oferta:$("#modal_oferta").val(),
                costo:$("#modal_costo").val(),
                formatos:formatoJSON,
                producto:$("#modal_producto").val(),
            }, function(data){
                console.log(data);
                loadFormatos();
            });
        }

    });
    function loadFormatos() {
        var url = "<?= base_url("admin/producto/{$ficha->_id()}/ajax/combinaciones") ?>";
        console.log(url);
        $.get(url, function(data){
            $("#formatosLoaded").html(data);
        });
    }
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".dropdown-menu li").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $(".color_select").click(function(){
        var id = $(this).attr("data-id");
        var value = $(this).html();
        $("#color_nombre").html(value);
        $("#color_input").val(id);
    });
    $(document).on("click", "tag span", function(){
        $(this).parent().remove();
        readTags();
    });
    $("#producto_familiatag").on("input", function(){
        var value = $(this).val();
        var text = "";
        if (value.indexOf(',') !== -1){
            text = value.replace(',', '');
            $("#tags").append("<tag><txt>"+text+"</txt><span>x</span></tag>");
            $(this).val("");
            readTags();
        }
    });
    function readTags() {
        var familiaTag = [];
        $("#producto_familiatag_real").val("");
        $("#tags tag txt").each(function(){
            familiaTag.push($(this).html());
        });
        $("#producto_familiatag_real").val(familiaTag.join(", "));
    }

    $(document).on("click", ".type", function(){
        type = $(this).attr("data-value");
        console.log("click type", type);
        $(".type.bg-dark").each(function(){
            $(this).removeClass("bg-dark");
        });
        $(this).addClass("bg-dark");
        if (type == "formato") {
            $("#type-label").html("Formatos <br><small>(escribe el formato de tu producto)</small>");
            $("#ajax_formato").attr("placeholder", "Mi formato...");
        } else {
            $("#type-label").html("Atributos <br><small>(escribe el atributo de tu producto)</small>");
            $("#ajax_formato").attr("placeholder", "Mi atributo...");
        }
    });

    $(document).on("click", ".add-producto-btn", function(e){
        e.preventDefault();
        if ($("#producto-form").valid()) {
            console.log("form is valid");
            return true;
        } else {
            console.log("form NOT VALID");
            return false;
        }
    });
</script>
