<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<form method="post" enctype="multipart/form-data" class="layout-px-spacing">
    <div class="row m-0">
        <div class="col-12">
            <h1 class="h2">Ficha de vídeo</h1>
        </div>
        <div class="col-md-6 container-fluid page__container">
            <div class="card">
                <div class="list-group-item">
                    <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                        <?php if ($ficha->_id() > 0): ?>
                            <div class="form-row mb-1">
                                <div class="col-md-12 bg-dark">
                                    <div class="text-center p-1" style="color: white;">
                                        Video
                                    </div>
                                    <?php if ($ficha->_get("ext") == "pdf"): ?>
                                        <iframe src="<?= $ficha->getHRef() ?>" width="100%" style="height: 30vh;"></iframe>
                                    <?php else: ?>
                                        <video width="100%" style="height: 30vh;" controls>
                                          <source src="<?= $ficha->getHRef() ?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-row mb-1">
                                <div class="col-md-12">
                                    <div role="group" class="input-group input-group-merge">
                                        <input name="video" accept="video/*|application/pdf" id="file-to-upload" type="file" class="form-control" aria-describedby="description-profilename">
                                    </div>
                                    <div id="upload-button" class="btn btn-primary w-100">Subir</div>
                                    <div id="progress_bar"><div class="percent">0%</div></div>
                                </div>
                            </div>
                        <?php else: ?>
                            *Antes de subir un Video/PDF debes guardar
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 container-fluid page__container">
            <div class="card">
                <div class="list-group list-group-fit">
                    <div class="list-group-item">
                        <div class="form-row mb-1">
                            <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                Nombre
                            </label>
                            <div class="col-md-9">
                                <div role="group" class="input-group input-group-merge">
                                    <input type="text" class="form-control" value="<?= $ficha->_get("nombre") ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                Nombre Original
                            </label>
                            <div class="col-md-9">
                                <div role="group" class="input-group input-group-merge">
                                    <input type="text" class="form-control" value="<?= $ficha->_get("nombreoriginal") ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                Path
                            </label>
                            <div class="col-md-9">
                                <div role="group" class="input-group input-group-merge">
                                    <input type="text" class="form-control" value="<?= $ficha->_get("path") ?>" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-1">
                            <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                                ALT
                            </label>
                            <div class="col-md-9">
                                <div role="group" class="input-group input-group-merge">
                                    <input type="text" class="form-control" name="ficha[archivo_alt]" value="<?= $ficha->_get("alt") ?>" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success">Guardar</button>
                    <a href="<?= base_url("admin/galeria/imagenes") ?>" class="btn btn-danger">Regresar</a>
                    <?php if ($ficha->_id() > 0): ?>
                        <a href="<?= base_url("admin/galeria/imagen/nueva") ?>" class="btn btn-primary">Nuevo</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</form>
<script src="<?= base_url("assets_admin/assets/js/uploadMultiImage.js") ?>" ></script>
<?= view("templates/tab_js",[]) ?>
<script>
    var reader = new FileReader();
    var progress = document.querySelector('.percent');
    var file;
    var start = 0;
    var end;
    var chunk = 100000;
    var prog = start + chunk;

    $("#upload-button").on('click', function() {
        file = $("#file-to-upload").get(0).files[0];
        end = file.size;

        progress.style.width = '0%';
        progress.textContent = '0%';
        // validate type of file
        if(['video/mp4', 'video/mov'].indexOf($("#file-to-upload").get(0).files[0].type) == -1) {
            alert('Error : Formato incorrecto');
            return;
        }

        reader.onloadstart = function(e) {
          document.getElementById('progress_bar').className = 'loading';
        };
        reader.onload = function(){
            var $data = { 'title': getFileName(), 'file': reader.result, 'start':start };
            $.ajax({
                type: 'POST',
                url: '<?= base_url("admin/galeria/video/{$ficha->_id()}/subir") ?>',
                data: $data,
                success: function(response) {
                    console.log("success", response);
                    var percentLoaded = Math.round((start / end) * 100);
                    // Increase the progress bar length.
                    if (percentLoaded <= 100) {
                      progress.style.width = percentLoaded + '%';
                      progress.textContent = percentLoaded + '%';
                    }
                    //location.reload();
                    start = start + chunk;
                    prog = prog + chunk;
                    if (start < end) {
                        readFile();
                    } else {
                        progress.style.width = '100%';
                        progress.textContent = '100%';
                        window.location.href = "<?= base_url("admin/galeria/video/{$ficha->_id()}/editar") ?>";
                    }
                },
                error: function(response) {

                },
            });
        };
        readFile();
    });

    function readFile() {
        if (prog > end) {
            prog = end;
        }
        console.log("uploading piece ("+ start+"-"+prog+") < "+ end);
        var blob = file.slice(start, prog);
        reader.readAsDataURL(blob);
    }

    function getFileName() {
        var fullPath = document.getElementById('file-to-upload').value;
        if (fullPath) {
            var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
            var filename = fullPath.substring(startIndex);
            if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                filename = filename.substring(1);
            }
            return filename;
        }
    }
</script>
