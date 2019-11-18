<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/config.php');

$ModalApp = new MyApp\Controller\Modal();

$ModalApp->run();

?>

<script type="text/jscript">
    $(function(){
        $('#uploadbtn').prop("disabled", true);
        $('.mask').click(function() {
            CloseModal();
        })
    });

    function  CloseModal() {
        $(".modal").addClass('hidden');
        $(".mask").addClass('hidden');
    }

    function FileSelected() {
        $('#filename').prop("disabled", false);
        $('#category').prop("disabled", false);
        $('#uploadbtn').prop("disabled", false);
        var path = $('#upfile').val();
        var fileNameIndex = path.lastIndexOf("\\") + 1;
        var fname = path.substr(fileNameIndex);
        var extIndex = fname.lastIndexOf(".") + 1;
        var ext = fname.substr(extIndex);
        var name = fname.substr(0, extIndex - 1);
        $('#filename').val(name);
        $('#ext').text(ext);
    }


</script>

<section class="modal hidden">
    <div class="container">
        <p class="message">アップロードするファイルを選択してください。</p>
        <form action="" method="post" enctype="multipart/form-data" name="uploadForm">
            <input type="hidden" name="from" value="upload">
            <p>
                <input type="file" value="参照" id="upfile" name="upfile" onchange="FileSelected()">
            </p>
            <p>
                ファイル名:　<input type="text" id="filename" name="filename" disabled>
                形式：<span id="ext"></span>
            </p>
            <p>
                カテゴリ:
                <?php if (is_array($ModalApp->getValue()->names)) : ?>
                    <select name="category" id="category" disabled>
                        <?php  foreach ($ModalApp->getValue()->names as $names) : ?>
                            <option value="<?= h($names->category); ?>"><?= h($names->name); ?></option>
                        <?php endforeach; ?>
                    </select>
                <?php endif; ?>
            </p>
            <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
            <input type="submit" id="uploadbtn" value="アップロード" disabled>

        </form>
        <input type="button" class="btn2" onclick="CloseModal()"value="閉じる">
    <div>
</section>

<div class="mask hidden"></div>
