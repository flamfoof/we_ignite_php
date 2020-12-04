<?= view("weignite/login/partes/head", ["mensaje" => $mensaje]) ?>
<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">

                    <h1 class="">Log In <a href="<?= base_url() ?>"><span class="brand-name"><?= $name ?></span></a></h1>
                    <p class="text-center">Type your email and recover your password</p>
                    <form method="post" class="text-left">
                        <div class="form">

                            <div id="username-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="username" name="ficha[usuario_email]" type="text" class="form-control" placeholder="Email">
                            </div>

                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" value="">Recover</button>
                                </div>

                            </div>

                        </div>
                    </form>
                    <div class=" mt-5">
                        <a class="text-primary mt-5" href="<?= base_url("$project_url/register") ?>">Don't you have an account? register</a>
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
