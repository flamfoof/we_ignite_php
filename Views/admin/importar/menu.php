<div class="layout-px-spacing">
    <div class="row">
        <div class="col-12 mt-5">
            <form method="post" enctype="multipart/form-data" class="card">
                <div class="card-header">
                    <h2>Configuración previa importación</h2>
                </div>
                <div class="card-body">
                    <div class="form-row mb-1">
                        <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                            Actualizar
                        </label>
                        <div class="col-md-9">
                            <div role="group" class="input-group input-group-merge">
                                <select class="form-control" name="ficha[actualizar]">
                                    <option value="productos">Productos</option>
                                    <option value="coches">Coches</option>
                                    <option value="compatible">Compatibles</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <label id="label-provincia_estado" for="provincia_estado" class="col-md-3 col-form-label form-label">
                            Archivo
                            <div class="">
                                <small>Sube un archivo TSV</small>
                            </div>
                        </label>
                        <div class="col-md-9">
                            <div role="group" class="input-group input-group-merge">
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Continuar</button>
                </div>
            </form>
        </div>
    </div>
</div>
