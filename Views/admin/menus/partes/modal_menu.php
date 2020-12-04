<div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="modalMenuTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" id="producto-form" action="<?= base_url("admin/menu/nuevo") ?>" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMenuTitle">Insertar un nuevo Grupo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div id="modalMenu-body" class="modal-body">

            </div>
            <div class="modal-footer">
                <div type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</div>
                <button class="btn btn-primary add-grupo-btn">Insertar</button>
            </div>
        </form>
    </div>
</div>
