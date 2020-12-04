<!-- Modal -->
<div class="modal fade" id="modalPickImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title w-100" id="exampleModalLongTitle">Seleccionar imagen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="border p-2">
          Imagen seleccionada: <span id="image-selected"></span>
      </div>
      <div class="modal-body">
          <div class="row">
              <?php
                  $path = FCPATH."{$carpeta}/images";
                  if ($gestor = opendir($path)) {
                      while (false !== ($entrada = readdir($gestor))):
                          if (($entrada != ".") && ($entrada != "..")):
                              $imagePath = base_url("{$carpeta}/images/{$entrada}");
              ?>
                          <div class="col-md-3">
                              <img class="image-selectable" src="<?= $imagePath ?>" style="height:10vw; width:100%; object-fit:cover;">
                          </div>
              <?php
                          endif;
                      endwhile;
                      closedir($gestor);
                  }
              ?>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button id="image_page" type="button" class="btn btn-primary">Insertar</button>
      </div>
    </div>
  </div>
</div>
