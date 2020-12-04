<script type="text/javascript">
    var itemSelected = "";
    $(".so-editor").click(function(){
        $(this).toggleClass("open");
    });
    $(document).on("click", ".editlement", function(e){
        clearAll();
        console.log("click on element");
        e.stopPropagation();
        $(this).toggleClass("editlement-selected");
        if ($(this).hasClass("editlement-selected")) {
            itemSelected = $(this);
        } else {
            itemSelected = null;
        }
    });
    $(document).on("dblclick", ".editlement", function(e){
        console.log("show modalEdit");
        if ($(this).hasClass("input")) {
            $("#modalEditBody").html('<input id="editor" class="form-control" value=""/>');
            $("#editor").val($(this).html())
        } else {
            $("#modalEditBody").html('<div id="editor" style="height: 40vh;"></div>');
            quill = new Quill('#editor', {
                theme: 'snow'
            });
            $("#editor .ql-editor").html($(this).html());
        }
        $('#modalEdit').modal('show');
        itemSelected = $(this);
        e.stopPropagation();
    });
    $(document).on("dblclick", ".editlement-image", function(e){
        console.log("show modalImage");
        $('#modalPickImage').modal('show');
        $('#image-selected').html($(this).attr("src"));
        itemSelected = $(this);
        e.stopPropagation();
    });
    $(document).on("click", ".image-selectable", function(){
        $(".image-selectable").each(function(){
            $(this).removeClass("selected");
        });
        $(this).addClass("selected");
        $("#image-selected").html($(this).attr("src"));
    });
    $(document).on("click", "#edit_page", function(){
        var text = "";
        if ($(itemSelected).hasClass("input")) {
            text = $("#editor").val();
        } else {
            text = $("#editor .ql-editor").html();
        }
        var curItem = $(".editlement-selected");
        $(".editlement-selected").removeClass("editlement-selected");
        var prevContent = $(curItem)[0].outerHTML;
        $(curItem).html(text);
        var content =  $(curItem)[0].outerHTML;
        var url = "<?= base_url("admin/pagina/{$pagina->_id()}/guardar/content") ?>";
        console.log(url);
        console.log("prevContent", prevContent);
        console.log("content", content);
        $.post(url, {
            content: content,
            prevContent:prevContent,
        },function(data){
            //location.reload();
            $('#modalEdit').modal('toggle');
        });
    });
    $(document).on("click", "#image_page", function(){
        var img = $("#image-selected").html();
        $(itemSelected).attr("src", img);
        $('#modalPickImage').modal('toggle');
    });
    $("#my-content").click(function(){
        clearAll();
        itemSelected = $("#my-content");
    });
    $("#guardar").click(function(e){
        e.stopPropagation();
        var url = "<?= base_url("admin/pagina/{$pagina->_id()}/guardar/content") ?>";
        var content = $("#my-content").html();
        console.log("guardando", url);
        $.post(url, {
            content: content
        },function(data){
            alert(data);
        });
    });
    //------------------------------------------------------------------------
    function clearAll() {
        $(".editlement-selected").each(function(){
            $(this).removeClass("editlement-selected");
        });
    }

    var quill = new Quill('#editor', {
        theme: 'snow'
    });

</script>
