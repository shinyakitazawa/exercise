<?php


    $usersModel = new \MyApp\Model\MasterMente\UsersTable();

    // 追加処理
    if ($_POST['from'] == 'add') {
        $usersModel->Insert($_POST);
    }

    // 削除処理
    if ($_POST['from'] == 'del') {
        $usersModel->Delete($_POST['id']);
    }

    $datas = $usersModel->Select();
    $this->setValue('users', $datas);
?>