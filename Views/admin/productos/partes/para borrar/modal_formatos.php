<div class="modal fade" id="modalFormatos" tabindex="-1" role="dialog" aria-labelledby="modalFormatosTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFormatosTitle">Editar Metodo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-row mb-1">
              <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                  Precio
              </label>
              <div class="col-md-9">
                  <input value="" id="modal_precio" type="text" class="form-control"/>
              </div>
          </div>
          <div class="form-row mb-1">
              <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                  Oferta
              </label>
              <div class="col-md-9">
                  <input value="" type="text" id="modal_oferta" class="form-control"/>
              </div>
          </div>
          <div class="form-row mb-1">
              <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                  Costo
              </label>
              <div class="col-md-9">
                  <input value="" type="text" id="modal_costo" class="form-control"/>
              </div>
          </div>
          <hr>
          <div class="form-row mb-1">
              <label id="label-profilename" for="profilename" class="col-md-3 col-form-label form-label">
                  Mover a otro producto <br> <small>Dejar vacio para ignorar</small>
              </label>
              <div class="col-md-9">
                  <input value="" type="text" id="modal_producto" class="form-control" placeholder="ID del producto"/>
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <div id="btn-aceptar" data-aceptar="todos" class="btn btn-info">Guardar</div>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
