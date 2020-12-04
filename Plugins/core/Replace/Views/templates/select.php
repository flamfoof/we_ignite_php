<?php if (count($objects) > 0): ?>
    <div class="form-row mb-1">
        <label class="col-md-3 col-form-label form-label">
            <?= $label ?>
        </label>
        <div class="col-md-9">
            <div class="dropdown w-100">
                <input class="<?= isset($class) ? $class : "" ?>" id="<?= $name ?>_input" type="hidden" name="ficha[<?= $field ?>]" value="<?= $ficha->_get($field, true) ?>">
                <button class="form-control dropdown-toggle d-flex" type="button" data-toggle="dropdown">
                    <span id="<?= $name ?>_nombre" class="w-100 text-left">
                        <?php if ($ficha->_get($field, true) > 0): ?>
                            <?= $nombre ?>
                        <?php else: ?>
                            <?= $selecciona_text ?>
                        <?php endif; ?>
                    </span>
                    <span class="caret"></span>
                </button>
                <ul id="ajax_<?= $name ?>_result" class="dropdown-menu w-100">
                    <input id="input-ajax-<?= $name ?>" class="form-control" type="text" placeholder="Search..">
                    <li>
                        <div data-id="0" class="<?= $name ?>_select d-block w-100  p-2 border selected-item">
                            Ninguno
                        </div>
                    </li>
                    <?php foreach ($objects as $object): ?>
                        <li>
                            <div data-id="<?= $object->_id() ?>" class="<?= $name ?>_select d-block w-100  p-2 border selected-item">
                                <?= $object->getNombre() ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
<script type="text/javascript">
    $("#input-ajax-<?= $name ?>").on("input", function(){
        var myInput = $(this).val();
        var url = "<?= $url ?>";
        console.log(url, myInput, "<?= $name ?>_select");
        $.post(url, {
            value:myInput,
            class:"<?= $name ?>_select"
        },function(data){
            $("#ajax_<?= $name ?>_result li").each(function(){
                $(this).remove();
            });
            $("#ajax_<?= $name ?>_result").append(data);
        });
    });
    $(document).on("click", ".<?= $name ?>_select", function(){
        var id = $(this).attr("data-id");
        var value = $(this).html();
        console.log("SET "+"#<?= $name ?>_nombre"+" as ", value);
        $("#<?= $name ?>_nombre").html(value);
        $("#<?= $name ?>_input").val(id);
    });
</script>
