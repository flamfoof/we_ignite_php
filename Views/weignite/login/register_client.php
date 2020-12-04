<?= view("weignite/login/partes/head", ["mensaje" => $mensaje]) ?>
    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wraps">
                <div class="form-container">
                    <div class="form-content">

                        <h1 class="text-center mt-4">Log In <a href="<?= base_url() ?>"><span class="brand-name"><?= $name ?></span></a></h1>
                        <form method="post" class="text-left" enctype="multipart/form-data">
                            <div class="form">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="banner-container">
                                            <img src="<?= base_url("assets/images/launch.svg") ?>" id="img-image" class="img-fluid" />
                                            <input type="file" name="file" class="form-control special-file d-none"
                                                required
                                                id="input-image" accept="image/*" />
                                        </div>
                                        <div class="text-center">
                                            <small>Click on the image to upload yours</small>
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="input mb-1">
                                            <input id="username" name="ficha[usuario_nombre]" type="text" class="form-control" placeholder="First name">
                                        </div>

                                        <div class="input mb-1">
                                            <input id="username" name="ficha[usuario_apellidos]" type="text" class="form-control" placeholder="Last name">
                                        </div>

                                        <div class="input mb-1">
                                            <input id="username" name="ficha[usuario_email]" type="text" class="form-control" placeholder="Email">
                                        </div>

                                        <div class="input mb-1">
                                            <input id="username" name="ficha[usuario_telefono]" type="text" class="form-control" placeholder="Phone">
                                        </div>

                                        <div class="input mb-1">
                                            <select class="form-control" name="ficha[state]" id="states">
                                                <option value="">-- SELECT STATE --</option>
                                            </select>
                                        </div>

                                        <div class="input mb-1">
                                            <select class="form-control" name="ficha[city]" id="cities">
                                                <option value="">-- SELECT CITY --</option>
                                            </select>
                                        </div>

                                        <div class="input mb-1">
                                            <input id="username" name="ficha[address]" type="text" class="form-control" placeholder="Address">
                                        </div>

                                        <div class="input mb-1">
                                            <input id="username" name="ficha[zip]" type="text" class="form-control" placeholder="Zip">
                                        </div>

                                        <div class="d-sm-flex justify-content-between">
                                            <div class="field-wrapper">
                                                <button id="register" type="submit" class="btn btn-primary w-100" value="">Register</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </form>
                        <div class=" mt-5">
                            <a class="text-primary mt-5" href="<?= base_url("$project_url/login") ?>">Back to login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">
            <div class="l-image">
            </div>
        </div>
    </div>


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="<?= base_url("assets_admin/assets/js/libs/jquery-3.1.1.min.js") ?>"></script>
    <script src="<?= base_url("assets_admin/bootstrap/js/popper.min.js") ?>"></script>
    <script src="<?= base_url("assets_admin/bootstrap/js/bootstrap.min.js") ?>"></script>

    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="<?= base_url("assets_admin/assets/js/authentication/form-1.js") ?>"></script>
    <script src="<?= base_url("assets_admin/assets/js/uploadImage.js") ?>" ></script>

    <script type="text/javascript">

        $.get("<?= base_url("direcciones/object") ?>", function(data){
            $("#states").html(data);
        });
        $(document).on("change", "#states", function(){
            var state_id = $(this).val();
            getCities(state_id);
        })
        function getCities(state_id) {
            $.get("<?= base_url("ciudades/options") ?>/"+state_id+"/0", function(data){
                console.log(data);
                $("#cities").html("<option value=''>--SELECT CITY--</option>"+data);
                console.log("cities have been set");
            });
        }
        function getStates() {
            var url = "<?= base_url("provincias/options/1/0") ?>";
            console.log(url);
            $.get(url, function(data){
                console.log(data);
                $("#states").html("<option value=''>--SELECT STATE--</option>"+data);
                console.log("states have been set");
            });
        }
        getStates();

        $("#register").click(function(){
            if ($("#input-image").val() == "") {
                alert("Image can't be empty");
                var parent = $("#input-image").parent();
                $(parent).css("border", "1px red solid");
                $("#input-image").focus();
            }
            if (window.File && window.FileReader && window.FileList && window.Blob){
               var pic_size = $('#input-image')[0].files[0].size;//get file size
               var pic_type = $('#input-image')[0].files[0].type;

               var extension = pic_type.split('/').pop().toUpperCase();

                if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG" || pic_size>=2048000)
                {
                    alert ("Please Select PNG,JPG,GIF,JPEG Image Only and File Size not Greater than 2MB");
                    $( "#input-image" ).focus()
                    return false;
                }
            }
        });
        $("#input-image").on("change", function(){
            if (window.File && window.FileReader && window.FileList && window.Blob){
               var pic_size = $('#input-image')[0].files[0].size;//get file size
               var pic_type = $('#input-image')[0].files[0].type;

               var extension = pic_type.split('/').pop().toUpperCase();

                if (extension!="PNG" && extension!="JPG" && extension!="GIF" && extension!="JPEG" || pic_size>=2048000)
                {
                    alert ("Please Select PNG,JPG,GIF,JPEG Image Only and File Size not Greater than 2MB");
                    $( "#input-image" ).focus()
                    return false;
                }
            }
        });
    </script>

</body>
</html>
