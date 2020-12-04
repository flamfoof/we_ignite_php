<div id="<?= $id ?>" data-toggle="quill" data-quill-placeholder="Quill WYSIWYG editor">
    <?= $ficha->_get($field, true) ?>
</div>
<textarea class="d-none" id="<?= $field ?>" name="<?= $fichaName ?>[<?= $field ?>]"><?= $ficha->_get($field, true) ?></textarea>
<script type="text/javascript">
var toolbarOptions = [
    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
    ['blockquote', 'code-block'],

    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript

    [ 'link', 'image', 'video' ],                    // add's image support
    [{ 'align': [] }],

    ['clean']                                        // remove formatting button
];
var quill = new Quill('#<?= $id ?>', {
    theme: 'snow',
    modules: {
        toolbar: {
            container: toolbarOptions,
            handlers: {
                image: imageHandler
            }
        },
        imageResize: {
           // See optional "config" below
       }
    }
});
function imageHandler() {
    var range = this.quill.getSelection();
    var value = prompt('URL de la imagen (http://www.imagen.com)');
    var alt = prompt('ALT de la imagen');
    this.quill.insertEmbed(range.index, 'image', value, Quill.sources.USER);
    quill.formatText(0, 1, 'alt', alt);
}
$("#<?= $id ?> .ql-editor").on("DOMSubtreeModified", function(){
    $("#<?= (isset($id_ta)) ? $id_ta : $field ?>").val($(this).html());
    console.log($("#<?= $field ?>").val());
});
</script>
