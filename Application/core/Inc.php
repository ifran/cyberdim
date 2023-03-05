<?php session_start();
    DEFINE('PROJECT_NAME', 'cyberdim');
    include($_SERVER['DOCUMENT_ROOT'] . '/' . PROJECT_NAME . '/Application/core/Const.php');
    
    // No local atual da pasta
    include(PATH_CORE  . 'Database.php');
    include(PATH_CORE  . 'Generic.php');

    // Incluindo todas as models
    $oModel = PATH_MODEL;
    $sArquivos = glob("$oModel{*.php}", GLOB_BRACE);

    foreach($sArquivos as $oPhp) {
        include($oPhp);
    }
?>