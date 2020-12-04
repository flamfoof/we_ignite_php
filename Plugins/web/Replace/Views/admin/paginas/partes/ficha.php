<div class="list-group list-group-fit">
    <div class="list-group-item">
        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
            <?= $ficha->loadHTML(["name", "estado"]) ?>
            <div class="form-row mb-1">
                <label id="label-pagina_slug" for="pagina_slug" class="col-md-3 col-form-label form-label">
                    Pagina path
                </label>
                <div class="col-md-9">
                    <div role="group" class="input-group input-group-merge">
                        <select id="pagina_slug" class="form-control" name="ficha[pagina_slug]">
                            <?php foreach ($configuracion->getThemeMap() as $file): ?>
                                <option
                                    value="<?= $file ?>"
                                    <?= ($file == $ficha->_get("slug")) ? "selected" : "" ?>>
                                    <?= $file ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="list-group list-group-fit">
    <div class="list-group-item">
        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
            <?= $ficha->loadHTML([
                "meta_index", "meta_title", "meta_description",
                "meta_keywords", "facebook_type"
            ]) ?>
        </div>
    </div>
    <div class="list-group-item">
        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
            <div class="form-row mb-1">
                <label class="col-md-3 col-form-label form-label">
                    Meta Facebook Imagen
                </label>
                <div class="col-md-9">
                    <div class="banner-container">
                        <img id="img-image" src="<?= isset($ficha) ? $ficha->getImagen() : "nohayimagen" ?>"
                            class="btn-archivos  margin-bottom-micro"
                            data-destination = "<?= FCPATH."assets/archivos/paginas" ?>" />
                        <input type="text" class="form-control special-file d-none"
                            name="ficha[pagina_facebook_image]"
                            value="<?= $ficha->_get("facebook_image") ?>"
                            id="input-image" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="list-group-item">
        <div role="group" aria-labelledby="label-profilename" class="m-0 form-group">
            <?= $ficha->loadHTML([
                "custom",
            ]) ?>
        </div>
    </div>
</div>
