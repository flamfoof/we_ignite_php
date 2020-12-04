<?= view("weignite/login/partes/head", ["mensaje" => $mensaje]) ?>
<div class="form-container">
    <div class="form-form">
        <div class="form-form-wraps">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="text-center mt-4">Download <a href="<?= base_url() ?>"><span class="brand-name"><?= $name ?></span></a></h1>
                    <div class="mt-2 text-center">
                        Please download our software and enjoy your visit
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-6 mb-2">
                            <a target="_blank" href="<?= base_url($project->_get("windows")) ?>" class="btn btn-primary w-100">Windows</a>
                        </div>
                        <div class="col-md-6 mb-2">
                            <a href="#" class="btn btn-primary w-100">Mac</a>
                        </div>
                        <div class="col-md-6 mb-2">
                            <a href="#" class="btn btn-primary w-100">App Store</a>
                        </div>
                        <div class="col-md-6 mb-2">
                            <a href="#" class="btn btn-primary w-100">Play Store</a>
                        </div>
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
<?php view("weignite/login/partes/footer") ?>
