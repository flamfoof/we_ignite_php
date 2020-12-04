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
<div class="row">
    <div class="col-md-5">
        <div class="list-group list-group-fit js">
            <div class="list-group-item">
                <div role="group" class="m-0 form-group">

                    <input type="file" name="files[]" value="" multiple placeholder="Sube tus imagenes">

                </div>
            </div>
        </div>
    </div>
    <div class="col-md-7">
        <?php $imagenes =$ficha->getImagenes() ?>
        <?php if (!empty($imagenes)): ?>
            <div class="row pt-2">
                <?php $i = 1 ?>
                <?php foreach ($imagenes as $imagen): ?>
                    <?php if ($i != $imagen->_get("posicion")): ?>
                        <?php $imagen->_set("posicion", $i) ?>
                        <?php $imagen->update() ?>
                    <?php endif; ?>
                    <div class="col-md-4 mt-3">
                        <div class="">
                            <img src="<?= $imagen->getImagen() ?>" class="img-fluid" alt="" style="height: 20vh; object-fit: cover; border: 1px darkgrey solid;">
                        </div>
                        <div class="d-flex">
                            <a href="<?= base_url("admin/producto/{$ficha->_id()}/productofoto/{$imagen->_id()}/back") ?>" class="">
                                <i data-v-134867f8="" class="material-icons icon-40pt">arrow_back_ios</i>
                            </a>
                            <a href="<?= base_url("admin/producto/{$ficha->_id()}/productofoto/{$imagen->_id()}/forward") ?>" class="">
                                <i data-v-134867f8="" class="material-icons icon-40pt">arrow_forward_ios</i>
                            </a>
                            <a href="<?= base_url("admin/producto/{$ficha->_id()}/productofoto/{$imagen->_id()}/borrar") ?>" class="check-link">
                                <i data-v-134867f8="" class="material-icons icon-40pt">delete</i>
                            </a>
                        </div>
                    </div>
                    <?php $i ++ ?>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p class="p-2 text-muted">
                <i data-v-134867f8="" class="material-icons icon-40pt">info_outline</i>
                Para añadir imágenes, puedes arrastrarlas hasta el área azul o
                hacer click en el botón de elegir archivo, recuerda que la suma de los pesos
                de las imágenes no debe exceder 2Mb
            </p>
        <?php endif; ?>
    </div>
</div>
