<div class="alert-wrapper">
    <div class="alert alert-<?= isset($classType)? $classType : "" ?>" role="alert">
      <?= isset($mensaje)? $mensaje : "" ?>
    </div>
</div>
<script type="text/javascript">
    setTimeout(function(){
        $(".alert-wrapper").addClass("d-none");
    }, <?= isset($time)? $time : "3000" ?>);
</script>
