<?php foreach ($fields as $field): ?>
    <?php $fullName = $ficha->_getFullName($field) ?>
    <?php if (isset($ficha->fields[$fullName])): ?>
        <?php $_field = $ficha->fields[$fullName] ?>
        <?php if (isset($_field["html"])): ?>
            <?php $html = $_field["html"] ?>
            <?php if (!($html["type"] == "hidden")): ?>
                <div class="form-row mb-1">
                    <?php if ($html["label"] !== false): ?>
                        <label id="label-<?= $fullName ?>" for="<?= $fullName ?>" class="<?= $col_label ?> col-form-label form-label d-flex">
                            <?= $html["label"] ?> <?= isset($html["link"]) ? $html["link"] : "" ?>
                            <?= isset($html["description"]) ? "<br><small class='text-lowercase'>".$html["description"]."</small>" : "" ?>
                            <?php if (
                                ($html["type"] == "textarea") &&
                                (isset($html["botones"]))
                                ): ?>
                                <div
                                    id="add_<?= $fullName ?>"
                                    class="btn btn-primary ml-4 add_button_html"
                                    data-load="<?= base_url("admin/galeria/load/boton_html") ?>"
                                    data-destination="#editor_<?= $field ?>">Añadir botón al texto</div>
                                <div class="btn btn-primary ml-4">Añadir Archivo</div>
                            <?php endif; ?>
                        </label>
                    <?php else: ?>
                        <?php $col_field = "col-12" ?>
                    <?php endif; ?>
                    <?php $inputTypes = ["text", "number", "tel", "email", "password", "color", "date", "datetime"] ?>
                    <?php if (in_array($html["type"], $inputTypes)): ?>
                        <div class="<?= $col_field ?>">
                            <div role="group" class="input-group input-group-merge">
                                <input id="<?= $fullName ?>" name="<?= $fichaName ?>[<?= $fullName ?>]"
                                    value="<?php
                                    if ($html["type"] == "date") {
                                        echo date("Y-m-d", strtotime($ficha->_get($field)));
                                    } elseif ($html["type"] == "datetime") {
                                        echo date("Y-m-d H:i:s", strtotime($ficha->_get($field)));
                                    } else {
                                        if (isset($html["default"])) {
                                            if ($ficha->_id() > 0) {
                                                echo $ficha->_get($field);
                                            } else {
                                                echo $html["default"];
                                            }
                                        } else {
                                            echo $ficha->_get($field);
                                        }
                                    }
                                    ?>" type="<?= $html["type"] ?>"
                                    placeholder="<?= isset($html["placeholder"]) ? $html["placeholder"] : "" ?>"
                                    <?= isset($html["min"]) ? "min='{$html["min"]}'" : "" ?>
                                    <?= isset($html["step"]) ? "step='{$html["step"]}'" : "" ?>
                                    <?= ($html["type"] == "password") ? "autocomplete='false'" : ""?>
                                    class="form-control <?= isset($html["class"]) ? $html["class"] : "" ?>"
                                    <?php if (isset($html["editable"])): ?>
                                        data-id="<?= $ficha->_id() ?>"
                                        data-field="<?= $fullName ?>"
                                        <?php if ($html["editable"]!== true): ?>
                                            <?php $url = str_replace("{id}", $ficha->_id(), $html["editable"]) ?>
                                            data-url="<?= base_url($url) ?>"
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?= isset($html["readonly"]) ? "readonly" : "" ?>>
                            </div>
                        </div>
                    <?php elseif($html["type"] == "textarea"): ?>
                        <div class="<?= $col_field ?> mb-5">
                            <?= view("templates/textarea",[
                                "ficha" => $ficha,
                                "id" => "editor_$field",
                                "field" => $fullName,
                                "fichaName" => $fichaName
                            ]) ?>
                        </div>
                    <?php elseif($html["type"] == "simple_textarea"): ?>
                        <div class="<?= $col_field ?>">
                            <textarea id="<?= $fullName ?>" name="<?= $fichaName ?>[<?= $fullName ?>]"
                                placeholder="<?= isset($html["placeholder"]) ? $html["placeholder"] : "" ?>"
                                class="form-control <?= isset($html["class"]) ? $html["class"] : "" ?>"
                                <?php if (isset($html["editable"])): ?>
                                    data-id="<?= $ficha->_id() ?>"
                                    data-field="<?= $fullName ?>"
                                    <?php if ($html["editable"]!== true): ?>
                                        <?php $url = str_replace("{id}", $ficha->_id(), $html["editable"]) ?>
                                        data-url="<?= base_url($url) ?>"
                                    <?php endif; ?>
                                <?php endif; ?>
                            ><?= $ficha->_get($field) ?></textarea>
                        </div>
                    <?php elseif($html["type"] == "switch"): ?>
                        <div class="<?= $col_field ?>">
                            <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">
                                <input id="<?= $fullName ?>" <?= ($ficha->_get($field) == 1) ? "checked" : "" ?>
                                    type="checkbox" id="editor_<?= $field ?>"
                                    class="custom-control-input" name="<?= $fichaName ?>[<?= $fullName ?>]">
                                <label class="custom-control-label" for="editor_<?= $field ?>">Si</label>
                            </div>
                            <label class="form-label mb-0" for="subscribe">Si</label>
                        </div>
                    <?php elseif($html["type"] == "select"): ?>
                        <div class="<?= $col_field ?>">
                            <div role="group" class="input-group input-group-merge">
                                <select id="<?= $fullName ?>" name="<?= $fichaName ?>[<?= $fullName ?>]"
                                    class="form-control"
                                    <?php if (isset($html["editable"])): ?>
                                        data-id="<?= $ficha->_id() ?>"
                                        data-field="<?= $fullName ?>"
                                        <?php if ($html["editable"]!== true): ?>
                                            <?php $url = str_replace("{id}", $ficha->_id(), $html["editable"]) ?>
                                            data-url="<?= base_url($url) ?>"
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    >
                                    <?php if (isset($html["placeholder"])): ?>
                                        <option value=""><?= $html["placeholder"] ?></option>
                                    <?php endif; ?>
                                    <?= $ficha->_getOptions($field) ?>
                                </select>
                            </div>
                        </div>
                    <?php elseif($html["type"] == "select_group"): ?>
                        <div class="<?= $col_field ?>">
                            <div role="group" class="input-group input-group-merge">
                                <select id="<?= $fullName ?>" name="<?= $fichaName ?>[<?= $fullName ?>]"
                                    class="form-control"
                                    <?php if (isset($html["editable"])): ?>
                                        data-id="<?= $ficha->_id() ?>"
                                        data-field="<?= $fullName ?>"
                                        <?php if ($html["editable"]!== true): ?>
                                            <?php $url = str_replace("{id}", $ficha->_id(), $html["editable"]) ?>
                                            data-url="<?= base_url($url) ?>"
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    >
                                    <?= $ficha->_getOptionsGroup($field, $ficha->_get($fullName, true)) ?>
                                </select>
                            </div>
                        </div>
                    <?php elseif ($html["type"] == "select_distinct"): ?>
                        <div class="<?= $col_field ?>">
                            <div role="group" class="input-group input-group-merge">
                                <select id="<?= $fullName ?>" name="<?= $fichaName ?>[<?= $fullName ?>]<?= isset($html["multiple"]) ? "[]" : "" ?>"
                                    list="<?= $fullName ?>_list"
                                    value="<?= $ficha->_get($field) ?>" type="<?= $html["type"] ?>"
                                    placeholder="<?= isset($html["placeholder"]) ? $html["placeholder"] : "" ?>"
                                    <?= isset($html["min"]) ? "min='{$html["min"]}'" : "" ?>
                                    <?= isset($html["step"]) ? "step='{$html["step"]}'" : "" ?>
                                    <?= ($html["type"] == "password") ? "autocomplete='false'" : ""?>
                                    class="form-control <?= isset($html["class"]) ? $html["class"] : "" ?> <?= isset($html["multiple"]) ? "tagging" : "" ?>"
                                    <?= isset($html["multiple"]) ? "multiple='multiple'" : "" ?>
                                    <?php if (isset($html["editable"])): ?>
                                        data-id="<?= $ficha->_id() ?>"
                                        data-field="<?= $fullName ?>"
                                        <?php if ($html["editable"]!== true): ?>
                                            <?php $url = str_replace("{id}", $ficha->_id(), $html["editable"]) ?>
                                            data-url="<?= base_url($url) ?>"
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    >
                                    <?php foreach ($ficha->model->select("$fullName")->distinct()->findAll() as $object): ?>
                                        <option value="<?= $object->_get($html["id"]) ?>"><?= $object->_get($html["field"]) ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>
                    <?php elseif ($html["type"] == "datalist"): ?>
                        <div class="<?= $col_field ?>">
                            <div role="group" class="input-group input-group-merge">
                                <input id="<?= $fullName ?>" name="<?= $fichaName ?>[<?= $fullName ?>]<?= isset($html["multiple"]) ? "[]" : "" ?>"
                                    list="<?= $fullName ?>_list"
                                    value="<?= $ficha->_get($field) ?>" type="<?= $html["type"] ?>"
                                    placeholder="<?= isset($html["placeholder"]) ? $html["placeholder"] : "" ?>"
                                    <?= isset($html["min"]) ? "min='{$html["min"]}'" : "" ?>
                                    <?= isset($html["step"]) ? "step='{$html["step"]}'" : "" ?>
                                    <?= ($html["type"] == "password") ? "autocomplete='false'" : ""?>
                                    class="form-control <?= isset($html["class"]) ? $html["class"] : "" ?> <?= isset($html["multiple"]) ? "tagging" : "" ?>"
                                    <?= isset($html["multiple"]) ? "multiple='multiple'" : "" ?>
                                    <?php if (isset($html["editable"])): ?>
                                        data-id="<?= $ficha->_id() ?>"
                                        data-field="<?= $fullName ?>"
                                        <?php if ($html["editable"]!== true): ?>
                                            <?php $url = str_replace("{id}", $ficha->_id(), $html["editable"]) ?>
                                            data-url="<?= base_url($url) ?>"
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    >
                                <datalist id="<?= $fullName ?>_list">
                                    <?php foreach ($ficha->model->select("$fullName")->distinct()->findAll() as $object): ?>
                                        <option value="<?= $object->_get($html["field"]) ?>">
                                    <?php endforeach; ?>
                                </datalist>
                            </div>
                        </div>
                    <?php elseif($html["type"] == "label"): ?>
                        <div class="<?= $col_field ?>">
                            <div role="group" class="input-group input-group-merge">
                                <div class="p-2 border rounded w-100">
                                    <?= $ficha->_get($field) ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; ?>
