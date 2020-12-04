<?php
    function getModel($model = "", $newModel = null){
        if ($model == "") {
            return true;
        }
        if (in_array($model, $GLOBALS['helper_models'])) {
            return $GLOBALS['helper_models'][$model];
        }else {
            return $GLOBALS['helper_models'][$model] = $newModel;
        }
    }
    /************helper_models***************
    $helper_models = [
        "UserModel" => new UserModel();
    ];
    ******************************************/
?>
