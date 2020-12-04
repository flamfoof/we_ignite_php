<?= view("weignite/login/partes/head", ["mensaje" => $mensaje]) ?>
<div class="form-container">
    <div class="form-form">
        <div class="form-form-wraps">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="text-center mt-4">Log In <a href="<?= base_url() ?>"><span class="brand-name"><?= $name ?></span></a></h1>
                    <div class="mt-2 text-center">
                        We have sent you an email, please check and verify your account
                    </div>
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
                console.log("states have been set");
            });
        }
        function getStates() {
            $.get("<?= base_url("provincias/options/1/0") ?>", function(data){
                console.log(data);
                $("#states").html("<option value=''>--SELECT STATE--</option>"+data);
                console.log("states have been set");
            });
        }
        getStates();
    </script>

</body>
</html>
