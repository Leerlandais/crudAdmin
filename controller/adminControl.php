<?php

if(isset($_GET['disconnect'])) administratorDisconnect();

if(isset($_GET['update'])&&ctype_digit($_GET['update'])){

    $id = (int) $_GET['update'];

    if(isset(
        $_POST['idourdatas'],
        $_POST['title'],
        $_POST['ourdesc'],
        $_POST['latitude'],
        $_POST['longitude']
    )){
        $idourdatas = (int) $_POST['idourdatas'];
        $title = htmlspecialchars(strip_tags(trim($_POST['title'])),ENT_QUOTES);
        $ourdesc = htmlspecialchars(trim($_POST['ourdesc']),ENT_QUOTES);
        $latitude = (float) $_POST['latitude'];
        $logintude = (float) $_POST['longitude'];

    }

    $update = getOneOurdatasByID($db,$id);
    var_dump($update,$_POST);

    require "../view/private/admin.update.html.php";

}

if(isset($_GET['insert'])){

    if(isset(
        $_POST['title'],
        $_POST['ourdesc'],
        $_POST['latitude'],
        $_POST['longitude']
    )){

        $title = strip_tags(trim($_POST['title']));
        $oudesc = trim($_POST['ourdesc']);
        $latitude = (float) $_POST['latitude'];
        $longitude = (float) $_POST['longitude'];

        $insert = addOurdatas($db,$title,$oudesc,$latitude,$longitude);

        if($insert===true):
            header("Location: ./?404"); 
            die();
        else:
            $error = $insert;
        endif;
    }

    require "../view/private/admin.insert.html.php";

    die();
}

$ourDatas = getAllOurdatas($db);

if(is_string($ourDatas)) $message = $ourDatas;

elseif(isset($ourDatas['error'])) $error = $ourDatas['error'];

require "../view/private/admin.homepage.html.php";


