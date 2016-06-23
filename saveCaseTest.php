<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('user.php');
require_once('videoOriginal.php');
require_once('videoFiltrados.php');
require_once('testeUsuario.php');

if (isset($_POST["caseTestId"]) && isset($_POST["video"])) {

    $caseTestId = $_POST["caseTestId"];
    $video = $_POST["video"];

    if(strcmp(trim($video), "") == 0){
        $_SESSION['msg']['reg-err'] = "You must select one of these videos";
        header('Location: ./videos.php');
        exit();
    }

    $tu = testeUsuario::selectById($caseTestId);
    $tu->setVEscolha($video);
    $tu->update();

    if($tu->getFinal() == 0){
        $tu2 = testeUsuario::selectFinalTest($tu->getEmail(), $tu->getVOriginal());
        if(is_null($tu2->getV1())) $tu2->setV1($video);
        else if(is_null($tu2->getV2())) $tu2->setV2($video);
        else if(is_null($tu2->getV3())) $tu2->setV3($video);
        else if(is_null($tu2->getV4())) $tu2->setV4($video);
        $tu2->update();
    }

    //search next test id
    $tests = testeUsuario::selectAll();
    for($i = 0; $i < sizeof($tests); $i++){
        $t = $tests[$i];

        if($t->getId() == $caseTestId){
            $t2 = $tests[($i + 1)];
            $u = User::selectByEmail($t->getEmail());
            $u->setCurrentTest($t->getId()+1);
            $u->update();
        }
    }

    header('Location: ./videos.php');
    exit();
} else {
    $_SESSION['msg']['reg-err'] = "You must select one of these videos";
    header('Location: ./videos.php');
    exit();
}
