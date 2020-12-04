<form method="post" class="layout-px-spacing" enctype="multipart/form-data">
    <div class="row m-0">
        <div class="col-lg container-fluid page__container">
            <h1 class="h2">reCaptcha v3</h1>
            <div class="card">
                <div class="card-body row">
                    <div class="col-12">
                        <div class="list-group list-group-fit">
                            <div class="list-group-item">
                                <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
                                    <div class="form-row mb-1">
                                        <label for="profilename" class="col-md-3 col-form-label form-label">
                                            Clave del sitio web
                                        </label>
                                        <div class="col-md-9">
                                            <div role="group" class="input-group input-group-merge">
                                                <input type="text" class="form-control" name="ficha[CLAVE_SITIO_WEB]" value="<?= $data["CLAVE_SITIO_WEB"] ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-1">
                                        <label for="profilename" class="col-md-3 col-form-label form-label">
                                            Clave secetra
                                        </label>
                                        <div class="col-md-9">
                                            <div role="group" class="input-group input-group-merge">
                                                <input type="text" class="form-control" name="ficha[CLAVE_SECRETA]" value="<?= $data["CLAVE_SECRETA"] ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row mb-1">
                                        <label for="profilename" class="col-md-3 col-form-label form-label">
                                            <div class="">
                                                Nivel de seguridad (0-1)
                                            </div>
                                            <small>0 -> Todo el mundo puede escribir, <br> 1-> Nadie puede escribir</small>
                                        </label>
                                        <div class="col-md-9">
                                            <div role="group" class="input-group input-group-merge">
                                                <input type="text" class="form-control" name="ficha[SECURITY_LEVEL]" value="<?= $data["SECURITY_LEVEL"] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <button class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>
