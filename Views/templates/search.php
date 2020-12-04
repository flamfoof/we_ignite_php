<!-- Search -->
<form class="search-form d-flex mb-5" method="get">
    <input type="text" name="query" value="<?= (isset($_GET["query"])) ? $_GET["query"] : "" ?>" class="form-control search" placeholder="<?= isset($placeHolder) ? $placeHolder : "Buscar..." ?>">
    <a href="<?= current_url() ?>" class="btn"><i class="material-icons">cancel</i></a>
    <button class="btn"><i class="material-icons">search</i></button>
</form>
