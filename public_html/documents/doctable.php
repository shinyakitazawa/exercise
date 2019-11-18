<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/config.php');

$app = new MyApp\Controller\Documents();

$app->run();

?>

<table border="2">

    <?php $docs = $app->getValue()->docs ?>
    <?php if (is_array($docs)) : ?> 
        <tr>
            <th class="hidden">id</th>
            <th>名称</th>
            <th>カテゴリ</th>
            <th class="pconly">登録日</th>
            <th class="pconly">更新日</th>
            <th>削除</th>
        </tr>
        <?php  for ($i = 0; $i < count($docs); $i++) : ?>
            <tr>
                <form action="" method="post" name="docs<?= h($i); ?>">
                    <input type="hidden" name="from" value="del">
                    <input type="hidden" name="id" value="<?= h($docs[$i]->id); ?>">
                    <input type="hidden" name="fname" value="<?= h($docs[$i]->name); ?>">
                    <td class="hidden"><?= h($docs[$i]->id); ?></td>
                    <td><a href="?download=<?= h($docs[$i]->name); ?>"><?= h($docs[$i]->name); ?></a></td>
                    <td><?= h($docs[$i]->category); ?></td>
                    <td class="pconly"><?= h($docs[$i]->created);  ?></td>
                    <td class="pconly"><?= h($docs[$i]->modified); ?></td>
                    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
                    <td><input type="submit" value="削除" onclick="return ConfirmDel('<?= h($docs[$i]->name); ?>', '<?= h($docs[$i]->id); ?>');"></td>
                </form>
            </tr>
        <?php endfor; ?>

    <?php else: ?>
        <h1>データが存在しません。</h1>
    <?php endif; ?>
</table>