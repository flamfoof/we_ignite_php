<div class="layout-px-spacing">
    <div class="card">
        <div class="card-header">
            <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                <div class="flex mb-2 mb-sm-0">
                    <h1 class="h2">Imágenes</span></h1>
                </div>
                <div id="archivo-nuevo" class="btn btn-success ml-auto">Nueva Imágen</div>
            </div>
        </div>
        <div class="card-body">
            <div id="archivo-insert-area" class="row d-none">
                <style media="screen">
                    input[type="file"] {
                        background: aliceblue;
                        width: 100%;
                        padding: 50px;
                        border: 1px #019090 dashed;
                    }
                    input[type=file]:hover{
                        background: white;
                    }
                </style>
                <div class="col-md-12">
                    <div class="list-group list-group-fit js">
                        <div class="list-group-item">
                            <div role="group" class="m-0 form-group">
                                <input id="file-to-upload" type="file" name="files[]" value=""
                                    multiple placeholder="Sube tus imagenes"
                                    data-url="<?= base_url("admin/archivo/subir") ?>"
                                    >
                            </div>
                        </div>
                    </div>
                    <div id="upload-button" class="btn btn-primary w-100">Subir</div>
                    <div id="progress_bar"><div class="percent" style="background: green; width: 0%;"></div></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 mb-2">
                    <!-- Search -->
                    <div class="search-form d-flex mb-5" method="get">
                        <input type="text" id="query" value="<?= (isset($_GET["query"])) ? $_GET["query"] : "" ?>" class="form-control search" placeholder="<?= isset($placeHolder) ? $placeHolder : "Buscar..." ?>">
                        <button id="search-form-btn" class="btn"><i class="material-icons">search</i></button>
                    </div>
                </div>
            </div>
            <div class="row results">
                <?php foreach ($fichas as $ficha): ?>
                    <?= view("admin/galeria/partes/imagenes", ["ficha" => $ficha]) ?>
                <?php endforeach; ?>
            </div>
            <div class="btn btn-primary w-100" id="more" data-page="1">
                    Cargar más
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $("#more").click(function(){
        var page = $(this).attr("data-page");
        page ++;
        $(this).attr("data-page", page);
        var query = $("#query").val();
        load(page, query, true);
    });
    $("#search-form-btn").click(function(){
        var page = 1;
        $("#more").attr("data-page", page);
        var query = $("#query").val();
        load(page, query, false);
    });

    function load(page, query, add) {
        var url = "<?= base_url("admin/archivos/mas") ?>?page="+page+"&query="+query;
        console.log(url);
        $.get(url, function(data){
            if (add) {
                $(".results").append(data);
            } else {
                $(".results").html(data);
            }
        });
    }
</script>
