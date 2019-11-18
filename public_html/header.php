<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/config.php');


$headerApp = new MyApp\Controller\Header;

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
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <div id="headercanvas"></div>
            <div id="headertitle"><?= $_SESSION['title'] ?></div>
            <a href="<?= h(SITE_URL); ?>"><input type="button" class="btn2" id="backbtn" value="戻る"></a>
            <form action="/logout.php" method="post" id="logout">
                <input type="submit" value="ログアウト" class="btn2" id="logoutbtn" <?= h($headerApp->GetDisable()); ?>>
                <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
            </form>
        </div>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.4.8/p5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.4.8/addons/p5.dom.js"></script>
        <script src="/js/headerbackground.js"></script>

    </body>
</html>