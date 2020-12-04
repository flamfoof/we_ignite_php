<?php if ($ficha->_id() > 0): ?>
    <div id="combinaciones159" class="list-group-item">
        <div class="form-row mb-1">
            <label class="col-md-3 col-form-label form-label">
                Productos <br><small>(escribe el producto a relacionar)</small>
            </label>
            <div class="col-md-9">
                <div role="group" class="input-group input-group-merge">
                    <input id="ajax_producto" name="ficha[ajax_producto]" value="" type="text" placeholder="Mi producto..." class="form-control">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                Encontrados:
                <div class="bg-dark p-3 m-3" id="ajax_result_producto">

                </div>
            </div>
            <div class="col-6">
                Seleccionados:
                <div class="bg-dark p-3 m-3" id="ajax_selected_producto">

                </div>
                <div id="agregar-block-producto"  class="d-none">
                    <div class="btn btn-primary w-100 mt-1" id="agregarProducto">
                        Relacionar producto
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
                            <th>producto</th>
                            <th  class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="productosLoaded">
                        <?= view("admin/productos/partes/relacionados_productos", ["ficha" => $ficha]); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal Producto-->
<?php else: ?>
    <p class="text-muted p-3">
        <i data-v-134867f8="" class="material-icons icon-40pt">info_outline</i>
        Antes de agregar Relacionados debes guardar el producto
    </p>
<?php endif; ?>
