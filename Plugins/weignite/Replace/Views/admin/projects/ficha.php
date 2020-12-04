<link type="text/css" href="<?= base_url("assets_admin/plugins/editors/quill/quill.snow.css") ?>" rel="stylesheet">
<script src="<?= base_url("assets_admin/plugins/editors/quill/quill.js") ?>"></script>
<script src="<?= base_url("assets_admin/assets/js/image-resize.min.js") ?>"></script>
<div class="layout-px-spacing">
    <form method="post"  enctype="multipart/form-data">
        <div class="row m-0">
            <div class="col-lg container-fluid page__container">
                <h1 class="h2">Project</h1>
                <div class="card">
                    <div class="list-group-item">
                        <div class="list-group list-group-fit">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="banner-container">
                                        <img id="img-image" src="<?= isset($ficha) ? $ficha->getImagen() : "nohayimagen" ?>"
                                            class="btn-archivos  margin-bottom-micro"
                                            data-destination = "<?= FCPATH."assets/archivos/paginas" ?>" />
                                        <input type="text" class="form-control special-file d-none"
                                            name="ficha[project_archivo_id]"
                                            value="<?= $ficha->_get("archivo_id") ?>"
                                            id="input-image" />
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                        <?= $ficha->loadHTML(["name", "url", "secretkey", "expiration", "windows", "mac", "appstore", "playstore", "estado"]) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <button class="btn btn-success">Save</button>
                        <a href="<?= base_url("admin/projects") ?>" class="btn btn-danger">Back</a>
                        <?php if ($ficha->_id() > 0): ?>
                            <a href="<?= base_url("admin/project/new") ?>" class="btn btn-primary">New</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php if ($ficha->_id() > 0): ?>
        <div class="row m-0">
            <div class="col-lg container-fluid page__container">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex flex-column flex-sm-row flex-wrap mb-headings align-items-start align-items-sm-center">
                            <div class="flex mb-2 mb-sm-0">
                                <h1 class="h2">Project's Users</span></h1>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Wrapper -->
                        <div class="table-responsive" data-toggle="lists" data-lists-values='["name"]'>
                            <!-- Search -->
                            <!-- Search -->
                            <form class="search-form d-flex mb-5" action="<?= base_url("admin/project/{$ficha->_id()}/user") ?>" method="post">
                                <input type="text" name="usuario_email" value="" class="form-control search" placeholder="User email">
                                <button class="btn"><i class="material-icons">person_add</i></button>
                            </form>
                            <!-- Table -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th  class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ficha->getUsuarios() as $_usuario): ?>
                                        <tr>
                                            <td><?= $_usuario->_id() ?></td>
                                            <td><?= $_usuario->usuario_nombre ?> <?= $_usuario->usuario_apellidos ?></td>
                                            <td><?= $_usuario->usuario_email ?></td>
                                            <td class="text-center">
                                                <a href="<?= base_url("admin/project/{$ficha->_id()}/user/{$_usuario->_id()}/delete") ?>" class="check-link">
                                                    <i data-v-134867f8="" class="material-icons icon-40pt">delete</i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?= isset($pagination) ? $pagination->links() : "" ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<script src="<?= base_url("assets_admin/assets/js/uploadMultiImage.js") ?>" ></script>
<?= view("templates/tab_js",[]) ?>
