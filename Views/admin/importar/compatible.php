<form method="post" class="layout-px-spacing">
    <div class="row">
        <div class="col-12 mt-5">
            <divclass="card">
                <div class="card-header">
                    <h2>Importación</h2>
                </div>
                <div class="card-body">
                    <?php $data = unserialize($_SESSION["uploaded_csv"]); ?>
                    <div class="table-responsive" data-toggle="lists" data-lists-values='["name"]'>
                        <!-- Table -->
                        <table class="table text-white">
                            <thead>
                                <tr>
                                    <?php $columns = count($data[0]) ?>
                                    <?php for ($i = 0; $i < $columns; $i++): ?>
                                        <th>
                                            <select class="form-control select-campo" name="ficha[<?= $i  ?>]">
                                                <option value="0">--IGNORAR--</option>
                                                <option value="marca">Marca</option>
                                                <option value="modelo">Modelo</option>
                                                <option value="generacion">Generacion</option>
                                                <option value="sku">SKU</option>
                                            </select>
                                        </th>
                                    <?php endfor; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    unset($data[0]);
                                    $max_rows = 10;
                                    $current_row = 0;
                                ?>
                                <?php foreach ($data as $post => $array): ?>
                                    <?php if ($current_row < $max_rows): ?>
                                        <tr>
                                            <?php foreach ($array as $key => $value): ?>
                                                <td><?= $value ?></td>
                                            <?php endforeach; ?>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $current_row ++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Continuar</button>
                </div>
            </div>
        </div>
    </div>
</form>
