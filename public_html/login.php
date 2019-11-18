<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/config.php');

$app = new MyApp\Controller\Login();

$app->run();

$_SESSION['title'] = 'ログイン画面';

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Home</title>
        <link rel="stylesheet" href="styles.css">
        <script type="text/jscript">
            function InputCheck(){
                if (loginForm.userid.value == "") {
                    alert ('ユーザーIDを入力してください。');
                    return false;
                } else if (loginForm.password.value == "") {
                    alert ('パスワードを入力してください。');
                    return false;
                } else {
                    return true;
                }
            }
        </script>
    </head>
    <body>
        <?php include( $_SERVER['DOCUMENT_ROOT'] . '/header.php'); ?>
        <canvas id="background" class="background"></canvas>
        <div class="container">
            <form action="" method="post" name="loginForm">
                <p>
                    ユーザーID:　<input type="text" name="userid">
                </p>
                <p>
                    パスワード:　<input type="password" name="password">
                </p>
                <p class="alert"><?= h($app->getMessage('loginfail')); ?></p>
                <input type="submit" onclick="return InputCheck();" value="ログイン">
                <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
            </form>
        </div>
        <script src="/js/drawbackground.js"></script>
    </body>
</html>