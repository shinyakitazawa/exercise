<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/config.php');

$app = new MyApp\Controller\Index();

$app->run();

$_SESSION['title'] = 'メイン画面';

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8"> 
        <title>Home</title>
        <link rel="stylesheet" href="/styles.css">
    </head>
    <body>
        <div class="container">
            <?php include( $_SERVER['DOCUMENT_ROOT'] . '/header.php'); ?>   
            <canvas id="background" class="background"></canvas>
            <div class="container">
            <a href="documents"><div class="btn1">文書管理</div></a>
            <a href="setting"><div class="btn1">設定</div></a>
            </div>      
            <script src="/js/drawbackground.js"></script>
        </div>
    </body>
</html>