<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/config.php');

$app = new MyApp\Controller\MasterMente\MasterMente();

$app->run();

?>

<table border="2">
    <?php $datas = $app->getValue()->names ?>
    <?php if (is_array($datas)) : ?> 
        <tr>
            <th class="hidden">id</th>
            <?php if ($_SESSION['me']->authority == 1) : ?> 
                <th>コード</th>
            <?php endif; ?>
            <th>カテゴリ名</th>
            <th>削除</th>
        </tr>

        <?php  for ($i = 0; $i < count($datas); $i++) : ?>
            <tr>
                <form action="" method="post" name="names<?= h($i); ?>">
                    <input type="hidden" name="from" value="del">
                    <input type="hidden" name="kind" value="names">
                    <input type="hidden" name="code" value="<?= h($datas[$i]->category); ?>">
                    <?php if ($_SESSION['me']->authority == 1) : ?>
                        <td><?= h($datas[$i]->category); ?></td>
                    <?php endif; ?>
                    <td><?= h($datas[$i]->name); ?></td>
                    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
                    <td><input type="submit" value="削除" onclick="return ConfirmDelNames('<?= h($datas[$i]->category); ?>');"></td>
                </form>
            </tr>
        <?php endfor; ?>
    <?php endif; ?>
</table>
