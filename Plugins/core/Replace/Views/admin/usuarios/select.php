<?php $usuarioModel = new \App\Models\UsuarioModel(); ?>
<?php $usuarios = $usuarioModel->where("usuario_estado", 1)->findAll(10) ?>
<div class="<?= isset($class) ? $class : "col-md-12 mb-1 px-0" ?>">
    <div class="dropdown w-100">
        <button id="usuario_btn" class="form-control dropdown-toggle d-flex" type="button" data-toggle="dropdown">
            <span id="usuario_nombre" class="w-100 text-left">
                <?= $usuario_nombre ?>
            </span>
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu w-100">
            <input id="input_usuario" class="form-control myInputUsuario" type="text" placeholder="Buscar usuario..">
            <li>
                <div class="usuario_select btn d-block w-100 p-2 border" data-id="0">
                    Invitado
                </div>
            </li>
            <div id="usuarios">
                <?= view("admin/usuarios/partes/select", ["usuarios" => $usuarios]) ?>
            </div>
        </ul>
    </div>
    <script type="text/javascript">
        $("#usuario_btn").click(function() {
            console.log("clik on user");
            setTimeout(function(){$("#input_usuario").focus(); }, 100);
        });
        $(".myInputUsuario").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            var url = "<?= base_url("admin/usuarios/filter") ?>";
            console.log(url, value);
            $.post(url,{
                value:value
            }, function(data){
                console.log(data);
                $("#usuarios").html(data);
            });
        });
    </script>
</div>
