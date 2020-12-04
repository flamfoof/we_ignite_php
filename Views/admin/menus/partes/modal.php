<div class="modal fade" id="modalEdition" tabindex="-1" role="dialog" aria-labelledby="modalEditionTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" id="producto-form" action="<?= base_url("admin/grupomenu/nuevo") ?>" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditionTitle">Insertar un nuevo Grupo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modalEdition-body" class="modal-body">

            </div>
            <div class="modal-footer">
                <input type="hidden" name="ficha[redirect]" value="admin/menus">
                <div type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</div>
                <button class="btn btn-primary add-grupo-btn">Aceptar</button>
            </div>
        </form>
    </div>
</div>
