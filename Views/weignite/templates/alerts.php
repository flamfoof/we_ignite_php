<style media="screen">
    .alert-wrapper{
        position: fixed;
        left: 0;
        right: 0;
        z-index: 9999999999999999;
        padding-top: 70px;
    }
    .alert-wrapper .alert{
        text-align: center;
    }
</style>
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
