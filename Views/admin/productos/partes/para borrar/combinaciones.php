<?php if ($ficha->_id() > 0): ?>
    <div id="combinaciones159" class="list-group-item">
        <div class="d-flex mb-2 pb-1" style="border-bottom: 1px silver solid;">
            <div data-value="formato" class="ml-2 p-2 border rounded bg-dark type pointer">
                Formatos
            </div>
            <div data-value="atributo" class="ml-2 p-2 border rounded type pointer">
                Atributos
            </div>
        </div>
        <div class="form-row mb-1">
            <label id="type-label" class="col-md-3 col-form-label form-label">
                Formatos <br><small>(escribe el formato de tu producto)</small>
            </label>
            <div class="col-md-9">
                <div role="group" class="input-group input-group-merge">
                    <input id="ajax_formato" name="ficha[ajax_formato]" value="" type="text" placeholder="Mi formato..." class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                Encontrados:
                <div class="bg-dark p-3 m-3" id="ajax_result">
                    <?php foreach ($formatos as $formato): ?>
                        <div class='ajax_selectme btn btn-primary m-1' data-value='<?= $formato->_id()?>' ><?= $formato->_get("nombre") ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-6">
                Seleccionados:
                <div class="bg-dark p-3 m-3" id="ajax_selected">

                </div>
                <div id="agregar-block"  class="d-none">
                    <div class="btn btn-primary w-100 mt-1" id="agregarFormato">
                        Crear combinaciones
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive" data-toggle="lists" data-lists-values='["name"]'>
                <!-- Table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>SEL</th>
                            <th>Formato</th>
                            <th>SKU</th>
                            <th>EAN13</th>
                            <th>Precio</th>
                            <th>Oferta</th>
                            <th>Costo</th>
                            <th>Cantidades</th>
                            <th  class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="formatosLoaded">
                        <?= view("admin/productos/partes/formatos", ["combinaciones" => $combinaciones, "ficha" => $ficha]); ?>
                    </tbody>
                </table>
                <div class="d-flex">
                    <div class="btn btn-primary open-modal-all">Editar todos</div>
                    <div class="btn btn-primary open-modal ml-2">Editar grupo</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Producto-->
    <?= view("admin/productos/partes/modal_formatos") ?>
<?php else: ?>
    <p class="text-muted p-3">
        <i data-v-134867f8="" class="material-icons icon-40pt">info_outline</i>
        Antes de agregar Combinaciones debes guardar el producto
    </p>
<?php endif; ?>
