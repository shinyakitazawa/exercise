<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/config.php');

$app = new MyApp\Controller\Documents();

$app->run();

$_SESSION['title'] = '文書管理';

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8"> 
        <title>Home</title>
        <link rel="stylesheet" href="/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/jscript">
        
            $(function(){
                $(".modal").load("/modal/upload.php");
                $('#categ').val('<?= h($_SESSION['dispcategory']); ?>');
                categoryChanged();
            });

            function ShowModal(){
                $(".modal").removeClass('hidden');
                $(".mask").removeClass('hidden');
            }

            function categoryChanged() {
                var selectedVal = $('[name=category]').val();
                var url = '/documents/doctable.php';
                $.ajax({
                    url: url,
                    type: 'post',
                    data: {
                        "from": 'pulldown',
                        "dispcategory": selectedVal
                    },
                    success: function(msg){
                        $("#doctable").html(msg);
                    } ,
                    error: function(err) {
                        alert(err);
                    }
                });
                
            }

            function ConfirmDel(fname,id) {
                var result = window.confirm('削除しますか？');
                if( result ) {
                    $.ajax({
                        url: '/documents/doctable.php',
                        type: 'post',
                        data: {
                            "from": 'del',
                            "fname": fname,
                            "id": id
                        },
                        success: function(msg){
                            $("#doctable").html(msg);
                        } ,
                        error: function(err) {
                            alert(err);
                        }
                    });
                }
                else {
                    return false;
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <?php include( $_SERVER['DOCUMENT_ROOT'] . '/header.php'); ?>
            <canvas id="background" class="background"></canvas>
            <section class="menubar">
                <div class="container inline">
                    <p>
                        カテゴリ:
                        <?php if (is_array($app->getValue()->names)) : ?>
                            <select name="category" id="categ" onChange="categoryChanged()">
                                <option value="all">全て</option>
                                <?php  foreach ($app->getValue()->names as $names) : ?>
                                    <option value="<?= h($names->category); ?>"><?= h($names->name); ?></option>
                                <?php endforeach; ?>
                            </select>
                        <?php endif; ?>
                    </p>
                <div>

                <div class="inline">
                    <input type="button" onclick="ShowModal();"  value="アップロード">
                </div>
                
            </section>
            <div class="container">

                <div id="doctable"></div>

                <?php include( $_SERVER['DOCUMENT_ROOT'] . '/modal/upload.php'); ?>
                
            </div>
        </div>
        <script src="/js/drawbackground.js"></script>
    </body>
</html>