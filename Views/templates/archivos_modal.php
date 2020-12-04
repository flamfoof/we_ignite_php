<div class="modal fade" id="archivosModal" tabindex="-1" role="dialog" aria-labelledby="archivosModal" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-archivo-title">Editor de archivos</h5>
                <!--<div class="btn btn-primary ml-4 img-image-custom" data-id="#img-image">
                    Insertar archivo
                </div>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-archivo-body"
                data-url="<?= base_url("admin/archivos") ?>"
                data-destination = "<?= FCPATH."assets/images/general" ?>" />>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a type="button" class="btn btn-primary continuar" href="#">Continuar</a>
            </div>
        </div>
    </div>
</div>
