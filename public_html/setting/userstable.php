<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/config.php');

$app = new MyApp\Controller\MasterMente\MasterMente();

$app->run();

?>

<table border="2">
    <tr>
        <th class="hidden">id</th>
        <th>ユーザーID</th>
        <th>パスワード</th>
        <th>権限</th>
        <th>削除</th>
    </tr>

    <?php $datas = $app->getValue()->users ?>
    <?php if (is_array($datas)) : ?> 
        <?php  for ($i = 0; $i < count($datas); $i++) : ?>
            <tr>
                <form action="" method="post" name="names<?= h($i); ?>">
                    <input type="hidden" name="from" value="del">
                    <input type="hidden" name="kind" value="users">
                    <input type="hidden" name="id" value="<?= h($datas[$i]->id); ?>">
                    <td><?= h($datas[$i]->email); ?></td>
                    <td>******</td>
                    <td><?= h($datas[$i]->authority); ?></td>
                    <input type="hidden" name="token" value="<?= h($_SESSION['token']); ?>">
                    <td><input type="submit" value="削除"  onclick="return ConfirmDelUsers('<?= h($datas[$i]->id); ?>');"></td>
                </form>
            </tr>
        <?php endfor; ?>
    <?php endif; ?>
</table>
